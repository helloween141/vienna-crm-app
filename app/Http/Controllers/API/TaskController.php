<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskUserTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function getTimer(Request $request): array
    {
        $taskId = (int)$request->get('id', 0);

        $userTime = TaskUserTime::query()
            ->where('task_id', $taskId)
            ->where('user_id', Auth::id())
            ->first();
        return [
            'time' => $userTime->time ?? 0
        ];
    }

    public function updateTimer(Request $request): array
    {
        $taskId = (int)$request->post('id', 0);
        $time = (int)$request->post('time', 0);

        $result = TaskUserTime::query()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'task_id' => $taskId,
                'time' => $time
            ]
        );

        return [
            'success' => (bool) $result
        ];
    }


}
