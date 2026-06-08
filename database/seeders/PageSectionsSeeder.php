<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSectionsSeeder extends Seeder
{
    public function run(): void
    {
        // Wipe existing raw_blade sections and rebuild as structured sections
        DB::table('page_sections')->truncate();

        $pages = DB::table('pages')->get()->keyBy('slug');

        // ═══════════════════════════════════════════════
        //  HOME PAGE
        // ═══════════════════════════════════════════════
        if ($home = $pages->get('home')) {
            $this->insert($home->id, [
                [
                    'name'       => 'Hero',
                    'type'       => 'hero',
                    'sort_order' => 10,
                    'data'       => [
                        'eyebrow'   => 'DreamStill Technologies',
                        'headline'  => 'Clean tech for <span>clothing with a future.</span>',
                        'lede'      => 'We help people, communities, and industries see the true value of clothing through AI-powered decision support, circular fashion events, and textile recovery education.',
                        'hero_note' => 'From garment scans to community swaps, DreamStill makes the next best use feel joyful, simple, and local.',
                        'buttons'   => [
                            ['label' => 'Try the sorting app', 'url' => '/app',                          'style' => 'lime'],
                            ['label' => 'Book an experience',  'url' => '/portfolio',                    'style' => 'light'],
                            ['label' => 'Partner with us',     'url' => '/contact?interest=partnership', 'style' => ''],
                        ],
                        'slides' => [
                            ['heading' => 'Scan your clothes in seconds',       'text' => 'Sorty scans a garment, recommends a pathway, and points users to nearby circular options.',                               'image' => '', 'image_alt' => 'Sorty mobile app user interface preview'],
                            ['heading' => 'Experience sustainable fashion',     'text' => 'Monthly activations, clothing swaps, repair workshops, community dye baths, and styling nights.',                          'image' => '', 'image_alt' => 'Illustration of DreamStill circular fashion event'],
                            ['heading' => 'Find local circular options near you','text' => 'A local pathway map helps residents find repair, resale, donation, consignment, and recycling options.',                 'image' => '', 'image_alt' => 'Illustrated map of nearby textile circularity locations'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Mission',
                    'type'       => 'mission',
                    'sort_order' => 20,
                    'data'       => [
                        'eyebrow' => 'Our mission',
                        'heading' => 'To equip people and industries with tools and skills to see the true value of clothing.',
                        'text'    => 'DreamStill drives a collective movement towards a zero-waste future of textiles by connecting clean technology, circular infrastructure, and community imagination.',
                    ],
                ],
                [
                    'name'       => 'Impact Stats',
                    'type'       => 'stats',
                    'sort_order' => 30,
                    'data'       => [
                        'heading' => 'Our impact so far',
                        'subtext' => 'Real numbers from community activations, pilots, and education – proof that circular fashion can scale.',
                        'columns' => '4',
                        'items'   => [
                            ['number' => '40+',   'label' => 'events hosted'],
                            ['number' => '2,000', 'label' => 'participants reached'],
                            ['number' => '4,000', 'label' => 'garments diverted'],
                            ['number' => '4',     'label' => 'events we spoke at'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Solutions',
                    'type'       => 'cards',
                    'sort_order' => 40,
                    'data'       => [
                        'heading'    => 'Our solutions',
                        'subtext'    => 'Two connected paths: smarter technology that reduces confusion, and community engagement that turns behavior change into culture.',
                        'columns'    => '2',
                        'card_class' => 'solution-card',
                        'items'      => [
                            ['eyebrow' => 'Solution 01', 'heading' => 'Technological Development', 'text' => 'We build digital decision-support tools that identify the next best use for textiles, reduce landfill disposal, and help municipalities and residents navigate circular options.'],
                            ['eyebrow' => 'Solution 02', 'heading' => 'Community Engagement',       'text' => 'We produce circular fashion activations that make repair, reuse, swaps, dye baths, and education feel inviting, creative, and connected.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Did you know? Stats',
                    'type'       => 'stats',
                    'sort_order' => 50,
                    'data'       => [
                        'heading'     => 'Did you know?',
                        'subtext'     => 'Canada\'s textile waste problem is large, but so is the opportunity to recover value from clothing already in circulation.',
                        'columns'     => '3',
                        'items'       => [
                            ['number' => '1.3M',  'label' => 'tonnes of textiles purchased in Canada every year'],
                            ['number' => '1.1M',  'label' => 'tonnes of textiles disposed in Canada every year'],
                            ['number' => '18%',   'label' => 'only of textile disposed in Canada are reused or recycled'],
                        ],
                        'source_note' => 'Numbers sourced from the National Waste Characterization Report (Environment and Climate Change Canada, 2016) and the Preferred Fiber & Materials Market Report (Textile Exchange, 2021).',
                    ],
                ],
                [
                    'name'       => 'Press & Recognition',
                    'type'       => 'press',
                    'sort_order' => 60,
                    'data'       => [
                        'heading' => 'Press & recognition',
                        'subtext' => 'DreamStill has been featured in media and at notable industry events.',
                        'items'   => [
                            ['eyebrow' => 'Media',  'heading' => 'The National Observer',  'text' => 'Opinion piece on clothing waste, AI, and the future of circular fashion in Canada.', 'link_label' => 'Read the article', 'link_url' => 'https://www.nationalobserver.com/2024/09/19/opinion/clothing-fashion-waste-AI'],
                            ['eyebrow' => 'Events', 'heading' => 'Kelowna Fashion Weekend', 'text' => 'DreamStill appeared at Kelowna Fashion Weekend, connecting circular fashion innovation with regional design and sustainability communities.', 'link_label' => '', 'link_url' => ''],
                        ],
                    ],
                ],
                [
                    'name'       => 'Who We Work With & Partners',
                    'type'       => 'logo_strip',
                    'sort_order' => 70,
                    'data'       => [
                        'heading'          => 'Who we work with',
                        'tags'             => [
                            ['label' => 'Municipalities'], ['label' => 'Corporations'], ['label' => 'Investors'],
                            ['label' => 'Researchers'],    ['label' => 'Grant bodies'], ['label' => 'Community organizations'],
                        ],
                        'partners_heading' => 'Partners & collaborators',
                        'partners'         => [
                            ['label' => 'Slow Fashion Season',    'url' => 'https://slowfashionseason.org/'],
                            ['label' => 'Love Your Clothes',      'url' => 'https://www.loveyourclothes.org.uk/'],
                            ['label' => 'Fashion Revolution Week','url' => 'https://www.fashionrevolution.org/'],
                            ['label' => 'Ecorise',                'url' => 'https://ecorise.org/'],
                            ['label' => 'South Granville',        'url' => 'https://www.southgranville.ca/'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Backed By',
                    'type'       => 'logo_strip',
                    'sort_order' => 80,
                    'data'       => [
                        'heading'  => 'Backed by',
                        'subtext'  => 'Grants, accelerators, and institutions supporting DreamStill\'s mission.',
                        'partners' => [
                            ['label' => 'Buildspace',                   'url' => ''],
                            ['label' => 'UBC Slow Fibre Research Cluster','url' => ''],
                            ['label' => 'Your logo here',               'url' => ''],
                        ],
                    ],
                ],
                [
                    'name'       => 'Newsletter',
                    'type'       => 'newsletter',
                    'sort_order' => 90,
                    'data'       => [
                        'eyebrow'      => 'Stay in the loop',
                        'heading'      => 'Join our mailing list',
                        'text'         => 'Get updates on Sorty, circular fashion events, and partnership opportunities – no spam, just progress.',
                        'placeholder'  => 'your@email.com',
                        'button_label' => 'Subscribe',
                    ],
                ],
                [
                    'name'       => 'Contact CTA',
                    'type'       => 'contact_cta',
                    'sort_order' => 100,
                    'data'       => [
                        'eyebrow'       => 'Get in touch',
                        'heading'       => 'Ready to work together?',
                        'text'          => 'Explore Sorty pilots, corporate experiences, textile waste education, or industry partnerships.',
                        'buttons'       => [
                            ['label' => 'Get in touch',          'url' => '/contact',   'style' => ''],
                            ['label' => 'For investors & funders','url' => '/investors', 'style' => 'light'],
                        ],
                        'contact_items' => [
                            ['label' => '778-888-8541',    'url' => 'tel:+17788888541'],
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                        ],
                    ],
                ],
            ]);
        }

        // ═══════════════════════════════════════════════
        //  ABOUT PAGE
        // ═══════════════════════════════════════════════
        if ($about = $pages->get('about')) {
            $this->insert($about->id, [
                [
                    'name'       => 'Hero Slider',
                    'type'       => 'page_hero',
                    'sort_order' => 10,
                    'data'       => [
                        'slider_style' => true,
                        'slides'       => [
                            ['eyebrow' => 'About us',        'heading' => 'Change happens when people are empowered, inspired, and connected.', 'text' => 'At DreamStill, sustainability is not just a technical goal — it\'s a cultural and emotional journey. We help people rediscover joy, agency, and care through the clothes they wear.', 'image' => '', 'image_alt' => 'DreamStill community activation'],
                            ['eyebrow' => 'Climate tech',    'heading' => 'Building tools and experiences for a zero-waste textile future.',    'text' => 'From AI-powered sorting apps to hands-on circular fashion events, DreamStill connects technology, community, and industry to keep clothing in use longer.',               'image' => '', 'image_alt' => 'Sorty app preview'],
                            ['eyebrow' => 'Community rooted','heading' => '40+ events. 2,000 participants. One mission.',                       'text' => 'We\'ve learned that the best climate solutions are tactile, creative, and local — and that people change behavior when they feel connected, not lectured.',                   'image' => '', 'image_alt' => 'DreamStill summer events'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Why We Started',
                    'type'       => 'text_card',
                    'sort_order' => 20,
                    'data'       => [
                        'heading' => 'Why we started',
                        'content' => '<p>DreamStill began with a simple frustration: millions of garments end up in landfill every year, not because people don\'t care, but because they don\'t know what else to do. Our founders saw this gap firsthand — in overflowing donation bins, in municipal waste reports, and in community clothing swaps where people lit up when given a better option.</p><p>We started with events — swaps, repair nights, styling sessions — and quickly realized the problem needed both human connection and scalable technology. Sorty was born from that insight: a tool that makes the right decision feel obvious, local, and fast. Today, DreamStill bridges community imagination with clean tech to build a circular textile future.</p>',
                    ],
                ],
                [
                    'name'       => 'Our Story Timeline',
                    'type'       => 'timeline',
                    'sort_order' => 30,
                    'data'       => [
                        'heading' => 'Our story',
                        'subtext' => 'Key milestones — and what we learned along the way.',
                        'items'   => [
                            ['period' => 'Spring 2024', 'title' => 'Finding Stuff',                        'text' => 'Identified textile waste pain points and gathered community stories.',                                          'outcome' => 'Validated that confusion, not apathy, drives most textile disposal.'],
                            ['period' => 'Summer 2024', 'title' => 'Clothing swaps, styling, and selling', 'text' => 'First hands-on circular fashion experiences.',                                                                'outcome' => 'Proved that joyful, tactile events change behavior faster than information alone.'],
                            ['period' => 'Fall 2024',   'title' => 'Buildspace',                           'text' => 'Refined the venture and shaped a stronger product narrative.',                                                'outcome' => 'Secured accelerator support and clarified Sorty as the core technology bet.'],
                            ['period' => 'Spring 2025', 'title' => 'Capstone app deliverable',             'text' => 'Sorty prototype with computer vision and pathway mapping.',                                                   'outcome' => 'Demonstrated end-to-end scan-to-recommendation flow in a working prototype.'],
                            ['period' => 'Summer 2025', 'title' => 'Community activations',                'text' => '10+ events across Vancouver: repair nights, dye baths, swaps, and styling sessions.', 'outcome' => 'Reached 500+ new community participants and refined the experience model.'],
                            ['period' => 'Fall 2025',   'title' => 'Municipal pilot conversations',        'text' => 'Began outreach to BC municipalities about Sorty as a textile diversion tool.', 'outcome' => 'Two pilot conversations opened with regional waste managers.'],
                            ['period' => 'Today',       'title' => 'Building and growing',                 'text' => 'DreamStill is actively fundraising, building Sorty v2, and planning 2026 activations.', 'outcome' => 'Actively seeking investment and grant funding to scale.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Impact Stats',
                    'type'       => 'stats',
                    'sort_order' => 40,
                    'data'       => [
                        'heading' => 'Impact by the numbers',
                        'columns' => '4',
                        'items'   => [
                            ['number' => '40+',   'label' => 'events hosted'],
                            ['number' => '2,000', 'label' => 'participants reached'],
                            ['number' => '4,000', 'label' => 'garments diverted'],
                            ['number' => '4',     'label' => 'events spoken at'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Contact CTA',
                    'type'       => 'contact_cta',
                    'sort_order' => 50,
                    'data'       => [
                        'eyebrow'       => 'Get in touch',
                        'heading'       => 'Ready to connect?',
                        'text'          => 'Whether you\'re interested in partnerships, events, or pilots — we\'d love to hear from you.',
                        'buttons'       => [
                            ['label' => 'Contact us',            'url' => '/contact',   'style' => ''],
                            ['label' => 'For investors & funders','url' => '/investors', 'style' => 'light'],
                        ],
                        'contact_items' => [
                            ['label' => '778-888-8541',     'url' => 'tel:+17788888541'],
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                        ],
                    ],
                ],
            ]);
        }

        // ═══════════════════════════════════════════════
        //  APP PAGE
        // ═══════════════════════════════════════════════
        if ($app = $pages->get('app')) {
            $this->insert($app->id, [
                [
                    'name'       => 'Hero',
                    'type'       => 'page_hero',
                    'sort_order' => 10,
                    'data'       => [
                        'eyebrow' => 'The app',
                        'heading' => 'Meet Sorty, the next-best-use tool for unwanted clothing.',
                        'text'    => 'Sorty is a computer vision mobile application that helps users determine the next best use for unwanted clothing in just a few taps.',
                        'badge'   => 'scan • answer • route • rescue',
                        'buttons' => [
                            ['label' => 'Notify me at launch', 'url' => '#waitlist', 'style' => 'lime'],
                            ['label' => 'Learn more',          'url' => '#how',      'style' => 'light'],
                        ],
                    ],
                ],
                [
                    'name'       => 'How It Works',
                    'type'       => 'image_text',
                    'sort_order' => 20,
                    'data'       => [
                        'eyebrow'        => 'How it works',
                        'heading'        => 'Simple decisions for circular textiles.',
                        'content'        => '<p>Sorty guides users through a quick scan-and-answer flow to find the next best use for any garment — whether that\'s repair, resale, donation, composting, or recycling.</p>',
                        'image'          => '',
                        'image_alt'      => 'Sorty app preview showing scan and repair recommendation',
                        'image_position' => 'right',
                    ],
                ],
                [
                    'name'       => 'Why It Exists',
                    'type'       => 'cards',
                    'sort_order' => 30,
                    'data'       => [
                        'columns'    => '2',
                        'card_class' => 'card',
                        'items'      => [
                            ['eyebrow' => 'Why it exists', 'heading' => 'Confusion drives landfill', 'text' => 'Most people don\'t know what to do with worn-out or unwanted clothes. Sorty removes that friction.'],
                            ['eyebrow' => 'The gap',       'heading' => 'No clear decision tool',   'text' => 'Existing resources are scattered, hard to navigate, and rarely local. Sorty aggregates them into one scan.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Technical Approach',
                    'type'       => 'text_card',
                    'sort_order' => 40,
                    'data'       => [
                        'heading' => 'Computer vision meets circular infrastructure.',
                        'content' => '<p>Sorty uses on-device computer vision to identify garment type, condition, and fabric composition. It then cross-references a live database of local circular options — repair shops, resellers, donation bins, textile recyclers — and recommends the highest-value pathway.</p>',
                    ],
                ],
                [
                    'name'       => 'Value Cards',
                    'type'       => 'cards',
                    'sort_order' => 50,
                    'data'       => [
                        'heading'    => 'Decision support for textile circularity',
                        'columns'    => '3',
                        'card_class' => 'value-card',
                        'items'      => [
                            ['heading' => 'For residents', 'text' => 'Scan any garment and get a personalized recommendation for its next best use — repair, resale, donate, compost, or recycle.'],
                            ['heading' => 'For municipalities', 'text' => 'Reduce textile waste stream volume with a scalable, measurable digital tool that integrates with existing diversion programs.'],
                            ['heading' => 'For corporations', 'text' => 'Offer employees and customers a branded sustainability tool that demonstrates measurable circular impact.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Newsletter / Waitlist',
                    'type'       => 'newsletter',
                    'sort_order' => 80,
                    'data'       => [
                        'eyebrow'      => 'Launch waitlist',
                        'heading'      => 'Be first to try Sorty',
                        'text'         => 'Sign up to be notified when Sorty launches. Early users get free premium access.',
                        'placeholder'  => 'your@email.com',
                        'button_label' => 'Notify me',
                    ],
                ],
                [
                    'name'       => 'Contact CTA',
                    'type'       => 'contact_cta',
                    'sort_order' => 90,
                    'data'       => [
                        'heading'       => 'Request a pilot',
                        'text'          => 'Interested in piloting Sorty for your municipality, organization, or team? Let\'s talk.',
                        'buttons'       => [
                            ['label' => 'Get in touch',    'url' => '/contact', 'style' => ''],
                            ['label' => 'For investors',   'url' => '/investors','style' => 'light'],
                        ],
                        'contact_items' => [
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                        ],
                    ],
                ],
            ]);
        }

        // ═══════════════════════════════════════════════
        //  PORTFOLIO / EXPERIENCES PAGE
        // ═══════════════════════════════════════════════
        if ($portfolio = $pages->get('portfolio')) {
            $this->insert($portfolio->id, [
                [
                    'name'       => 'Hero',
                    'type'       => 'page_hero',
                    'sort_order' => 10,
                    'data'       => [
                        'eyebrow' => 'DreamStill Experiences',
                        'heading' => 'Corporate Experiences That Inspire Creativity and Connection.',
                        'text'    => 'DreamStill designs unforgettable sustainability and creativity experiences for teams, conferences, retreats, and company celebrations across British Columbia.',
                        'buttons' => [
                            ['label' => 'Book a Discovery Call', 'url' => '#book-discovery', 'style' => 'coral'],
                            ['label' => 'See experiences',       'url' => '#experiences',    'style' => 'light'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Experience Cards',
                    'type'       => 'cards',
                    'sort_order' => 20,
                    'data'       => [
                        'heading'    => 'Our experiences',
                        'subtext'    => 'Every experience is designed to be hands-on, memorable, and connected to real sustainability themes.',
                        'columns'    => '3',
                        'card_class' => 'experience-card',
                        'items'      => [
                            ['eyebrow' => 'Workshop',   'heading' => 'Clothing Swap',          'text' => 'Community-style clothing swap events that bring people together around the joy of circular fashion.'],
                            ['eyebrow' => 'Workshop',   'heading' => 'Repair Night',            'text' => 'Hands-on mending and repair sessions led by skilled textile artists. Participants leave with repaired garments and new skills.'],
                            ['eyebrow' => 'Workshop',   'heading' => 'Natural Dye Bath',        'text' => 'Explore natural dyeing with plant-based pigments. Participants transform old or plain garments into unique, vibrant pieces.'],
                            ['eyebrow' => 'Activation', 'heading' => 'Sustainability Showcase', 'text' => 'A branded, immersive circular fashion activation for corporate events, conferences, and community gatherings.'],
                            ['eyebrow' => 'Education',  'heading' => 'Textile Waste Workshop',  'text' => 'An educational session on the lifecycle of clothing, the scale of textile waste, and what individuals and organizations can do.'],
                            ['eyebrow' => 'Styling',    'heading' => 'Secondhand Styling Night', 'text' => 'A fun, guided styling session using only secondhand and thrifted pieces — helping people see circular fashion as aspirational.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Contact CTA',
                    'type'       => 'contact_cta',
                    'sort_order' => 80,
                    'data'       => [
                        'eyebrow'       => 'Book an experience',
                        'heading'       => 'Ready to bring DreamStill to your team or event?',
                        'text'          => 'We\'d love to design something together. Get in touch to start the conversation.',
                        'buttons'       => [
                            ['label' => 'Book a discovery call', 'url' => '/contact?interest=experiences', 'style' => 'coral'],
                        ],
                        'contact_items' => [
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                        ],
                    ],
                ],
            ]);
        }

        // ═══════════════════════════════════════════════
        //  CONTACT PAGE
        // ═══════════════════════════════════════════════
        if ($contact = $pages->get('contact')) {
            $this->insert($contact->id, [
                [
                    'name'       => 'Hero',
                    'type'       => 'page_hero',
                    'sort_order' => 10,
                    'data'       => [
                        'eyebrow' => 'Contact',
                        'heading' => 'Questions, inquiries, pilots, or circular fashion ideas?',
                        'text'    => 'Reach out and tell us what you are building. DreamStill would be happy to explore app partnerships, textile recovery education, community activations, and circular fashion event production.',
                        'badge'   => 'we respond within 2 business days',
                    ],
                ],
                [
                    'name'       => 'Contact Areas',
                    'type'       => 'cards',
                    'sort_order' => 20,
                    'data'       => [
                        'heading' => 'What can we help with?',
                        'columns' => '3',
                        'items'   => [
                            ['eyebrow' => '📱', 'heading' => 'Sorty App',           'text' => 'Questions about the app, beta access, or integration partnerships.'],
                            ['eyebrow' => '🎉', 'heading' => 'Experiences & Events', 'text' => 'Book a clothing swap, repair night, dye bath, or corporate sustainability activation.'],
                            ['eyebrow' => '🤝', 'heading' => 'Partnerships',         'text' => 'Municipal pilots, research collaborations, or corporate sustainability programs.'],
                            ['eyebrow' => '💰', 'heading' => 'Investment',           'text' => 'Investor inquiries, grant applications, or funding conversations.'],
                            ['eyebrow' => '📰', 'heading' => 'Media',                'text' => 'Press enquiries, interviews, or media kit requests.'],
                            ['eyebrow' => '💬', 'heading' => 'General',              'text' => 'Anything else — we love hearing from people who care about circular fashion.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Contact Details',
                    'type'       => 'contact_cta',
                    'sort_order' => 30,
                    'data'       => [
                        'heading'       => 'Get in touch directly',
                        'text'          => 'We respond to all enquiries within 2 business days.',
                        'buttons'       => [],
                        'contact_items' => [
                            ['label' => '778-888-8541',     'url' => 'tel:+17788888541'],
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                            ['label' => 'Vancouver, BC, Canada','url' => ''],
                        ],
                    ],
                ],
            ]);
        }

        // ═══════════════════════════════════════════════
        //  INVESTORS PAGE
        // ═══════════════════════════════════════════════
        if ($investors = $pages->get('investors')) {
            $this->insert($investors->id, [
                [
                    'name'       => 'Hero',
                    'type'       => 'page_hero',
                    'sort_order' => 10,
                    'data'       => [
                        'eyebrow' => 'For investors & funders',
                        'heading' => 'Scalable climate technology for textile circularity.',
                        'text'    => 'DreamStill is building the decision-support infrastructure for a zero-waste textile future — combining AI-powered sorting (Sorty) with community engagement and municipal partnerships.',
                    ],
                ],
                [
                    'name'       => 'Traction Stats',
                    'type'       => 'stats',
                    'sort_order' => 20,
                    'data'       => [
                        'heading' => 'Traction',
                        'columns' => '3',
                        'items'   => [
                            ['number' => '40+',   'label' => 'events run'],
                            ['number' => '2,000', 'label' => 'community participants'],
                            ['number' => '4,000', 'label' => 'garments diverted'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Opportunity',
                    'type'       => 'text_card',
                    'sort_order' => 30,
                    'data'       => [
                        'heading' => 'The opportunity',
                        'content' => '<p>Canada generates 1.3M tonnes of textiles per year — with only 18% being reused or recycled. DreamStill targets this gap with Sorty, a computer vision app that routes garments toward their next best use. The global secondhand fashion market is projected to reach $350B by 2027.</p><p>We combine proven community traction with emerging AI technology to build the decision-support layer that circular textile infrastructure is missing.</p>',
                    ],
                ],
                [
                    'name'       => 'Investment Areas',
                    'type'       => 'cards',
                    'sort_order' => 40,
                    'data'       => [
                        'heading' => 'Where investment goes',
                        'columns' => '3',
                        'items'   => [
                            ['heading' => 'Sorty v2 Development',    'text' => 'Computer vision improvements, pathway database expansion, and mobile app development.'],
                            ['heading' => 'Municipal Pilots',         'text' => 'Deploying Sorty in partnership with BC municipalities as a textile diversion tool.'],
                            ['heading' => 'Community Activations',    'text' => 'Scaling DreamStill events across British Columbia to expand reach and impact.'],
                        ],
                    ],
                ],
                [
                    'name'       => 'Contact CTA',
                    'type'       => 'contact_cta',
                    'sort_order' => 90,
                    'data'       => [
                        'eyebrow'       => 'Interested in investing?',
                        'heading'       => 'Let\'s talk.',
                        'text'          => 'We\'re currently raising a seed round. Reach out to start the conversation.',
                        'buttons'       => [
                            ['label' => 'Contact us', 'url' => '/contact?interest=investment', 'style' => ''],
                        ],
                        'contact_items' => [
                            ['label' => 'info@dreamstill.ca','url' => 'mailto:info@dreamstill.ca'],
                        ],
                    ],
                ],
            ]);
        }
    }

    private function insert(int $pageId, array $sections): void
    {
        $now = now();
        foreach ($sections as $section) {
            DB::table('page_sections')->insert([
                'page_id'    => $pageId,
                'type'       => $section['type'],
                'name'       => $section['name'],
                'sort_order' => $section['sort_order'],
                'data'       => json_encode($section['data']),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
