<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tbs_get( $key ) {
    $settings = get_option( TBS_OPTION_KEY, [] );
    $defaults  = tbs_get_defaults();
    if ( isset( $settings[ $key ] ) && $settings[ $key ] !== '' ) {
        return $settings[ $key ];
    }
    return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

function tbs_get_all() {
    $saved    = get_option( TBS_OPTION_KEY, [] );
    $defaults = tbs_get_defaults();
    return array_merge( $defaults, $saved );
}
