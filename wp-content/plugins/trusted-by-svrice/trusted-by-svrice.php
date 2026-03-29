<?php
/**
 * Plugin Name: Trusted by SVRICE
 * Plugin URI:  https://svrice.com
 * Description: A fully customizable Trust & Reviews page builder with shortcode support. Edit every section, text, button and color from WordPress admin.
 * Version:     1.0.0
 * Author:      SVRICE
 * Author URI:  https://svrice.com
 * License:     GPL v2 or later
 * Text Domain: trusted-by-svrice
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TBS_VERSION',  '1.0.0' );
define( 'TBS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TBS_OPTION_KEY', 'tbs_settings' );

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
