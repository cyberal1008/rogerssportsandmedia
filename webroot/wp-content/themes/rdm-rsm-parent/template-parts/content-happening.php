	<div class="container pt-4">
		<?php if ( is_single() ) { ?>
			<div class="page-header single-header">
				<h2>similar reads</h2>      
			</div>
		<?php } else { ?>
		<div class="tri">
			<div class="tri-element"></div>
			<div class="tri-element"></div>
		</div>
		<div class="page-header">
			<h2 id="portfolio-news-anchor">what&lsquo;S happening</h2>      
		</div>
		<p class="page-header-desc">Get the latest news from Rogers Sports & Media. </p>
			<?php
			$category_id   = get_cat_ID( 'What\'s Happening' );
			$category_link = get_category_link( $category_id );
			?>
		   
		<p><a href="<?php echo esc_url( $category_link ); ?>" class="card-button">Read More</a></p>
		<?php } ?>   
	</div>

	<div class="row justify-content-between">
		<?php
		global $zone;
		if ( function_exists( 'z_get_posts_in_zone' ) && ! empty( $zone ) ) {
			$the_query = z_get_zone_query( $zone );
		} else {
			$the_query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'post__not_in'   => array( get_the_ID() ),
				)
			);
		}
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
				$featured_img_url_m = get_the_post_thumbnail_url( get_the_ID(), 'square-375' );
				$categories         = get_the_category();
				$post_meta          = get_post_meta( get_the_ID(), 'blog', true );

				if ( $the_query->current_post == 0 ) {
					?>
					<div class="container mb-5">
						<div class="row">
							<div class="col-md order-md-1">
								<div class="card-body">
									<p class="cat-date date-mobile"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
										<?php
										if ( ! empty( $categories ) ) {
											echo ' / ' . esc_html( $categories[0]->name );
										}
										?>
									</p>
									<h4 class="card-title-gb"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
									<?php
									if ( ! empty( $post_meta['blog_meta']['buttontext'] ) ) {
										?>
									<a href="<?php echo $post_meta['blog_meta']['buttonurl']; ?>" class="card-button"><?php echo $post_meta['blog_meta']['buttontext']; ?></a>
									<?php } ?>
								</div>
							</div>
							<div class="col-md order-first order-md-2">
								<div class="img-square-wrapper">
									<div class="card-rectangle-one"></div>
									<img class="card-img-one" src="<?php echo $featured_img_url; ?>" alt="">
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>   
					<div class="col-lg-6 col-md-12 mb-4 second">
						<div class="card card-gb">
							<div class="cat-date-next one">
								<p class="cat-date date-mobile"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
									<?php
									if ( ! empty( $categories ) ) {
										echo ' / ' . esc_html( $categories[0]->name );
									}
									?>
								</p>
							</div>
							<div class="img-shadow two">
								<div class="card-rectangle"></div>                          
								<img class="card-img-next small-img" src="<?php echo $featured_img_url_m; ?>">
								<img class="card-img-next large-img" src="<?php echo $featured_img_url; ?>">
							</div>
							<div class="card-body three">
								<h4 class="card-title-next"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
								<?php
								if ( ! empty( $post_meta['blog_meta']['buttontext'] ) ) {
									?>
									<a href="<?php echo $post_meta['blog_meta']['buttonurl']; ?>" class="card-button"><?php echo $post_meta['blog_meta']['buttontext']; ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php
				}
			endwhile;
			?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
				<p>
					<?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?>
				</p>
		<?php endif; ?>
		</div>
