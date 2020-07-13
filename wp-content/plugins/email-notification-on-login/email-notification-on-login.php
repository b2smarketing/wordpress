<?php

/*
Plugin Name: Email Notification on login
Description: This plugin sends an email to the WordPress System email (Settings / General / Email Address) or any other configured email address each time somebody logs into WordPress. This is handy if there are not many logins each day or week to keep track of all of them and being able to detect non authorized logins.
Version: 1.2.0
Author: Apasionados
Author URI: https://apasionados.es/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: apa-enol
Domain Path: /languages
*/

# Start a session if not already started
# so that our $_SESSION variables would work
	if(session_id() == ''){
		session_start();
	}

# Check if the user is an admin
	function apa_enol_check_if_admin(){
		if(current_user_can('manage_options')){
			return true;
		}else{
			return false;
		}
	}
# Gets the time the admin logged in
	function apa_enol_get_date_of_login(){
		$apa_enol_date_format = get_option( 'date_format' );
		$apa_enol_date_of_login = date_i18n($apa_enol_date_format);
		return $apa_enol_date_of_login;
	}
	function apa_enol_get_time_of_login(){
		$apa_enol_time_format = get_option( 'time_format' );
		$apa_enol_time_of_login = date_i18n($apa_enol_time_format);
		return $apa_enol_time_of_login;
	}	
# Gets the IP of the user that logged himself as admin
	function apa_enol_get_ip(){
		$sources = array(
	'REMOTE_ADDR',
	'HTTP_X_FORWARDED_FOR',
	'HTTP_CLIENT_IP',
);
	foreach ($sources as $source) {
		if(!empty($_SERVER[$source])){
			$ip = $_SERVER[$source];
		}
	}
	return $ip;
	}

# Email all the info above to a pointed email address
function apa_enol_send_email( $login ){
	$apa_enol_website_name =  get_bloginfo('wpurl');
	$apa_enol_website_name = preg_replace('#^https?://#', '', rtrim($apa_enol_website_name,'/'));
	$apa_enol_admin_email =  get_option('admin_email'); 
	if ( is_email ( get_option( 'apa_enol_admin_email' ) ) ) {
		$apa_enol_admin_email = get_option( 'apa_enol_admin_email' );
	}
	//$current_user = wp_get_current_user();
	$current_user = get_user_by('login',$login); // Changed to work correctly with wp_login action
	//$user = wp_get_current_user();
	//if(wpautop($array['body']) == $array['body']) // The email is of HTML type
	//	$lineBreak = "<br/>";
	//else
		$lineBreak = "\n";
	//if(apa_enol_check_if_admin() === true and !isset($_SESSION['logged_in_once'])){
	if(!isset($_SESSION['logged_in_once'])){
		$apa_enol_date_login = apa_enol_get_date_of_login();
		$apa_enol_time_login = apa_enol_get_time_of_login();
		$apa_enol_ip = apa_enol_get_ip();
		if ( is_plugin_active( 'geoip-detect/geoip-detect.php' ) ) {
			$trackingCountry =  geoip_detect_get_info_from_current_ip();
			$trackingInfo = __('Country:','apa-enol') . ' ' . $trackingCountry->country_name . ' (' . $trackingCountry->country_code . ' - ' . $trackingCountry->continent_code . ')';
			if (!empty($trackingCountry->region_name)) {
				$trackingInfo .= ' - ' . __('Region:','apa-enol') . ' ' . $trackingCountry->region_name . '(' . $trackingCountry->region . ')';
			}
			if (!empty($trackingCountry->city)) {			
				$trackingInfo .= ' - ' . __('Postal Code + City:','apa-enol') . ' ' . $trackingCountry->postal_code . ' ' . $trackingCountry->city;		
			}
			$trackingInfo .= $lineBreak;
		}
		if ( in_array( 'administrator', (array) $current_user->roles ) ) {
			$user_type = __( 'Administrator', 'apa-enol' );
		}
		if ( in_array( 'editor', (array) $current_user->roles ) ) {
			$user_type = __( 'Editor', 'apa-enol' );
		}
		if ( in_array( 'author', (array) $current_user->roles ) ) {
			$user_type = __( 'Author', 'apa-enol' );
		}
		if ( in_array( 'contributor', (array) $current_user->roles ) ) {
			$user_type = __( 'Contributor', 'apa-enol' );
		}
		if (!isset($user_type) || $user_type == null) {
			$user_type = __( 'Unknown', 'apa-enol' );
		}
		# Email subject and message
		$subject = __( 'Login on', 'apa-enol' ) . ' ' . $apa_enol_website_name . ' (' . $current_user->user_login . ' - ' . $user_type . ')';
		$message = __( 'A user logged in your WordPress website ', 'apa-enol' ) . $apa_enol_website_name . ' ' . __( 'on', 'apa-enol' ) . ' ' . $apa_enol_date_login . ' ' . $apa_enol_time_login . $lineBreak . $lineBreak;
		$message .=  __( 'User', 'apa-enol' ) . ' ' . $current_user->user_login . ' ' . __( 'with user ID', 'apa-enol' ) . ' ' . $current_user->ID . ' (' . __( 'User type', 'apa-enol' ) . ': ' . $user_type .')' . $lineBreak . $lineBreak;
		$message .=  __( 'Login from IP', 'apa-enol' ) . ': ' . $apa_enol_ip . $lineBreak;
		if (!empty($trackingInfo)) {
			$message .=  __( 'IP info', 'apa-enol' ) . ': ' . $trackingInfo . $lineBreak;
		}
		if ( isset ($_SERVER["HTTP_USER_AGENT"]) )
			$message .= __('Browser is:','apa-enol') . ' ' . $_SERVER["HTTP_USER_AGENT"];
		# Sending of the email notification
			wp_mail(
					$apa_enol_admin_email
					, $subject
					, $message
					);
		# We assign 1 as to make so that the script does not sends emails on each page refresh like a deaf rooster
		$_SESSION['logged_in_once'] = 1;
	}
}
add_action('wp_login', 'apa_enol_send_email');

