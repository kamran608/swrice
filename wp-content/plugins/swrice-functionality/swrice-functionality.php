<?php 

/**
 * Plugin Name: Swrice Functionality
 * Plugin URI: www.swrice.com
 * Description: This add-on help to send mail to admin after order complete
 * Author: swrice
 * Author URI: www.swrice.com
 * Version: 1.0
 * Plugin URL: www.swrice.com
 * Text Domain: custom-swrice
 */

if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Swrice_Functionality
 */
class Swrice_Functionality {

    const VERSION = '1.0';

    /**
     * @var self
     */
    private static $instance = null;

    /**
     * @since 1.0
     * @return $this
     */
    public static function instance() {

        if ( is_null( self::$instance ) && ! ( self::$instance instanceof Swrice_Functionality ) ) {
            self::$instance = new self;

            self::$instance->setup_constants();
            self::$instance->includes();
        }

        return self::$instance;
    }

    /**
     * defining constants for plugin
     */
    public function setup_constants() {

        /**
         * Directory
         */
        define( 'SWR_DIR', plugin_dir_path ( __FILE__ ) );
        define( 'SWR_DIR_FILE', SWR_DIR . basename ( __FILE__ ) );
        define( 'SWR_INCLUDES_DIR', trailingslashit ( SWR_DIR . 'includes' ) );
        define( 'SWR_TEMPLATES_DIR', trailingslashit ( SWR_DIR . 'templates' ) );
        define( 'SWR_BASE_DIR', plugin_basename(__FILE__));

        /**
         * URLs
         */
        define( 'SWR_URL', trailingslashit ( plugins_url ( '', __FILE__ ) ) );
        define( 'SWR_ASSETS_URL', trailingslashit ( SWR_URL . 'assets/' ) );

        /**
         * Text Domain
         */
        define( 'SWR_TEXT_DOMAIN', 'swrice-functionality' );

        /**
         * Version
         */
        define( 'SWR_VERSION', self::VERSION );
    }

    /**
     * Plugin requiered files
     */
    public function includes() {
        
        if( file_exists( SWR_INCLUDES_DIR.'/client-reviews.php' ) ) {
            require SWR_INCLUDES_DIR.'/client-reviews.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'header.php' ) ) {
            require SWR_INCLUDES_DIR.'header.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'swrice-menu-customize.php' ) ) {
            require SWR_INCLUDES_DIR.'swrice-menu-customize.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'footer-manager.php' ) ) {
            require SWR_INCLUDES_DIR.'footer-manager.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'header-manager.php' ) ) {
            require SWR_INCLUDES_DIR.'header-manager.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'plugin-buy-now.php' ) ) {
            require SWR_INCLUDES_DIR.'plugin-buy-now.php';
        }
        if( file_exists( SWR_INCLUDES_DIR.'plugin-post-list.php' ) ) {
            require SWR_INCLUDES_DIR.'plugin-post-list.php';
        }
        
        // Pages mein Categories add karne ke liye
        function add_categories_to_pages() {
            register_taxonomy_for_object_type('category', 'page');
        }
        add_action('init', 'add_categories_to_pages');

        add_action( 'wp_head', function() {

            if ( current_user_can( 'administrator' ) ) {
                return;
            }

            ?>
            <script src="https://cdn.logr-in.com/LogRocket.min.js" crossorigin="anonymous"></script>
            <script>window.LogRocket && window.LogRocket.init('rmkh0u/swrice');</script>
            <?php
        } );
    }
}

return Swrice_Functionality::instance();