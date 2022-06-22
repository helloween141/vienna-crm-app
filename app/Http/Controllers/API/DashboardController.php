<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getStatistic(): array
    {
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentDayStart = $currentDate->startOfMonth()->toDateString();
        $currentDayEnd = $currentDate->endOfMonth()->toDateString();

        $lastDate = Carbon::now()->subMonthsNoOverflow();
        $lastYear = $lastDate->year;
        $lastDayStart = $lastDate->startOfMonth()->toDateString();
        $lastDayEnd = $lastDate->endOfMonth()->toDateString();

        $beforeLastDate = Carbon::now()->subMonthsNoOverflow(2);
        $beforeLastYear = $lastDate->year;
        $beforeLastDayStart = $lastDate->startOfMonth()->toDateString();
        $beforeLastDayEnd = $lastDate->endOfMonth()->toDateString();

        // TODO: skip 0 or to resource
        $usersTime = User::getExecutors()
            ->map(function ($user) use (
                $lastDayStart, $beforeLastDayStart,
                $currentDayStart, $beforeLastDayEnd, $beforeLastYear,
                $lastDayEnd, $currentDayEnd, $lastYear, $currentYear
            ) {
                $currentMonthTime = Task::getUserMonthTime($user, $currentYear, [$currentDayStart, $currentDayEnd]);
                $lastMonthTime = Task::getUserMonthTime($user, $lastYear, [$lastDayStart, $lastDayEnd]);
                $beforeLastMonthTime = Task::getUserMonthTime($user, $beforeLastYear, [$beforeLastDayStart, $beforeLastDayEnd]);

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'current_time' => $currentMonthTime,
                    'last_time' => $lastMonthTime,
                    'before_last_time' => $beforeLastMonthTime
                ];
            })->toArray();

        return [
            'month_norm' => 132,
            'today_norm' => 16,
            'months' => [
                $lastDate->monthName,
                $beforeLastDate->monthName
            ],
            'users' => $usersTime
        ];
    }

    public function getActiveTasks(Request $request): AnonymousResourceCollection
    {
        $userId = (int)$request->input('user_id');

        $tasks = Task::query()
            ->with('client')
            ->where('status', '<>', 'complete')
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();

        return TaskResource::collection($tasks);
    }
}
