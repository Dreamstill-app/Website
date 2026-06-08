<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'top_ribbon',
        'contact_email',
        'contact_phone',
        'contact_location',
        'social_links',
        'footer_blurb',
        'default_meta_description',
        'default_og_image',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
        ];
    }
}
