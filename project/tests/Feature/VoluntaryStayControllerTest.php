<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Stay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\Cases\TestCaseVoluntaryFeature;

class VoluntaryStayControllerTest extends TestCaseVoluntaryFeature
{
    /**
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/voluntario/estadias');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringStayInPagination()
    {
        $stay = factory(Stay::class)->create();

        $response = $this->getJson('/pagination/voluntary/stays');
        $response->assertJson([
            'data' => [
                [
                    'client_name' => $stay->client->name . ' (' . $stay->client->years_old . ' anos)',
                    'responsible_name' => $stay->responsible->name,
                    'source_name' => $stay->source->name,
                    'type' => __('labels.common.' . $stay->type),
                    'entry_date' => $stay->entry_date,
                    'departure_date' => $stay->departure_date,
                ]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateStay()
    {
        $response = $this->get('/voluntario/estadias/create');

        $response->assertSee('Estadia :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateStay()
    {
        $stay = factory(Stay::class)->make()->toArray();

        $response = $this->post('/voluntario/estadias', $stay);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateStay()
    {
        $stay = factory(Stay::class)->state('empty')->make()->toArray();

        $response = $this->post('/voluntario/estadias', $stay);

        $response->assertSessionHasErrors([
            'type' => 'Campo obrigatório.',
            'client_id' => 'Campo obrigatório.',
            'source_id' => 'Campo obrigatório.',
            'responsible_id' => 'Campo obrigatório.',
            'entry_date' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowEditStay()
    {
        $stay = factory(Stay::class)->create();

        $response = $this->get('/voluntario/estadias/' . $stay->id . '/edit');

        $response->assertSee($stay->client->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditStay()
    {
        $stay = factory(Stay::class)->state('without_departure_date')->create();
        $stay->departure_date = Carbon::createFromFormat('d/m/Y', $stay->entry_date)
            ->addDays(7)
            ->format('d/m/Y');

        $response = $this->put("/voluntario/estadias/{$stay->id}", $stay->toArray());

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditStay()
    {
        $stay = factory(Stay::class)->create();
        $emptyStay = factory(Stay::class)->state('empty')->make()->toArray();

        $response = $this->put("/voluntario/estadias/{$stay->id}", $emptyStay);

        $response->assertSessionHasErrors([
            'type' => 'Campo obrigatório.',
            'source_id' => 'Campo obrigatório.',
            'responsible_id' => 'Campo obrigatório.',
            'entry_date' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteStay()
    {
        $stay = factory(Stay::class)->create();
        $response = $this->delete("/voluntario/estadias/{$stay->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }
}
