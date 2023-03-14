<?php

namespace Getsno\Relesys;

class Relesys
{
    private string $token;

    public function __construct()
    {
        $this->token = random_int(1, 100);
    }

    // public static function getInstance(): self
    // {
    //     if (!self::$instance) {
    //         self::$instance = new self();
    //     }
    //
    //     return self::$instance;
    // }

    public function getToken(): string
    {
        return $this->token;
    }
}
