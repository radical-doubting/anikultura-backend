<?php

namespace App\Actions\Insights;

use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCensusMetric
{
    use AsAction;

    public function handle(
        $model,
        string $measurementName,
        array $tags = [],
        string $fieldName = 'count',
        int $increment = 1
    ) {
        $newCount = RetrieveModelCount::run(
            $model,
            $tags,
            $fieldName,
            $increment
        );

        $point = Point::measurement($measurementName)
            ->addField($fieldName, $newCount)
            ->time(time());

        foreach ($tags as $tag => $property) {
            $sluggableProperty = $model;
            $tagParts = explode('.', $tag);

            foreach ($tagParts as $tagPart) {
                $sluggableProperty = $sluggableProperty->$tagPart;
            }

            $point = $point->addTag(end($tagParts), $sluggableProperty->slug);
        }

        CreateInsightMetric::run([$point]);
    }
}
