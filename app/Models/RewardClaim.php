<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RewardClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'reward_id',
        'user_id',
        'points_spent',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'points_spent' => 'integer',
        ];
    }

    /** @return BelongsTo<Reward, $this> */
    public function reward(): BelongsTo
    {
        return $this->belongsTo(Reward::class);
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
