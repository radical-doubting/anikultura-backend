<?php

namespace App\Actions\Insights;

use App\Helpers\MetricPropertyHelper;
use Illuminate\Support\Str;
use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCensusMetric
{
    use AsAction;

    public function handle(array $properties)
    {
        $results = RetrieveModelAggregate::run($properties);
        $newCount = $results['count'];
        $model = $results['model'];

        $measurementName = MetricPropertyHelper::getPointProperty($properties, 'measurement');
        $fieldName = MetricPropertyHelper::getPointProperty($properties, 'field', 'count');
        $tags = MetricPropertyHelper::getPointProperty($properties, 'tags', []);

        $point = Point::measurement($measurementName)
            ->addField($fieldName, $newCount)
            ->time(time());

        foreach ($tags as $tag => $property) {
            $sluggableProperty = $model;
            $tagParts = explode('.', Str::camel($tag));

            foreach ($tagParts as $tagPart) {
                $sluggableProperty = $sluggableProperty->$tagPart;
            }

            $lastTagPart = end($tagParts);
            $point = $point->addTag(Str::kebab($lastTagPart), $sluggableProperty->slug);
        }

        CreateInsightMetric::run([$point]);
    }
}
