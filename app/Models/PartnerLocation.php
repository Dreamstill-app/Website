<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerLocation extends Model
{
    use HasFactory;

    public const TYPES = ['thrift', 'repair', 'donation', 'recycler', 'retail_takeback'];

    protected $fillable = [
        'name',
        'type',
        'lat',
        'lng',
        'address',
        'city',
        'hours',
        'accepted_categories',
        'website',
        'phone',
        'notes',
        'partner_user_id',
        'verified_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'lat' => 'float',
            'lng' => 'float',
            'hours' => 'array',
            'accepted_categories' => 'array',
            'verified_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function partnerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_user_id');
    }

    /** @param Builder<static> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    /**
     * Order by Haversine distance from a point and hydrate distance_km.
     *
     * @param  Builder<static>  $query
     */
    public function scopeNear(Builder $query, float $lat, float $lng, float $radiusKm = 15): void
    {
        $haversine = '(6371 * acos(least(1.0, cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))))';

        $query->selectRaw("partner_locations.*, {$haversine} AS distance_km", [$lat, $lng, $lat])
            ->whereRaw("{$haversine} <= ?", [$lat, $lng, $lat, $radiusKm])
            ->orderBy('distance_km');
    }

    /**
     * The decision type this location serves, for map filtering.
     */
    public static function typesForDecision(string $decision): array
    {
        return match ($decision) {
            'resell' => ['thrift'],
            'donate' => ['donation', 'thrift'],
            'repair' => ['repair'],
            'recycle' => ['recycler', 'retail_takeback'],
            default => self::TYPES,
        };
    }
}
