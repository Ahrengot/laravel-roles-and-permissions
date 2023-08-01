<?php

namespace Ahrengot\RolesAndPermissions\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPermissions
{
    protected array $temporaryPermissions = [];

    /**
     * Returns the permissions for this model
     */
    protected function permissionsConfig(): array
    {
        return config('user-permissions.roles')[$this->role->value]['permissions'];
    }

    public function permissions(): Attribute
    {
        return Attribute::get(
            fn () => collect($this->temporaryPermissions)->merge($this->permissionsConfig())
        );
    }

    /**
     * Grants temporary permissions which is useful for
     * testing authorization and policies
     */
    public function grantTemporaryPermission(string $permission): void
    {
        $this->temporaryPermissions[] = $permission;
    }
}
