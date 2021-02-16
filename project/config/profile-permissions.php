<?php

use App\Enums\UserRolesEnum;

return [
    UserRolesEnum::ADMIN => [
        'users' => [
            'create admin',
            'edit admin',
            'show admin',
            'list admin',
            'delete admin',
            'create client',
            'edit client',
            'show client',
            'list client',
            'delete client',
            'forbid client',
            'allow client',
            'create voluntary',
            'edit voluntary',
            'show voluntary',
            'list voluntary',
            'delete voluntary',
        ],

        'sources' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'stays' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'meals' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'donations' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'categories' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'units' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'profile' => [
            'edit admin',
        ],
    ],

    UserRolesEnum::VOLUNTARY => [
        'profile' => [
            'edit client',
        ],

        'stays' => [
            'create',
            'edit',
            'list',
            'delete',
        ],

        'meals' => [
            'create',
            'edit',
            'list',
            'delete',
        ],
    ],
];
