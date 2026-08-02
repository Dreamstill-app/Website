<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpactMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period',
        'sorts_total',
        'by_decision',
        'ghg_kg_avoided',
        'textiles_kg_diverted',
        'computed_at',
    ];

    protected function casts(): array
    {
        return [
            'sorts_total' => 'integer',
            'by_decision' => 'array',
            'ghg_kg_avoided' => 'float',
            'textiles_kg_diverted' => 'float',
            'computed_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
