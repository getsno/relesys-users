<?php

namespace Getsno\Relesys\Api;

enum PatchOperation: string
{
    case ADD = 'add';
    case REMOVE = 'remove';
    case REPLACE = 'replace';
    case TEST = 'test';
    case MOVE = 'move';
    case COPY = 'copy';
}
