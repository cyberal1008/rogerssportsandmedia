<?php

namespace RSM\Broadcast\Taxonomy;

use RSM\Broadcast\PostType\Events;

class Speakers {

	const TAXONOMY = "speaker";
	const METADATA_SLUG = 'speakers_metadata';
	/**
	 * Our taxonomy labels and settings
	 * @var array
	 */
	static $args = array(
		'labels'            => array(
			'name'              => 'Speaker',
			'singular_name'     => 'Speaker',
			'search_items'      => 'Search Speakers',
			'all_items'         => 'All Speakers',
			'parent_item'       => 'Parent Speaker',
			'parent_item_colon' => 'Parent Speaker:',
			'edit_item'         => 'Edit Speaker',
			'update_item'       => 'Update Speaker',
			'add_new_item'      => 'Add New Speaker',
			'new_item_name'     => 'New Speaker Name',
			'menu_name'         => 'Speakers',
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'public'            => true,
		'show_in_nav_menus' => false,
		'rewrite'           => false,
		'hierarchical'      => true,
	);

	function register_taxonomy() {
		register_taxonomy( self::TAXONOMY, Events::SLUG, self::$args );
	}

	public function get_schema() {
		return array(
			array(
				'id'     => "speaker",
				'title'  => __( 'Speaker Metadata', RSM_BROADCAST_LOCALE ),
				'fields' => array(
					array(
						'id'                => 'company_name',
						'type'              => 'text',
						'label'             => __( "Company Name", RSM_BROADCAST_LOCALE ),
						'description'       => __( "", RSM_BROADCAST_LOCALE )
					),
					array(
						'id'                => 'job_title',
						'type'              => 'text',
						'label'             => __( "Job Title", RSM_BROADCAST_LOCALE ),
						'description'       => __( "", RSM_BROADCAST_LOCALE )
					),
				),
			),
		);
	}

	public function add_form_fields() {
		echo '<div class="form-field">
			<label for="speaker-company">Speaker Company</label>
			<input type="text" name="speaker-company" id="speaker-company" />
			<label for="speaker-job-title">Speaker Job Title</label>
			<input type="text" name="speaker-job-title" id="speaker-job-title" />
			<label for="speaker-image">Speaker Image</label>
			<input type="url" name="speaker-image" size="60" />
			<button type="button" class="rsm_upload_button" value="Upload Image">Upload Image</button>
		</div>';
	}

	public function add_edit_form_fields($term) {
		$company = get_term_meta( $term->term_id, 'speaker-company', true );
		$job_title = get_term_meta( $term->term_id, 'speaker-job-title', true );
		$image = get_term_meta( $term->term_id, 'speaker-image', true );

		echo '<tr class="form-field">
				<th><label for="speaker-company">Speaker Company</label></th>
				<td><input name="speaker-company" id="speaker-company" type="text" value="' . esc_attr( $company ) .'" /></td>
			</tr>
			<tr class="form-field">
				<th><label for="speaker-job-title">Speaker Company</label></th>
				<td><input name="speaker-job-title" id="speaker-job-title" type="text" value="' . esc_attr( $job_title ) .'" /></td>
			</tr>
			<tr class="form-field">
				<th><label for="speaker-image">Speaker Image</label></th>
				<td>
					<input type="url" name="speaker-image" value="' . esc_attr( $image ) . '" size="60" />
					<button type="button" class="rsm_upload_button" value="Upload Image">Upload Image</button>
				</td>
			</tr>';
	}

	public function save_meta( $term_id ) {
		if( isset( $_POST['speaker-company'] ) ) {
			update_term_meta( $term_id, 'speaker-company', sanitize_text_field( $_POST['speaker-company'] ) );
		}
		if( isset( $_POST['speaker-job-title'] ) ) {
			update_term_meta( $term_id, 'speaker-job-title', sanitize_text_field( $_POST['speaker-job-title'] ) );
		}
		if( isset( $_POST['speaker-image'] ) ) {
			update_term_meta( $term_id, 'speaker-image', sanitize_text_field( $_POST['speaker-image'] ) );
		}
	}

	public function render_speakers() {
		$speakers = get_terms( 'speaker' );
		$output = "<div class='speakers'>
			<h1>Meet Your Speakers</h1>";

		foreach( $speakers as $speaker ) {
			$speaker_meta = get_term_meta( $speaker->term_id );
			$image = isset( $speaker_meta['speaker-image'] ) ? $speaker_meta['speaker-image'][0] : '';
			$company = isset( $speaker_meta['speaker-company'] ) ? $speaker_meta['speaker-company'][0] : '';
			$job_title = isset( $speaker_meta['speaker-job-title'] ) ? $speaker_meta['speaker-job-title'][0] : '';

			$output .= "<div class='speaker'>
				<image src='" . $image . "'/>
				<div>
					<p class='name'>" . $speaker->name . "</p>
					<p>" . $company . "</p>
					<p>" . $job_title . "</p>
					<p class='speaker-description'>" . $speaker->description . "</p>
				</div>
			</div>";
		}

		return $output . "</div>";
	}
}
