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

	}
// add_action('admin_menu', 'SUVBC_roster_menu');

// function SUVBC_roster_menu()
// {
//     add_menu_page('Suvbc Roster', 'Roster', 'manage_options', __FILE__ );
// }
// function form_page(){

// }

// register_activation_hook( __FILE__, 'SUVBC_roster_install' );

// function SUVBC_roster_install(){
// 	global $wpdb;

// 	$SUVBC_Roster = $wpdb->prefix . 'SUVBCRoster';
	
// 	$sql = "CREATE TABLE " . $SUVBC_Roster . "(
// 		player_number int(3) NOT NULL,
// 		player_name tinytext NOT NULL,
// 		player_position varchar(2) NOT NULL,
// 		player_year varchar(2) NOT NULL,
// 		player_hometown tinytext NOT NULL,
// 		PRIMARY KEY  player_number (player_number)
// 		);";
// 	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
// 	dbDelta( $sql );


// }
}
?>