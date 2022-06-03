<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\traits\AuthTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use AuthTrait;

    public function getAll(): array
    {
        return User::all();
    }

    public function getActiveTasks(): Collection
    {
        $user = Auth::user();

        return $user->tasks([
            'active' => true
        ]);
    }

}
