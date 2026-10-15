<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_routes_are_not_registered(): void
    {
        $this->assertFalse(Route::has('verification.notice'));
        $this->assertFalse(Route::has('verification.verify'));
        $this->assertFalse(Route::has('verification.send'));
    }

    public function test_users_can_access_the_application_without_verified_email(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/profile')
            ->assertOk();
    }
}
