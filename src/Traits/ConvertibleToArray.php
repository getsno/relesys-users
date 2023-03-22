<?php

namespace Getsno\Relesys\Traits;

trait ConvertibleToArray
{
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        $toArrayIfObject = static function (mixed $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                return $value->toArray();
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
