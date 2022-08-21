<?php

namespace App\Actions\Insights;

use App\Helpers\MetricPropertyHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

/**
 * Aggregates a model from cache. Supported aggregation types: `count` and `sum`.
 */
class RetrieveModelAggregate
{
    use AsAction;

    public function handle(array $properties)
    {
        $tags = MetricPropertyHelper::getPointProperty($properties, 'tags', []);
        $fieldName = MetricPropertyHelper::getPointProperty($properties, 'field', 'count');
        $shouldIncrement = MetricPropertyHelper::getPointProperty($properties, 'increment', true);

        $modelId = MetricPropertyHelper::getModelProperty($properties, 'id');
        $modelClass = MetricPropertyHelper::getModelProperty($properties, 'class');
        $aggregation = MetricPropertyHelper::getModelProperty($properties, 'aggregation', [
            'type' => 'count',
            'column' => '*',
        ]);

        $hydratedModel = $this->retrieveHydratedModel($modelId, $modelClass, $tags);
        $flatModel = $this->retrieveFlatModel($hydratedModel);

        $tableName = $hydratedModel->getTable();
        $key = $this->retrieveKey($tableName, $tags, $fieldName, $flatModel);

        $newCount = $this->retrieveNewCount($modelClass, $flatModel, $tags, $key, $aggregation, $shouldIncrement);

        Cache::put($key, $newCount);

        return ['count' => $newCount, 'model' => $hydratedModel];
    }

    private function retrieveHydratedModel(int $modelId, $modelClass, array $tags)
    {
        $model = $modelClass::query();

        foreach ($tags as $tag => $property) {
            $model = $model->with(Str::camel($tag));
        }

        return $model->find($modelId);
    }

    private function retrieveFlatModel($model)
    {
        return Arr::dot($model->toArray());
    }

    private function retrieveKey(
        string $tableName,
        array $tags,
        string $fieldName,
        array $flatModel
    ) {
        $key = $tableName;

        if (empty($tags)) {
            return $key;
        }

        $ids = [];

        foreach ($tags as $tag => $property) {
            $ids[] = $flatModel["$tag.$property"];
        }

        return "$key:$fieldName:".implode(':', $ids);
    }

    private function retrieveNewCount(
        $modelClass,
        array $flatModel,
        array $tags,
        string $key,
        array $aggregation,
        bool $shouldIncrement
    ) {
        $lastCount = $this->retrieveLastCount($modelClass, $flatModel, $tags, $key, $aggregation);
        $offset = $this->retrieveOffset($flatModel, $key, $aggregation);

        $offsetSign = $shouldIncrement ? 1 : -1;
        $newCount = $lastCount + ($offset * $offsetSign);

        return $newCount < 0 ? 0 : $newCount;
    }

    private function retrieveOffset(array $flatModel, string $key, array $aggregation)
    {
        /*
         * Do not offset when retrieving from database since it already has offsetted values.
         */
        if (! Cache::has($key)) {
            return 0;
        }

        $type = $aggregation['type'];
        $column = $aggregation['column'];

        switch ($type) {
            case 'count':
                return 1;
            case 'sum':
                return $flatModel[$column];
        }
    }

    private function retrieveLastCount(
        $modelClass,
        array $flatModel,
        array $tags,
        string $key,
        array $aggregation
    ) {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return $this->retrieveLastCountFromDatabase($modelClass, $flatModel, $tags, $aggregation);
    }

    private function retrieveLastCountFromDatabase(
        $modelClass,
        array $flatModel,
        array $tags,
        array $aggregation
    ) {
        $masterQuery = $modelClass::query();

        foreach ($tags as $tag => $property) {
            $masterQuery = $masterQuery->whereHas(
                Str::camel($tag),
                function ($query) use ($tag, $property, $flatModel) {
                    $query->where($property, $flatModel["$tag.$property"]);
                }
            );
        }

        $type = $aggregation['type'];
        $column = $aggregation['column'];

        return $masterQuery->$type($column);
    }
}
