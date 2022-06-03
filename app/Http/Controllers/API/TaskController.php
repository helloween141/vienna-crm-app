<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): array
    {
        $tasks = Task::with('client')->get();
        return array_reverse($tasks->toArray());
    }
}
