<?php

namespace Ahrengot\RolesAndPermissions\Contracts;

interface Comparable
{
    public function is(mixed $other): bool;

    public function isNot(mixed $other): bool;
}
