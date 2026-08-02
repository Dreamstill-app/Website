<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bundle extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'name',
        'decision',
        'partner_location_id',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<PartnerLocation, $this> */
    public function partnerLocation(): BelongsTo
    {
        return $this->belongsTo(PartnerLocation::class);
    }

    /** @return BelongsToMany<Sort, $this> */
    public function sorts(): BelongsToMany
    {
        return $this->belongsToMany(Sort::class, 'bundle_items')->withTimestamps();
    }
}
