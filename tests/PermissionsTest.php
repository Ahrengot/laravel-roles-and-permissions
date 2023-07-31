<?php

use Ahrengot\RolesAndPermissions\Enums\UserRole;
use Ahrengot\RolesAndPermissions\Models\Traits\HasPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

beforeAll(function () {
    class User extends Authenticatable
    {
        use HasPermissions;

        public function role(): Illuminate\Database\Eloquent\Casts\Attribute
        {
            return Illuminate\Database\Eloquent\Casts\Attribute::get(fn () => UserRole::User);
        }
    }
});

it('provides a collection of permissions on the user model')
    ->expect(fn () => new User)
    ->permissions
    ->toBeInstanceOf(Collection::class);

it('registers user permissions as gates', function () {
    $user = new User;

    expect($user->can('go fish'))->toBeFalse();

    $user->grantPermission('go fish');

    expect($user->can('go fish'))->toBeTrue();
});

it('can overwrite default permissions', function () {
    class ThingWithPermissions extends Authenticatable
    {
        use HasPermissions;

        protected function permissionsConfig(): array
        {
            return ['foo', 'bar', 'baz'];
        }
    }

    expect(new ThingWithPermissions)
        ->permissions
        ->toEqual(
            collect(['foo', 'bar', 'baz'])
        );
});
