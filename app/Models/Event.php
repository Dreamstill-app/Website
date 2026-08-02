<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'starts_at',
        'ends_at',
        'location',
        'link',
        'is_published',
        'status',
        'submitted_by',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    /** @param Builder<static> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true)->where('status', 'approved');
    }

    /** @param Builder<static> $query */
    public function scopeUpcoming(Builder $query): void
    {
        $query->where(function (Builder $q) {
            $q->where('starts_at', '>=', now()->startOfDay())
                ->orWhere('ends_at', '>=', now());
        })->orderBy('starts_at');
    }
}
