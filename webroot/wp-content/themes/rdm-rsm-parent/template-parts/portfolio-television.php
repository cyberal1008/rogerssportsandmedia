<?php

use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\PostType\Shows;

if ( ! isset( $args ) || ! isset( $args['page_id'] ) ) {
	return '';
}

$page_meta = get_post_meta( $args['page_id'], RSM\Broadcast\PageMeta::METADATA_SLUG, true );
$pdf_url   = "";
if ( isset( $page_meta['broadcast'] ) && isset( $page_meta['broadcast']['schedule_uri'] ) ) {
	$pdf_url = $page_meta['broadcast']['schedule_uri'];
}
$default_image = get_template_directory_uri() . "assets/images/missing-image-portrait.png";

// get all the taxonomies for filters
$days_terms   = get_terms( array(
	'taxonomy'   => Days::TAXONOMY,
	'hide_empty' => false,
) );
$new_days     = wp_list_pluck( $days_terms, 'name', 'slug' );
$template_arr = array( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
$days         = array();
foreach ( $template_arr as $v ) {
	if ( array_key_exists( strtolower( $v ), $new_days ) ) {
		$days[ $v ] = $new_days[ $v ];
	}
}

$days = array_merge( array( 'all' => 'All Days' ), $days );

$shows_terms = get_terms( array(
	'taxonomy'   => ShowCategory::TAXONOMY,
	'hide_empty' => false,
) );

$shows_category = array_merge( array( 'all' => 'All Programming' ), wp_list_pluck( $shows_terms, 'name', 'slug' ) );

$network_terms = get_terms( array(
	'taxonomy'   => Networks::TAXONOMY,
	'hide_empty' => false,
) );

$networks_category = array_merge( array( 'all' => 'All Networks' ), wp_list_pluck( $network_terms, 'name', 'slug' ) );

// schedule and header urls
$tv_posts = new WP_Query( array(
	'post_type'      => RSM\Broadcast\PostType\Shows::SLUG,
	'post_status'    => 'publish',
	'orderby'        => 'title',
	'posts_per_page' => - 1
) );

function get_data_items( $post_id, $taxonomy ) {
	$post_terms = get_the_terms( $post_id, $taxonomy );

	return implode( "|", wp_list_pluck( $post_terms, 'slug' ) );
}

?>
<div class="row television-header justify-content-md-between">
    <div class="col-12 col-md-3">
        <h2>Programming</h2>
    </div>
    <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-center">
        <a href="<?php echo $pdf_url; ?>" target="_blank" class="download-link">Download TV schedule</a>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 program-grid-filter">
		<?php
		get_template_part(
			'template-parts/portfolio',
			'filter',
			array(
				'total'     => $tv_posts->found_posts,
				'unit-text' => 'Shows',
				'filters'   => array(
					'networks-category' => $networks_category,
					'shows-category'    => $shows_category,
					'days-category'     => $days,
				),
			) );
		?>
    </div>
</div>

<div class="row television-grid">
	<?php
	foreach ( $tv_posts->posts as $post ) {
		$post_meta = get_post_meta( $post->ID, Shows::METADATA_SLUG, true );
		if ( isset( $post_meta['image'] ) && isset( $post_meta['image']['tile'] ) ) {
			$img_srcset = wp_get_attachment_image_srcset( $post_meta['image']['tile'], 'portrait' );
			$img_src    = wp_get_attachment_image_src( $post_meta['image']['tile'], 'portrait' )[0];

		} else {
			$img_srcset = '';
			$img_src    = $default_image;
		}

		?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 programming-item"
             data-day="<?php echo get_data_items( $post->ID, Days::TAXONOMY ) ?>"
             data-show="<?php echo get_data_items( $post->ID, ShowCategory::TAXONOMY ) ?>"
             data-networks="<?php echo get_data_items( $post->ID, Networks::TAXONOMY ) ?>">
            <div class="card">
                <img class="card-img-top" src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>"
                     alt="<?php echo esc_attr( $post->post_title ); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo esc_html( $post->post_title ); ?></h5>
                </div>
            </div>
        </div>
		<?php
	}
	?>
</div>
<div class="col-12 programming-none">
    <h3>No shows found.</h3>
</div>