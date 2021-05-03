<?php


namespace RSM\Broadcast;

use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\PostType\Shows;

class Importer {

	public function __construct(
		$network, $videos_uri, $mapping = array(
		'post_title'   => 'title',
		'post_content' => 'description',
		'image'        => 'mobile_show_art'
	)
	) {
		$this->network    = $network;
		$this->videos_api = $videos_uri;
		$this->mapping    = $mapping;
	}

	public function CallAPI( $method, $url, $data = false ) {
		$curl = curl_init();

		switch ( $method ) {
			case "POST":
				curl_setopt( $curl, CURLOPT_POST, 1 );

				if ( $data ) {
					curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
				}
				break;
			case "PUT":
				curl_setopt( $curl, CURLOPT_PUT, 1 );
				break;
			default:
				if ( $data ) {
					$url = sprintf( "%s?%s", $url, http_build_query( $data ) );
				}
		}

		// Optional Authentication:
		curl_setopt( $curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
		curl_setopt( $curl, CURLOPT_USERPWD, "username:password" );

		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );

		$result = curl_exec( $curl );

		curl_close( $curl );

		return $result;
	}

	function UploadImage( $post_id, $image_url ) {
		$upload_dir = wp_upload_dir();

		$image_data = file_get_contents( $image_url );

		$filename = basename( $image_url );

		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}

		file_put_contents( $file, $image_data );

		$wp_filetype = wp_check_filetype( $filename, null );

		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_author'    => 6,
			'post_parent'    => $post_id,
			'post_status'    => 'inherit',
		);

		$attach_id = wp_insert_attachment( $attachment, $file );
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return $attach_id;
	}

	public function import() {
		$days_terms = get_terms( array(
			'taxonomy'   => Days::TAXONOMY,
			'hide_empty' => false,
		) );
		$days       = wp_list_pluck( $days_terms, 'name' );

		$shows_terms   = get_terms( array(
			'taxonomy'   => ShowCategory::TAXONOMY,
			'hide_empty' => false,
		) );
		$show_category = wp_list_pluck( $shows_terms, 'name' );

		$all_shows = json_decode( $this->CallAPI( 'GET', $this->videos_api ), true );

		foreach ( $all_shows as $show ) {

			$post_args = array(
				'post_title'   => $show[ $this->mapping['post_title'] ],
				'post_content' => $show[ $this->mapping['post_content'] ],
				'post_type'    => Shows::SLUG,
				'post_status'  => 'publish',
				'post_author'  => 6,
			);

			$post_id = wp_insert_post( $post_args );

			// updating taxonomies
			wp_set_object_terms( $post_id, $this->network, Networks::TAXONOMY );
			wp_set_object_terms( $post_id, $show_category[ array_rand( $show_category ) ], ShowCategory::TAXONOMY );
			wp_set_object_terms( $post_id, $days[ array_rand( $days ) ], Days::TAXONOMY );

			$images = array_filter( $show['images'], function ( $image ) {
				return $image['type'] === $this->mapping['image'];
			} );
			

			if ( count( $images ) > 0 ) {
				$portrait_image = end($images);
				$attach_id     = $this->UploadImage( $post_id, $portrait_image['uri'] );
				$data          = [];
				$data['image'] = array( 'tile' => $attach_id );
				update_post_meta( $post_id, Shows::METADATA_SLUG, $data );
			}

			echo 'Imported ' . $show['title'] . ' into Post: ' . $post_id . PHP_EOL;
		}


	}
}