<?php

function test($str, array $constructor = [], Closure $mock = null) {
    // var_dump(...func_get_args());
    var_dump(...array_filter(func_get_args()));
}

test('string', [], fn() => 'lol');

