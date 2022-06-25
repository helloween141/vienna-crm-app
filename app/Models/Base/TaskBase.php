<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskBase extends Model
{
    use HasFactory;

    // TODO: iterface getFields(), getAdditionalData()...
    public static array $fields = [
        [
            'name' => 'id',
            'title' => 'Номер обращения',
            'type' => 'string',
            'readonly' => true
        ],
        [
            'name' => 'created_at',
            'title' => 'Дата регистрации',
            'type' => 'datetime',
            'readonly' => true
        ],
        [
            'name' => 'department',
            'title' => 'Работы для отдела',
            'type' => 'string'
        ],
        [
            'name' => 'client_id',
            'title' => 'Клиент',
            'type' => 'int'
        ],
        [
            'name' => 'person_id',
            'title' => 'Контактное лицо',
            'type' => 'int'
        ],
        [
            'name' => 'executor_id',
            'title' => 'Ответственный специалист',
            'type' => 'int'
        ],
        [
            'name' => 'type',
            'title' => 'Тип обращения',
            'type' => 'select',
            'values' => [
                [
                    'name' => 'consultation',
                    'title' => 'Консультация'
                ],
                [
                    'name' => 'content',
                    'title' => 'Работы по контенту'
                ],
                [
                    'name' => 'code',
                    'title' => 'Доработка кода'
                ],
                [
                    'name' => 'design',
                    'title' => 'Дизайн'
                ],
                [
                    'name' => 'configure',
                    'title' => 'Конфигурирование системы'
                ],
                [
                    'name' => 'warranty',
                    'title' => 'Гарантийные работы'
                ],
                [
                    'name' => 'other',
                    'title' => 'Другое'
                ],
            ]
        ],
        [
            'name' => 'priority',
            'title' => 'Приоритет',
            'type' => 'select',
            'values' => [
                [
                    'name' => 'high',
                    'title' => 'Высокий'
                ],
                [
                    'name' => 'middle',
                    'title' => 'Средний'
                ],
                [
                    'name' => 'low',
                    'title' => 'Низкий'
                ],
            ]
        ],
        [
            'name' => 'status',
            'title' => 'Статус',
            'type' => 'select',
            'values' => [
                [
                    'name' => 'new',
                    'title' => 'Передано специалисту'
                ],
                [
                    'name' => 'progress',
                    'title' => 'В процессе выполнения'
                ],
                [
                    'name' => 'complete',
                    'title' => 'Выполнено'
                ],
                [
                    'name' => 'waiting_answer',
                    'title' => 'Ожидается ответ клиента'
                ],
                [
                    'name' => 'waiting_payment',
                    'title' => 'Ожидается оплата клиента'
                ],
                [
                    'name' => 'additional',
                    'title' => 'По доп. соглашению'
                ],
                [
                    'name' => 'cancel',
                    'title' => 'Отложено/отменено'
                ],
            ]
        ],
        [
            'name' => 'short_description',
            'title' => 'Суть проблемы',
            'type' => 'text'
        ],
        [
            'name' => 'full_description',
            'title' => 'Комментарий',
            'type' => 'text'
        ],
        [
            'name' => 'deadline_date',
            'title' => 'Выполнить до',
            'type' => 'datetime'
        ],
        [
            'name' => 'complete_date',
            'title' => 'Дата выполнения',
            'type' => 'datetime'
        ],
        [
            'name' => 'current_time',
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
    
    public static string $singleName = 'Обращение';
    public static string $accusativeName = 'обращение';

    public static array $sidebarAdditionalData = [
        'headers' => [
            'Номер', 'Дата', 'Суть обращения'
        ],
        'filters' => []
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y H:i',
        'updated_at' => 'datetime:d.m.Y H:i',
        'finished_at' => 'datetime:d.m.Y H:i',
        'deadline_at' => 'datetime:d.m.Y H:i',
    ];
}
