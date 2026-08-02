<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandTier extends Model
{
    use HasFactory;

    public const TIERS = ['luxury', 'premium', 'mainstream', 'fast_fashion'];

    protected $fillable = [
        'brand',
        'tier',
    ];

    /**
     * Case-insensitive brand lookup.
     */
    public static function tierFor(?string $brand): string
    {
        if ($brand === null || trim($brand) === '') {
            return 'unknown';
        }

        return static::whereRaw('LOWER(brand) = ?', [mb_strtolower(trim($brand))])
            ->value('tier') ?? 'unknown';
    }
}
