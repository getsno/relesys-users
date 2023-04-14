<?php

namespace Getsno\Relesys\Traits;

use Illuminate\Support\Str;

trait FillableTrait
{
    public function fill(array|object $data): self
    {
        $data = is_object($data) ? get_object_vars($data) : $data;

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $setter = 'set' . Str::ucfirst($key);
                if ($value !== null && method_exists($this, $setter)) {
                    $this->$setter($value);
                } else {
                    $this->$key = $value;
                }
            }
        }

        return $this;
    }
}
