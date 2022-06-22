<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\traits\AuthTrait;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use AuthTrait;

    public function getAll(Request $request): AnonymousResourceCollection
    {
        $filterExecutor = $request->input('executor', false);

        $query = User::query();

        if ($filterExecutor) {
            $query->where('executor', true);
        }

        $users = $query->orderBy('name', 'DESC')->get();

        return UserResource::collection($users);
    }

}
