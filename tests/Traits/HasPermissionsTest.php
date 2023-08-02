<?php

use Ahrengot\RolesAndPermissions\Traits\HasPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

beforeAll(function () {
    enum UserRole: string
    {
        case User = 'user';
    }

    class User extends Authenticatable
    {
        use HasPermissions;

        public function role(): Illuminate\Database\Eloquent\Casts\Attribute
        {
            return Illuminate\Database\Eloquent\Casts\Attribute::get(fn () => UserRole::User);
        }
    }
});

beforeEach(
    fn () => config()->set('permissions.roles.'.UserRole::User->value, [])
);

it('provides a collection of permissions')
    ->expect(fn () => new User)
    ->permissions
    ->toBeInstanceOf(Collection::class);

it('registers configured permissions as gates', function () {
    expect((new User)->can('go fish'))->toBeFalse();

    config()->set('permissions.roles.'.UserRole::User->value, [
        'go fish',
    ]);

    expect((new User)->can('go fish'))->toBeTrue();
});

it('registers temporary permissions as gates', function () {
    $user = new User;

    expect($user->can('go fish'))->toBeFalse();

    $user->grantTemporaryPermission('go fish');

    expect($user->can('go fish'))->toBeTrue();
});

it('overwrites default permissions config', function () {
    class ModelWithCustomPermissions extends Authenticatable
    {
        use HasPermissions;

        protected function permissionsConfig(): array
        {
            return ['foo', 'bar', 'baz'];
        }
    }

    expect(new ModelWithCustomPermissions)
        ->permissions
        ->toEqual(
            collect(['foo', 'bar', 'baz'])
        );
});
