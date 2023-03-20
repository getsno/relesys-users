<?php

namespace Getsno\Relesys\HttpClient;

enum HttpMethod: string
{
    CASE GET = 'get';
    CASE POST = 'post';
    CASE PUT = 'put';
    CASE PATCH = 'patch';
    CASE DELETE = 'delete';
}
