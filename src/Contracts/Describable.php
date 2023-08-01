<?php

namespace Ahrengot\RolesAndPermissions\Contracts;

interface Describable
{
    /**
     * Human-readable description
     */
    public function description(): string;
}
