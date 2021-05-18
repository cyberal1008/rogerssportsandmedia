<?php

use RSM\Broadcast\PostType\Solutions;

if ( ! empty ( $args['zone'] ) && ! empty ( $args['page_meta'] ) ) {
    
	$solutions = z_get_posts_in_zone( $args['zone'] );
	if ( count( $solutions ) > 0 ) {
	    $jsvar = array();
		?>
        <div class="container portfolio-solutions">
            <div class="row portfolio-solutions-header py-5">
                <div class="col-12">
                    <h2 id="portfolio-solutions-anchor">Solutions</h2>
                </div>
            </div>
            <div class="row solutions-grid pb-5">
				<?php
				foreach ( $solutions as $key => $solution ) {
					$post_meta = get_post_meta( $solution->ID, Solutions::METADATA_SLUG, true );
					$featured_image_id = get_post_thumbnail_id( $solution->ID );

					$tmpjsvar = array(
						"title"       => $solution->post_title,
						"description" => strip_tags( $solution->post_content ),
					);

					if ( ! empty ( $post_meta['video'] ) && ! empty ( $post_meta['video']['id'] ) ) {
						$tmpjsvar['video_id'] = $post_meta['video']['id'];
					}

					// featured image
					$featured_image_id = get_post_thumbnail_id( $solution->ID );
					if ( ! empty ( $featured_image_id ) ) {
						$size              = "large";
						$tmpjsvar['image'] = array(
							'src'    => wp_get_attachment_image_src( $featured_image_id, $size ),
							'srcset' => wp_get_attachment_image_srcset( $featured_image_id, $size ),
							'sizes'  => wp_get_attachment_image_sizes( $featured_image_id, $size )
						);
					}
					?>
                    <div class="col-12 col-sm-6 col-md-4 solution-item" data-solution-id="<?php echo $solution->ID ?>">
                        <div class="card">
							<?php echo wp_get_attachment_image( $featured_image_id, 'large', '', array( 'class' => 'card-img-top' ) ); ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo esc_html( $solution->post_title ); ?></h5>
                            </div>
                        </div>
                    </div>
					<?php
                    $jsvar[$solution->ID] = $tmpjsvar;
				}
				wp_localize_script( 'solutions-js', 'solutions', $jsvar );
				?>
            </div>
        </div>
        <div class="portfolio-modal-wrapper solutions-modal"></div>
		<?php
	}
}
?>