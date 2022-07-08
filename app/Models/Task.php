<?php

namespace App\Models;

use App\Models\Base\TaskBase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends TaskBase
{
    use HasFactory;

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function singleTimerTime(): HasOne
    {
        return $this->hasOne(TaskUserTime::class);
    }

    /**
     * @param User $user
     * @param int $year
     * @param array $daysPeriod
     * @return int Получить суммарное время выполнения задач за месяц (в минутах)
     * Получить суммарное время выполнения задач за месяц (в минутах)
     */
    public static function getUserMonthTime(User $user, int $year, array $daysPeriod): int
    {
        // TODO: Учитывать участие в других задачах
        return static::query()
            ->where('user_id', '=', $user->id)
            ->whereYear('finished_at', '=', $year)
            ->whereBetween('finished_at', $daysPeriod)
            ->sum('client_time');
    }

    public static function getActiveForUser(int $userId): Collection|array
    {
        return self::query()
            ->where('status', '<>', 'complete')
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
