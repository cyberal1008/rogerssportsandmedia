<?php


namespace RSM\TV\Taxonomy;


use RSM\TV\PostType\Shows;

class Networks {

	const TAXONOMY = "rsm_network";
	/**
	 * Our taxonomy labels and settings
	 * @var array
	 */
	static $args = array(
		'labels'            => array(
			'name'              => 'Network',
			'singular_name'     => 'Network',
			'search_items'      => 'Search Networks',
			'all_items'         => 'All Networks',
			'parent_item'       => 'Parent Network',
			'parent_item_colon' => 'Parent Network:',
			'edit_item'         => 'Edit Network',
			'update_item'       => 'Update Network',
			'add_new_item'      => 'Add New Network',
			'new_item_name'     => 'New Network Name',
			'menu_name'         => 'Networks',
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