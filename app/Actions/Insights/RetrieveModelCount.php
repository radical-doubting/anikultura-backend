<?php

namespace App\Actions\Insights;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveModelCount
{
    use AsAction;

    public function handle(
        $model,
        array $tags = [],
        string $fieldName = 'count',
        int $increment = 1
    ) {
        $dotModel = $this->createDotModel($model, $tags);
        $key = $this->retrieveKey($model, $tags, $fieldName, $dotModel);

        $lastCount = $this->retrieveLastCount($model, $tags, $key, $dotModel);
        $newCount = $lastCount + $increment;

        Cache::put($key, $newCount);

        return $newCount;
    }

    private function createDotModel($model, array $tags)
    {
        $clonedModel = $model->replicate();

        foreach ($tags as $tag => $property) {
            $clonedModel = $clonedModel->with($tag);
        }

        $clonedModel = $clonedModel->first();

        return Arr::dot($clonedModel->toArray());
    }

    private function retrieveKey($model, array $tags, string $fieldName, array $dotModel)
    {
        $key = $model->getTable();

        if (empty($tags)) {
            return $key;
        }

        $ids = [];

        foreach ($tags as $tag => $property) {
            $ids[] = $dotModel["$tag.$property"];
        }

        return "$key:$fieldName:" . implode(':', $ids);
    }

    private function retrieveLastCount($model, array $tags, string $key, array $dotModel)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        return $this->retrieveLastCountFromDatabase($model, $tags, $dotModel);
    }

    private function retrieveLastCountFromDatabase($model, array $tags, $dotModel)
    {
        $masterQuery = null;

        foreach ($tags as $tag => $property) {
            $masterQuery = $model->whereHas(
                $tag,
                function ($query) use ($tag, $property, $dotModel) {
                    $query->where($property, $dotModel["$tag.$property"]);
                }
            );
        }

        return $masterQuery->count();
    }
}
