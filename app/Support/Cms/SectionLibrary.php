<?php

namespace App\Support\Cms;

class SectionLibrary
{
    public static function types(): array
    {
        return [
            'raw_blade' => 'Raw Blade section',
        ];
    }

    public static function options(): array
    {
        return self::types();
    }
}
