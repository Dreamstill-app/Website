<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort_id',
        'reason',
        'time_owned',
        'thrifted',
        'style',
        'times_worn',
        'purchase_price',
    ];

    protected function casts(): array
    {
        return [
            'thrifted' => 'boolean',
            'purchase_price' => 'decimal:2',
        ];
    }

    /** @return BelongsTo<Sort, $this> */
    public function sort(): BelongsTo
    {
        return $this->belongsTo(Sort::class);
    }
}
