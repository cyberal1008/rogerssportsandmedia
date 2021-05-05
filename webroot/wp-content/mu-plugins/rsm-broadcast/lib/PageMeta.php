<?php

namespace RSM\Broadcast;

class PageMeta {
	const SLUG = 'page';
	const METADATA_SLUG = 'broadcast';

	public function get_schema() {
		return array(
			array(
				'id'     => "broadcast",
				'title'  => __( '', RSM_BROADCAST_LOCALE ),
				'fields' => array(
					array(
						'id'                => 'schedule_uri',
						'type'              => 'upload',
						'mediatype'         => 'pdf',
						'label'             => __( "Schedule URL", RSM_BROADCAST_LOCALE ),
						'description'       => __( "", RSM_BROADCAST_LOCALE )
					),
					array(
						'id'                => 'image_uri',
						'type'              => 'upload',
						'mediatype'         => 'image',
						'label'             => __( "Header Image URL (1280 x 720)", RSM_BROADCAST_LOCALE ),
						'description'       => __( "", RSM_BROADCAST_LOCALE )
					),
					array(
						'id'                => 'video_uri',
						'type'              => 'upload',
						'mediatype'         => 'video',
						'label'             => __( "Header Video URL (1280 x 720)", RSM_BROADCAST_LOCALE ),
						'description'       => __( "", RSM_BROADCAST_LOCALE ),
					),
				),
			),
		);
	}

	public function add_meta_box() {

		//
		add_meta_box(
			strtolower( __CLASS__ ),
			__( 'Additional Metadata', RSM_BROADCAST_LOCALE ),
			[ 'RSM\Broadcast\Util', 'render_meta_box' ],
			'page',
			'normal',
			'low',
			[
				"fields" => self::get_schema(),
				"slug"   => self::METADATA_SLUG,
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