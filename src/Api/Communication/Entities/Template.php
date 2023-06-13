<?php

namespace Getsno\Relesys\Api\Communication\Entities;

use Carbon\Carbon;
use Getsno\Relesys\Api\ApiEntity;
use Getsno\Relesys\Api\Communication\ValueObjects\TemplateCultures;

class Template extends ApiEntity
{
    public string $id;
    public string $name;

    /**
     * @var TemplateCultures[]
     */
    public array $communicationTemplateCultures;
    public Carbon $creationDateTime;
    public ?Carbon $lastModifiedDateTime;

    protected function setCreationDateTime(string $dateTime): void
    {
        $this->creationDateTime = Carbon::parse($dateTime);
    }

    protected function setLastModifiedDateTime(string $dateTime): void
    {
        $this->lastModifiedDateTime = Carbon::parse($dateTime);
    }
}
