<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DamageMarker extends Model
{
    use HasFactory;

    /** Damage taxonomy — see docs/decision-tree.md. */
    public const TYPES = [
        'stain',
        'damaged_text',
        'shrinkage',
        'faded_colour',
        'pilling',
        'tear',
        'seam_breakage',
        'missing_button',
        'broken_zipper',
    ];

    /** Class A: not economically repairable. Class B: repairable. */
    public const CLASS_A = ['stain', 'damaged_text', 'shrinkage', 'faded_colour', 'pilling'];

    public const CLASS_B = ['tear', 'seam_breakage', 'missing_button', 'broken_zipper'];

    protected $fillable = [
        'sort_id',
        'image_type',
        'damage_type',
        'severity',
        'x',
        'y',
        'source',
    ];

    protected function casts(): array
    {
        return [
            'severity' => 'integer',
            'x' => 'float',
            'y' => 'float',
        ];
    }

    /** @return BelongsTo<Sort, $this> */
    public function sort(): BelongsTo
    {
        return $this->belongsTo(Sort::class);
    }

    public function isRepairable(): bool
    {
        return in_array($this->damage_type, self::CLASS_B, true);
    }
}
