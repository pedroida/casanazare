<?php

namespace Tests\Cases;

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Tests\CreatesApplication;

abstract class TestCaseVoluntaryFeature extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupDatabase();

        $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ]);

        $voluntary = User::find(2);

        $this->actingAs($voluntary);
        Auth::login($voluntary);
    }

    private function setupDatabase()
    {
            $this->artisan('migrate:fresh');
            $this->artisan('db:seed');
            $this->artisan('upgrade --dev');
            $this->app[Kernel::class]->setArtisan(null);
    }
}