add_action('wp_logout', 'session_logout');
function session_logout() {
	session_destroy();
}


/**
 * Set plugin Page links for the plugins settings page
 */
function apa_enol_f_plugin_settings_link($links) {
	unset($links['edit']);
	$support_link   = '<a target="_blank" href="https://apasionados.es/contacto/">' . __('Support', 'apa-enol') . '</a>';
	$settings_link = '<a href="options-general.php?page=email-notification-on-login-settings">' . __('Settings', 'apa-enol') . '</a>';
	array_unshift( $links, $support_link );
	array_unshift( $links, $settings_link );
	return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'apa_enol_f_plugin_settings_link' );

/**
 * Do some check on plugin activation
  */
function apa_enol_f_activation() {
	$plugin_data = get_plugin_data( __FILE__ );
	$plugin_version = $plugin_data['Version'];
	$plugin_name = $plugin_data['Name'];
	if ( version_compare( PHP_VERSION, '5.5', '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( '<h1>' . __('Could not activate plugin: PHP version error', 'apa-enol' ) . '</h1><h2>PLUGIN: <i>' . $plugin_name . ' ' . $plugin_version . '</i></h2><p><strong>' . __('You are using PHP version', 'apa-enol' ) . ' ' . PHP_VERSION . '</strong>. ' . __( 'This plugin has been tested with PHP versions 5.5 and greater.', 'apa-enol' ) . '</p><p>' . __('WordPress itself <a href="https://wordpress.org/about/requirements/" target="_blank">recommends using PHP version 7 or greater</a>. Please upgrade your PHP version or contact your Server administrator.', 'apa-enol' ) . '</p>', __('Could not activate plugin: PHP version error', 'apa-enol' ), array( 'back_link' => true ) );
	}
	if ( NULL === get_option( 'apa_enol_admin_email', NULL ) ) {
		update_option( 'apa_enol_admin_email', get_option('admin_email') );
	}
	add_action( 'admin_init', 'apa_enol_f_register_settings' );
}
register_activation_hook( __FILE__, 'apa_enol_f_activation' );

/**
 * Delete options on plugin uninstall 
 */
function apa_enol_f_uninstall() {
	delete_option( 'apa_enol_admin_email' );
}
register_uninstall_hook( __FILE__, 'apa_enol_f_uninstall' );

/**
 * Add menu to Settings
 */
function apa_enol_f_nav(){
    add_options_page( 'Email Notification on login', 'Email Notification on Login', 'manage_options', 'email-notification-on-login-settings', 'apa_enol_f_include_settings_page' );
	add_action( 'admin_init', 'apa_enol_f_register_settings' );
}
add_action( 'admin_menu', 'apa_enol_f_nav' ); 

/**
 * Register Options
 */
function apa_enol_f_register_settings() {
	register_setting( 'apa-enol-settings-group', 'apa_enol_admin_email', 'apa_enol_sanitize_input' );
}
function apa_enol_sanitize_input($apa_enol_clean_code_admin_form) {
	$apa_enol_clean_code_admin_form = sanitize_text_field( $apa_enol_clean_code_admin_form );
	return $apa_enol_clean_code_admin_form;
}

function apa_enol_f_include_settings_page(){
    include(plugin_dir_path(__FILE__) . 'email-notification-on-login-settings.php');
}

/**
 * Read translations.
 */
function apa_enol_f_init() {
 load_plugin_textdomain( 'apa-enol', false,  dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'apa_enol_f_init');

# ♫ This is where the story ends, this is goodbye ♫
# EOF
?>
