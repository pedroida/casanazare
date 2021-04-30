<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Stay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\Cases\TestCaseVoluntaryFeature;

class VoluntaryClientControllerTest extends TestCaseVoluntaryFeature
{
    /**
     * Should see index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/voluntario/acolhidos');

        $response->assertStatus(200);
    }

    /**
     * Should see units index.
     *
     * @return void
     */
    public function testShouldSeeForbiddenIndex()
    {
        $response = $this->get('/voluntario/acolhidos-proibidos');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringClientInPagination()
    {
        $client = factory(Client::class)->create();

        $response = $this->getJson('/pagination/voluntary/clients');
        $response->assertJson([
            'data' => [
                ['name' => $client->name . ' (' . $client->years_old . ' anos)']
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

        $response = $this->getJson('/pagination/voluntary/forbidden-clients');
        $response->assertJson([
            'data' => [
                ['name' => $client->name . ' (' . $client->years_old . ' anos)']
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

        $response = $this->getJson('/pagination/voluntary/forbidden-clients');
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

        $response = $this->getJson('/pagination/voluntary/clients');
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
    public function testShouldShowClient()
    {
        $client = factory(Client::class)->create();

        $response = $this->get('/voluntario/acolhidos/' . $client->id);
        $response->assertSee($client->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldToggleForbiddenClient()
    {
        $client = factory(Client::class)->create();
        $response = $this->postJson("/ajax/voluntary/client/{$client->id}/toggle-forbidden");

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
        $response = $this->delete("/voluntario/acolhidos/{$client->id}");

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
        $response = $this->delete("/voluntario/acolhidos/{$client->id}");

        $response->assertJson([
            "type" => "error",
            "message" => "O acolhido ainda possui hospedagem em aberto"
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateClient()
    {
        $response = $this->get('/voluntario/acolhidos/create');

        $response->assertSee('Acolhido :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateClient()
    {
        $client = factory(Client::class)->make()->toArray();
        $client['date_of_birth'] = Carbon::make($client['date_of_birth'])->format('d/m/Y');

        $response = $this->post('/voluntario/acolhidos', $client);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateClient()
    {
        $emptyClient = factory(Client::class)->state('empty')->make()->toArray();
        $response = $this->post('/voluntario/acolhidos', $emptyClient);

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
    public function testShouldShowEditClient()
    {
        $client = factory(Client::class)->create();

        $response = $this->get('/voluntario/acolhidos/' . $client->id . '/edit');

        $response->assertSee($client->birth_date);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditClient()
    {
        $client = factory(Client::class)->create();
        $clientNewData = factory(Client::class)->make()->toArray();
        $clientNewData['date_of_birth'] = Carbon::make($clientNewData['date_of_birth'])->format('d/m/Y');

        $response = $this->put("/voluntario/acolhidos/{$client->id}", $clientNewData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditClient()
    {
        $client = factory(Client::class)->create();
        $clientNewData = factory(Client::class)->state('empty')->make()->toArray();

        $response = $this->put("/voluntario/acolhidos/{$client->id}", $clientNewData);

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
