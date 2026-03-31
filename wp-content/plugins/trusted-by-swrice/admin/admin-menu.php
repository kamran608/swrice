<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'tbs_register_menu' );
function tbs_register_menu() {
    add_menu_page(
        'Trusted by SWRICE',
        'Trust by SWRICE',
        'manage_options',
        'trusted-by-swrice',
        'tbs_render_admin_page',
        'dashicons-awards',
        30
    );
}

/**
 * Enqueue admin assets ONLY on the plugin's own menu page.
 * $hook will be "toplevel_page_trusted-by-swrice" for the main menu page.
 */
add_action( 'admin_enqueue_scripts', 'tbs_admin_scripts' );
function tbs_admin_scripts( $hook ) {
    if ( $hook !== 'toplevel_page_trusted-by-swrice' ) return;
    wp_enqueue_style(  'tbs-admin-css', TBS_PLUGIN_URL . 'admin/admin-style.css', [], TBS_VERSION );
    wp_enqueue_script( 'tbs-admin-js',  TBS_PLUGIN_URL . 'admin/admin-script.js', [ 'jquery' ], TBS_VERSION, true );
}

function tbs_render_admin_page() {
    $tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'hero';
    $s   = tbs_get_all();

    $tabs = [
        'hero'         => '🦸 Hero',
        'fcard'        => '💚 Fiverr Card',
        'stats'        => '📊 Stats',
        'reviews'      => '⭐ Reviews',
        'testimonials' => '💬 Testimonials',
        'tech'         => '🛠 Tech & Services',
        'cta'          => '🚀 CTA Section',
    ];
    ?>
    <div class="tbs-wrap">
        <div class="tbs-header">
            <div class="tbs-header-logo">
                <span class="tbs-logo-icon">🏆</span>
                <div>
                    <h1>Trust by SWRICE</h1>
                    <p>Manage your Trust &amp; Reviews page — every section, every word.</p>
                </div>
            </div>
            <div class="tbs-shortcode-box">
                <label>Shortcode — paste on any page:</label>
                <code>[trust_by_swrice]</code>
                <button type="button" class="tbs-copy-btn" onclick="tbsCopy('[trust_by_swrice]', this)">📋 Copy</button>
            </div>
        </div>

        <div class="tbs-layout">
            <nav class="tbs-sidebar">
                <?php foreach ( $tabs as $key => $label ) :
                    $active = ( $tab === $key ) ? 'active' : '';
                    $url    = admin_url( 'admin.php?page=trusted-by-swrice&tab=' . $key );
                ?>
                <a href="<?php echo esc_url( $url ); ?>" class="tbs-nav-link <?php echo $active; ?>">
                    <?php echo $label; ?>
                </a>
                <?php endforeach; ?>
            </nav>

            <div class="tbs-main">
                <?php if ( isset( $_GET['saved'] ) ) : ?>
                    <div class="tbs-notice">✅ Settings saved successfully!</div>
                <?php endif; ?>

                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <?php wp_nonce_field( 'tbs_save', 'tbs_nonce' ); ?>
                    <input type="hidden" name="action"  value="tbs_save_settings">
                    <input type="hidden" name="tbs_tab" value="<?php echo esc_attr( $tab ); ?>">

                    <?php
                    switch ( $tab ) {
                        case 'fcard':        tbs_tab_fcard( $s );        break;
                        case 'stats':        tbs_tab_stats( $s );        break;
                        case 'reviews':      tbs_tab_reviews( $s );      break;
                        case 'testimonials': tbs_tab_testimonials( $s ); break;
                        case 'tech':         tbs_tab_tech( $s );         break;
                        case 'cta':          tbs_tab_cta( $s );          break;
                        default:             tbs_tab_hero( $s );         break;
                    }
                    ?>

                    <div class="tbs-save-bar">
                        <button type="submit" class="tbs-save-btn">💾 Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/* ─── SHARED FIELD HELPERS ────────────────────── */

function tbs_field( $label, $name, $value, $type = 'text', $desc = '' ) {
    echo '<div class="tbs-field">';
    echo '<label>' . esc_html( $label ) . '</label>';
    if ( $type === 'textarea' ) {
        echo '<textarea name="' . esc_attr( $name ) . '" rows="3">' . esc_textarea( $value ) . '</textarea>';
    } elseif ( $type === 'html' ) {
        echo '<textarea name="' . esc_attr( $name ) . '" rows="3" class="tbs-html-field">' . esc_textarea( $value ) . '</textarea>';
    } else {
        echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
    }
    if ( $desc ) echo '<p class="tbs-desc">' . esc_html( $desc ) . '</p>';
    echo '</div>';
}

function tbs_card( $title, $cb ) {
    echo '<div class="tbs-card"><div class="tbs-card-title">' . $title . '</div>';
    $cb();
    echo '</div>';
}

/* ─── TAB RENDERERS ─────────────────────────────── */

function tbs_tab_hero( $s ) {
    echo '<div class="tbs-tab-title">🦸 Hero Section</div>';
    tbs_card( '✏️ Hero Content', function() use ( $s ) {
        tbs_field( 'Top Eyebrow Text',    'hero_eyebrow',      $s['hero_eyebrow'] );
        tbs_field( 'Main Heading',         'hero_heading',      $s['hero_heading'] );
        tbs_field( 'Subtitle',             'hero_subtitle',     $s['hero_subtitle'] );
        tbs_field( 'Description',          'hero_description',  $s['hero_description'], 'textarea' );
        tbs_field( 'Rating Label Text',    'hero_rating_label', $s['hero_rating_label'] );
        tbs_field( 'Clients Button Text',  'hero_clients_btn',  $s['hero_clients_btn'] );
        tbs_field( 'Clients Button URL',   'hero_clients_url',  $s['hero_clients_url'],  'url' );
    } );
}

function tbs_tab_fcard( $s ) {
    echo '<div class="tbs-tab-title">💚 Fiverr Card</div>';
    tbs_card( '🟢 Fiverr Card Settings', function() use ( $s ) {
        tbs_field( 'Years Badge Text', 'fcard_years',    $s['fcard_years'] );
        tbs_field( 'Rating Score',     'fcard_score',    $s['fcard_score'] );
        tbs_field( 'Check Line 1',     'fcard_line1',    $s['fcard_line1'] );
        tbs_field( 'Check Line 2',     'fcard_line2',    $s['fcard_line2'] );
        tbs_field( 'Check Line 3',     'fcard_line3',    $s['fcard_line3'] );
        tbs_field( 'Button Text',      'fcard_btn_text', $s['fcard_btn_text'] );
        tbs_field( 'Button URL',       'fcard_btn_url',  $s['fcard_btn_url'],  'url' );
    } );
}

function tbs_tab_stats( $s ) {
    echo '<div class="tbs-tab-title">📊 Stats Section</div>';
    for ( $i = 1; $i <= 4; $i++ ) {
        tbs_card( "📌 Stat #{$i}", function() use ( $s, $i ) {
            tbs_field( 'Icon (emoji)', "stat{$i}_icon",  $s["stat{$i}_icon"] );
            tbs_field( 'Number',       "stat{$i}_num",   $s["stat{$i}_num"] );
            tbs_field( 'Label',        "stat{$i}_label", $s["stat{$i}_label"] );
        } );
    }
}

function tbs_tab_reviews( $s ) {
    echo '<div class="tbs-tab-title">⭐ Client Reviews</div>';
    tbs_card( '📋 Section Header', function() use ( $s ) {
        tbs_field( 'Eyebrow Text', 'reviews_eyebrow', $s['reviews_eyebrow'] );
        tbs_field( 'Heading',      'reviews_heading', $s['reviews_heading'] );
        tbs_field( 'Subtext',      'reviews_subtext', $s['reviews_subtext'], 'textarea' );
    } );

    $reviews = isset( $s['reviews'] ) ? $s['reviews'] : [];
    foreach ( $reviews as $i => $r ) :
        $n = $i + 1;
        tbs_card( "⭐ Review #{$n}", function() use ( $r, $i ) {
            tbs_field( 'Reviewer Name',               "reviews[{$i}][name]",    $r['name'] );
            tbs_field( 'Date',                         "reviews[{$i}][date]",    $r['date'] );
            tbs_field( 'Avatar Initial (1 letter)',    "reviews[{$i}][initial]", $r['initial'] );
            tbs_field( 'Avatar Color',                 "reviews[{$i}][color]",   $r['color'], 'color' );
            tbs_field( 'Review Text (HTML allowed)',   "reviews[{$i}][text]",    $r['text'], 'html' );
            tbs_field( 'Project Tag',                  "reviews[{$i}][project]", $r['project'] );
        } );
    endforeach;
}

function tbs_tab_testimonials( $s ) {
    echo '<div class="tbs-tab-title">💬 Testimonials</div>';
    tbs_card( '📋 Section Header', function() use ( $s ) {
        tbs_field( 'Eyebrow', 'testi_eyebrow', $s['testi_eyebrow'] );
        tbs_field( 'Heading', 'testi_heading', $s['testi_heading'] );
        tbs_field( 'Subtext', 'testi_subtext', $s['testi_subtext'], 'textarea' );
    } );

    $testis = isset( $s['testimonials'] ) ? $s['testimonials'] : [];
    foreach ( $testis as $i => $t ) :
        $n = $i + 1;
        tbs_card( "💬 Testimonial #{$n}", function() use ( $t, $i ) {
            tbs_field( 'Name',                       "testimonials[{$i}][name]",     $t['name'] );
            tbs_field( 'Location',                   "testimonials[{$i}][location]", $t['location'] );
            tbs_field( 'Avatar Initial (1 letter)',  "testimonials[{$i}][initial]",  $t['initial'] );
            tbs_field( 'Avatar Color',               "testimonials[{$i}][color]",    $t['color'], 'color' );
            tbs_field( 'Text (HTML allowed)',         "testimonials[{$i}][text]",     $t['text'], 'html' );
            tbs_field( 'Platform Label',             "testimonials[{$i}][platform]", $t['platform'] );
        } );
    endforeach;
}

function tbs_tab_tech( $s ) {
    echo '<div class="tbs-tab-title">🛠 Technologies &amp; Services</div>';
    tbs_card( '📋 Section Header', function() use ( $s ) {
        tbs_field( 'Heading', 'tech_heading', $s['tech_heading'] );
        tbs_field( 'Subtext', 'tech_subtext', $s['tech_subtext'], 'textarea' );
    } );

    $chips = isset( $s['tech_chips'] ) ? $s['tech_chips'] : [];
    tbs_card( '⚙️ Technology Chips', function() use ( $chips ) {
        echo '<p class="tbs-desc" style="margin-bottom:12px;">Each row = one chip displayed on the page.</p>';
        foreach ( $chips as $i => $chip ) {
            echo '<div class="tbs-inline-row">';
            echo '<input type="text" name="tech_chips[' . $i . '][icon]"  value="' . esc_attr( $chip['icon'] )  . '" placeholder="emoji" style="width:60px">';
            echo '<input type="text" name="tech_chips[' . $i . '][label]" value="' . esc_attr( $chip['label'] ) . '" placeholder="Label">';
            echo '</div>';
        }
    } );

    $services = isset( $s['services'] ) ? $s['services'] : [];
    tbs_card( '📋 Services', function() use ( $services ) {
        foreach ( $services as $i => $svc ) {
            echo '<div class="tbs-service-row">';
            echo '<div class="tbs-inline-row">';
            echo '<input type="text"  name="services[' . $i . '][icon]"  value="' . esc_attr( $svc['icon'] )  . '" placeholder="emoji" style="width:55px">';
            echo '<input type="color" name="services[' . $i . '][bg]"    value="' . esc_attr( $svc['bg'] )    . '" style="width:50px;height:36px;border:none;padding:2px;cursor:pointer">';
            echo '<input type="text"  name="services[' . $i . '][title]" value="' . esc_attr( $svc['title'] ) . '" placeholder="Service Title" style="flex:1">';
            echo '</div>';
            echo '<input type="text" name="services[' . $i . '][desc]" value="' . esc_attr( $svc['desc'] ) . '" placeholder="Short description" style="width:100%;margin-top:6px">';
            echo '</div>';
        }
    } );
}

function tbs_tab_cta( $s ) {
    echo '<div class="tbs-tab-title">🚀 CTA Section</div>';
    tbs_card( '🎯 Call to Action Content', function() use ( $s ) {
        tbs_field( 'Heading (HTML allowed)', 'cta_heading', $s['cta_heading'], 'html' );
        tbs_field( 'Subtext',                'cta_subtext', $s['cta_subtext'], 'textarea' );
        tbs_field( 'Note Text (below buttons)', 'cta_note', $s['cta_note'] );
    } );
    tbs_card( '🔘 CTA Buttons', function() use ( $s ) {
        tbs_field( 'Button 1 Text', 'cta_btn1_text', $s['cta_btn1_text'] );
        tbs_field( 'Button 1 URL',  'cta_btn1_url',  $s['cta_btn1_url'],  'url' );
        tbs_field( 'Button 2 Text', 'cta_btn2_text', $s['cta_btn2_text'] );
        tbs_field( 'Button 2 URL',  'cta_btn2_url',  $s['cta_btn2_url'],  'url' );
        tbs_field( 'Button 3 Text', 'cta_btn3_text', $s['cta_btn3_text'] );
        tbs_field( 'Button 3 URL',  'cta_btn3_url',  $s['cta_btn3_url'],  'url' );
    } );
}
