<?php

namespace Tests\Feature;

use App\Http\Resources\Admin\AdminUserResource;
use App\Models\Client;
use App\Models\Stay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class AdminUserControllerTest extends TestCaseFeature
{
    /**
     * Should see index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {

        $response = $this->get('/admin/administradores');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringAdminInPagination()
    {
        factory(User::class)->state('admin')->create();

        $adminUsers = User::query()->role('admin')->orderBy('updated_at', 'asc')->get();

        $resources = AdminUserResource::collection($adminUsers)->toArray(null);

        $response = $this->getJson('/pagination/admin/admin-users');
        $response->assertJson(['data' => $resources]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeAdminAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/administradores');
        $responseCreate = $this->get('/admin/administradores/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowAdmin()
    {
        $admin = factory(User::class)->state('admin')->create();

        $response = $this->get('/admin/administradores/' . $admin->id);
        $response->assertSee($admin->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteAdmin()
    {
        $admin = factory(User::class)->state('admin')->create();
        $response = $this->delete("/admin/administradores/{$admin->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotDeleteSelfAdmin()
    {
        $user = current_user();

        $response = $this->delete("/admin/administradores/{$user->id}");

        $response->assertJson([
            "type" => "error",
            "message" => "Não é possível remover o usuário corrente."
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateAdmin()
    {
        $response = $this->get('/admin/administradores/create');

        $response->assertSee('Usuário Administrador :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateAdmin()
    {
        $user = factory(User::class)->make()->toArray();
        $user['password'] = '123456';
        $user['password_confirmation'] = '123456';

        $response = $this->post('/admin/administradores', $user);
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
        $response = $this->post('/admin/administradores', $emptyUser);

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
    public function testShouldShowEditAdmin()
    {
        $user = factory(User::class)->state('admin')->create();

        $response = $this->get('/admin/administradores/' . $user->id . '/edit');

        $response->assertSee($user->email);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditUser()
    {
        $user = factory(User::class)->state('admin')->create();
        $userNewData = factory(User::class)->make()->toArray();

        $response = $this->put("/admin/administradores/{$user->id}", $userNewData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditAdmin()
    {
        $user = factory(User::class)->state('admin')->create();
        $userNewData = factory(User::class)->state('empty')->make()->toArray();

        $response = $this->put("/admin/administradores/{$user->id}", $userNewData);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'email' => 'Campo obrigatório.',
        ]);
    }
}
