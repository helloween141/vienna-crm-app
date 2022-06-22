<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskSidebarResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    private array $additionalData = [
        'headers' => [
            'Номер', 'Дата', 'Суть обращения'
        ]
    ];

    private int $perPage = 3;

    public function getByFilter(Request $request): AnonymousResourceCollection
    {
        $tasks = Task::query()
            ->orderBy('id', 'DESC')
            ->paginate($this->perPage);

        return TaskSidebarResource::collection($tasks)
            ->additional($this->additionalData);
    }
}
