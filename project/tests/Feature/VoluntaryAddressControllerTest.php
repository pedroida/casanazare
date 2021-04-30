<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Source;
use App\Models\State;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\Cases\TestCaseVoluntaryFeature;
use Tests\TestCase;

class VoluntaryAddressControllerTest extends TestCaseVoluntaryFeature
{
    /**
     * @return void
     */
    public function testShouldBringAllStates()
    {
        $states = State::query()->orderBy('name', 'asc')->get();
        $response = $this->getJson(route('voluntary.states.json.all'));

        $response->assertStatus(200);
        $response->assertJson($states->toArray());
    }
    /**
     * @return void
     */
    public function testShouldBringAllStateCities()
    {
        $state = State::query()->with('cities')->first();
        $response = $this->getJson(route('voluntary.cities.state.json', ['abbr' => $state->abbr]));

        $response->assertStatus(200);
        $response->assertJson($state->cities->toArray());
    }
}
