<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class TaskUserTime extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['user_id', 'task_id', 'timer', 'client_time'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @param int $year
     * @param array $daysPeriod
     * @return int Получить суммарное время выполнения задач за месяц (в минутах)
     * Получить суммарное время выполнения задач за месяц (в минутах)
     */
    public static function getSumMonthTime(int $userId, int $year, array $daysPeriod): int
    {
        return self::query()
            ->join('tasks', 'task_user_times.task_id', '=', 'tasks.id')
            ->where('task_user_times.user_id', '=', $userId)
            ->whereYear('tasks.finished_at', '=', $year)
            ->whereBetween('tasks.finished_at', $daysPeriod)
            ->sum('task_user_times.timer');
    }
}
