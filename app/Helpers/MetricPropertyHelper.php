<?php

namespace App\Helpers;

use Exception;

class MetricPropertyHelper
{
    public static function getModelProperty(array $properties, string $propertyName, $defaultValue = null)
    {
        $modelProperties = $properties['model'];

        if (is_null($modelProperties)) {
            throw new Exception('Model property is null');
        }

        if (!array_key_exists($propertyName, $modelProperties)) {
            if (is_null($defaultValue)) {
                throw new Exception("Model value property '$propertyName' is null");
            }

            $propertyValue = $defaultValue;
        } else {
            $readValue = $modelProperties[$propertyName];
            $propertyValue = is_null($readValue) ? $defaultValue : $readValue;
        }

        return $propertyValue;
    }

    public static function getPointProperty(array $properties, string $propertyName, $defaultValue = null)
    {
        $pointProperties = $properties['point'];

        if (is_null($pointProperties)) {
            throw new Exception('Point value is null');
        }

        if (!array_key_exists($propertyName, $pointProperties)) {
            if (is_null($defaultValue)) {
                throw new Exception("Point value property '$propertyName' is null");
            }

            $propertyValue = $defaultValue;
        } else {
            $readValue = $pointProperties[$propertyName];
            $propertyValue = is_null($readValue) ? $defaultValue : $readValue;
        }

        return $propertyValue;
    }
}
