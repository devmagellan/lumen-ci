# WGTCRM Backend

## Patterns used

 * [PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

 * [GraphQL pattern](https://graphql.org) (package: [nuwave/lighthouse](https://lighthouse-php.com/))

 * [Service layer pattern](https://en.wikipedia.org/wiki/Service_layer_pattern)

 * [Repository pattern](https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5) (package: [prettus/l5-repository](https://github.com/andersao/l5-repository))


## Local Dev installation

### 1. Download Project

Clone the project:

```
git clone https://github.com/WGT-hq/wgtcrm-backend.git
```

And access `wgtcrm-backend` directory.

### 2. Configure your development environment

You must copy the .env.example file to a new file named .env

```
cp .env.example .env
```

### 3. Download and start the containers

[Docker-compose](https://docs.docker.com/compose/install/) must be installed.

Run the following command in your terminal:

```
docker-compose up -d
```

### 4. Access container terminal

```
docker-compose exec wgtcrm-php bash
```

### 5. Download PHP Composer dependencies

```
composer update
```
### 6. Build your database - Run migrations

```
php artisan migrate
```

6.1. Refresh the database and run all database seeds

```
php artisan migrate:refresh --seed
```

### 7. Preloading data (optional)

7.1. Executing All Seeders

```
php artisan db:seed
```

7.2. Executing Individual Seeder

```
php artisan db:seed --class=UsersSeeder
php artisan db:seed --class=ProfanitySeeder
```

### 8. Usage

Open your GraphQL client and run the following query:

```
{
    hello
}
```

The response will be:
```
{
    "data": {
        "hello": "it is working!"
    }
}
```

If you choose to use [Insomnia](https://insomnia.rest/) as a Graphql Client, you can import a `.json` file ([docs/insomnia](https://github.com/world-gem-trade/wgtcrm-backend/tree/develop/docs/insomnia)) contains a lot of requests.

### Extra commands

#### Regenerate Composer's autoloader:

```
composer -o dump-autoload
```

### Library Reference

#### Setting log for all activities

You need to do is let your model use the `Spatie\Activitylog\Traits\LogsActivity` trait.

You can log the changed attributes for events such as create, update or delete when setting `$logAttributes` and `$logOnlyDirty` properties on the model.

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'text'];

    protected static $logFillable = true;

    protected static $logOnlyDirty = true;
}
```

If you want to log changes to specific attributes of the model, you can specify `protected static $logAttributes = ['name', 'text']` instead of `$logFillable`.

More details: [laravel-activitylog](https://docs.spatie.be/laravel-activitylog/v3/introduction/)


#### Offensive words

To enable offensive words for a model, use the `WGT\Models\Traits\ProfanityFilter` trait on the model:

```php
<?php

namespace WGT\Models;

use Illuminate\Database\Eloquent\Model;
use WGT\Traits\ProfanityFilter;

class MyModel extends Model
{
    use ProfanityFilter;
}
```

By default, it is checked all fields of your model.

If you wish to use specific fields you must set the public `$profanityFields` property on your model:

```php
/**
 * Profanity fields for the model.
 *
 * @var array
 */
protected $profanityFields = ['title', 'description'];
```

But if you prefer to ignore some fields, you can add `$ignoreProfanity` property in your model.

```php
/**
 * Ignore the profanity fields for the model.
 *
 * @var array
 */
protected $profanityFields = ['comments'];
```

#### Roles and permissions

To allow access control to each request, we must insert the call `@middleware`, informing the necessary permission to access it.
```graphql
extend type Query @middleware(checks: ["auth"]) {
    firms: [Firm]!
        @field(resolver: "FirmQuery@all")
        @middleware(checks: ["permission:list-firms"])
```

Role and permission seeds must be fed and run with each new role/permission in the system.
```php
    // config/permissions.php

    // php artisan db:seed --class=PermissionSeeder

    // php artisan db:seed --class=RoleSeeder

    'permissions' => [

        'roles' => [
            'list' => 'list-roles',
            'view' => 'view-roles',
            'create' => 'create-roles',
            'update' => 'update-roles',
            'delete' => 'delete-roles',
            'give-permission' => 'give-permission-to-roles',
            'revoke-permission' => 'revoke-permission-to-roles',
        ],
```

By default, a `adm@worldgemtrade` user will be created with the `super-admin` role. Only he should have that role.

By default, a `dev@worldgemtrade` user will be created with the `owner-admin` role. However, that user will be created only when the seed is run outside the production environment.

By default, only the `super-admin` can create and edit roles and permissions. However, all users of the `owner-admin` role can give and revoke permissions for other users.

By default, the `owner-admin` have all permissions, except roles and permissions.