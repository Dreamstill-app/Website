<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Decision engine
    |--------------------------------------------------------------------------
    */

    'tree_version' => env('SORTY_DECISION_TREE_VERSION', '1.0'),

    // Media disk: 'local' (private, API-served) or 'azure' (public CDN URLs).
    'media_disk' => env('SORTY_MEDIA_DISK', 'local'),

    'analyze_daily_quota' => (int) env('SORTY_ANALYZE_DAILY_QUOTA', 50),

    // Resell price threshold (CAD): estimates below this route to Donate.
    'resell_price_threshold' => 20,

    /*
    |--------------------------------------------------------------------------
    | Price estimation (docs/decision-tree.md §Price estimation)
    |--------------------------------------------------------------------------
    */

    'price' => [
        'category_base' => [
            'shirt' => 12,
            'pants' => 18,
            'dress' => 25,
            'outerwear' => 40,
            'shoes' => 30,
            'accessory' => 10,
            'other' => 15,
        ],
        'tier_multiplier' => [
            'luxury' => 4.0,
            'premium' => 2.0,
            'mainstream' => 1.0,
            'fast_fashion' => 0.6,
            'unknown' => 0.8,
        ],
        'condition_multiplier' => [
            4 => 1.0,
            3 => 0.6,
        ],
        'band_low' => 0.8,
        'band_high' => 1.3,
    ],

    /*
    |--------------------------------------------------------------------------
    | Impact factors
    |--------------------------------------------------------------------------
    | Defaults derived from the Dreamstill GHG Calculator V1.0 workbook and
    | WRAP reuse figures. Average garment mass 0.5 kg. GHG factors are
    | kg CO2e avoided per kg of textile routed to each pathway.
    */

    'impact' => [
        'avg_garment_kg' => 0.5,
        'ghg_per_kg' => [
            'resell' => 3.2,
            'donate' => 3.2,
            'repair' => 2.4,
            'recycle' => 1.1,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Azure OpenAI
    |--------------------------------------------------------------------------
    */

    'azure' => [
        'endpoint' => env('AZURE_OPENAI_ENDPOINT'),
        'api_key' => env('AZURE_OPENAI_API_KEY'),
        // gpt-5-mini is multimodal + reasoning: one deployment serves both
        // vision analysis and chat. Overridable per-role.
        'vision_deployment' => env('AZURE_OPENAI_VISION_DEPLOYMENT', env('AZURE_OPENAI_DEPLOYMENT', 'gpt-5-mini')),
        'chat_deployment' => env('AZURE_OPENAI_CHAT_DEPLOYMENT', env('AZURE_OPENAI_DEPLOYMENT', 'gpt-5-mini')),
        // Reasoning effort: keep latency low for interactive use.
        'vision_reasoning_effort' => env('AZURE_OPENAI_VISION_REASONING', 'low'),
        'chat_reasoning_effort' => env('AZURE_OPENAI_CHAT_REASONING', 'minimal'),
        'ml_score_uri' => env('AZURE_ML_SCORE_URI'),
        'ml_score_key' => env('AZURE_ML_SCORE_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    */

    'uploads' => [
        'max_bytes' => 8 * 1024 * 1024,
        'max_dimension' => 2048,
        'jpeg_quality' => 82,
    ],
];
