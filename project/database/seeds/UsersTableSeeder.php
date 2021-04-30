<?php

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $user = User::firstOrNew([
            'email' => 'admin@email.com',
        ]);

        $user->fill([
            'name' => 'Admin',
            'password' => \Hash::make('12345678')
        ]);

        $user->save();
        $user->assignRole(UserRolesEnum::ADMIN);

        $user = User::firstOrNew([
            'email' => 'voluntario@email.com',
        ]);

        $user->fill([
            'name' => 'Voluntário',
            'password' => \Hash::make('12345678')
        ]);

        $user->save();
        $user->assignRole(UserRolesEnum::VOLUNTARY);


        $user = User::firstOrNew([
            'email' => 'pedrohsida@hotmail.com',
        ]);

        $user->fill([
            'name' => 'Administrador',
            'password' => \Hash::make('josecuervo')
        ]);

        $user->save();
        $user->assignRole(UserRolesEnum::ADMIN);

    }
}
