<?php
/**
 * Load plugin's files with check for installing it as a standalone plugin or
 * a module of a theme / plugin. If standalone plugin is already installed, it
 * will take higher priority.
 *
 * @package Meta Box
 */

/**
 * Plugin loader class.
 *
 * @package Meta Box
 */
class Bestwebsite_Loader {
	/**
	 * Define plugin constants.
	 */
	protected function constants() {
		// Script version, used to add version for scripts and styles.
		define( 'Bestwebsite_VER', '5.2.10' );

		list( $path, $url ) = self::get_path( dirname( dirname( __FILE__ ) ) );

		// Plugin URLs, for fast enqueuing scripts and styles.
		define( 'Bestwebsite_URL', $url );
		define( 'Bestwebsite_JS_URL', trailingslashit( Bestwebsite_URL . 'js' ) );
		define( 'Bestwebsite_CSS_URL', trailingslashit( Bestwebsite_URL . 'css' ) );

		// Plugin paths, for including files.
		define( 'Bestwebsite_DIR', $path );
		define( 'Bestwebsite_INC_DIR', trailingslashit( Bestwebsite_DIR . 'inc' ) );
	}

	/**
	 * Get plugin base path and URL.
	 * The method is static and can be used in extensions.
	 *
	 * @link http://www.deluxeblogtips.com/2013/07/get-url-of-php-file-in-wordpress.html
	 * @param string $path Base folder path.
	 * @return array Path and URL.
	 */
	public static function get_path( $path = '' ) {
		// Plugin base path.
		$path       = wp_normalize_path( untrailingslashit( $path ) );
		$themes_dir = wp_normalize_path( untrailingslashit( dirname( get_stylesheet_directory() ) ) );

		// Default URL.
		$url = plugins_url( '', $path . '/' . basename( $path ) . '.php' );

		// Included into themes.
		if (
			0 !== strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) )
			&& 0 !== strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) )
			&& 0 === strpos( $path, $themes_dir )
		) {
			$themes_url = untrailingslashit( dirname( get_stylesheet_directory_uri() ) );
			$url        = str_replace( $themes_dir, $themes_url, $path );
		}

		$path = trailingslashit( $path );
		$url  = trailingslashit( $url );

		return array( $path, $url );
	}

	/**
	 * Bootstrap the plugin.
	 */
	public function init() {
		$this->constants();

		// Register autoload for classes.
		require_once Bestwebsite_INC_DIR . 'autoloader.php';
		$autoloader = new Bestwebsite_Autoloader();
		$autoloader->add( Bestwebsite_INC_DIR, 'RW_' );
		$autoloader->add( Bestwebsite_INC_DIR, 'Bestwebsite_' );
		$autoloader->add( Bestwebsite_INC_DIR . 'about', 'Bestwebsite_' );
		$autoloader->add( Bestwebsite_INC_DIR . 'fields', 'Bestwebsite_', '_Field' );
		$autoloader->add( Bestwebsite_INC_DIR . 'walkers', 'Bestwebsite_Walker_' );
		$autoloader->add( Bestwebsite_INC_DIR . 'interfaces', 'Bestwebsite_', '_Interface' );
		$autoloader->add( Bestwebsite_INC_DIR . 'storages', 'Bestwebsite_', '_Storage' );
		$autoloader->add( Bestwebsite_INC_DIR . 'helpers', 'Bestwebsite_Helpers_' );
		$autoloader->add( Bestwebsite_INC_DIR . 'update', 'Bestwebsite_Update_' );
		$autoloader->register();

		// Plugin core.
		$core = new Bestwebsite_Core();
		$core->init();

		// Validation module.
		new Bestwebsite_Validation();

		$sanitizer = new Bestwebsite_Sanitizer();
		$sanitizer->init();

		$media_modal = new Bestwebsite_Media_Modal();
		$media_modal->init();

		// WPML Compatibility.
		$wpml = new Bestwebsite_WPML();
		$wpml->init();

		// Update.
		$update_option  = new Bestwebsite_Update_Option();
		$update_checker = new Bestwebsite_Update_Checker( $update_option );
		$update_checker->init();
		$update_settings = new Bestwebsite_Update_Settings( $update_checker, $update_option );
		$update_settings->init();
		$update_notification = new Bestwebsite_Update_Notification( $update_checker, $update_option );
		$update_notification->init();

		if ( is_admin() ) {
			$about = new Bestwebsite_About( $update_checker );
			$about->init();
		}

		// Public functions.
		require_once Bestwebsite_INC_DIR . 'functions.php';
	}
}
