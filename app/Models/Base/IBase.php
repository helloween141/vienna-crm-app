<?php
namespace App\Models\Base;

interface IBase {
    public static function getFields(): array;

    public static function getSidebarAdditionalData(): array;
}