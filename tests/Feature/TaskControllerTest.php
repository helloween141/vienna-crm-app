<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function testGetTasksByFilter(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Task::factory(3)->for($user)->create();
        $response = $this->get('/api/core/sidebar/');
        $response->assertOk();

        $this->assertCount(3, $response->json('data'));
    }
}
