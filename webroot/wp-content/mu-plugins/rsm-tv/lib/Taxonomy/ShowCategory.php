<?php


namespace RSM\TV\Taxonomy;


use RSM\TV\PostType\Shows;

class ShowCategory {

	const TAXONOMY = "rsm_show_category";
	/**
	 * Our taxonomy labels and settings
	 * @var array
	 */
	static $args = array(
		'labels'            => array(
			'name'              => 'Show Category',
			'singular_name'     => 'Show Category',
			'search_items'      => 'Search Show Categories',
			'all_items'         => 'All Show Categories',
			'parent_item'       => 'Parent Show Category',
			'parent_item_colon' => 'Parent Show Category:',
			'edit_item'         => 'Edit Show Category',
			'update_item'       => 'Update Show Category',
			'add_new_item'      => 'Add New Show Category',
			'new_item_name'     => 'New Show Category Name',
			'menu_name'         => 'Show Categories',
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