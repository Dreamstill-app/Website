<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'template',
        'nav_label',
        'show_in_nav',
        'is_homepage',
        'meta_title',
        'meta_description',
        'og_image',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'show_in_nav' => 'boolean',
            'is_homepage' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getRoutePathAttribute(): string
    {
        return $this->is_homepage ? '/' : '/'.$this->slug;
    }
}
