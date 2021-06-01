<?php
/**
 * Template Name: Portfolio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
$anchors   = array( 'portfolio-about' => 'About' );

$solutions_anchor_label = 'Solutions';
if ( ! empty( $page_meta['broadcast'] ) && ! empty ( $page_meta['broadcast']['solutions_label'] ) ) {
	$solutions_anchor_label = $page_meta['broadcast']['solutions_label'];
}

$solutions_exists = ! empty( $page_meta['zones'] ) && ! empty( $page_meta['zones']['solutions'] );
if ( $solutions_exists || stripos( get_the_title(), 'radio' ) !== false || stripos( get_the_title(), 'television' ) !== false ) {
	$anchors['portfolio-grid-anchor'] = $solutions_anchor_label;
}

$highlights_exists = ! empty( $page_meta['zones'] ) && ! empty( $page_meta['zones']['highlights'] );
if ( $highlights_exists ) {
	$anchors['portfolio-hightlights-anchor'] = 'Highlights';
}

$whats_happening_exists = ! empty( $page_meta['zones'] ) && ! empty( $page_meta['zones']['whats_happening'] );
if ( $whats_happening_exists ) {
	$anchors['portfolio-news-anchor'] = 'News and updates';
}
?>
    <div class="portfolio-main">
        <div class="portfolio-header jumbotron j-main d-flex justify-content-center align-items-center">
            <div>
				<?php
				if ( $post->post_parent ) {
					?>
                    <div class="text-center parent-url">
                        <a href="<?php echo get_permalink( $post->post_parent ); ?>">
							<?php echo get_the_title( $post->post_parent ); ?>
                        </a>
                    </div>
				<?php } ?>
                <h1 class="display-3 j-title text-center"><?php echo esc_html( get_the_title() ); ?></h1>
            </div>
        </div>
        <div class="portfolio-anchors">
			<?php
			get_template_part(
				'template-parts/portfolio',
				'anchors',
				$anchors
			);

			?>
        </div>
		<?php
		get_template_part(
			'template-parts/content',
			'about',
			array(
				'title'       => 'About',
				'description' => get_the_content(),
				'image_url'   => $page_meta['broadcast']['about_image_uri']
			) );

		if ( $page_meta['broadcast'] && $page_meta['broadcast']['about_video_id'] ) {
			get_template_part(
				'template-parts/content',
				'video',
				array(
					'video_id' => $page_meta['broadcast']['about_video_id'],
				) );

		}

		?>
        <div class="w-100 p-5"></div>
        <div class="container portfolio-page">
			<?php
			if ( stripos( get_the_title(), 'television' ) !== false ) {
				get_template_part(
					'template-parts/portfolio',
					'television',
					array(
						'page_meta'     => $page_meta,
						'section_title' => $solutions_anchor_label
					)
				);
			} else if ( stripos( get_the_title(), 'radio' ) !== false ) {
				get_template_part(
					'template-parts/portfolio',
					'radio',
					array(
						'page_id'       => get_the_ID(),
						'section_title' => $solutions_anchor_label
					)
				);
			} else {
				if ( $solutions_exists ) {
					get_template_part(
						'template-parts/portfolio',
						'solutions',
						array(
							'zone'          => $page_meta['zones']['solutions'],
							'page_meta'     => $page_meta,
							'section_title' => $solutions_anchor_label
						)
					);
				}
			}
			?>

        </div>
		<?php
		if ( function_exists( 'z_get_posts_in_zone' )
		     && $highlights_exists ) {

			$highlights = z_get_posts_in_zone( $page_meta['zones']['highlights'] );
			if ( count( $highlights ) > 2 ) {
				?>
                <div class="container portfolio-highlights">
                    <div class="row portfolio-highlights-header pt-5">
                        <div class="col-12">
                            <h2 id="portfolio-hightlights-anchor">Highlights</h2>
                        </div>
                    </div>
					<?php
					foreach ( $highlights as $key => $highlight ) {
						?>
                        <div class="row portfolio-highlights-item justify-content-md-between py-5 mb-5<?php echo ( ( $key + 1 ) % 2 !== 0 ) ? ' flex-md-row-reverse' : '' ?>">
                            <div class="col-8 mx-auto mb-3 col-md-6 mb-md-auto mx-md-0 col-lg-4">
								<?php echo wp_get_attachment_image( get_post_thumbnail_id( $highlight->ID ), 'portrait' ); ?>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-md-center">
                                <div>
                                    <h3><?php echo esc_html( $highlight->post_title ); ?></h3>
                                    <p><?php echo esc_html( $highlight->post_content ); ?></p>
                                </div>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
				<?php
			}
		}

		if ( $whats_happening_exists ) {
			$zone = $page_meta['zones']['whats_happening'];
			$zone = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
			get_template_part( 'template-parts/content', 'happening', $zone );
		}
		
		?>
    </div>
<?php
get_footer();

