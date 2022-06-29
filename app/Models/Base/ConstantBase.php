<?php

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstantBase extends Model implements IBase
{
    use HasFactory;

    public static string $singleTitle = 'Константа';

    public static string $sidebarTitle = 'Константы';

    public static string $accusativeTitle = 'константа';

    public $timestamps = false;

    protected $guarded = ['created_at', 'updated_at'];

    public static function getFields(): array
    {
        return [
            [
                'name' => 'title',
                'title' => 'Название',
                'type' => 'string',
                'required' => true,
            ],
            [
                'name' => 'name',
                'title' => 'Название (лат.)',
                'type' => 'string',
                'required' => true,
            ],
            [
                'name' => 'value',
                'title' => 'Значение',
                'type' => 'string',
                'required' => true,
            ],
        ];
    }

    public static function getSidebarAdditionalData(): array
    {
        return [
            'title' => 'Константы',
            'url' => 'constants',
            'headers' => [
                'Название', 'Значение'
            ],
            'filters' => []
        ];
    }
}
