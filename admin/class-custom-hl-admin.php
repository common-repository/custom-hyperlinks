<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.techmuzz.com
 * @since      1.0.0
 *
 * @package    Custom_HL
 * @subpackage Custom_HL/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_HL
 * @subpackage Custom_HL/admin
 * @author     TechMuzz <info@techmuzz.com>
 */
class Custom_HL_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		if(get_current_screen()->id == "settings_page_custom-hl") {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-hl-admin.css', array(), $this->version, 'all' );
			wp_register_style( 'bootstrap-min',  plugin_dir_url( __FILE__ ) .'/css/bootstrap.min.css', array(), null, 'all' );
			wp_enqueue_style( 'bootstrap-min' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if(get_current_screen()->id == "settings_page_custom-hl") {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-hl-admin.js', array( 'jquery' ), $this->version, false );
			wp_register_script('jquery-steps', plugin_dir_url( __FILE__ ) . 'js/jquery.steps.js');
			wp_enqueue_script( 'jquery-steps');
			wp_enqueue_script( 'jquery-form' );
		}
	}


	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {
		add_options_page( 'Custom Hyperlinks', 'Custom Hyperlinks', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'));
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge( $links, $settings_link );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/custom-hl-admin-display.php' );
	}

	public function validate($input) {    
		$valid = array();
	
		$valid['switch'] = (isset($input['switch']) && !empty($input['switch'])) ? 1 : 0;
		$valid['domains'] = esc_textarea($input['domains']);
		$valid['element'] = esc_textarea($input['element']);
		$valid['target'] = sanitize_text_field($input['target']);
		$valid['exampleText'] = esc_textarea($input['exampleText']);
	
		return $valid;
	 }

	 public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	 }
}
