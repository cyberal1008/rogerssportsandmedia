<?php
/**
 * Custom taxonomy for radio program featured groups - filter
 */
namespace RSM\Broadcast\Taxonomy;

use RSM\Broadcast\PostType\Radio;

class RadioCategory {

	const SLUG = "rsm_radio_category";

	public function register() {
        $labels = array(
            'name'              => 'Radio Category',
            'singular_name'     => 'Radio Categories',
            'search_items'      => 'Search Radio Categories',
            'all_items'         => 'All Radio Categories',
            'parent_item'       => 'Parent Radio Category',
            'parent_item_colon' => 'Parent Radio Category:',
            'edit_item'         => 'Edit Radio Category',
            'update_item'       => 'Update Radio Category',
            'add_new_item'      => 'Add New Radio Category',
            'new_item_name'     => 'New Radio Category Name',
            'menu_name'         => 'Radio Categories',
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
