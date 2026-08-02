<?php

namespace Database\Seeders;

use App\Models\BrandTier;
use Illuminate\Database\Seeder;

class BrandTierSeeder extends Seeder
{
    /**
     * Starter brand → tier table for the price estimator (docs/decision-tree.md).
     * Admin-extendable in Filament.
     */
    public function run(): void
    {
        $tiers = [
            'luxury' => [
                'Gucci', 'Prada', 'Louis Vuitton', 'Chanel', 'Hermès', 'Burberry',
                'Saint Laurent', 'Balenciaga', 'Moncler', 'Canada Goose',
            ],
            'premium' => [
                'Aritzia', 'Lululemon', "Arc'teryx", 'The North Face', 'Patagonia',
                "Levi's", 'Ralph Lauren', 'Tommy Hilfiger', 'Calvin Klein', 'Nike',
                'Adidas', 'New Balance', 'Columbia', 'Eileen Fisher', 'Frank And Oak',
            ],
            'mainstream' => [
                'Gap', 'Banana Republic', 'J.Crew', 'Uniqlo', 'Roots', 'Reitmans',
                'RW&CO', 'American Eagle', 'Hollister', 'Guess', 'Mango', 'COS',
            ],
            'fast_fashion' => [
                'H&M', 'Zara', 'Shein', 'Forever 21', 'Primark', 'Ardene',
                'Garage', 'Dynamite', 'Urban Planet', 'Fashion Nova', 'Temu',
            ],
        ];

        foreach ($tiers as $tier => $brands) {
            foreach ($brands as $brand) {
                BrandTier::query()->updateOrCreate(['brand' => $brand], ['tier' => $tier]);
            }
        }
    }
}
