<?php

namespace Getsno\Relesys\Traits;

use UnitEnum;
use Carbon\Carbon;

trait ConvertibleToArray
{
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        $toPrimitiveIfObject = static function (mixed $value): mixed {
            // get formatted datetime value
            if ($value instanceof Carbon) {
                return $value->format('m-d-Y');
            }

            if (is_object($value) && method_exists($value, 'toArray')) {
                return $value->toArray();
            }

            // get value/name if instance of enum
            if ($value instanceof UnitEnum) {
                return property_exists($value, 'value') ? $value->value : $value->name;
            }

            return $value;
        };

        $result = [];
        foreach ($properties as $property => $value) {
            if (is_array($value)) {
                $result[$property] = array_map(static fn(mixed $item) => $toPrimitiveIfObject($item), $value);
            } else {
                $result[$property] = $toPrimitiveIfObject($value);
            }
        }

        return $result;
    }
}
