<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Stay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class ClientControllerTest extends TestCaseFeature
{
    /**
     * Should see units index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/acolhidos');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringClientInPagination()
    {
        $client = factory(Client::class)->create();

        $response = $this->getJson('/pagination/admin/clients');
        $response->assertJson([
            'data' => [
                ['name' => $client->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringForbiddenClientInPagination()
    {
        $client = factory(Client::class)->state('forbidden')->create();

        $response = $this->getJson('/pagination/admin/forbidden-clients');
        $response->assertJson([
            'data' => [
                ['name' => $client->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotBringClientInForbiddenPagination()
    {
        $client = factory(Client::class)->create();

        $response = $this->getJson('/pagination/admin/forbidden-clients');
        $response->assertJsonMissing([
            'data' => [
                ['name' => $client->name]
            ]
        ]);
    }


    /**
     *
     * @return void
     */
    public function testShouldNotBringForbiddenClientInPagination()
    {
        $client = factory(Client::class)->state('forbidden')->create();

        $response = $this->getJson('/pagination/admin/clients');
        $response->assertJsonMissing([
            'data' => [
                ['name' => $client->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeClientsAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/acolhidos');
        $responseCreate = $this->get('/admin/acolhidos/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowClient()
    {
        $client = factory(Client::class)->create();

        $response = $this->get('/admin/acolhidos/' . $client->id);
        $response->assertSee($client->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldToggleForbiddenClient()
    {
        $client = factory(Client::class)->create();
        $response = $this->postJson("/ajax/admin/client/{$client->id}/toggle-forbidden");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro alterado com sucesso."
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteClient()
    {
        $client = factory(Client::class)->create();
        $response = $this->delete("/admin/acolhidos/{$client->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotDeleteClientWithOpenedDeparture()
    {
        $stay = factory(Stay::class)->state('without_departure_date')->create();
        $client = $stay->client;
        $response = $this->delete("/admin/acolhidos/{$client->id}");

        $response->assertJson([
            "type" => "error",
            "message" => "O acolhido ainda possui hospedagem em aberto"
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateClient()
    {
        $client = factory(Client::class)->make()->toArray();

        $response = $this->post('/admin/acolhidos', $client);
        $response->assertStatus(302);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateClient()
    {
        $emptyClient = factory(Client::class)->state('empty')->make()->toArray();
        $response = $this->post('/admin/acolhidos', $emptyClient);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'rg' => 'Campo obrigatório.',
            'date_of_birth' => 'Campo obrigatório.',
            'phone_one' => 'Campo obrigatório.',
            'phone_two' => 'Campo obrigatório.',
            'city_id' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditClient()
    {
        $client = factory(Client::class)->create();
        $clientNewData = factory(Client::class)->make()->toArray();

        $response = $this->put("/admin/acolhidos/{$client->id}", $clientNewData);
        $response->assertStatus(302);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditClient()
    {
        $client = factory(Client::class)->create();
        $clientNewData = factory(Client::class)->state('empty')->make()->toArray();

        $response = $this->put("/admin/acolhidos/{$client->id}", $clientNewData);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.',
            'rg' => 'Campo obrigatório.',
            'date_of_birth' => 'Campo obrigatório.',
            'phone_one' => 'Campo obrigatório.',
            'phone_two' => 'Campo obrigatório.',
            'city_id' => 'Campo obrigatório.',
        ]);
    }
}
