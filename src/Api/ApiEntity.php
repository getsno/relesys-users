<?php

namespace Getsno\Relesys\Api;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

abstract class ApiEntity
{
    use CreatableFromArray;
    use ConvertibleToArray;

    /**
     * The original decoded API response on which the entity is based.
     */
    public readonly array $source;

    public function setSource(array $source): self
    {
        $this->source = $source;

        return $this;
    }
}
