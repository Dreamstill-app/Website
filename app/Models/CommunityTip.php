<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunityTip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
        'image_path',
        'status',
        'moderation_reason',
        'moderation_source',
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @param Builder<static> $query */
    public function scopeApproved(Builder $query): void
    {
        $query->where('status', 'approved');
    }
}
