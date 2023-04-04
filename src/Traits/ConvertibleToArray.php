<?php

namespace Getsno\Relesys\Traits;

use UnitEnum;

trait ConvertibleToArray
{
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        $toArrayIfObject = static function (mixed $value) {
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
                $result[$property] = array_map(static fn(mixed $item) => $toArrayIfObject($item), $value);
            } else {
                $result[$property] = $toArrayIfObject($value);
            }
        }

        return $result;
    }
}
