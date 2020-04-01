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
            'create voluntary',
            'edit voluntary',
            'show voluntary',
            'list voluntary',
            'delete voluntary',
        ],

        'profile' => [
            'edit admin',
        ],
    ],

    UserRolesEnum::VOLUNTARY => [
        'profile' => [
            'edit client',
        ],
    ],
];
