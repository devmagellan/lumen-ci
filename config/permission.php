<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',
    ],

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * When checking for a permission against a model by passing a Permission
         * instance to the check, this key determines what attribute on the
         * Permissions model is used to cache against.
         *
         * Ideally, this should match your preferred way of checking permissions, eg:
         * `$user->can('view-posts')` would be 'name'.
         */

        'model_key' => 'name',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],

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

        'permissions' => [
            'list' => 'list-permissions',
            'view' => 'view-permissions',
            'create' => 'create-permissions',
            'update' => 'update-permissions',
            'delete' => 'delete-permissions',
        ],

        'users' => [
            'view-me' => 'view-me-users',
            'update-me' => 'update-me-users',
            'list' => 'list-users',
            'view' => 'view-users',
            'create' => 'create-users',
            'update' => 'update-users',
            'delete' => 'delete-users',
            'assign-role' => 'assign-role-to-users',
            'remove-role' => 'remove-role-to-users',
            'give-permission' => 'give-permission-to-users',
            'revoke-permission' => 'revoke-permission-to-users',
        ],

        'firms' => [
            'list' => 'list-firms',
            'view' => 'view-firms',
            'create' => 'create-firms',
            'update' => 'update-firms',
            'delete' => 'delete-firms',
            'attach-employee' => 'attach-employee-to-firms',
            'detach-employee' => 'detach-employee-to-firms',
        ],

        'positions' => [
            'list' => 'list-positions',
            'view' => 'view-positions',
            'create' => 'create-positions',
            'update' => 'update-positions',
            'delete' => 'delete-positions',
            'give-permission' => 'give-permission-to-positions',
            'revoke-permission' => 'revoke-permission-to-positions',
        ],

        'profanities' => [
            'list' => 'list-profanities',
            'view' => 'view-profanities',
            'create' => 'create-profanities',
            'update' => 'update-profanities',
            'ignore-list' => 'list-ignore-profanities',
            'ignore-view' => 'view-ignore-profanities',
            'ignore-create' => 'create-ignore-profanities',
            'ignore-update' => 'update-ignore-profanities',
            'logs' => 'list-log-profanities',
        ],

        'currencies' => [
            'list' => 'list-currencies',
            'view' => 'view-currencies',
            'create' => 'create-currencies',
            'update' => 'update-currencies',
            'delete' => 'delete-currencies',
            'converter' => 'converter-currencies',
            'converter-via-user' => 'converter-via-user-currencies',
        ],
        'properties' => [
            'list' => 'list-properties',
            'view' => 'view-properties',
            'create' => 'create-properties',
            'update' => 'update-properties',
            'delete' => 'delete-properties',
        ],
        'propertyItems' => [
            'list' => 'list-propertyItems',
            'view' => 'view-propertyItems',
            'create' => 'create-propertyItems',
            'update' => 'update-propertyItems',
            'delete' => 'delete-propertyItems',
        ],

        'categories' => [
            'list' => 'list-categories',
            'view' => 'view-categories',
            'create' => 'create-categories',
            'update' => 'update-categories',
            'delete' => 'delete-categories',
        ],

        'products' => [
            'list' => 'list-products',
            'view' => 'view-products',
            'create' => 'create-products',
            'update' => 'update-products',
            'delete' => 'delete-products',
            'attach-firm' => 'attach-firm-to-products',
            'detach-firm' => 'detach-firm-to-products',
        ],

        'templates' => [
            'list' => 'list-templates',
            'view' => 'view-templates',
            'create' => 'create-templates',
            'update' => 'update-templates',
            'delete' => 'delete-templates'
        ],

    ],

];
