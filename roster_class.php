<?php
/**
 * @package   SUVBC roster
 * @author    Mike Brandt 
 * @license   GPL-2.0+
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
		add_action( 'admin_menu', array( $this, 'add_SUVBC_Roster_admin_menu' ) );

		// Add the options page and menu item.
		add_action( 'wp_enqueue_scripts', array( $this, 'SUVCB_enqueue_styles' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueSUVBC_admin_scripts' ) );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'activate_SUVBC_roster_jquery' ) );




	}
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function activate() {
		// TODO: Define activation functionality here
		include_once('views/public.php');
	}

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

	public function activate_SUVBC_roster_jquery() {
		wp_enqueue_script( 'jquery' );

	}

	public function SUVCB_enqueue_styles() {
		
		wp_register_style( 'Roster-style', plugins_url( 'css/SUVBCstyle.css', __FILE__ ), false, "1.0" );
		wp_enqueue_style( 'Roster-style' );

	}
	public function enqueueSUVBC_admin_scripts() {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
	}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function display_SUVBC_admin_page() {
		include_once( 'views/admin.php' );

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
	


	function SUVBC_roster_settings() {
		register_setting( 'suvbc_rotster_group', 'roster_set');
	}


	public function SUVBC_roster_install(){
		global $wpdb;

		$table_name = $wpdb->prefix . 'Roster';
		
		$sql = "CREATE TABLE " . $table_name . "(
			player_number int(3) NOT NULL,
			player_name tinytext NOT NULL,
			player_position varchar(2) NOT NULL,
			player_year varchar(2) NOT NULL,
			player_hometown tinytext NOT NULL,
			PRIMARY KEY  player_number (player_number)
			);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		$wpdb->insert(
			$table_name, 
			array(
				'player_number' 	=> '18',
				'player_name'		=> 'Name',
				'player_position' 	=> 'Po',
				'player_year'		=> 'Cl',
				'player_hometown'	=> 'Hometown'
				), 
			array(
					'%d',
					'%s',
					'%s',
					'%s',
					'%s'
				)
			);


		}

	}
?>