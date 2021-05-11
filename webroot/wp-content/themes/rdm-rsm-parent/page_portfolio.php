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
        <div class="container portfolio-anchors">
			<?php
			if ( stripos( get_the_title(), 'television' ) !== false ) {
				$zone = 'happening-tv';
				get_template_part(
					'template-parts/portfolio',
					'anchors',
					array(
						'portfolio-about'              => 'About',
						'portfolio-grid-anchor'        => 'Programming',
						'portfolio-hightlights-anchor' => 'Highlights',
						'portfolio-news-anchor'        => 'News and updates',
					)
				);
			} elseif ( stripos( get_the_title(), 'radio' ) !== false ) {
				$zone = 'happening-radio';
				get_template_part(
					'template-parts/portfolio',
					'anchors',
					array(
						'portfolio-about'              => 'About',
						'portfolio-grid-anchor'        => 'Stations and Podcasts',
						'portfolio-hightlights-anchor' => 'Highlights',
						'portfolio-news-anchor'        => 'News and updates',
					)
				);
			} else {
				get_template_part(
					'template-parts/portfolio',
					'anchors',
					array(
						'portfolio-about'              => 'About',
						'portfolio-grid-anchor'        => 'Solutions',
						'portfolio-hightlights-anchor' => 'Highlights',
						'portfolio-news-anchor'        => 'News and updates',
					)
				);
			}
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
		?>
        <div class="container portfolio-page">
			<?php
			if ( stripos( get_the_title(), 'television' ) !== false ) {
				get_template_part(
					'template-parts/portfolio',
					'television',
					array(
						'page_meta' => $page_meta,
					)
				);
			}
			if ( stripos( get_the_title(), 'radio' ) !== false ) {
				get_template_part(
					'template-parts/portfolio',
					'radio',
					array(
						'page_id' => get_the_ID(),
					)
				);
			}
			?>

        </div>
		<?php
		if ( function_exists( 'z_get_posts_in_zone' )
		     && ! empty( $page_meta['zones'] )
		     && ! empty( $page_meta['zones']['highlights'] ) ) {
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
                        <div class="row portfolio-highlights-item justify-content-md-between flex-r py-5 mb-5<?php echo ( ( $key + 1 ) % 2 !== 0 ) ? ' flex-md-row-reverse' : '' ?>">
                            <div class="col-8 col-md-6 col-lg-4 mb-3 mb-md-auto mx-auto mx-md-0">
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

		$zone = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
		get_template_part( 'template-parts/content', 'happening', $zone );
		?>
    </div>
<?php
get_footer();

