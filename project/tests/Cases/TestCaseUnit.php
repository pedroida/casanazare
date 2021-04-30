<?php

namespace Tests\Cases;

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Tests\CreatesApplication;
use Tests\RefreshDatabase;

abstract class TestCaseUnit extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupDatabase();

        $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ]);
    }

    private function setupDatabase()
    {
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        $this->artisan('upgrade --dev');
        $this->app[Kernel::class]->setArtisan(null);
    }
}