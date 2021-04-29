<div class="container">
		<div class="tri">
			<div class="tri-element"></div>
			<div class="tri-element"></div>
		</div>
		<div class="page-header">
			<h1>WHAT’S HAPPENING</h1>      
		  </div>
		<p class="page-header-desc">Get the latest news from Rogers Sports & Media. </p>
		<?php
			$category_id   = get_cat_ID( 'What\'s Happening' );
			$category_link = get_category_link( $category_id );
		?>
		   
		<p><a href="<?php echo esc_url( $category_link ); ?>" class="card-button">Read More</a></p>      
	</div>
	<div class="row justify-content-between">
		<?php
		$the_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
				'post_status'    => 'publish',
				'post__in'       => $args['ids_array'],
				'orderby'        => 'post__in',
			)
		);
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
				$categories         = get_the_category();
				$call_to_action     = get_post_meta( get_the_ID(), 'call-to-action', true );
				$call_to_action_url = get_post_meta( get_the_ID(), 'call-to-action_url', true );

				if ( $the_query->current_post == 0 ) {
					?>
					<div class="container mb-5">
						<div class="row">
							<div class="col-sm">
								<div class="card-body">
									<p class="cat-date"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
										<?php
										if ( ! empty( $categories ) ) {
											echo ' / ' . esc_html( $categories[0]->name ); }
										?>
									</p>
									<h4 class="card-title-gb"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
									<?php
									if ( ! empty( $call_to_action ) ) {
										?>
										<a href="<?php echo $call_to_action_url; ?>" class="card-button"><?php echo $call_to_action; ?></a>
									<?php } ?>
								</div>
							</div>
							<div class="col-sm">
								<div class="img-square-wrapper">
									<div class="card-rectangle-one"></div>
									<img class="card-img-one" src="<?php echo $featured_img_url; ?>" alt="">
								</div>
							</div>
						</div>
					</div>
					<?php } else { ?>	
					<div class="col-lg-6 col-md-12 mb-4 second">
						<div class="card mb-2 card-gb">
							<div class="cat-date-next">
								<p class="cat-date"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
									<?php
									if ( ! empty( $categories ) ) {
										echo ' / ' . esc_html( $categories[0]->name ); }
									?>
								</p>
							</div>
							<div class="img-shadow">
								<div class="card-rectangle"></div>
								<img class="card-img-next" src="<?php echo $featured_img_url; ?>" alt="">
							</div>
							<div class="card-body">
								<h4 class="card-title-next"><a href="<?php echo get_permalink( $post->id ); ?>"><?php the_title(); ?></a></h4>
								<?php
								if ( ! empty( $call_to_action ) ) {
									?>
									<a href="<?php echo $call_to_action_url; ?>" class="card-button"><?php echo $call_to_action; ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
				<p>
					<?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?>
				</p>
		<?php endif; ?>
		</div>
