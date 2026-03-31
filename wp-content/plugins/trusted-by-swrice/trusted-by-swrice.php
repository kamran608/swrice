<?php
/**
 * Plugin Name: Trusted by SWRICE
 * Plugin URI:  https://swrice.com
 * Description: A fully customizable Trust & Reviews page builder with shortcode support. Edit every section, text, button and color from WordPress admin.
 * Version:     1.0.0
 * Author:      SWRICE
 * Author URI:  https://swrice.com
 * License:     GPL v2 or later
 * Text Domain: trusted-by-swrice
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TBS_VERSION',    '1.0.0' );
define( 'TBS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TBS_OPTION_KEY', 'tbs_swrice_settings' );

require_once TBS_PLUGIN_DIR . 'includes/defaults.php';
require_once TBS_PLUGIN_DIR . 'includes/helpers.php';
require_once TBS_PLUGIN_DIR . 'admin/admin-menu.php';
require_once TBS_PLUGIN_DIR . 'admin/admin-save.php';
require_once TBS_PLUGIN_DIR . 'public/shortcode.php';

register_activation_hook( __FILE__, 'tbs_on_activate' );
function tbs_on_activate() {
    if ( ! get_option( TBS_OPTION_KEY ) ) {
        update_option( TBS_OPTION_KEY, tbs_get_defaults() );
    }
}
