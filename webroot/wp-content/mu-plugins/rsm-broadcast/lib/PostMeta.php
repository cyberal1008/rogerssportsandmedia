<?php

namespace RSM\Broadcast;

class PostMeta {
	const SLUG          = 'post';
	const METADATA_SLUG = 'blog';

	public function get_schema() {
		return array(

			array(
				'id'     => 'blog_meta',
				'title'  => __( 'Blog Metadata', RSM_BROADCAST_LOCALE ),
				'fields' => array(
					array(
						'id'          => 'buttontext',
						'type'        => 'text',
						'label'       => __( 'CTA Button text', RSM_BROADCAST_LOCALE ),
						'description' => __( '', RSM_BROADCAST_LOCALE ),
					),
					array(
						'id'          => 'buttonurl',
						'type'        => 'text',
						'label'       => __( 'CTA Button URL', RSM_BROADCAST_LOCALE ),
						'description' => __( '', RSM_BROADCAST_LOCALE ),
					),
					array(
						'id'          => 'whats_happening',
						'type'        => 'text',
						'label'       => __( 'Zone slug for whats happening', RSM_BROADCAST_LOCALE ),
						'description' => __( '', RSM_BROADCAST_LOCALE ),
					),
				),
			),
		);
	}

	public function add_meta_box() {

				add_meta_box(
					strtolower( __CLASS__ ),
					__( 'Additional Metadata', RSM_BROADCAST_LOCALE ),
					[ 'RSM\Broadcast\Util', 'render_meta_box' ],
					'post',
					'normal',
					'low',
					[
						'fields' => self::get_schema(),
						'slug'   => self::METADATA_SLUG,
					]
				);
	}

	public function save_meta( $post ) {
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
