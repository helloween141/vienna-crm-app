<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\traits\AuthTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    use AuthTrait;

    public function getExecutors(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(User::getExecutors());
    }

}
