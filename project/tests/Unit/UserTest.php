<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\Cases\TestCaseUnit;

class UserTest extends TestCaseUnit
{
    /**
     * @return void
     */
    public function testShouldSendResetPasswordEmail()
    {
        $user = factory(User::class)->create();
        $user->save();
        $response = $this->post(route('password.email'), ['email' => $user->email]);

        $response->assertSessionHas('status', 'O link para redefinição de senha foi enviado para o seu e-mail!');
    }
}
