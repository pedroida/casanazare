<?php

namespace Tests\Feature;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;

class MealsControllerTest extends TestCaseFeature
{
    /**
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/refeicoes');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringMealInPagination()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $meal = factory(Meal::class)->create();

        $response = $this->getJson('/pagination/admin/meals');
        $response->assertJson([
            'data' => [
                [
                    'day_formatted' => format_date($meal->day, 'd/m/Y'),
                    'id' => $meal->id,
                    'lunches' => $meal->lunches,
                    'dinners' => $meal->dinners,
                    'breakfasts' => $meal->breakfasts,
                    'week_day' => $meal->day->formatLocalized('%A'),
                ]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldBringMealWithFilterInPagination()
    {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        $meal = factory(Meal::class)->create();

        $route = route('admin.pagination.meals', ['day' => $meal->day->format('d/m/Y')]);

        $response = $this->getJson($route);
        $response->assertJson([
            'data' => [
                [
                    'day_formatted' => format_date($meal->day, 'd/m/Y'),
                    'id' => $meal->id,
                    'lunches' => $meal->lunches,
                    'dinners' => $meal->dinners,
                    'breakfasts' => $meal->breakfasts,
                    'week_day' => $meal->day->formatLocalized('%A'),
                ]
            ]
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldSeeMealsAsVoluntary()
    {
        $voluntary = User::query()->firstWhere('name', 'Voluntário');
        $this->actingAs($voluntary);
        Auth::login($voluntary);

        $responseIndex = $this->get('/voluntario/refeicoes');

        $responseIndex->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldCreateMeal()
    {
        $meal = factory(Meal::class)->make()->toArray();
        $meal['day'] = now()->format('d/m/Y');

        $response = $this->postJson('/admin/refeicoes', $meal);
        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateMeal()
    {
        $meal = factory(Meal::class)->state('empty')->make()->toArray();

        $response = $this->post('/admin/refeicoes', $meal);

        $response->assertSessionHasErrors([
            'day' => 'Campo obrigatório.',
            'breakfasts' => 'Campo obrigatório.',
            'lunches' => 'Campo obrigatório.',
            'dinners' => 'Campo obrigatório.',
        ]);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditMeal()
    {
        $meal = factory(Meal::class)->create();

        $response = $this->putJson("/admin/refeicoes/{$meal->id}", [
            'day' => $meal->day->format('d/m/Y'),
            'breakfasts' => 1,
            'lunches' => 2,
            'dinners' => 3,
        ]);

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldNotCreateMealWithEqualDay()
    {
        $meal = factory(Meal::class)->create();
        $secondMeal = factory(Meal::class)->make()->toArray();
        $secondMeal['day'] = $meal->day->format('d/m/Y');
        $response = $this->postJson("/admin/refeicoes", $secondMeal);

        $response->assertJsonValidationErrors([
            'day' => 'O valor informado para o campo dia já está em uso.'
        ]);
    }
}
