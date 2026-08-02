<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SortImage extends Model
{
    use HasFactory;

    public const TYPES = ['front', 'back', 'tag', 'marked'];

    protected $fillable = [
        'sort_id',
        'type',
        'path',
        'width',
        'height',
        'bytes',
        'sha256',
    ];

    /** @return BelongsTo<Sort, $this> */
    public function sort(): BelongsTo
    {
        return $this->belongsTo(Sort::class);
    }
}
