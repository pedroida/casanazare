<?php

namespace Tests\Feature;

use App\Http\Resources\Admin\AdminUserResource;
use App\Http\Resources\Admin\VoluntaryUserResource;
use App\Models\Client;
use App\Models\Stay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class VoluntaryUserControllerTest extends TestCaseFeature
{
    /**
     * Should see index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {

        $response = $this->get('/admin/voluntarios');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringVoluntaryInPagination()
    {
        $voluntary = User::where('name', 'Voluntário')->get()->first();
        $resource = VoluntaryUserResource::make($voluntary)->toArray(null);

        $response = $this->getJson('/pagination/admin/voluntary-users');
        $response->assertJson([
            'data' => [
                $resource
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeVoluntaryAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/voluntarios');
        $responseCreate = $this->get('/admin/voluntarios/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowVoluntary()
    {
        $voluntary = factory(User::class)->state('voluntary')->create();

        $response = $this->get('/admin/voluntarios/' . $voluntary->id);
        $response->assertSee($voluntary->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteVoluntary()
    {
        $voluntary = factory(User::class)->state('voluntary')->create();
        $response = $this->delete("/admin/voluntarios/{$voluntary->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateVoluntary()
    {
        $response = $this->get('/admin/voluntarios/create');

        $response->assertSee('Usuário Voluntário :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateVoluntary()
    {
        $user = factory(User::class)->make()->toArray();
        $user['password'] = '123456';
        $user['password_confirmation'] = '123456';

        $response = $this->post('/admin/voluntarios', $user);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateUser()
    {
        $emptyUser = factory(User::class)->state('empty')->make()->toArray();
        $response = $this->post('/admin/voluntarios', $emptyUser);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'email' => 'Campo obrigatório.',
            'password' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowEditVoluntary()
    {
        $user = factory(User::class)->state('voluntary')->create();

        $response = $this->get('/admin/voluntarios/' . $user->id . '/edit');

        $response->assertSee($user->email);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditUser()
    {
        $user = factory(User::class)->state('voluntary')->create();
        $userNewData = factory(User::class)->make()->toArray();

        $response = $this->put("/admin/voluntarios/{$user->id}", $userNewData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditVoluntary()
    {
        $user = factory(User::class)->state('voluntary')->create();
        $userNewData = factory(User::class)->state('empty')->make()->toArray();

        $response = $this->put("/admin/voluntarios/{$user->id}", $userNewData);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'email' => 'Campo obrigatório.',
        ]);
    }
}
