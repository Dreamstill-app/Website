<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'category',
        'source',
        'source_url',
        'year',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    /** @param Builder<static> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }
}
