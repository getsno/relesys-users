<?php

namespace Getsno\Relesys\Api;

enum PatchOperation: string
{
    case Add = 'add';
    case Remove = 'remove';
    case Replace = 'replace';
    case Test = 'test';
    case Move = 'move';
    case Copy = 'copy';
}
