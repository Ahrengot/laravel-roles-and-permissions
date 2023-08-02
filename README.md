# User roles and permissions for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahrengot/laravel-roles-and-permissions.svg?style=flat-square)](https://packagist.org/packages/ahrengot/laravel-roles-and-permissions)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ahrengot/laravel-roles-and-permissions/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ahrengot/laravel-roles-and-permissions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ahrengot/laravel-roles-and-permissions/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ahrengot/laravel-roles-and-permissions/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ahrengot/laravel-roles-and-permissions.svg?style=flat-square)](https://packagist.org/packages/ahrengot/laravel-roles-and-permissions)

Roles and permissions for laravel

## Installation

Install the package via composer

```bash
composer require ahrengot/laravel-roles-and-permissions
```

Run the install command to publish the migration, stubs, config file and a basic test

```bash
php artisan roles-and-permissions:install
```

Run the migration to add a `role` column to your users table. Feel free to modify this migration as needed.

```bash
php artisan migrate
```

## Configuring your User model

Add the `HasPermissions` trait to your user model and an enum cast for the role column. Optionally you can add a default value for the role using the built-in `$attributes` property.
```php
use \Ahrengot\RolesAndPermissions\Traits\HasPermissions;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasPermissions;
    
    protected $casts = [
        'role' => UserRole::class,
    ];
    
    // Optional default role
    protected $attributes = [
        'role' => UserRole::User,
    ]
}
```

## Configuring roles and permissions

Your permissions are configured in `config/permissions.php`. 

User roles are defined in `App\Enums\UserRole.php`. Update these roles to fit your application needs.

Permissions are just simple strings, but this package provides a helper class in `App/Permissions/Permission.php` that declare each permission as a constant. This provides better editor support and helps prevent typos.

The config file contains an example of defining various permissions for each user role:

```php
return [
    'roles' => [
        UserRole::Admin->value => [
            Permission::AccessAdminPanel,
            Permission::CreateApiTokens,
        ],
    ],
];
```

## Usage

In blade
```html
<nav>
    @can(Permission::AccessAdminPanel)
        <a href="...">Admin panel</a>
    @endcan
    <a href="...">Other link</a>
</nav>
```

In policies
```php
public function create(User $user)
{
    return $user->can(Permission::CreatePosts);
}
```

## Comparing user roles

The UserRole enum has two simple comparison methods

```php
    $user->role->is(UserRole::Admin);
    
    $user->role->isNot(UserRole::Admin);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jens Ahrengot Boddum](https://github.com/ahrengot)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
