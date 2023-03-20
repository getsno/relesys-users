<?php

namespace Getsno\Relesys\Traits;

use ReflectionProperty;
use Illuminate\Support\Str;

trait FillableTrait
{
    public function fill(array|object $data): self
    {
        $data = is_object($data) ? get_object_vars($data) : $data;

        foreach ($data as $key => $value) {
            if (property_exists(__CLASS__, $key)) {
                $setter = 'set' . Str::ucfirst($key);
                if (method_exists(__CLASS__, $setter)) {
                    $this->$setter($value);
                } else {
                    $this->$key = $value;
                }
            }
        }

        return $this;
    }

    public static function fromArray(array $data): self
    {
        return (new self())->fill($data);
    }
}
