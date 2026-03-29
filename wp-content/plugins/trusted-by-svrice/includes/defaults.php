<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tbs_get_defaults() {
    return [

        /* ── NAV ─────────────────────────────── */
        'nav_logo_text'        => 'SVRICE',
        'nav_linkedin_url'     => '#',
        'nav_twitter_url'      => '#',

        /* ── HERO ────────────────────────────── */
        'hero_eyebrow'         => '100+ Verified Client Reviews',
        'hero_heading'         => 'Trusted by Clients Worldwide',
        'hero_subtitle'        => 'Real Reviews from Real Clients',
        'hero_description'     => 'We have worked with clients from around the world on LearnDash, WordPress and custom plugin development projects. Here are some of our verified client reviews and feedback.',
        'hero_rating_label'    => '5.0 Rating on Fiverr',
        'hero_clients_btn'     => '100+ Happy Clients',
        'hero_clients_url'     => '#',

        /* ── FIVERR CARD ─────────────────────── */
        'fcard_years'          => '+ 5 Years',
        'fcard_score'          => '5.0',
        'fcard_line1'          => '5.0 Rating on Fiverr',
        'fcard_line2'          => '100+ Completed Orders',
        'fcard_line3'          => 'Level 2 Seller',
        'fcard_btn_text'       => 'View Fiverr Profile',
        'fcard_btn_url'        => '#',

        /* ── STATS ───────────────────────────── */
        'stat1_num'            => '80+',
        'stat1_label'          => 'Happy Clients',
        'stat1_icon'           => '👥',
        'stat2_num'            => '100+',
        'stat2_label'          => 'Projects Delivered',
        'stat2_icon'           => '📦',
        'stat3_num'            => '5.0',
        'stat3_label'          => 'Average Rating',
        'stat3_icon'           => '⭐',
        'stat4_num'            => '6+',
        'stat4_label'          => 'Years Experience',
        'stat4_icon'           => '🗓️',

        /* ── REVIEWS SECTION ─────────────────── */
        'reviews_eyebrow'      => '⭐ Fiverr Client Reviews',
        'reviews_heading'      => 'What Our Clients Say on Fiverr',
        'reviews_subtext'      => 'Real, unedited reviews directly from our Fiverr profile — straight from the clients we\'ve served.',

        'reviews' => [
            [
                'name'    => 'Michaelsgrey1234',
                'date'    => 'December 2023',
                'color'   => '#3b82f6',
                'initial' => 'M',
                'text'    => '<strong>Outstanding Experience!</strong> Kamran completed our LearnDash plugin exactly how we needed. Super fast delivery, great communication & very clean code. Will hire again!',
                'project' => 'Custom LearnDash Progress Plugin — 5 Star Review',
            ],
            [
                'name'    => 'FastMAT',
                'date'    => 'March 2023',
                'color'   => '#f59e0b',
                'initial' => 'F',
                'text'    => '<strong>LearnDash options will</strong> keep next gen learners engaged — great to collaborate again. Delivered exactly what was discussed with excellent attention to detail.',
                'project' => 'LearnDash Dashboard Customization — Fiverr Client Review',
            ],
            [
                'name'    => 'JWebwork',
                'date'    => 'November 2022',
                'color'   => '#10b981',
                'initial' => 'J',
                'text'    => '<strong>Great communication</strong> and top-quality work. Customized and optimized our LearnDash dashboard perfectly. Highly recommended — will work together again.',
                'project' => 'LearnDash Dashboard Optimization — 5 Star Review',
            ],
            [
                'name'    => 'Jamesbl',
                'date'    => 'July 2023',
                'color'   => '#8b5cf6',
                'initial' => 'J',
                'text'    => '<strong>Amazing and very professional</strong> in building our e-learning site. Fast, excellent work for our LearnDash project. Communication top notch.',
                'project' => 'E-Learning Platform Build — Fiverr Review',
            ],
            [
                'name'    => 'sara_r_design',
                'date'    => 'January 2024',
                'color'   => '#f97316',
                'initial' => 'S',
                'text'    => '<strong>Absolutely fantastic work!</strong> Built a custom WordPress plugin exactly as required. Clean, well-documented code. Will be hiring again for our next project.',
                'project' => 'Custom WordPress Plugin — 5 Star Review',
            ],
            [
                'name'    => 'ahmed_k_biz',
                'date'    => 'February 2024',
                'color'   => '#0ea5e9',
                'initial' => 'A',
                'text'    => '<strong>Solved a complex integration</strong> that three other devs couldn\'t fix. WooCommerce + LearnDash working perfectly. Done in under 24 hours. Incredible talent!',
                'project' => 'WooCommerce + LearnDash Integration — Fiverr Review',
            ],
        ],

        /* ── TRUST BANNER ────────────────────── */
        'trust_text1'          => 'Trusted by <strong>100+</strong> Clients Worldwide',
        'trust_text2'          => '<strong>5.0</strong> Rating',
        'trust_text3'          => '<strong>100+</strong> Happy Clients',

        /* ── TESTIMONIALS ────────────────────── */
        'testi_eyebrow'        => '💬 Client Testimonials',
        'testi_heading'        => 'In Their Own Words',
        'testi_subtext'        => 'Long-form feedback from clients who\'ve trusted us with their most important projects.',

        'testimonials' => [
            [
                'name'     => 'Michael S.',
                'location' => '📍 USA',
                'color'    => '#3b82f6',
                'initial'  => 'M',
                'text'     => '"Kamran customized our <em>LearnDash</em> plugin exactly how we needed. Fast delivery, great communication and very clean code. Highly recommended!"',
                'platform' => 'fiverr',
            ],
            [
                'name'     => 'Samantha W.',
                'location' => '📍 UK',
                'color'    => '#10b981',
                'initial'  => 'S',
                'text'     => '"<em>Excellent work!</em> Hope to hire Kamran again for future projects. Responsive, quick, and highly efficient. Delivered beyond expectations!"',
                'platform' => 'fiverr',
            ],
            [
                'name'     => 'Alexander H.',
                'location' => '📍 Australia',
                'color'    => '#f59e0b',
                'initial'  => 'A',
                'text'     => '"Fantastic job on our custom <em>WordPress</em> plugin. Kamran is skilled, professional, and delivers quality work. Very satisfied with the outcome!"',
                'platform' => 'fiverr',
            ],
        ],

        /* ── SERVICES / TECH ─────────────────── */
        'tech_heading'         => 'What We Work With',
        'tech_subtext'         => 'Deep expertise across the WordPress and LearnDash ecosystem — from plugin dev to full LMS builds.',

        'tech_chips' => [
            [ 'icon' => '🔷', 'label' => 'WordPress' ],
            [ 'icon' => '🎓', 'label' => 'LearnDash' ],
            [ 'icon' => '🛒', 'label' => 'WooCommerce' ],
            [ 'icon' => '🐘', 'label' => 'PHP 8+' ],
            [ 'icon' => '🟨', 'label' => 'JavaScript' ],
            [ 'icon' => '⚛️', 'label' => 'React / Gutenberg' ],
            [ 'icon' => '🗃️', 'label' => 'MySQL' ],
            [ 'icon' => '🔗', 'label' => 'REST API' ],
            [ 'icon' => '🔄', 'label' => 'Git / GitHub' ],
            [ 'icon' => '📦', 'label' => 'Composer' ],
            [ 'icon' => '🚀', 'label' => 'Elementor Pro' ],
            [ 'icon' => '🐋', 'label' => 'Docker / Local' ],
        ],

        'services' => [
            [ 'icon' => '🎓', 'bg' => '#dbeafe', 'title' => 'LearnDash LMS Development',           'desc' => 'Full setup, courses, drip content, certificates, quizzes & SCORM support' ],
            [ 'icon' => '🔌', 'bg' => '#d1fae5', 'title' => 'Custom WordPress Plugin Development', 'desc' => 'Purpose-built plugins, hooks, REST endpoints, admin dashboards' ],
            [ 'icon' => '⚡', 'bg' => '#fef3c7', 'title' => 'Performance Optimization',            'desc' => 'Core Web Vitals, caching, image optimization, database cleanup' ],
            [ 'icon' => '🔗', 'bg' => '#ede9fe', 'title' => 'WooCommerce + LearnDash Integration', 'desc' => 'Bundles, memberships, subscriptions, Stripe & PayPal setup' ],
            [ 'icon' => '🛠', 'bg' => '#fce7f3', 'title' => 'Bug Fixing & Maintenance',            'desc' => 'Fast diagnosis and resolution for any WordPress / LearnDash issue' ],
        ],

        /* ── CTA ─────────────────────────────── */
        'cta_heading'          => 'Ready to Build Something <em>Exceptional?</em>',
        'cta_subtext'          => 'Whether it\'s a full LMS, a custom plugin, or a performance fix — let\'s make it happen.',
        'cta_btn1_text'        => '🔌 View Our Plugins',
        'cta_btn1_url'         => '#',
        'cta_btn2_text'        => '💬 Contact Us',
        'cta_btn2_url'         => '#',
        'cta_btn3_text'        => '✓ Hire on Fiverr',
        'cta_btn3_url'         => '#',
        'cta_note'             => '🔒 Secure payments via Fiverr · ⚡ Fast response · ✓ Satisfaction guaranteed',

        /* ── FOOTER ──────────────────────────── */
        'footer_text'          => '© 2024 SVRICE · WordPress & LearnDash Expert Developer',
    ];
}
