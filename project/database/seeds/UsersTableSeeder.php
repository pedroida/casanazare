<?php

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
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
