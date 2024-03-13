<?php
$happening_section_title = get_field('happening_section_title');
$happening_content = get_field('happening_content');
?>
<section id="trends" class="trends <?php echo (isset($args['class']) ? $args['class'] : ''); ?>">
	<div class="wrapper">
		<hr class="tw-mb-6 tw-bg-gray tw-w-3/4 md:tw-w-3/5" />
		<div class="tw-text-gray-dark tw-text-4xl md:tw-text-5xl tw-font-bold tw-mb-3"><?php echo $happening_section_title ? $happening_section_title : "The Latest"; ?></div>
		<?php echo $happening_content ? $happening_content : '<p>Get the latest news from Rogers Sports & Media</p>'; ?>
		<?php
		$zone = isset($args['zone']) ? $args['zone'] : 'whats-happening-television';
		if ( function_exists( 'z_get_posts_in_zone' ) && ! empty( $zone ) ) {
			$the_query = z_get_zone_query( $zone );
		} else {
			$the_query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post_status'    => 'publish',
					'post__not_in'   => array( get_the_ID() ),
					'order'			=> 'DESC',
					'orderby'		=> 'date'
				)
			);
		}
		?>
		<div class="grid">
			<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
				$id = get_the_ID();
				$feat_img_id = get_post_thumbnail_id($id);
				$featured_img_url   = get_the_post_thumbnail_url( $id, 'wide-577' );
				$alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
				$categories         = get_the_category();
				$post_meta          = get_post_meta( $id, 'blog', true );
				?>
				<div class="item">
					<?php $title_formatted = ucwords(strtolower(get_the_title())); ?>
					<p class="date" style="margin: 0px; padding-bottom: 8px;"><?php echo get_the_date( get_option( 'date_format' ) ); ?> / <?php echo $categories ? $categories[0]->name : ''; ?></p>
					<a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt; ?>" loading="lazy"></a>
					<h3 class="post-title"><a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><?php echo $title_formatted; ?></a></h3>
					<div class="btn-wrap">
						<a class="tw-text-gray-dark tw-font-bold tw-border-b-[3px] tw-py-1 tw-border-gray-light hover:tw-border-red tw-no-underline hover:tw-no-underline focus:tw-no-underline hover:tw-text-black visited:tw-text-black" 
                        	href="<?php the_permalink(); ?>" aria-label="Read More about <?php echo $title_formatted; ?>">Read More</a>
					</div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</section>