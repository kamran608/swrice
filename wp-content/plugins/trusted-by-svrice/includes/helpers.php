<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get a single setting value, falling back to default.
 */
function tbs_get( $key, $sub_key = null ) {
    $settings = get_option( TBS_OPTION_KEY, [] );
    $defaults  = tbs_get_defaults();

    if ( $sub_key !== null ) {
        $arr = isset( $settings[ $key ] ) ? $settings[ $key ] : ( isset( $defaults[ $key ] ) ? $defaults[ $key ] : [] );
        return isset( $arr[ $sub_key ] ) ? $arr[ $sub_key ] : '';
    }

    if ( isset( $settings[ $key ] ) && $settings[ $key ] !== '' ) {
        return $settings[ $key ];
    }
    return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Get all settings merged with defaults.
 */
function tbs_get_all() {
    $saved    = get_option( TBS_OPTION_KEY, [] );
    $defaults = tbs_get_defaults();
    return array_merge( $defaults, $saved );
}

/**
 * Escape and output a text field value.
 */
function tbs_esc( $key ) {
    return esc_attr( tbs_get( $key ) );
}
