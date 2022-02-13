<?php

namespace App\Actions\Insights;

use App\Helpers\MetricPropertyHelper;
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
            $tagParts = explode('.', $tag);

            foreach ($tagParts as $tagPart) {
                $sluggableProperty = $sluggableProperty->$tagPart;
            }

            $point = $point->addTag(end($tagParts), $sluggableProperty->slug);
        }

        CreateInsightMetric::run([$point]);
    }
}
