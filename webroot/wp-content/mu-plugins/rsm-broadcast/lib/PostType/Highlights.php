<?php


namespace RSM\Broadcast\PostType;

class Highlights {

	const SLUG = 'rsm_highlight';
	/**
	 * Our post type labels and settings
	 * @var array
	 */
	static $post_type_args = array(
		'label'               => self::SLUG,
		'labels'              => array(
			'name'               => 'Highlights',
			'singular_name'      => 'Highlight',
			'menu_name'          => 'Highlights',
			'name_admin_bar'     => 'Highlights',
			'parent_item_colon'  => 'Parent Highlights:',
			'all_items'          => 'Highlights',
			'add_new_item'       => 'Add New Highlight',
			'add_new'            => 'Add New',
			'new_item'           => 'New Highlight',
			'edit_item'          => 'Edit Highlight',
			'update_item'        => 'Update Highlight',
			'view_item'          => 'View Highlights',
			'search_items'       => 'Search Highlights',
			'not_found'          => 'Not found',
			'not_found_in_trash' => 'Not found in Trash',
		),
		'description'         => 'Highlights Post Type',
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
		'menu_icon'           => 'dashicons-menu-alt3',
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
}