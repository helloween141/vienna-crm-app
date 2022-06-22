<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    public function testGetActiveTasksForUser(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Task::factory(3)->for($user)->create();
        $response = $this->get('/api/dashboard/active-tasks/?user_id=' . $user->id);
        $response->assertOk();

        $this->assertCount(3, $response->json('data'));
    }
}
