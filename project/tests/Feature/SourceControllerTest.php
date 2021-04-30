<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Source;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class SourceControllerTest extends TestCaseFeature
{
    /**
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/origens');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringSourceInPagination()
    {
        $source = factory(Source::class)->create();

        $response = $this->getJson('/pagination/admin/sources');
        $response->assertJson([
            'data' => [
                ['name' => $source->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeSourcesAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/origens');
        $responseCreate = $this->get('/admin/origens/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateSource()
    {
        $response = $this->get('/admin/origens/create');

        $response->assertSee('Origem :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateSource()
    {
        $source = factory(Source::class)->make()->toArray();

        $response = $this->post('/admin/origens', $source);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateSource()
    {
        $source = ['name' => ''];

        $response = $this->post('/admin/origens', $source);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowEditSource()
    {
        $source = factory(Source::class)->create();

        $response = $this->get('/admin/origens/' . $source->id . '/edit');

        $response->assertSee($source->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditSource()
    {
        $source = factory(Source::class)->create();

        $response = $this->put("/admin/origens/{$source->id}", ['name' => 'new name']);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditUnit()
    {
        $source = factory(Source::class)->create();

        $response = $this->put("/admin/origens/{$source->id}", ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteSource()
    {
        $source = factory(Source::class)->create();
        $response = $this->delete("/admin/origens/{$source->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }
}
