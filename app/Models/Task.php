<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i',
        'updated_at' => 'datetime:d.m.Y H:i',
        'finished_at' => 'datetime:d.m.Y H:i',
        'deadline_at' => 'datetime:d.m.Y H:i',
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @param User $user
     * @return int|mixed
     * Получить суммарное время выполнения задач за месяц
     */
    public static function getUserCurrentMonthTime(User $user, int $year, array $daysPeriod): mixed
    {
        return static::query()
            ->where('user_id', '=', $user->id)
            ->whereYear('finished_at', '=', $year)
            ->whereBetween('finished_at', $daysPeriod)
            ->sum('executor_time');
    }

    public function singleTimerTime(): void
    {
        $this->hasOne(TaskUserTime::class);
    }
}
