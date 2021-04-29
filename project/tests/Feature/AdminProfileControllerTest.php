<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Source;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\Cases\TestCaseFeature;
use Tests\TestCase;

class AdminProfileControllerTest extends TestCaseFeature
{
    /**
     * Should see index.
     *
     * @return void
     */
    public function testShouldSeeIndex()
    {
        $response = $this->get('/admin/profile');

        $response->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function testShouldEditProfile()
    {
        $response = $this->put("/admin/profile", ['name' => 'new name', 'email' => current_user()->email]);
        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }
}
