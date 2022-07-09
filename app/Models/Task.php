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

    public static function getActiveForUser(int $userId): Collection|array
    {
        return self::query()
            ->where('status', '<>', 'complete')
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
