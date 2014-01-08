<?php
/**
 * Roster Plugin
 *
 * @package   SUVBC roster
 * @author    Mikey Brandt 
 * @license   GPL-2.0+
 */
/**
 * Plugin class.
 */
class SUVBC_ROSTER {
	
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

	/**
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'SUVBC_Rosters';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_SUVBC_Roster_admin_menu' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'activate_SUVBC_roster_jquery' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scriptsZ') );

		// Load style sheet.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_stylesX') );

		add_action( 'admin_init', array( $this, 'SUVBC_settings' ) );
		add_action( 'wp_ajax_save_player', array( $this, 'save_player_handler') );

	}
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate() {
		// TODO: Define activation functionality here
		include_once('views/public.php');
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
	}
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scriptsZ() {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
		}

	
	public function activate_SUVBC_roster_jquery() {
		wp_enqueue_script( 'jquery' );
	}


	/**
	 * Register and enqueue style sheet.
	 *
	 * @since    1.0.0
	 */

	public function enqueue_stylesX() {
		// wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/stylesss.css', false, '1.0.0' );
		// wp_enqueue_style( 'custom_wp_admin_css' );
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/stylesss.css', __FILE__ ), array(), $this->version );
	}
	


	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	
	public function add_SUVBC_Roster_admin_menu() {
		add_menu_page(
			__( 'SUVBC Roster'),
			__( 'SUVBC Roster' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_SUVBC_admin_page')
			);

	}
	


	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	
	public function display_SUVBC_admin_page() {
		include_once( 'views/admin.php' );

	}

	public function SUVBC_settings() {
		register_setting( 'suvbc_rotster_group', 'roster_set');
	}

	public function SUVBC_roster_install(){
		global $wpdb;

		$table_name = $wpdb->prefix . 'suvbc_Roster';
		
		$sql = "CREATE TABLE " . $table_name . "(
			player_number int(3) NOT NULL,
			player_name tinytext NOT NULL,
			player_position varchar(2) NOT NULL,
			player_year varchar(2) NOT NULL,
			player_hometown tinytext NOT NULL,
			player_img tinytext NOT NULL,
			player_bio varchar(500) NOT NULL,
			PRIMARY KEY  player_number (player_number)
			);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
?>