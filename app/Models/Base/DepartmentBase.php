<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentBase extends Model implements IBase
{
    use HasFactory;

    public static string $detailTitle = 'Отдел';

    public static string $accusativeDetailTitle = 'отдел';

    public static string $sidebarTitle = 'Отделы';

    public static string $sidebarUrl = 'departments';

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
        ];
    }
}
