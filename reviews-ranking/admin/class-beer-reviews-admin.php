<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/johnchou71
 * @since      1.0.0
 *
 * @package    Beer_Reviews
 * @subpackage Beer_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Beer_Reviews
 * @subpackage Beer_Reviews/admin
 * @author     John <John.chou.on@gmail.com>
 */
class Beer_Reviews_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/beer-reviews-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beer_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beer_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/beer-reviews-admin.js', array('jquery'), $this->version, false);
	}

	public function add_admin_menu() // add the admin page
	{
		add_menu_page(
			'Beer Reviews',
			'Beer Reviews',
			'edit_dashboard',
			'beer-reviews-settings',
			array($this, 'render_beer_reviews_settings')
		);

		add_submenu_page(
			'Beer Reviews',
			'Beer Reviews',
			'Beer Reviews',
			'edit_dashboard',
			'beer-reviews-settings',
			array($this, 'render_beer_reviews_settings')
		);
	}

	public function render_beer_reviews_settings() // load data to html page
	{
		$beer_reviews = Beer_Reviews_Service_Import::factory()->import_beer_feed();
		include_once 'partials/beer-reviews-admin-display.php';
	}
}
