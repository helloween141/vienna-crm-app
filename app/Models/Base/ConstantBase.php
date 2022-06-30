<?php

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstantBase extends Model implements IBase
{
    use HasFactory;

    public static string $detailTitle = 'Константа';

    public static string $accusativeDetailTitle = 'константу';

    public static string $sidebarTitle = 'Константы';

    public static string $sidebarUrl = 'constants';

    protected $guarded = [];

    public $timestamps = false;

    public static function getFields(): array
    {
        return [
            [
                'name' => 'title',
                'title' => 'Название',
                'type' => 'string',
                'required' => true,
                'show_in_sidebar' => true
            ],
            [
                'name' => 'name',
                'title' => 'Название (лат.)',
                'type' => 'string',
                'required' => true,
                'show_in_sidebar' => true
            ],
            [
                'name' => 'value',
                'title' => 'Значение',
                'type' => 'string',
                'required' => true,
                'show_in_sidebar' => true
            ],
        ];
    }
}
