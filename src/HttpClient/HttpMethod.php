<?php

namespace Getsno\Relesys\HttpClient;

enum HttpMethod: string
{
    CASE Get = 'get';
    CASE Post = 'post';
    CASE Put = 'put';
    CASE Patch = 'patch';
    CASE Delete = 'delete';
}
