<?php

use RSM\Broadcast\Taxonomy\Days;
use RSM\Broadcast\Taxonomy\Networks;
use RSM\Broadcast\Taxonomy\ShowCategory;
use RSM\Broadcast\PostType\Shows;

$default_image = get_template_directory_uri() . 'assets/images/missing-image-portrait.png';

if ( ! isset( $args ) || empty( $args['slider_shows'] ) || empty( $args['slider_name'] ) ) {
	return '';
}
$slider_shows = $args['slider_shows'];
$slider_name = $args['slider_name'];
$filter = empty( $args['filter'] ) ? false : $args['filter'];
$text_color = empty( $args['text_color'] ) ? '#000' : $args['text_color'];

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
$program_default_category = get_field('program_default_category') ? get_field('program_default_category') : '';

if ( $filter ) {
	?>
	<div class="television-header justify-content-md-between">
		<div class="program-grid-filter">
			<?php
			get_template_part(
				'template-parts/portfolio',
				'program-slider-filter',
				array(
					'total'     => $slider_shows,
					'unit-text' => 'Shows',
					'filters'   => array(
						'networks-category' => $networks_category,
					),
					'slug'		=> !empty( $program_default_category ) ? $program_default_category->slug : null
				)
			);
			?>
		</div>
	</div>
	<?php
}
?>

<div class="slider">
	<div class="swiper <?php echo $slider_name; ?>-slider show-slider">
		<div class="swiper-wrapper">
			<?php
			// js var for programming grid modal
			$jsvar = array();
			$prog_ctr = 0;
			foreach ( $slider_shows as $show ) : $prog_ctr++;
				$post = $show['show'];
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
					$order = array( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
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
				<div class="swiper-slide"
					data-show-id="<?php echo $post->ID; ?>"
					data-day="<?php echo $post_days; ?>"
					data-show="<?php echo get_data_items( $post->ID, ShowCategory::TAXONOMY ); ?>"
					data-networks="<?php echo get_data_items( $post->ID, Networks::TAXONOMY ); ?>"
					>
					<?php
						$video_embed_code = get_field('video_embed_code', $post->ID);
						$network_id = get_post_meta( $post->ID, '_yoast_wpseo_primary_rsm_network');
						if( !empty( $network_id[0] ) ) {
							$network_term = get_term($network_id[0]);
							if( !empty( $network_term ) ) {
								$network = $network_term->name;
							}
						}
						$day_id = get_post_meta( $post->ID, '_yoast_wpseo_primary_rsm_day');
						if( !empty( $day_id[0] ) ) {
							$day_term = get_term($day_id[0]);
							if( !empty( $day_term ) ) {
								$day = $day_term->name;
							}
						}
					?>
					<div class="inner">
						<div class="imgbox">
							<a href="#prog-popup-<?php echo $post->ID; ?>" aria-label="read about <?php echo esc_html( $post->post_title ); ?>" data-fancybox>
								<?php echo $img_tag; ?>
							</a>
						</div>
						<p class="title h4"><a style="color: <?php echo $text_color; ?>" href="#prog-popup-<?php echo $prog_ctr; ?>" aria-label="read about <?php echo esc_html( $post->post_title ); ?>" data-fancybox><?php echo esc_html( $post->post_title ); ?></a></p>
					</div>
					<div id="prog-popup-<?php echo $post->ID; ?>" class="prog-popup popup">
						<div class="inner">
							<a href="#" class="back" data-fancybox-close aria-label="Back to content">Back</a>

							<div class="meta">
								<?php echo $network ? $network : ''; ?>
								<?php echo $network && $day ? '<span class="divider">/</span>' : ''; ?>
								<?php echo isset($day) ? $day : ''; ?>
							</div>

							<p class="title h2"><?php echo esc_html( $post->post_title ); ?></p>
							<?php echo get_the_content(null, false, $post->ID); ?>
							<?php if ($video_embed_code) : ?>
								<div class="iframe-wrap">
									<?php echo $video_embed_code; ?>
								</div>
							<?php else : 
								$popup_image = get_field('popup_image', $post->ID);
								if ($popup_image) : 
								?>
									<img src="<?php echo $popup_image['sizes']['large']; ?>" alt="<?php echo $popup_image['alt']; ?>" loading="lazy">
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; wp_reset_query(); ?>
		</div>
	</div>
	<div class="navi">
		<div class="swiper-button-prev <?php echo $slider_name; ?>-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
		<div class="swiper-button-next <?php echo $slider_name; ?>-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
	</div>
</div>

<div class="no-shows">No Shows Found</div>
<?php