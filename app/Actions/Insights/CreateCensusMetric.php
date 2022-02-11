<?php

namespace App\Actions\Insights;

use InfluxDB2\Point;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCensusMetric
{
    use AsAction;

    public function handle($model, string $measurementName, array $tags = [])
    {
        $newCount = RetrieveModelCount::run(
            $model,
            $tags
        );

        $point = Point::measurement($measurementName)
            ->addField('count', $newCount)
            ->time(time());

        foreach ($tags as $tag => $_) {
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
