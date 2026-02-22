<?php
/**
 * Hero Section Template - EXACT MATCH with Original Plugin
 */

if (!defined('ABSPATH')) exit;

$plugin_name = isset($attributes['pluginName']) ? $attributes['pluginName'] : 'Plugin Name';
$hero_subtitle = isset($attributes['heroSubtitle']) ? $attributes['heroSubtitle'] : 'Plugin subtitle';
$plugin_price = isset($attributes['pluginPrice']) ? $attributes['pluginPrice'] : '29';
$plugin_original_price = isset($attributes['pluginOriginalPrice']) ? $attributes['pluginOriginalPrice'] : '49';
$total_value = isset($attributes['totalValue']) ? $attributes['totalValue'] : '199';
$buy_now_shortcode = isset($attributes['buyNowShortcode']) ? $attributes['buyNowShortcode'] : '';
$demo_link = isset($attributes['demoLink']) ? $attributes['demoLink'] : '';
$hero_image = isset($attributes['heroImageUrl']) ? $attributes['heroImageUrl'] : '';
?>

<!-- HERO SECTION - EXACT MATCH WITH ORIGINAL -->
<div class="sppm-plugin-page-hero">
    <div class="sppm-container">
        <section class="sppm-hero">
    <div class="sppm-hero-left">
        <div class="sppm-logo-row">
            <div class="sppm-logo-mark">
                <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="2" width="20" height="4" rx="2" fill="#5fa0d8"/>
                    <rect x="2" y="10" width="16" height="4" rx="2" fill="#82bfe4"/>
                    <rect x="2" y="18" width="12" height="4" rx="2" fill="#bcdff6"/>
                </svg>
            </div>
            <div class="sppm-logo-text">
                <?php echo esc_html($plugin_name); ?>
            </div>
        </div>

        <div class="sppm-rating">
            <div class="sppm-rating-stars">★ ★ ★ ★ ★</div>
            <div>5.0</div>
        </div>

        <h1 class="sppm-hero-title"><?php echo esc_html($plugin_name); ?></h1>
        <p class="sppm-hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>

        <div class="sppm-hero-ctas">
            <?php if ($buy_now_shortcode): ?>
                <?php echo do_shortcode($buy_now_shortcode); ?>
            <?php else: ?>
                <button class="sppm-btn sppm-btn-primary">Buy Now - $<?php echo esc_html($plugin_price); ?></button>
            <?php endif; ?>
            <?php if (!empty($demo_link) && $demo_link !== '#'): ?>
                <a href="<?php echo esc_url($demo_link); ?>" class="sppm-btn sppm-btn-ghost" target="_blank">Live Demo</a>
            <?php endif; ?>
        </div>

        <!-- Price and Total Value Section -->
        <?php if (!empty($plugin_price) || !empty($plugin_original_price) || !empty($total_value)): ?>
        <div class="sppm-price-wrapper">
            <div class="sppm-price-box">
                <div class="sppm-column">
                    <div class="sppm-label">Price</div>
                    <div class="sppm-price">
                        <?php if ($plugin_original_price && $plugin_original_price !== $plugin_price): ?>
                            <span class="sppm-old-price">$<?php echo esc_html($plugin_original_price); ?></span>
                        <?php endif; ?>
                        <span class="sppm-new-price">$<?php echo esc_html($plugin_price); ?></span>
                    </div>
                </div>

                <div class="sppm-divider"></div>

                <div class="sppm-column">
                    <div class="sppm-label">Total Value</div>
                    <div class="sppm-value">$<?php echo esc_html($total_value); ?>+</div>
                </div>
            </div>

            <div class="sppm-offer-badge">✨ Limited Time Offer!</div>
        </div>
        <?php endif; ?>
    </div>

    <div class="sppm-hero-right">
        <?php if ($hero_image): ?>
            <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($plugin_name); ?>" class="sppm-hero-image" />
        <?php else: ?>
            <div class="sppm-device">
                <div class="sppm-device-inner">
                    <h3>Plugin Preview</h3>
                    <div class="sppm-section-row">Getting Started <span>▾</span></div>
                    <div class="sppm-section-row">Configuration <span>▾</span></div>
                    <div class="sppm-section-row">Advanced Features <span>▾</span></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
    </div>
</div>
