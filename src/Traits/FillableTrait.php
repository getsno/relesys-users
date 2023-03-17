<?php

namespace Getsno\Relesys\Traits;

use Illuminate\Support\Str;

trait FillableTrait
{
    public function fill(array|object $data): self
    {
        $array = is_object($data) ? get_object_vars($data) : $data;

        foreach ($array as $key => $value) {
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
}
