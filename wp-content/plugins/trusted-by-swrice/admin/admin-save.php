<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_post_tbs_save_settings', 'tbs_handle_save' );
function tbs_handle_save() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );
    check_admin_referer( 'tbs_save', 'tbs_nonce' );

    $current = get_option( TBS_OPTION_KEY, tbs_get_defaults() );
    $tab     = isset( $_POST['tbs_tab'] ) ? sanitize_key( $_POST['tbs_tab'] ) : 'hero';

    $str  = fn( $k ) => isset( $_POST[ $k ] ) ? sanitize_text_field( $_POST[ $k ] ) : '';
    $url  = fn( $k ) => isset( $_POST[ $k ] ) ? esc_url_raw( $_POST[ $k ] ) : '';
    $html = fn( $k ) => isset( $_POST[ $k ] ) ? wp_kses_post( wp_unslash( $_POST[ $k ] ) ) : '';
    $ta   = fn( $k ) => isset( $_POST[ $k ] ) ? sanitize_textarea_field( wp_unslash( $_POST[ $k ] ) ) : '';

    switch ( $tab ) {

        case 'hero':
            $current['hero_eyebrow']      = $str( 'hero_eyebrow' );
            $current['hero_heading']      = $str( 'hero_heading' );
            $current['hero_subtitle']     = $str( 'hero_subtitle' );
            $current['hero_description']  = $ta( 'hero_description' );
            $current['hero_rating_label'] = $str( 'hero_rating_label' );
            $current['hero_clients_btn']  = $str( 'hero_clients_btn' );
            $current['hero_clients_url']  = $url( 'hero_clients_url' );
            break;

        case 'fcard':
            $current['fcard_years']    = $str( 'fcard_years' );
            $current['fcard_score']    = $str( 'fcard_score' );
            $current['fcard_line1']    = $str( 'fcard_line1' );
            $current['fcard_line2']    = $str( 'fcard_line2' );
            $current['fcard_line3']    = $str( 'fcard_line3' );
            $current['fcard_btn_text'] = $str( 'fcard_btn_text' );
            $current['fcard_btn_url']  = $url( 'fcard_btn_url' );
            break;

        case 'stats':
            for ( $i = 1; $i <= 4; $i++ ) {
                $current["stat{$i}_icon"]  = $str( "stat{$i}_icon" );
                $current["stat{$i}_num"]   = $str( "stat{$i}_num" );
                $current["stat{$i}_label"] = $str( "stat{$i}_label" );
            }
            break;

        case 'reviews':
            $current['reviews_eyebrow'] = $str( 'reviews_eyebrow' );
            $current['reviews_heading'] = $str( 'reviews_heading' );
            $current['reviews_subtext'] = $ta( 'reviews_subtext' );
            if ( isset( $_POST['reviews'] ) && is_array( $_POST['reviews'] ) ) {
                $reviews = [];
                foreach ( $_POST['reviews'] as $r ) {
                    $reviews[] = [
                        'name'    => sanitize_text_field( $r['name']    ?? '' ),
                        'date'    => sanitize_text_field( $r['date']    ?? '' ),
                        'initial' => sanitize_text_field( $r['initial'] ?? '' ),
                        'color'   => sanitize_hex_color(  $r['color']   ?? '#3b82f6' ),
                        'text'    => wp_kses_post( wp_unslash( $r['text'] ?? '' ) ),
                        'project' => sanitize_text_field( $r['project'] ?? '' ),
                    ];
                }
                $current['reviews'] = $reviews;
            }
            break;

        case 'testimonials':
            $current['testi_eyebrow'] = $str( 'testi_eyebrow' );
            $current['testi_heading'] = $str( 'testi_heading' );
            $current['testi_subtext'] = $ta( 'testi_subtext' );
            if ( isset( $_POST['testimonials'] ) && is_array( $_POST['testimonials'] ) ) {
                $testis = [];
                foreach ( $_POST['testimonials'] as $t ) {
                    $testis[] = [
                        'name'     => sanitize_text_field( $t['name']     ?? '' ),
                        'location' => sanitize_text_field( $t['location'] ?? '' ),
                        'initial'  => sanitize_text_field( $t['initial']  ?? '' ),
                        'color'    => sanitize_hex_color(  $t['color']    ?? '#3b82f6' ),
                        'text'     => wp_kses_post( wp_unslash( $t['text'] ?? '' ) ),
                        'platform' => sanitize_text_field( $t['platform'] ?? 'fiverr' ),
                    ];
                }
                $current['testimonials'] = $testis;
            }
            break;

        case 'tech':
            $current['tech_heading'] = $str( 'tech_heading' );
            $current['tech_subtext'] = $ta( 'tech_subtext' );
            if ( isset( $_POST['tech_chips'] ) && is_array( $_POST['tech_chips'] ) ) {
                $chips = [];
                foreach ( $_POST['tech_chips'] as $c ) {
                    if ( empty( $c['label'] ) ) continue;
                    $chips[] = [
                        'icon'  => sanitize_text_field( $c['icon']  ?? '' ),
                        'label' => sanitize_text_field( $c['label'] ?? '' ),
                    ];
                }
                $current['tech_chips'] = $chips;
            }
            if ( isset( $_POST['services'] ) && is_array( $_POST['services'] ) ) {
                $svcs = [];
                foreach ( $_POST['services'] as $svc ) {
                    if ( empty( $svc['title'] ) ) continue;
                    $svcs[] = [
                        'icon'  => sanitize_text_field( $svc['icon']  ?? '' ),
                        'bg'    => sanitize_hex_color(  $svc['bg']    ?? '#dbeafe' ),
                        'title' => sanitize_text_field( $svc['title'] ?? '' ),
                        'desc'  => sanitize_text_field( $svc['desc']  ?? '' ),
                    ];
                }
                $current['services'] = $svcs;
            }
            break;

        case 'cta':
            $current['cta_heading']   = $html( 'cta_heading' );
            $current['cta_subtext']   = $ta( 'cta_subtext' );
            $current['cta_note']      = $str( 'cta_note' );
            $current['cta_btn1_text'] = $str( 'cta_btn1_text' );
            $current['cta_btn1_url']  = $url( 'cta_btn1_url' );
            $current['cta_btn2_text'] = $str( 'cta_btn2_text' );
            $current['cta_btn2_url']  = $url( 'cta_btn2_url' );
            $current['cta_btn3_text'] = $str( 'cta_btn3_text' );
            $current['cta_btn3_url']  = $url( 'cta_btn3_url' );
            break;
    }

    update_option( TBS_OPTION_KEY, $current );

    wp_redirect( admin_url( 'admin.php?page=trusted-by-swrice&tab=' . $tab . '&saved=1' ) );
    exit;
}
