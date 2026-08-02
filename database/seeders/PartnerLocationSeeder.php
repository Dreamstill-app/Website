<?php

namespace Database\Seeders;

use App\Models\PartnerLocation;
use Illuminate\Database\Seeder;

class PartnerLocationSeeder extends Seeder
{
    /**
     * Real Metro Vancouver circular-economy locations, migrated from the POC's
     * curated content. Coordinates are approximate; refine in the admin panel.
     */
    public function run(): void
    {
        $locations = [
            // --- Resale / consignment (thrift) ---
            ['name' => 'Hunter & Hare', 'type' => 'thrift', 'address' => '311 W Cordova St, Vancouver', 'lat' => 49.2843, 'lng' => -123.1089, 'website' => 'https://hunterandhare.com', 'accepted_categories' => ['womens', 'accessories'], 'notes' => 'Consignment — womenswear and accessories in excellent condition.'],
            ['name' => 'Mintage Vintage', 'type' => 'thrift', 'address' => '242 E Hastings St, Vancouver', 'lat' => 49.2812, 'lng' => -123.0972, 'accepted_categories' => ['vintage'], 'notes' => 'Vintage buy-sell-trade.'],
            ['name' => 'Front & Company', 'type' => 'thrift', 'address' => '3772 Main St, Vancouver', 'lat' => 49.2555, 'lng' => -123.1010, 'website' => 'https://frontandcompany.ca', 'accepted_categories' => ['mens', 'womens'], 'notes' => 'Consignment — contemporary labels.'],
            ['name' => 'Turnabout Luxury Resale', 'type' => 'thrift', 'address' => '3121 Granville St, Vancouver', 'lat' => 49.2570, 'lng' => -123.1387, 'website' => 'https://turnabout.com', 'accepted_categories' => ['luxury'], 'notes' => 'Luxury and designer resale.'],
            ['name' => 'Mine & Yours', 'type' => 'thrift', 'address' => '2302 Main St, Vancouver', 'lat' => 49.2650, 'lng' => -123.1008, 'website' => 'https://mineandyours.com', 'accepted_categories' => ['luxury'], 'notes' => 'Luxury resale — bags, apparel.'],

            // --- Donation ---
            ['name' => 'Salvation Army Thrift Store (Main St)', 'type' => 'donation', 'address' => '3016 Main St, Vancouver', 'lat' => 49.2593, 'lng' => -123.1010, 'website' => 'https://thriftstore.ca', 'accepted_categories' => ['all_clothing'], 'notes' => 'Clean, wearable clothing.'],
            ['name' => 'Value Village (E Hastings)', 'type' => 'donation', 'address' => '1820 E Hastings St, Vancouver', 'lat' => 49.2811, 'lng' => -123.0764, 'website' => 'https://valuevillage.com', 'accepted_categories' => ['all_clothing', 'household_textiles']],
            ['name' => 'Big Brothers Clothing Donation', 'type' => 'donation', 'address' => '1338 W 6th Ave, Vancouver', 'lat' => 49.2662, 'lng' => -123.1345, 'website' => 'https://bigbrothersvancouver.com', 'accepted_categories' => ['all_clothing']],
            ['name' => "Downtown Eastside Women's Centre", 'type' => 'donation', 'address' => '302 Columbia St, Vancouver', 'lat' => 49.2827, 'lng' => -123.1017, 'website' => 'https://dewc.ca', 'accepted_categories' => ['womens', 'professional'], 'notes' => "Women's clothing, especially warm and professional wear."],
            ['name' => 'Union Gospel Mission', 'type' => 'donation', 'address' => '616 E Cordova St, Vancouver', 'lat' => 49.2820, 'lng' => -123.0891, 'website' => 'https://ugm.ca', 'accepted_categories' => ['mens', 'warm_clothing']],
            ['name' => 'Covenant House Vancouver', 'type' => 'donation', 'address' => '326 W Pender St, Vancouver', 'lat' => 49.2822, 'lng' => -123.1105, 'website' => 'https://covenanthousebc.org', 'accepted_categories' => ['youth'], 'notes' => 'Youth clothing (ages 16–24).'],

            // --- Textile recycling ---
            ['name' => 'Our Social Fabric', 'type' => 'recycler', 'address' => '310 W Hastings St, Vancouver', 'lat' => 49.2827, 'lng' => -123.1094, 'website' => 'https://oursocialfabric.org', 'accepted_categories' => ['all_textiles'], 'notes' => 'Accepts all textiles, any condition.'],
            ['name' => 'FabCycle', 'type' => 'recycler', 'address' => '404 Industrial Ave, Vancouver', 'lat' => 49.2712, 'lng' => -123.0910, 'website' => 'https://fabcycle.shop', 'accepted_categories' => ['fabric_scraps', 'all_textiles'], 'notes' => 'Creative textile reuse and recycling.'],
            ['name' => 'Vancouver Zero Waste Centre', 'type' => 'recycler', 'address' => '8588 Yukon St, Vancouver', 'lat' => 49.2088, 'lng' => -123.1150, 'website' => 'https://vancouver.ca/zerowastecentre', 'accepted_categories' => ['all_textiles'], 'notes' => 'City-run depot — textiles accepted any condition.'],

            // --- Retail take-back ---
            ['name' => 'H&M Garment Collecting (Robson)', 'type' => 'retail_takeback', 'address' => '788 Robson St, Vancouver', 'lat' => 49.2820, 'lng' => -123.1216, 'website' => 'https://www2.hm.com', 'accepted_categories' => ['all_clothing'], 'notes' => 'Any garment, any brand, any condition.'],
            ['name' => 'UNIQLO RE.UNIQLO (Granville)', 'type' => 'retail_takeback', 'address' => '725 Granville St, Vancouver', 'lat' => 49.2818, 'lng' => -123.1189, 'accepted_categories' => ['uniqlo_items'], 'notes' => 'UNIQLO items only.'],
            ['name' => "Levi's Take-Back (Robson)", 'type' => 'retail_takeback', 'address' => '862 Granville St, Vancouver', 'lat' => 49.2803, 'lng' => -123.1201, 'accepted_categories' => ['denim'], 'notes' => 'Any brand of jeans/denim.'],

            // --- Repair ---
            ['name' => 'Busy Bee Tailor', 'type' => 'repair', 'address' => '2183 W 4th Ave, Vancouver', 'lat' => 49.2681, 'lng' => -123.1553, 'accepted_categories' => ['alterations', 'repairs'], 'notes' => 'Tailoring and alterations, Kitsilano.'],
            ['name' => 'Sew & Sew Alterations', 'type' => 'repair', 'address' => '873 Beatty St, Vancouver', 'lat' => 49.2777, 'lng' => -123.1141, 'accepted_categories' => ['alterations', 'repairs'], 'notes' => 'Yaletown alterations.'],
            ['name' => 'Main Street Mending Co.', 'type' => 'repair', 'address' => '4391 Main St, Vancouver', 'lat' => 49.2477, 'lng' => -123.1011, 'accepted_categories' => ['mending', 'visible_mending'], 'notes' => 'Mending and visible-mending specialists.'],
            ['name' => 'Vancouver Repair Café (Britannia)', 'type' => 'repair', 'address' => '1661 Napier St, Vancouver', 'lat' => 49.2757, 'lng' => -123.0716, 'website' => 'https://repaircafe.org', 'accepted_categories' => ['free_repairs'], 'notes' => 'Free volunteer-run repairs — check schedule.'],
        ];

        foreach ($locations as $location) {
            PartnerLocation::query()->updateOrCreate(
                ['name' => $location['name']],
                $location + ['city' => 'Vancouver', 'is_published' => true, 'verified_at' => now()]
            );
        }
    }
}
