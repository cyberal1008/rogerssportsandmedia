<?php
/**
 * Custom taxonomy for radio program regions 
 */
namespace RSM\Broadcast\Taxonomy;

use RSM\Broadcast\PostType\Radio;

class Region {

	const SLUG = "rsm_region";

	public function register() {
        $labels = array(
            'name'              => 'Region',
            'singular_name'     => 'Regions',
            'search_items'      => 'Search Regions',
            'all_items'         => 'All Regions',
            'parent_item'       => 'Parent Region',
            'parent_item_colon' => 'Parent Region:',
            'edit_item'         => 'Edit Region',
            'update_item'       => 'Update Region',
            'add_new_item'      => 'Add New Region',
            'new_item_name'     => 'New Region Name',
            'menu_name'         => 'Regions',
        );
        $args = array(
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'public'            => true,
            'show_in_nav_menus' => false,
            'rewrite'           => false,
            'hierarchical'      => true,
        );
        
		register_taxonomy( self::SLUG, Radio::TYPE, $args );
	}

//    public function __construct() {
//
//        // Register the taxonomy
//        add_action('init', array($this, 'register'));
//
//    }
}