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
        $currentDayEnd = $currentDate->endOfMonth()->toDateString();

        $previousDate = Carbon::now()->subMonthsNoOverflow();
        $previousYear = $previousDate->year;
        $previousDayEnd = $previousDate->endOfMonth()->toDateString();

        $usersTime = User::all()->map(function ($user) use ($previousDayEnd, $currentDayEnd, $previousYear, $currentYear) {
            $currentMonthTime = Task::getUserCurrentMonthTime($user, $currentYear, [1, $currentDayEnd]);
            $previousMonthTime = Task::getUserCurrentMonthTime($user, $previousYear, [1, $previousDayEnd]);

            return [
                'id' => $user->id,
                'name' => $user->name,
                'current_time' => round((int)$currentMonthTime / 60),
                'last_time' => round((int)$previousMonthTime / 60),
                'before_last_time' => round((int)$previousMonthTime / 60)
            ];
        })->toArray();

        return [
            'month_norm' => 132,
            'today_norm' => 16,
            'months' => [
                $currentDate->monthName,
                $previousDate->monthName
            ],
            'users' => $usersTime
        ];
    }

    public function getActive(Request $request): AnonymousResourceCollection
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
