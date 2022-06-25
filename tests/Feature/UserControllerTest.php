<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * @return void
     * Проверить успешную авторизации пользователя
     */
    public function testUserSignIn(): void
    {
        $user = User::all()->random();
        Sanctum::actingAs($user);

        $response = $this->get('/api/user/');
        $response->assertOk();
    }

    /**
     * @return void
     * Проверить получение исполнителей
     */
    public function testGetExecutors(): void
    {
        $user = User::all()->random();
        Sanctum::actingAs($user);

        $response = $this->get('/api/users/executors/');
        $response->assertOk();
    }
}
