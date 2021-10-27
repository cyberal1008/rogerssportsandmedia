<?php

namespace RSM\Broadcast;

use RSM\Broadcast\PostType\Highlights;
use RSM\Broadcast\PostType\Shows;
use RSM\Broadcast\PostType\Radio;
use RSM\Broadcast\PostType\Solutions;
use RSM\Broadcast\PostType\Events;
use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\Taxonomy\Region;
use RSM\Broadcast\Taxonomy\RadioCategory;
use RSM\Broadcast\Taxonomy\Speakers;

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

		// loading thickbox for gutenberg editor

		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );

		\wp_enqueue_script(
			$this->get_plugin_name(),
			\plugin_dir_url( dirname( __FILE__ ) ) . 'dist/scripts/rsm-broadcast-admin.js',
			array( 'jquery' ),
			$this->get_version(),
			false
		);

	}

	public function enqueue_block_scripts() {

		$asset_file = include( plugin_dir_path( dirname( __FILE__ ) ) . 'build/index.asset.php' );

		wp_register_script(
			'rsm-product-block',
			plugin_dir_url( dirname( __FILE__ ) ) . 'build/index.js',
			$asset_file['dependencies'],
			$asset_file['version']
		);

		wp_register_style(
			'rsm-product-blocks-editor',
			plugin_dir_url( dirname( __FILE__ ) ) . 'css/editor.css',
			array( 'wp-edit-blocks' ),
			filemtime( plugin_dir_path( dirname( __FILE__ ) ) . 'css/editor.css' )
		);

//		wp_register_style(
//			'rsm-product-blocks-style',
//			plugin_dir_url( dirname( __FILE__ ) ) . 'css/style.css',
//			array(),
//			filemtime( plugin_dir_path( dirname( __FILE__ ) ) . 'css/style.css' )
//		);

		wp_register_style(
			'rsm-bootstrap4-editor-style',
			plugin_dir_url( dirname( __FILE__ ) ) . 'css/bootstrap-grid.min.css',
			array(),
			filemtime( plugin_dir_path( dirname( __FILE__ ) ) . 'css/bootstrap-grid.min.css' )
		);

		register_block_type( 'rsm/products-block', array(
			'api_version'   => 2,
//			'style'         => 'rsm-product-blocks-style',
			'editor_style'  => 'rsm-product-blocks-editor',
			'editor_script' => 'rsm-product-block',
		) );

		register_block_style(
			'rsm/products-block', array(
			'name'         => 'bootstrap-grid',
			'label'        => 'Bootstrap Grid',
			'style_handle' => 'rsm-bootstrap4-editor-style',
			)
		);

	}

//	public function rsm_add_editor_styles() {
//
//	}


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
		$solution_post_type       = new Solutions();
		$highlights_post_type     = new Highlights();
		$events_post_type					= new Events();
		$networks_taxonomy        = new Networks();
		$days_taxonomy            = new Days();
		$show_categories_taxonomy = new ShowCategory();
		$region_taxonomy          = new Region();
		$radio_catetory_taxonomy  = new RadioCategory();
		$speakers_taxonomy				= new Speakers();

		$page_meta = new PageMeta();
		$post_meta = new PostMeta();

		$video_settings = new VideoSettings();

		// $this->loader->add_action( 'after_theme_setup', $this, 'rsm_add_editor_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_init', $this, 'enqueue_block_scripts' );
		$this->loader->add_action( 'admin_menu', $video_settings, 'add_admin_menu' );
		$this->loader->add_action( 'admin_init', $video_settings, 'register_settings' );
		$this->loader->add_action( 'init', $show_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $radio_post_type, 'register' );
		$this->loader->add_action( 'init', $solution_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $highlights_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $events_post_type, 'register_post_type' );
		$this->loader->add_action( 'init', $networks_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'init', $show_categories_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'init', $radio_catetory_taxonomy, 'register' );
		$this->loader->add_action( 'init', $region_taxonomy, 'register' );
		$this->loader->add_action( 'init', $days_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'init', $speakers_taxonomy, 'register_taxonomy' );
		$this->loader->add_action( 'add_meta_boxes', $show_post_type, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $show_post_type, 'save_meta' );

		// Radio Meta boxes
		$this->loader->add_action( 'add_meta_boxes', $radio_post_type, 'add_metaboxes' );
		$this->loader->add_action( 'save_post', $radio_post_type, 'save_metabox_data', 10, 2 );

		$this->loader->add_action( 'add_meta_boxes', $page_meta, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $page_meta, 'save_meta' );

		$this->loader->add_action( 'add_meta_boxes', $post_meta, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $post_meta, 'save_meta' );

		$this->loader->add_action( 'add_meta_boxes', $solution_post_type, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $solution_post_type, 'save_meta' );

		$this->loader->add_action( 'add_meta_boxes', $events_post_type, 'add_meta_box' );
		$this->loader->add_action( 'save_post', $events_post_type, 'save_meta' );

		$this->loader->add_action( 'speaker_add_form_fields', $speakers_taxonomy, 'add_form_fields' );
		$this->loader->add_action( 'speaker_edit_form_fields', $speakers_taxonomy, 'add_edit_form_fields' );
		$this->loader->add_action( 'created_speaker', $speakers_taxonomy, 'save_meta' );
		$this->loader->add_action( 'edited_speaker', $speakers_taxonomy, 'save_meta' );

		add_shortcode( "speakers", array( $speakers_taxonomy, 'render_speakers' ) );
		//$this->loader->add_action( 'save_post', $events_post_type, 'save_meta' );


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
			return strtok( $this->version, ' . ' );
		}

		return $this->version;
	}

}
