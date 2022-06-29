<?php

namespace App\Models\Base;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBase extends Model implements IBase
{
    use HasFactory;

    public static string $detailTitle = 'Обращение';

    public static string $accusativeDetailTitle = 'обращение';

    protected $guarded = ['created_at', 'updated_at'];

    public static function getFields(): array
    {
        return [
            [
                'name' => 'id',
                'title' => 'Номер обращения',
                'type' => 'string',
                'readonly' => true,
                'hidden' => true
            ],
            [
                'name' => 'created_at',
                'title' => 'Дата регистрации',
                'type' => 'datetime',
                'readonly' => true,
                'default' => Carbon::now()
            ],
            [
                'name' => 'department',
                'title' => 'Работы для отдела',
                'type' => 'string',
                'required' => true
            ],
            [
                'name' => 'client_id',
                'title' => 'Клиент',
                'type' => 'pointer',
                'search_model' => 'Client',
                'required' => true,
            ],
            [
                'name' => 'person_id',
                'title' => 'Контактное лицо',
                'type' => 'int'
            ],
            [
                'name' => 'executor_id',
                'title' => 'Ответственный специалист',
                'type' => 'select',
                'values' => UserResource::collection(User::getExecutors()),
                'required' => true
            ],
            [
                'name' => 'type',
                'title' => 'Тип обращения',
                'type' => 'select',
                'values' => [
                    [
                        'id' => 'consultation',
                        'name' => 'Консультация',
                        'default' => true
                    ],
                    [
                        'id' => 'content',
                        'name' => 'Работы по контенту'
                    ],
                    [
                        'id' => 'code',
                        'name' => 'Доработка кода'
                    ],
                    [
                        'id' => 'design',
                        'name' => 'Дизайн'
                    ],
                    [
                        'id' => 'configure',
                        'name' => 'Конфигурирование системы'
                    ],
                    [
                        'id' => 'warranty',
                        'name' => 'Гарантийные работы'
                    ],
                    [
                        'id' => 'other',
                        'name' => 'Другое'
                    ],
                ],
                'required' => true
            ],
            [
                'name' => 'priority',
                'title' => 'Приоритет',
                'type' => 'select',
                'values' => [
                    [
                        'id' => 'low',
                        'name' => 'Низкий',
                        'default' => true
                    ],
                    [
                        'id' => 'middle',
                        'name' => 'Средний'
                    ],
                    [
                        'id' => 'high',
                        'name' => 'Высокий'
                    ],
                ],
                'required' => true
            ],
            [
                'name' => 'status',
                'title' => 'Статус',
                'type' => 'select',
                'values' => [
                    [
                        'id' => 'new',
                        'name' => 'Передано специалисту',
                        'default' => true
                    ],
                    [
                        'id' => 'progress',
                        'name' => 'В процессе выполнения'
                    ],
                    [
                        'id' => 'complete',
                        'name' => 'Выполнено'
                    ],
                    [
                        'id' => 'waiting_answer',
                        'name' => 'Ожидается ответ клиента'
                    ],
                    [
                        'id' => 'waiting_payment',
                        'name' => 'Ожидается оплата клиента'
                    ],
                    [
                        'id' => 'additional',
                        'name' => 'По доп. соглашению'
                    ],
                    [
                        'id' => 'cancel',
                        'name' => 'Отложено/отменено'
                    ],
                ],
                'required' => true
            ],
            [
                'name' => 'short_description',
                'title' => 'Суть проблемы',
                'type' => 'text',
                'required' => true
            ],
            [
                'name' => 'full_description',
                'title' => 'Комментарий',
                'type' => 'text'
            ],
            [
                'name' => 'deadline_at',
                'title' => 'Выполнить до',
                'type' => 'datetime'
            ],
            [
                'name' => 'finished_at',
                'title' => 'Дата выполнения',
                'type' => 'datetime'
            ],
            [
                'name' => 'executor_time',
                'title' => 'Мой таймер (мин.)',
                'type' => 'int',
                'readonly' => true
            ],
            [
                'name' => 'client_time',
                'title' => 'Время для клиента (мин.)',
                'type' => 'int'
            ],
            [
                'name' => 'max_time',
                'title' => 'Макс. время выполнения (мин.)',
                'type' => 'string'
            ],
            [
                'name' => 'tech_comment',
                'title' => 'Технический комментарий',
                'type' => 'text'
            ],
            [
                'name' => 'client_comment',
                'title' => 'Комментарий для клиента',
                'type' => 'text'
            ],
        ];
    }

    public static function getSidebarAdditionalData(): array
    {
        return [
            'title' => 'Обращения',
            'url' => 'tasks',
            'headers' => [
                'Номер', 'Дата', 'Суть обращения'
                //['Номер', 'Дата', 'Суть обращения']
                //['id', 'created_at', 'short_description']
            ],
            'filters' => []
        ];
    }
}
