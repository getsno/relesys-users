<?php

namespace Getsno\Relesys\Api;

class BatchResponse
{
    public function __construct(
        public readonly int $count,
        public readonly array $data,
        public readonly ?string $nextUrl = null,
        public readonly ?string $previousUrl = null,
    ) {}
}
