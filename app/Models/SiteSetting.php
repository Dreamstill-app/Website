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
        'logo_path',
        'logo_width_px',
        'header_cta_label',
        'header_cta_url',
        'footer_cta_text',
        'footer_cta_button_label',
        'footer_cta_button_url',
        'contact_email',
        'contact_phone',
        'contact_location',
        'social_links',
        'footer_blurb',
        'mobile_cta_primary_label',
        'mobile_cta_primary_url',
        'mobile_cta_secondary_label',
        'mobile_cta_secondary_url',
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