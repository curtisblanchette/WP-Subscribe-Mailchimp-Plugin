<?php
/**
 * Plugin Name: Curt's Modal Overlay for Politik.io
 * Plugin URI: https://github.com/curtisblanchette/WP-Subscribe-Mailchimp-Plugin
 * Description: Responsive modal overlay that blurs the background.
 * Version: 1.0.0
 * Author: Curtis Blanchette
 * Author URI: http://www.blanchettedesigns.com
 * License: GPL2
 */
/*  Copyright 2015  CURTIS_BLANCHETTE  (email : curtis.blanchette88@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(session_id()==''){
	session_start();
}
if(!class_exists('Curts_Modal_Overlay')) {

	class Curts_Modal_Overlay {
		/**
		 * Construct the plugin object
		 */
		public function __construct() {
			// Register Scripts
			add_action( 'wp_footer', array($this, 'enqueueAssets') );

			// hook into the admin_init and admin_menu actions
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
			
			
		}

		/**
		 * Enqueue plugin Assets
		 */
		public function enqueueAssets() {


			$plugins_url = plugins_url();

			// store the variables to be passed to the script
			$script_vars = array(
				'setting_1' => get_option('modal_heading'),
				'setting_2' => get_option('modal_content'),
				'plugin_url' => $plugins_url,
			);

		    wp_enqueue_script('curts_modal_overlay', plugins_url('js/subscribeModal.js', __FILE__), array( 'jquery' ), '', true);
		    wp_localize_script('curts_modal_overlay', 'curts_vars', $script_vars);
		    wp_register_script('curts_modal_overlay', plugins_url('js/subscribeModal.js', __FILE__) );

		}

		/**
		 * Activate the plugin
		 */
		public static function activate() {
			//do nothing
		}
		
		/**
		 * Deactivate the plugin
		 */
		public static function deactivate() {
			//do nothing
		}

		/**
		 * Hook into WP's admin_init action hook
		 */
		public function admin_init() {
			// set up the settings for this plugin
			$this->init_settings();
			wp_register_script('curts_modal_overlay_settings', plugins_url('js/settingsPage.js', __FILE__) );
			wp_enqueue_script('curts_modal_overlay_settings', plugins_url('js/settingsPage.js', __FILE__), array( 'jquery' ), '', true);
		}

		/**
		 * Initilize some custom settings
		 */
		public function init_settings() {
			register_setting('curts_modal_overlay-group', 'modal_heading');
			register_setting('curts_modal_overlay-group', 'modal_content');
			register_setting('curts_modal_overlay-group', 'mc_api_key');
			register_setting('curts_modal_overlay-group', 'mc_list_id');
		}

		/**
		 * Add a menu
		 */
		public function add_menu() {
			add_options_page('Curts Modal Overlay Settings', 'Curts Modal Overlay', 'manage_options', 'curts_modal_overlay', array(&$this, 'plugin_settings_page'));
		}
		/**
		 * Menu Callback
		*/
		public function plugin_settings_page() {
			if(!current_user_can('manage_options')){
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}
			// render the settings template
			include(sprintf("%s/settings.php", dirname(__file__)));
		}
	}// end class
}// end if


if(class_exists('Curts_Modal_Overlay')) {
			
	// Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Curts_Modal_Overlay', 'activate'));
    register_deactivation_hook(__FILE__, array('Curts_Modal_Overlay', 'deactivate'));
    // instantiate the plugin class
	$curts_modal_overlay = new Curts_Modal_Overlay();

	//store the api_key and list_ID in the session
	$_SESSION['mc_api_key'] = get_option('mc_api_key');
	$_SESSION['mc_list_id'] = get_option('mc_list_id');
	
	// Add a link to the settings page
	if(isset($curts_modal_overlay)) {
		//add the settings link to the plugins page
		function plugin_settings_link() {
			$settings_link = '<a href="options-general.php?page=curts_modal_overlay">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}
		$plugin = plugin_basename(__FILE__);
		add_filter("plugin_action_links_$plugin", "plugin_settings_link");
		
	}
	
	wp_enqueue_style('curts_modal_overlay_style', plugins_url('css/curts-modal-overlay.css', __FILE__), '', '', false);

}

?>