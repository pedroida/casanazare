<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Meal;
use App\Models\Source;
use App\Models\State;
use App\Models\Stay;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\Cases\TestCaseVoluntaryFeature;
use Tests\TestCase;

class VoluntaryDashboardControllerTest extends TestCaseVoluntaryFeature
{
    /**
     * @return void
     */
    /**
     * @return void
     */
    public function testShouldGetDashboardDataForYear()
    {
        $stay = factory(Stay::class)->create();
        Meal::create(['day' => $stay->entry_date, 'breakfasts' => 1, 'lunches' => 1, 'dinners' => 1]);

        $response = $this->postJson(route('ajax.voluntary.dashboard.get-data', [
            'type' => 'year',
            'date' => $stay->entry_date
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'stays_count' => 1,
            'meals' => [
                'breakfasts' => 1,
                'dinners' => 1,
                'lunches' => 1,
                'total' => 3
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testShouldGetDashboardDataForMonth()
    {
        $stay = factory(Stay::class)->create();
        Meal::create(['day' => $stay->entry_date, 'breakfasts' => 1, 'lunches' => 1, 'dinners' => 1]);

        $response = $this->postJson(route('ajax.voluntary.dashboard.get-data', [
            'type' => 'month',
            'date' => $stay->entry_date
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'stays_count' => 1,
            'meals' => [
                'breakfasts' => 1,
                'dinners' => 1,
                'lunches' => 1,
                'total' => 3
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testShouldGetDashboardDataForMonthWithoutMeals()
    {
        $stay = factory(Stay::class)->create();

        $response = $this->postJson(route('ajax.voluntary.dashboard.get-data', [
            'type' => 'month',
            'date' => $stay->entry_date
        ]));

        $response->assertStatus(200);
        $response->assertJson([
            'stays_count' => 1,
            'meals' => [
                'breakfasts' => 0,
                'dinners' => 0,
                'lunches' => 0,
                'total' => 0
            ]
        ]);
    }
}
