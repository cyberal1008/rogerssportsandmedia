<?php


namespace RSM\Broadcast\PostType;

class Events {

	const SLUG = 'event';
  const METADATA_SLUG = 'events_metadata';
	/**
	 * Our post type labels and settings
	 * @var array
	 */
	static $post_type_args = array(
		'label'               => self::SLUG,
		'labels'              => array(
			'name'               => 'Events',
			'singular_name'      => 'Event',
			'menu_name'          => 'Events',
			'name_admin_bar'     => 'Events',
			'parent_item_colon'  => 'Parent Events:',
			'all_items'          => 'Events',
			'add_new_item'       => 'Add New Event',
			'add_new'            => 'Add New',
			'new_item'           => 'New Event',
			'edit_item'          => 'Edit Event',
			'update_item'        => 'Update Event',
			'view_item'          => 'View Events',
			'search_items'       => 'Search Events',
			'not_found'          => 'Not found',
			'not_found_in_trash' => 'Not found in Trash',
		),
		'description'         => 'Events Post Type',
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
		'menu_icon'           => 'dashicons-admin-page',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => true,
		'taxonomies'          => array(),
		'capability_type'     => 'post'
	);

	function register_post_type() {
		register_post_type( self::SLUG, self::$post_type_args );
	}

  public static function get_schema() {
    $fields = array(
      array(
        'id'     => 'event',
        'title'  => __( 'Event Metadata', RSM_BROADCAST_LOCALE ),
        'fields' => array(
          array(
            'id'          => 'id',
            'type'        => 'text',
            'label'       => __( 'Cloudpage ID', RSM_BROADCAST_LOCALE ),
            'description' => __( '', RSM_BROADCAST_LOCALE ),
          ),
          array(
            'id'          => 'date',
            'type'        => 'date',
            'label'       => __( 'Event Date', RSM_BROADCAST_LOCALE ),
            'description' => __( '', RSM_BROADCAST_LOCALE ),
          ),
          array(
            'id'          => 'start_time',
            'type'        => 'time',
            'label'       => __( 'Event Start Time', RSM_BROADCAST_LOCALE ),
            'description' => __( '', RSM_BROADCAST_LOCALE ),
          ),
          array(
            'id'          => 'end_time',
            'type'        => 'time',
            'label'       => __( 'Event End Time', RSM_BROADCAST_LOCALE ),
            'description' => __( '', RSM_BROADCAST_LOCALE ),
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
      __( 'Custom Metadata', RSM_BROADCAST_LOCALE ),
      [ 'RSM\Broadcast\Util', 'render_meta_box' ],
      self::SLUG,
      'normal',
      'low',
      [
        "fields" => self::get_schema(),
        "slug"   => self::METADATA_SLUG,
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
