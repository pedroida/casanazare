<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class CategoryControllerTest extends TestCaseFeature
{
    /**
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/categorias');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringCategoryInPagination()
    {
        $category = factory(Category::class)->create();

        $response = $this->getJson('/pagination/admin/categories');
        $response->assertJson([
            'data' => [
                ['name' => $category->name]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotSeeCategoriesAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/admin/categorias');
        $responseCreate = $this->get('/admin/categorias/create');

        $responseIndex->assertStatus(403);
        $responseCreate->assertStatus(403);
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateUnit()
    {
        $category = factory(Category::class, 1)->make()->toArray();

        $response = $this->post('/admin/categorias', $category);
        $response->assertStatus(302);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateUnit()
    {
        $category = ['name' => ''];

        $response = $this->post('/admin/categorias', $category);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditUnit()
    {
        $category = factory(Category::class)->create();

        $response = $this->put("/admin/categorias/{$category->id}", ['name' => 'new name']);
        $response->assertStatus(302);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotEditUnit()
    {
        $category = factory(Category::class)->create();

        $response = $this->put("/admin/categorias/{$category->id}", ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'Campo obrigatório.'
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldDeleteCategory()
    {
        $category = factory(Category::class)->create();
        $response = $this->delete("/admin/categorias/{$category->id}");

        $response->assertJson([
            "type" => "success",
            "message" => "Registro removido com sucesso."
        ]);
    }
}
