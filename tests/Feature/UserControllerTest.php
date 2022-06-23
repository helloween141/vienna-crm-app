<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserSignIn(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->delete();

        $response = $this->get('/api/user');

        $response->assertOk();
    }

    public function testGetExecutors(): void
    {
        $user = User::factory()->create();
        $response = $this->get('/api/users/get-all?only_executor=' . true);

        $response->assertOk();
    }
}
