<?php


namespace RSM\Broadcast\Taxonomy;


use RSM\Broadcast\PostType\Shows;

class Days {

	const TAXONOMY = "rsm_day";
	/**
	 * Our taxonomy labels and settings
	 * @var array
	 */
	static $args = array(
		'labels'            => array(
			'name'              => 'Day',
			'singular_name'     => 'Day',
			'search_items'      => 'Search Days',
			'all_items'         => 'All Days',
			'parent_item'       => 'Parent Day',
			'parent_item_colon' => 'Parent Day:',
			'edit_item'         => 'Edit Day',
			'update_item'       => 'Update Day',
			'add_new_item'      => 'Add New Day',
			'new_item_name'     => 'New Day Name',
			'menu_name'         => 'Days',
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_in_nav_menus' => false,
		'rewrite'           => false,
		'hierarchical'      => true,
	);

	function register_taxonomy() {
		register_taxonomy( self::TAXONOMY, Shows::SLUG, self::$args );
	}
}