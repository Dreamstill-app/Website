<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sort extends Model
{
    use HasFactory, HasUuids;

    public const STATUS_PENDING = 'pending';

    public const STATUS_ANALYZED = 'analyzed';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_REJECTED = 'rejected';

    public const DECISIONS = ['resell', 'donate', 'repair', 'recycle'];

    protected $fillable = [
        'user_id',
        'status',
        'decision',
        'condition_score',
        'price_low',
        'price_high',
        'brand',
        'category',
        'analysis',
        'analysis_source',
        'tree_version',
        'model_version',
        'corrected_decision',
        'feedback',
        'accepted_at',
        'analyzed_at',
    ];

    protected function casts(): array
    {
        return [
            'analysis' => 'array',
            'condition_score' => 'integer',
            'price_low' => 'integer',
            'price_high' => 'integer',
            'accepted_at' => 'datetime',
            'analyzed_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return HasMany<SortImage, $this> */
    public function images(): HasMany
    {
        return $this->hasMany(SortImage::class);
    }

    /** @return HasMany<DamageMarker, $this> */
    public function damageMarkers(): HasMany
    {
        return $this->hasMany(DamageMarker::class);
    }

    /** @return HasOne<SurveyResponse, $this> */
    public function surveyResponse(): HasOne
    {
        return $this->hasOne(SurveyResponse::class);
    }

    public function image(string $type): ?SortImage
    {
        return $this->images->firstWhere('type', $type);
    }
}
