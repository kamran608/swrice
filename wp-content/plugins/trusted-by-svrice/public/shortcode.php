<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'trust_by_svrice', 'tbs_render_shortcode' );

function tbs_render_shortcode() {
    $s = tbs_get_all();

    wp_enqueue_style(  'tbs-public-css', TBS_PLUGIN_URL . 'public/css/tbs-public.css', [], TBS_VERSION );
    wp_enqueue_script( 'tbs-public-js',  TBS_PLUGIN_URL . 'public/js/tbs-public.js',  [], TBS_VERSION, true );

    ob_start();
    ?>
    <div class="tbs-page">

    <!-- ══ HERO ══════════════════════════════════════ -->
    <section class="tbs-hero">
        <div class="tbs-container">
            <div class="tbs-hero-inner">
                <div class="tbs-hero-left">
                    <div class="tbs-eyebrow-badge tbs-fade">
                        <span class="tbs-pulse-dot"></span>
                        <?php echo esc_html( $s['hero_eyebrow'] ); ?>
                    </div>
                    <h1 class="tbs-fade"><?php echo esc_html( $s['hero_heading'] ); ?></h1>
                    <p class="tbs-hero-subtitle tbs-fade"><?php echo esc_html( $s['hero_subtitle'] ); ?></p>
                    <p class="tbs-hero-desc tbs-fade"><?php echo esc_html( $s['hero_description'] ); ?></p>
                    <div class="tbs-rating-bar tbs-fade">
                        <div class="tbs-rating-left">
                            <span class="tbs-gold-star">★</span>
                            <div class="tbs-rating-label"><?php echo esc_html( $s['hero_rating_label'] ); ?></div>
                        </div>
                        <div class="tbs-rating-div"></div>
                        <div class="tbs-rating-right">
                            <a href="<?php echo esc_url( $s['hero_clients_url'] ); ?>" class="tbs-btn tbs-btn-green" style="font-size:13px;padding:10px 22px;">
                                👥 <?php echo esc_html( $s['hero_clients_btn'] ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Fiverr Card -->
                <div class="tbs-fade">
                    <div class="tbs-fcard">
                        <div class="tbs-fcard-head">
                            <div class="tbs-fcard-logo">
                                <div class="tbs-fcard-logo-icon">f</div>
                                iverr
                            </div>
                            <span class="tbs-fcard-years"><?php echo esc_html( $s['fcard_years'] ); ?></span>
                        </div>
                        <div class="tbs-fcard-body">
                            <div class="tbs-fcard-rating">
                                <div class="tbs-fcard-stars">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                </div>
                                <span class="tbs-fcard-score"><?php echo esc_html( $s['fcard_score'] ); ?></span>
                            </div>
                            <div class="tbs-fcard-item">
                                <div class="tbs-fcard-check">✓</div>
                                <div class="tbs-fcard-text"><?php echo esc_html( $s['fcard_line1'] ); ?></div>
                            </div>
                            <div class="tbs-fcard-item">
                                <div class="tbs-fcard-check">✓</div>
                                <div class="tbs-fcard-text"><?php echo esc_html( $s['fcard_line2'] ); ?></div>
                            </div>
                            <div class="tbs-fcard-item">
                                <div class="tbs-fcard-check">✓</div>
                                <div class="tbs-fcard-text"><?php echo esc_html( $s['fcard_line3'] ); ?></div>
                            </div>
                            <div class="tbs-fcard-cta">
                                <a href="<?php echo esc_url( $s['fcard_btn_url'] ); ?>" class="tbs-btn tbs-btn-green">
                                    ✓ <?php echo esc_html( $s['fcard_btn_text'] ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ STATS ═════════════════════════════════════ -->
    <section class="tbs-stats">
        <div class="tbs-container">
            <div class="tbs-stats-grid">
                <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                <div class="tbs-stat tbs-fade">
                    <div class="tbs-stat-icon"><?php echo esc_html( $s["stat{$i}_icon"] ); ?></div>
                    <div class="tbs-stat-num"><?php echo esc_html( $s["stat{$i}_num"] ); ?></div>
                    <div class="tbs-stat-label"><?php echo esc_html( $s["stat{$i}_label"] ); ?></div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- ══ REVIEWS ═══════════════════════════════════ -->
    <section class="tbs-reviews" id="tbs-reviews">
        <div class="tbs-container">
            <div class="tbs-sec-header tbs-fade">
                <div class="tbs-sec-eyebrow"><?php echo esc_html( $s['reviews_eyebrow'] ); ?></div>
                <h2><?php echo esc_html( $s['reviews_heading'] ); ?></h2>
                <p><?php echo esc_html( $s['reviews_subtext'] ); ?></p>
            </div>
            <div class="tbs-reviews-grid">
                <?php foreach ( $s['reviews'] as $r ) : ?>
                <div class="tbs-review-card tbs-fade">
                    <div class="tbs-rc-top">
                        <span class="tbs-rc-brand">fiverr</span>
                        <div class="tbs-rc-stars">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                    </div>
                    <div class="tbs-rc-reviewer">
                        <div class="tbs-rc-avatar" style="background:<?php echo esc_attr( $r['color'] ); ?>">
                            <?php echo esc_html( $r['initial'] ); ?>
                        </div>
                        <div>
                            <div class="tbs-rc-name"><?php echo esc_html( $r['name'] ); ?></div>
                            <div class="tbs-rc-date"><?php echo esc_html( $r['date'] ); ?></div>
                        </div>
                    </div>
                    <div class="tbs-rc-text"><?php echo wp_kses_post( $r['text'] ); ?></div>
                    <div class="tbs-rc-project">📌 <span><?php echo esc_html( $r['project'] ); ?></span></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ══ TRUST BANNER ══════════════════════════════ -->
    <div class="tbs-trust-banner">
        <div class="tbs-container">
            <div class="tbs-trust-inner">
                <div class="tbs-trust-item">
                    <span class="tbs-t-icon">👥</span>
                    <div><?php echo wp_kses_post( $s['trust_text1'] ); ?></div>
                </div>
                <div class="tbs-trust-sep"></div>
                <div class="tbs-trust-item">
                    <span class="tbs-t-icon">⭐</span>
                    <div><?php echo wp_kses_post( $s['trust_text2'] ); ?></div>
                </div>
                <div class="tbs-trust-sep"></div>
                <div class="tbs-trust-item">
                    <span class="tbs-t-icon">👥</span>
                    <div><?php echo wp_kses_post( $s['trust_text3'] ); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ TESTIMONIALS ══════════════════════════════ -->
    <section class="tbs-testimonials" id="tbs-testimonials">
        <div class="tbs-container">
            <div class="tbs-sec-header tbs-fade">
                <div class="tbs-sec-eyebrow"><?php echo esc_html( $s['testi_eyebrow'] ); ?></div>
                <h2><?php echo esc_html( $s['testi_heading'] ); ?></h2>
                <p><?php echo esc_html( $s['testi_subtext'] ); ?></p>
            </div>
            <div class="tbs-testi-wrap tbs-fade">
                <div class="tbs-testi-title">
                    <span class="tbs-testi-title-icon">💬</span>
                    Client Testimonials
                </div>
                <div class="tbs-testi-grid">
                    <?php foreach ( $s['testimonials'] as $t ) : ?>
                    <div class="tbs-tcard">
                        <div class="tbs-tcard-top">
                            <div class="tbs-tcard-avatar" style="background:<?php echo esc_attr( $t['color'] ); ?>">
                                <?php echo esc_html( $t['initial'] ); ?>
                            </div>
                            <div>
                                <div class="tbs-tcard-name"><?php echo esc_html( $t['name'] ); ?></div>
                                <div class="tbs-tcard-location"><?php echo esc_html( $t['location'] ); ?></div>
                            </div>
                            <div class="tbs-tcard-stars">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                        </div>
                        <div class="tbs-tcard-text"><?php echo wp_kses_post( $t['text'] ); ?></div>
                        <div class="tbs-tcard-footer">
                            <div class="tbs-tcard-author"><?php echo esc_html( $t['name'] ); ?></div>
                            <div class="tbs-tcard-platform">🟢 <?php echo esc_html( $t['platform'] ); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ TECH & SERVICES ═══════════════════════════ -->
    <section class="tbs-tech" id="tbs-services">
        <div class="tbs-container">
            <div class="tbs-sec-header tbs-fade">
                <div class="tbs-sec-eyebrow">🛠 Technologies & Services</div>
                <h2><?php echo esc_html( $s['tech_heading'] ); ?></h2>
                <p><?php echo esc_html( $s['tech_subtext'] ); ?></p>
            </div>
            <div class="tbs-tech-inner">
                <div>
                    <div class="tbs-col-title tbs-fade">
                        <span class="tbs-col-title-icon" style="background:#dbeafe;color:#1d4ed8;">⚙️</span>
                        Technologies
                    </div>
                    <div class="tbs-chips tbs-fade">
                        <?php foreach ( $s['tech_chips'] as $chip ) : ?>
                        <span class="tbs-chip">
                            <span class="tbs-chip-icon"><?php echo esc_html( $chip['icon'] ); ?></span>
                            <?php echo esc_html( $chip['label'] ); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <div class="tbs-col-title tbs-fade">
                        <span class="tbs-col-title-icon" style="background:#d1fae5;color:#065f46;">📋</span>
                        Services
                    </div>
                    <div class="tbs-svc-list tbs-fade">
                        <?php foreach ( $s['services'] as $svc ) : ?>
                        <div class="tbs-svc-item">
                            <div class="tbs-svc-icon" style="background:<?php echo esc_attr( $svc['bg'] ); ?>">
                                <?php echo esc_html( $svc['icon'] ); ?>
                            </div>
                            <div>
                                <div class="tbs-svc-title"><?php echo esc_html( $svc['title'] ); ?></div>
                                <div class="tbs-svc-desc"><?php echo esc_html( $svc['desc'] ); ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ CTA ═══════════════════════════════════════ -->
    <section class="tbs-cta" id="tbs-contact">
        <div class="tbs-container tbs-cta-inner">
            <div class="tbs-cta-logos tbs-fade">
                <div class="tbs-cta-logo"><span class="tbs-cta-logo-icon">🔷</span> WordPress</div>
                <div class="tbs-cta-logo-sep"></div>
                <div class="tbs-cta-logo"><span class="tbs-cta-logo-icon">🎓</span> LearnDash+</div>
            </div>
            <div class="tbs-cta-heading tbs-fade"><?php echo wp_kses_post( $s['cta_heading'] ); ?></div>
            <p class="tbs-cta-sub tbs-fade"><?php echo esc_html( $s['cta_subtext'] ); ?></p>
            <div class="tbs-cta-buttons tbs-fade">
                <a href="<?php echo esc_url( $s['cta_btn1_url'] ); ?>" class="tbs-btn tbs-btn-outline">
                    <?php echo esc_html( $s['cta_btn1_text'] ); ?>
                </a>
                <a href="<?php echo esc_url( $s['cta_btn2_url'] ); ?>" class="tbs-btn tbs-btn-outline">
                    <?php echo esc_html( $s['cta_btn2_text'] ); ?>
                </a>
                <a href="<?php echo esc_url( $s['cta_btn3_url'] ); ?>" class="tbs-btn tbs-btn-green">
                    <?php echo esc_html( $s['cta_btn3_text'] ); ?>
                </a>
            </div>
            <div class="tbs-cta-note tbs-fade"><?php echo esc_html( $s['cta_note'] ); ?></div>
        </div>
    </section>

    <!-- ══ FOOTER ════════════════════════════════════ -->
    <footer class="tbs-footer">
        <div class="tbs-container">
            <div class="tbs-footer-inner">
                <div class="tbs-footer-logo">
                    <span class="tbs-logo-s"><?php echo esc_html( substr( $s['nav_logo_text'], 0, 1 ) ); ?></span><?php echo esc_html( substr( $s['nav_logo_text'], 1 ) ); ?>
                </div>
                <div class="tbs-footer-copy"><?php echo esc_html( $s['footer_text'] ); ?></div>
            </div>
        </div>
    </footer>

    </div><!-- .tbs-page -->
    <?php
    return ob_get_clean();
}
