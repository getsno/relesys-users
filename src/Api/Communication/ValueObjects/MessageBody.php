<?php

namespace Getsno\Relesys\Api\Communication\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class MessageBody
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly ?TemplateSms $sms;
    public readonly ?TemplateEmail $email;

    protected function setSms(array $data): void
    {
        $this->sms = TemplateSms::fromArray($data);
    }

    protected function setEmail(array $data): void
    {
        $this->email = TemplateEmail::fromArray($data);
    }
}
