<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\traits\AuthTrait;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use AuthTrait;

    // TODO: fix year && refactoring && filtering
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
                'username' => $user->name,
                'current_month_time' => round((int)$currentMonthTime / 60),
                'previous_month_time' => round((int)$previousMonthTime / 60)
            ];
        })->toArray();

        return [
            'norm' => 123,
            'months' => [
                $currentDate->monthName,
                $previousDate->monthName
            ],
            'users' => $usersTime
        ];
    }
}
