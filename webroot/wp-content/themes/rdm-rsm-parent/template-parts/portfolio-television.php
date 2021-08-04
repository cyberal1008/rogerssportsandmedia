<?php

use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\PostType\Shows;

$default_image = get_template_directory_uri() . 'assets/images/missing-image-portrait.png';

if ( ! isset( $args ) || ! isset( $args['page_meta'] ) ) {
	return '';
}
$page_meta = $args['page_meta'];
$pdf_url   = '';
if ( isset( $page_meta['broadcast'] ) && isset( $page_meta['broadcast']['schedule_uri'] ) ) {
	$pdf_url = $page_meta['broadcast']['schedule_uri'];
}

// get all the taxonomies for filters
$days_terms   = get_terms(
	array(
		'taxonomy'   => Days::TAXONOMY,
		'hide_empty' => false,
	)
);
$new_days     = wp_list_pluck( $days_terms, 'name', 'slug' );
$template_arr = array( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
$days         = array();
foreach ( $template_arr as $v ) {
	if ( array_key_exists( strtolower( $v ), $new_days ) ) {
		$days[ $v ] = $new_days[ $v ];
	}
}

$days = array_merge( array( 'all' => 'All Days' ), $days );

$shows_terms = get_terms(
	array(
		'taxonomy'   => ShowCategory::TAXONOMY,
		'hide_empty' => false,
	)
);

$shows_category = array_merge( array( 'all' => 'All Programming' ), wp_list_pluck( $shows_terms, 'name', 'slug' ) );

$network_terms = get_terms(
	array(
		'taxonomy'   => Networks::TAXONOMY,
		'hide_empty' => false,
	)
);

$networks_category = array_merge( array( 'all' => 'All Networks' ), wp_list_pluck( $network_terms, 'name', 'slug' ) );

// schedule and header urls
$tv_posts = new WP_Query(
	array(
		'post_type'      => RSM\Broadcast\PostType\Shows::SLUG,
		'post_status'    => 'publish',
		'orderby'        => 'title',
		'posts_per_page' => - 1,
	)
);

?>
<div class="row television-header justify-content-md-between">
	<div class="col-12 col-md-3">
		<h2 id="portfolio-grid-anchor"><?php echo $args['section_title']; ?></h2>
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
			)
		);
		?>
	</div>
</div>
<div class="row television-grid">
	<?php
	// js var for programming grid modal
	$jsvar = array();
	foreach ( $tv_posts->posts as $post ) {
		$post_meta = get_post_meta( $post->ID, Shows::METADATA_SLUG, true );

		$tmpjsvar = array(
			'title'       => $post->post_title,
			'description' => strip_tags( $post->post_content ),
			'days'        => '',
			'airing'      => '',
		);

		if ( ! empty( $post_meta['video'] ) && ! empty( $post_meta['video']['id'] ) ) {
			$tmpjsvar['video_id'] = $post_meta['video']['id'];
		}

		if ( ! empty( $post_meta['general'] ) && ! empty( $post_meta['general']['airing_text'] ) ) {
			$tmpjsvar['airing'] = $post_meta['general']['airing_text'];
		}

		// featured image
		$featured_image_id = get_post_thumbnail_id( $post->ID );
		if ( ! empty( $featured_image_id ) ) {
			$size              = 'large';
			$tmpjsvar['image'] = array(
				'src'    => wp_get_attachment_image_src( $featured_image_id, $size ),
				'srcset' => wp_get_attachment_image_srcset( $featured_image_id, $size ),
				'sizes'  => wp_get_attachment_image_sizes( $featured_image_id, $size ),
			);
		}

		$post_days = get_data_items( $post->ID, Days::TAXONOMY );
		if ( $post_days ) {
			$days = explode( '|', $post_days );
			$order = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );
			usort( $days, function ( $a, $b ) use ( $order ) {
				$pos_a = array_search( $a, $order );
				$pos_b = array_search( $b, $order );
				return $pos_a - $pos_b;
			});

			$tmpjsvar['days'] = ucwords( implode( ', ', $days ) );
		}


		$jsvar[ $post->ID ] = $tmpjsvar;


		if ( isset( $post_meta['image'] ) && isset( $post_meta['image']['tile'] ) ) {
			$img_tag = wp_get_attachment_image( $post_meta['image']['tile'], 'portrait', '', array( 'class' => 'card-img-top' ) );
		} else {
			$img_tag = '<img alt="' . esc_attr( $post->post_title ) . '" src="' . esc_attr( $default_image ) . '" height="720" width="450" />';
		}

		?>
		<div class="col-6 col-sm-4 col-md-3 col-lg-2 programming-item"
			 data-show-id="<?php echo $post->ID; ?>"
			 data-day="<?php echo $post_days; ?>"
			 data-show="<?php echo get_data_items( $post->ID, ShowCategory::TAXONOMY ); ?>"
			 data-networks="<?php echo get_data_items( $post->ID, Networks::TAXONOMY ); ?>">
			<div class="card">
				<?php echo $img_tag; ?>
				<div class="card-body">
					<h5 class="card-title"><?php echo esc_html( $post->post_title ); ?></h5>
				</div>
			</div>
		</div>
		<?php
	}
	// programming grids info
	wp_localize_script( 'television-js', 'tv_shows', $jsvar );
	?>
</div>
<div class="col-12 programming-none">
	<h3>No shows found</h3>
</div>
<div class="portfolio-modal-wrapper television-modal"></div>
