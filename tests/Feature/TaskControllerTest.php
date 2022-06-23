<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function testGetTaskById(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $user->delete();

        $response = $this->get('/api/core/task/record/' . Task::all()->random()->id);
        $response->assertOk();
    }
}
