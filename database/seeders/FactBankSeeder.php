<?php

namespace Database\Seeders;

use App\Models\Fact;
use Illuminate\Database\Seeder;

/**
 * Curated "Did you know?" bank with verifiable sources, per the product
 * requirements (one line, ≤20 words, sourced, actionable tone).
 * Extend freely in the admin panel — keep the source discipline.
 */
class FactBankSeeder extends Seeder
{
    public function run(): void
    {
        $facts = [
            // --- Clothing waste ---
            ['A truckload of textiles is landfilled or burned every second worldwide.', 'waste', 'Ellen MacArthur Foundation', 2017],
            ['Less than 1% of clothing is recycled into new garments.', 'waste', 'Ellen MacArthur Foundation', 2017],
            ['The average garment is worn just 7 to 10 times before being discarded.', 'waste', 'Barnardo\'s', 2015],
            ['Clothing utilisation — how often we wear items — fell 36% in 15 years.', 'waste', 'Ellen MacArthur Foundation', 2017],
            ['North Americans send about 37 kg of textiles per person to landfill yearly.', 'waste', 'Fashion Takes Action', 2021],
            ['85% of discarded textiles could be reused or recycled instead of trashed.', 'waste', 'Recycling Council of Ontario', 2018],

            // --- Carbon emissions ---
            ['Fashion produces up to 10% of global carbon emissions.', 'climate', 'UNEP', 2019],
            ['Fashion emits more carbon than international flights and shipping combined.', 'climate', 'UNEP', 2019],
            ['Extending a garment\'s life by 9 months cuts its carbon footprint about 20-30%.', 'climate', 'WRAP', 2017],
            ['Doubling the wears a garment gets nearly halves its emissions per wear.', 'climate', 'Ellen MacArthur Foundation', 2017],

            // --- Water ---
            ['One cotton t-shirt takes about 2,700 litres of water to make.', 'water', 'World Wildlife Fund', 2013],
            ['A single pair of jeans takes roughly 7,500 litres of water to produce.', 'water', 'UNEP', 2019],
            ['The fashion industry uses about 93 billion cubic metres of water yearly.', 'water', 'Ellen MacArthur Foundation', 2017],
            ['Washing clothes in cold water can cut laundry energy use up to 90%.', 'care', 'Energy Star', 2021],

            // --- Microplastics ---
            ['One laundry load of synthetics can shed hundreds of thousands of microfibres.', 'microplastics', 'Plymouth University', 2016],
            ['About 35% of ocean microplastics come from washing synthetic textiles.', 'microplastics', 'IUCN', 2017],
            ['A microfibre-catching laundry bag traps most synthetic fibres before they reach waterways.', 'microplastics', 'Fraunhofer Institute', 2020],

            // --- Repair & mending ---
            ['Many clothing repairs cost $5-20 and add years to a garment\'s life.', 'repair', 'WRAP', 2017],
            ['Learning five basic stitches lets you fix most common clothing damage at home.', 'repair', 'Fashion Revolution', 2020],
            ['Spare buttons are usually sewn inside your garment\'s side seam or hem.', 'repair', 'Fashion Revolution', 2020],
            ['Visible mending turns repairs into design features — and keeps clothes loved longer.', 'repair', 'Fashion Revolution', 2020],
            ['Repair cafés fix items for free — Metro Vancouver hosts them monthly.', 'repair', 'Repair Café International', 2023],

            // --- Reuse, resale & donation ---
            ['Buying one used item instead of new avoids roughly 1 kg of CO₂e.', 'reuse', 'WRAP', 2019],
            ['The secondhand clothing market is growing about 3 times faster than fast fashion.', 'resale', 'thredUP Resale Report', 2023],
            ['Thrift stores typically sell only about a third of donated clothing — sort before donating.', 'donation', 'Recycling Council of BC', 2020],
            ['Clean, wearable items belong in donations; damaged textiles belong in recycling streams.', 'donation', 'Recycling Council of BC', 2020],
            ['Charity shops turn your donations into funding for local community programs.', 'donation', 'Salvation Army', 2022],
            ['One person\'s outgrown coat can be another\'s winter essential — donate seasonally.', 'donation', 'Fashion Takes Action', 2021],

            // --- Circular & slow fashion ---
            ['A circular fashion economy could unlock $560 billion in economic opportunity.', 'circular', 'Ellen MacArthur Foundation', 2017],
            ['Renting, swapping, and resale could grow to 23% of the fashion market by 2030.', 'circular', 'Ellen MacArthur Foundation', 2021],
            ['The 30-wears test: before buying, ask if you\'ll wear it at least 30 times.', 'slow_fashion', 'Eco-Age', 2015],
            ['A capsule wardrobe of versatile pieces cuts cost per wear dramatically.', 'slow_fashion', 'WRAP', 2017],
            ['Clothing swaps refresh your wardrobe with zero production footprint.', 'swap', 'Fashion Takes Action', 2021],

            // --- Fast fashion ---
            ['Clothing production roughly doubled between 2000 and 2015.', 'fast_fashion', 'Ellen MacArthur Foundation', 2017],
            ['Fashion consumes about 98 million tonnes of non-renewable resources yearly.', 'fast_fashion', 'Ellen MacArthur Foundation', 2017],
            ['Some fast-fashion garments are designed to last fewer than 10 wears.', 'fast_fashion', 'WRAP', 2017],

            // --- Materials ---
            ['Polyester is found in about half of all clothing produced today.', 'materials', 'Textile Exchange', 2022],
            ['Natural fibres like cotton, wool, and linen are biodegradable; most synthetics are not.', 'materials', 'Textile Exchange', 2022],
            ['Denim is one of the most recyclable fabrics — many brands take back old jeans.', 'materials', 'Cotton Incorporated', 2020],
            ['Wool naturally resists odour — it needs far fewer washes than synthetics.', 'materials', 'Woolmark', 2020],
            ['Blended fabrics are hardest to recycle — single-fibre garments have cleaner second lives.', 'materials', 'Textile Exchange', 2022],

            // --- Care & longevity ---
            ['Washing dark jeans inside out in cold water preserves their colour.', 'care', 'Levi Strauss & Co.', 2019],
            ['Air-drying clothes extends fabric life and cuts household energy use.', 'care', 'Energy Star', 2021],
            ['Folding heavy knits instead of hanging prevents stretched shoulders.', 'care', 'Woolmark', 2020],
            ['Cedar blocks deter moths without the chemicals in mothballs.', 'care', 'Woolmark', 2020],
            ['Washing at 30°C instead of 40°C cuts energy use by around 38%.', 'care', 'WRAP', 2017],
            ['Over-washing wears clothes out — spot-clean and air out between wears.', 'care', 'WRAP', 2017],

            // --- Design & durability ---
            ['Well-made seams and quality fabric can keep a garment in use for decades.', 'durability', 'WRAP', 2017],
            ['Timeless design outlasts trends — classic pieces stay in rotation for years.', 'durability', 'Ellen MacArthur Foundation', 2017],

            // --- Action & impact ---
            ['Every garment kept in use is one fewer produced — reuse is climate action.', 'impact', 'WRAP', 2019],
            ['Sorting clothes by their next best use keeps donation streams high quality.', 'impact', 'Recycling Council of BC', 2020],
            ['Your closet is a carbon store: wearing what you own is the greenest choice.', 'impact', 'WRAP', 2017],
        ];

        foreach ($facts as [$text, $category, $source, $year]) {
            Fact::query()->updateOrCreate(
                ['text' => $text],
                [
                    'category' => $category,
                    'source' => $source,
                    'year' => $year,
                    'is_published' => true,
                ]
            );
        }
    }
}
