<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function updateTimer(Request $request) {
        $taskId = (int)$request->post('id', 0);
        $time = (int)$request->post('time', 0);

        $result = Task::query()
            ->where('id', $taskId)
            ->update(['executor_time'=> $time]);

        return [
            'success' => (bool) $result
        ];
    }
}
