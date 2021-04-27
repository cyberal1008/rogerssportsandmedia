<?php


namespace RSM\TV\PostType;

class Shows {

	const SLUG = 'rsm_show';
	const METADATA_SLUG = 'custom_metadata';
	/**
	 * Our post type labels and settings
	 * @var array
	 */
	static $post_type_args = array(
		'label'               => self::SLUG,
		'labels'              => array(
			'name'               => 'Shows',
			'singular_name'      => 'Show',
			'menu_name'          => 'Shows',
			'name_admin_bar'     => 'Shows',
			'parent_item_colon'  => 'Parent Shows:',
			'all_items'          => 'Shows',
			'add_new_item'       => 'Add New Show',
			'add_new'            => 'Add New',
			'new_item'           => 'New Show',
			'edit_item'          => 'Edit Show',
			'update_item'        => 'Update Show',
			'view_item'          => 'View Shows',
			'search_items'       => 'Search Shows',
			'not_found'          => 'Not found',
			'not_found_in_trash' => 'Not found in Trash',
		),
		'description'         => 'Shows Post Type',
		'hierarchical'        => false,
		'supports'            => array(
			'title',
			'editor',
			'author',
			'revisions',
			'thumbnail',
		),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 20,
		'menu_icon'           => 'dashicons-format-video',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'taxonomies'          => array(),
		'capability_type'     => 'post'
	);

	function register_post_type() {
		register_post_type( self::SLUG, self::$post_type_args );
	}

	public static function get_schema() {
		$fields = array(
			array(
				'id'     => "video",
				'title'  => __( 'Video Metadata', RSM_TV_LOCALE ),
				'fields' => array(
					array(
						'id'          => 'id',
						'type'        => 'text',
						'label'       => __( 'Brighcove ID', RSM_TV_LOCALE ),
						'description' => __( "", RSM_TV_LOCALE ),
					),

				),
			),
		);

		return $fields;
	}

	public static function add_meta_box() {

		//
		add_meta_box(
			strtolower( __CLASS__ ),
			__( 'Custom Metadata', RSM_TV_LOCALE ),
			[ 'RSM\TV\Util', 'render_meta_box' ],
			self::SLUG,
			'normal',
			'low',
			[
				"fields" => self::get_schema(),
				"slug"   => self::METADATA_SLUG,
			]
		);

		// Tile featured image
		add_meta_box(
			'rsmtileimg',
			__( 'Tile Image', RSM_TV_LOCALE ),
			[ 'RSM\TV\Util', 'render_image_box' ],
			self::SLUG,
			'side',
			'low',
			[
				"slug" => self::METADATA_SLUG,
			] 
		);
	}

	public static function save_meta( $post ) {
		if ( get_post_type( $post ) !== self::SLUG ) {
			return;
		}

		$data = array();

		if ( isset( $_POST[ self::METADATA_SLUG ] ) ) :
			foreach ( $_POST[ self::METADATA_SLUG ] as $section => $fields ) :
				$data[ $section ] = $fields;
			endforeach;
		endif;

		if ( count( $data ) > 0 ) {
			update_post_meta( $post, self::METADATA_SLUG, $data );
		}
	}
}