<?php

namespace RSM\Broadcast;


use RSM\Broadcast\PostType\Highlights;
use RSM\Broadcast\PostType\Shows;
use RSM\Broadcast\PostType\Radio;
use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\Taxonomy\Region;
use RSM\Broadcast\Taxonomy\RadioCategory;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 */
class Plugin {


	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      \RSM\Broadcast\Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $RDMContent The string used to uniquely identify this plugin.
	 */
	protected $pluginname = 'rsm-broadcast';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version = '1.0.0';

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->loader = new Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new I18n();
		$plugin_i18n->set_domain( RSM_BROADCAST_LOCALE );
		$plugin_i18n->load_plugin_textdomain();

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in RDMContent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The RDMContent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 *
		 * \wp_enqueue_style(
		 * $this->plugin->get_plugin_name(),
		 * \plugin_dir_url( dirname( __FILE__ ) ) . 'dist/styles/rdm-content-api-admin.css',
		 * array(),
		 * $this->plugin->get_version(),
		 * 'all' );
		 */
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		\wp_enqueue_script(
			$this->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/scripts/rsm-broadcast-admin.js',
			array( 'jquery' ),
			$this->get_version(),
			false );
	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$show_post_type           = new Shows();
		$radio_post_type          = new Radio();
		$highlights_post_type     = new Highlights();
		$networks_taxonomy        = new Networks();
		$days_taxonomy            = new Days();
		$show_categories_taxonomy = new ShowCategory();
		$region_taxonomy          = new Region();
		$radio_catetory_taxonomy  = new RadioCategory();

		$page_meta = new PageMeta();

		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $show_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $radio_post_type, 'register' );
		$this->loader->add_action( 'init', $highlights_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $networks_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'init', $show_categories_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'init', $radio_catetory_taxonomy, 'register' );
		$this->loader->add_action( 'init', $region_taxonomy, 'register' );
		$this->loader->add_action( 'init', $days_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'add_meta_boxes', $show_post_type, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $show_post_type, 'save_meta' );

		$this->loader->add_action( 'add_meta_boxes', $page_meta, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $page_meta, 'save_meta' );


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->set_locale();
		$this->define_admin_hooks();
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->pluginname;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    \RSM\Broadcast\Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version( $major = false ) {
		if ( $major ) {
			return strtok( $this->version, '.' );
		}

		return $this->version;
	}

}
