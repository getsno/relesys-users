<?php

namespace Getsno\Relesys\Traits;

trait CreatableFromArray
{
    use FillableTrait;

    public static function fromArray(array $data): static
    {
        return (new static())->fill($data);
    }
}
