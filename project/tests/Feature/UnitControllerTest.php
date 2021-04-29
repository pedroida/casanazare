<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Source;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\TestCase;

class UnitControllerTest extends TestCaseFeature
{
    /**
     * Should see index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/unidades');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringUnitInPagination()
    {
        $unit = factory(Unit::class)->create();

        $response = $this->getJson('/pagination/admin/units');
        $response->assertJson([
            'data' => [
                ['name' => $unit->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeUnitsAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/unidades');
        $responseCreate = $this->get('/admin/unidades/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowCreateCategory()
    {
        $response = $this->get('/admin/unidades/create');

        $response->assertSee('Unidade :. Novo');
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateUnit()
    {
        $unitData = factory(Unit::class)->make()->toArray();

        $response = $this->post('/admin/unidades', $unitData);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateUnit()
    {
        $unitData = ['name' => ''];

        $response = $this->post('/admin/unidades', $unitData);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldShowEditCategory()
    {
        $unit = factory(Unit::class)->create();

        $response = $this->get('/admin/unidades/' . $unit->id . '/edit');

        $response->assertSee($unit->name);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditUnit()
    {
        $unit = factory(Unit::class)->create();

        $response = $this->put("/admin/unidades/{$unit->id}", ['name' => 'new name']);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditUnit()
    {
        $unit = factory(Unit::class)->create();

        $response = $this->put("/admin/unidades/{$unit->id}", ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteUnit()
    {
        $unit = factory(Unit::class)->create();
        $response = $this->delete("/admin/unidades/{$unit->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }
}
