<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUserTime extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['user_id', 'task_id', 'time'];
}
