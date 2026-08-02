<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Event;
use App\Models\Fact;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Events, challenges and facts — replaces the Firestore admin_* collections.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'DreamStill Clothing Swap',
                'description' => 'Bring up to 10 clean, wearable items and swap them for new-to-you pieces. Leftovers are donated or recycled responsibly.',
                'starts_at' => now()->addDays(9)->setTime(11, 0),
                'ends_at' => now()->addDays(9)->setTime(15, 0),
                'location' => 'Britannia Community Centre, 1661 Napier St, Vancouver',
            ],
            [
                'title' => 'Mending & Upcycling Workshop',
                'description' => 'Learn visible mending, patching, and simple alterations. Bring a damaged garment — leave with it wearable again.',
                'starts_at' => now()->addDays(16)->setTime(18, 0),
                'ends_at' => now()->addDays(16)->setTime(20, 30),
                'location' => 'Mount Pleasant Neighbourhood House, Vancouver',
            ],
            [
                'title' => 'Fill-a-Bag Sustainable Fashion Sale',
                'description' => 'Fill a bag with pre-loved clothing for a flat price. All proceeds support DreamStill community programming.',
                'starts_at' => now()->addDays(23)->setTime(10, 0),
                'ends_at' => now()->addDays(23)->setTime(16, 0),
                'location' => 'Trout Lake Community Centre, Vancouver',
            ],
        ];

        foreach ($events as $event) {
            Event::query()->updateOrCreate(['title' => $event['title']], $event + ['is_published' => true]);
        }

        $challenges = [
            ['title' => 'First Sort', 'description' => 'Sort your first garment with Sorty.', 'points' => 10, 'metric' => 'sorts_count', 'target' => 1],
            ['title' => 'Closet Cleanout', 'description' => 'Sort 10 garments this month.', 'points' => 50, 'metric' => 'sorts_count', 'target' => 10, 'ends_at' => now()->endOfMonth()],
            ['title' => 'Repair Champion', 'description' => 'Choose repair for 3 garments — extend their life!', 'points' => 30, 'metric' => 'decision_repair', 'target' => 3],
            ['title' => 'Circular Seller', 'description' => 'List 5 resell-graded items.', 'points' => 40, 'metric' => 'decision_resell', 'target' => 5],
        ];

        foreach ($challenges as $challenge) {
            Challenge::query()->updateOrCreate(['title' => $challenge['title']], $challenge + ['is_published' => true]);
        }

        $facts = [
            ['text' => 'The fashion industry produces around 10% of global carbon emissions — more than international flights and maritime shipping combined.', 'category' => 'climate'],
            ['text' => '85% of textiles end up in landfills each year, even though nearly all of them could be reused or recycled.', 'category' => 'waste'],
            ['text' => 'It takes about 2,700 litres of water to make a single cotton t-shirt — enough drinking water for one person for 2.5 years.', 'category' => 'water'],
            ['text' => 'Extending the life of clothing by just 9 months reduces its carbon, water, and waste footprint by 20–30%.', 'category' => 'impact'],
            ['text' => 'The average garment is worn only 7 times before being discarded.', 'category' => 'waste'],
            ['text' => 'Thrift stores typically sell only about a third of donations — sorting before donating keeps the stream high quality.', 'category' => 'donation'],
            ['text' => 'Many small repairs cost $5–20 and can extend a garment’s life by years.', 'category' => 'repair'],
            ['text' => 'Synthetic fabrics shed microplastics with every wash — a laundry bag like Guppyfriend catches most of them.', 'category' => 'care'],
        ];

        foreach ($facts as $fact) {
            Fact::query()->updateOrCreate(['text' => $fact['text']], $fact + ['is_published' => true]);
        }
    }
}
