<?php

namespace App\Actions\Insights;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * Aggregates a model from cache. Supported aggregation types: `count` and `sum`.
 */
class RetrieveModelAggregate
{
    use AsAction;

    public function handle(
        $model,
        array $tags = [],
        string $fieldName = 'count',
        array $aggregation = ['type' => 'count', 'column' => '*'],
    ) {
        $hydratedModel = $this->createHydratedModel($model, $tags);
        $key = $this->retrieveKey($model, $tags, $fieldName, $hydratedModel);

        $lastCount = $this->retrieveLastCount($model, $tags, $key, $aggregation, $hydratedModel);
        $increment = $this->retrieveIncrement($aggregation, $hydratedModel);

        $newCount = $lastCount + $increment;

        Cache::put($key, $newCount);

        return $newCount;
    }

    private function createHydratedModel($model, array $tags)
    {
        $clonedModel = $model->replicate();

        foreach ($tags as $tag => $property) {
            $clonedModel = $clonedModel->with($tag);
        }

        $clonedModel = $clonedModel->first();

        return Arr::dot($clonedModel->toArray());
    }

    private function retrieveKey(
        $model,
        array $tags,
        string $fieldName,
        array $hydratedModel
    ) {
        $key = $model->getTable();

        if (empty($tags)) {
            return $key;
        }

        $ids = [];

        foreach ($tags as $tag => $property) {
            $ids[] = $hydratedModel["$tag.$property"];
        }

        return "$key:$fieldName:" . implode(':', $ids);
    }

    private function retrieveIncrement(array $aggregation, $hydratedModel)
    {
        $type = $aggregation['type'];
        $column = $aggregation['column'];

        switch ($type) {
            case 'count':
                return 1;
            case 'sum':
                return $hydratedModel[$column];
        }
    }

    private function retrieveLastCount(
        $model,
        array $tags,
        string $key,
        array $aggregation,
        array $hydratedModel
    ) {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return $this->retrieveLastCountFromDatabase($model, $tags, $aggregation, $hydratedModel);
    }

    private function retrieveLastCountFromDatabase(
        $model,
        array $tags,
        array $aggregation,
        $hydratedModel
    ) {
        $masterQuery = null;

        foreach ($tags as $tag => $property) {
            $masterQuery = $model->whereHas(
                $tag,
                function ($query) use ($tag, $property, $hydratedModel) {
                    $query->where($property, $hydratedModel["$tag.$property"]);
                }
            );
        }

        $type = $aggregation['type'];
        $column = $aggregation['column'];

        return $masterQuery->$type($column);
    }
}
