<?php

namespace App\Support\Cms;

class SiteDefaults
{
    public static function settings(): array
    {
        return [
            'site_name' => 'DreamStill Technologies',
            'site_tagline' => 'Circular textile tools for a zero-waste future.',
            'top_ribbon' => 'Clean technology for textile circularity • Vancouver, BC • Sort better, waste less',
            'logo_path' => 'assets/img/logo.svg',
            'logo_width_px' => 140,
            'header_cta_label' => "Let's talk",
            'header_cta_url' => '/contact',
            'contact_email' => 'info@dreamstill.ca',
            'contact_phone' => '778-888-8541',
            'contact_location' => 'Vancouver, BC',
            'social_links' => [
                [
                    'label' => 'Instagram',
                    'url' => 'https://www.instagram.com/dreamstilll',
                ],
                [
                    'label' => 'LinkedIn',
                    'url' => 'https://ca.linkedin.com/company/dreamstilll',
                ],
                [
                    'label' => 'Facebook',
                    'url' => 'https://www.facebook.com/people/DreamStill/61558387175265/',
                ],
            ],
            'footer_blurb' => 'DreamStill operates in Vancouver, BC, on the traditional, ancestral, and unceded territories of the Musqueam, Squamish, and Tsleil-Waututh Nations. We acknowledge the responsibilities that come with building climate solutions on these lands.',
            'footer_cta_text' => 'Ready to work together? Get in touch.',
            'footer_cta_button_label' => 'Contact DreamStill',
            'footer_cta_button_url' => '/contact',
            'mobile_cta_primary_label' => 'Book an experience',
            'mobile_cta_primary_url' => '/portfolio',
            'mobile_cta_secondary_label' => 'Get in touch',
            'mobile_cta_secondary_url' => '/contact',
            'default_meta_description' => 'DreamStill Technologies builds circular textile tools, community experiences, and clean technology for a zero-waste future.',
            'default_og_image' => 'assets/img/logo.svg',
        ];
    }
}
