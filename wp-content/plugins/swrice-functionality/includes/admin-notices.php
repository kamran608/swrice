<?php
/**
 * Admin Notices
 *
 * @package Swrice_Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Swrice_Admin_Notices
 */
class Swrice_Admin_Notices {

	/**
	 * @var self
	 */
	private static $instance = null;

	/**
	 * @since 1.0
	 * @return $this
	 */
	public static function instance() {

		if ( is_null( self::$instance ) && ! ( self::$instance instanceof Swrice_Admin_Notices ) ) {
			self::$instance = new self();

			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Register hooks
	 */
	public function hooks() {
		add_action( 'admin_notices', array( $this, 'display_swrice_agent_notice' ) );
	}

	/**
	 * Display SWRICE Agent Test notice
	 */
	public function display_swrice_agent_notice() {
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php echo esc_html__( 'SWRICE Agent Test', 'swrice-functionality' ); ?></p>
		</div>
		<?php
	}
}

return Swrice_Admin_Notices::instance();
