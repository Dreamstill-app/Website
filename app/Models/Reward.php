<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'points_cost',
        'reward_type',
        'partner_name',
        'image_path',
        'stock',
        'expires_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'points_cost' => 'integer',
            'stock' => 'integer',
            'expires_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    /** @return HasMany<RewardClaim, $this> */
    public function claims(): HasMany
    {
        return $this->hasMany(RewardClaim::class);
    }

    /** @param Builder<static> $query */
    public function scopeAvailable(Builder $query): void
    {
        $query->where('is_published', true)
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->where(function (Builder $q) {
                $q->whereNull('stock')->orWhere('stock', '>', 0);
            });
    }
}
