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
            'create voluntary',
            'edit voluntary',
            'show voluntary',
            'list voluntary',
            'delete voluntary',
        ],

        'clients' => [
            'create',
            'edit',
            'show',
            'list',
            'delete',
            'forbid',
            'allow',
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
            'import',
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
            'edit voluntary',
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
        'clients' => [
            'create',
            'edit',
            'show',
            'list',
            'delete',
            'forbid',
            'allow',
        ],
    ],
];
