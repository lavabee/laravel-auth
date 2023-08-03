<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Connection
    |--------------------------------------------------------------------------
    |
    | You can set a different database connection for this package. It will set
    | new connection for models Role and Permission. When this option is null,
    | it will connect to the main database, which is set up in database.php
    |
    */

    'connection'            => null,
    'rolesTable'            => 'roles',
    'roleUserTable'         => 'role_user',
    'permissionsTable'      => 'permissions',
    'permissionsRoleTable'  => 'permission_role',
    'permissionsUserTable'  => 'permission_user',

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `LavaBee\LaravelAuth\Models\Role` model and
    | `LavaBee\LaravelAuth\Models\Permission` model.
    |
    */

    'models' => [
        'role'          => LavaBee\LaravelAuth\Models\Role::class,
        'permission'    => LavaBee\LaravelAuth\Models\Permission::class,
        'defaultUser'   =>  config('auth.providers.users.model'),
    ],


    /*
    |--------------------------------------------------------------------------
    | Roles, Permissions and Allowed "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods hasRole(), hasPermission() and allowed() return.
    |
    */

    'pretend' => [
        'enabled' => false,
        'options' => [
            'hasRole'       => true,
            'hasPermission' => true,
            'allowed'       => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Register 'role', 'permission', 'level' route middlewares
    |--------------------------------------------------------------------------
    */

    'route_middlewares' => true,
];
