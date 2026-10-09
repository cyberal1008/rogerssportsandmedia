<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<?php get_header(); ?>

	<?php
		$id = get_the_ID();
		$feat_img_id = get_post_thumbnail_id($id);
        $feat_img = get_the_post_thumbnail_url($id);
        $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
        $feat_image_caption = get_field('feat_image_caption');

		$banner_image_id = get_post_meta($id, '_banner_image_id', true);
		$banner_image_url = wp_get_attachment_image_url($banner_image_id, 'full');
	?>
	<?php if ($banner_image_url) : ?>
		<section class="tw-relative tw-flex tw-flex-col tw-justify-center tw-overflow-hidden" style="max-height: 384px;">
			<img src="<?php echo $banner_image_url; ?>" alt="<?php echo $alt ? $alt : ''; ?>" class="tw-w-full">
		</section>
	<?php else: ?>
		<section class="tw-relative tw-h-96">
			<?php if ($feat_img) : ?>
				<img src="<?php echo $feat_img; ?>" alt="<?php echo $alt ? $alt : ''; ?>" class="tw-object-cover tw-h-full tw-w-full tw-brightness-50">
			<?php endif; ?>
		</section>
	<?php endif; ?>

	<main id="content" class="blog-post" role="main">
		<?php
			$category_link = "";
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$category_name = esc_html( $categories[0]->name );
				$category_link = home_url( '/the-latest/' );
			}
		?>

		<!-- INTRO -->
		<section class="blog-post-intro">
			<div class="backwrap">
				<div class="wrapper">
					<a href="<?php echo get_home_url(); ?>/the-latest" class="back-btn" aria-label="Go back to What's Happening"><i class="icon fa-sharp fa-regular fa-arrow-left"></i>The Latest</a>
				</div>
			</div>
				
			<div class="wrapper">
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="meta" style="margin: 0">
					<div class="date-cat">
						<?php echo get_the_date('F j, Y'); ?> / <a href="<?php echo $category_link; ?>" aria-label="Read more <?php echo $category_name; ?> posts"><?php echo $category_name; ?></a>
					</div>
				</div>
			</div>
		</section>

		<!-- POST CONTENT -->
		<section class="blog-post-main">
			<div class="inner wrapper">

				<div class="container clearfix">

					<!-- SIDEBAR -->
					<div id="blogpost-sidebar">
						<div class="sidebar__inner">

							<!-- SHARE BLOCK-->
							<?php $pagelink = get_the_permalink(); ?>
							<div class="share-block widget">
								<span class="title">Share to:</span>
								<div class="icons">
									<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pagelink; ?>" aria-label="share to linkedin" target="_blank"><i class="icon fa-brands fa-linkedin"></i></a>
									<a href="https://twitter.com/intent/tweet?text=&url=<?php echo $pagelink; ?>" aria-label="share to twitter" target="_blank"><i class="icon fa-brands fa-square-twitter"></i></a>
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pagelink; ?>" aria-label="share to facebook" target="_blank"><i class="icon fa-brands fa-square-facebook"></i></a>
									<a href="mailto:?&body=<?php echo $pagelink; ?>" aria-label="share via email"><i class="icon fa-solid fa-square-envelope"></i></a>
								</div>
							</div>
			
							<!-- COPY LINK BLOCK-->
							<?php 
							$req_uri = $_SERVER['REQUEST_URI'];
							$path = substr($req_uri,0,strrpos($req_uri,'/'));
							$display_url = 'https://rogerssportsandmedia.com' . $path;
							?>
							<div class="copylink widget">
								<span class="title">Copy link:</span>
								<button type="button" class="copytext" value="<?php echo $pagelink; ?>"><?php echo substr($display_url,0,35).'...'; ?></button>
							</div>

							<!-- POSTS BLOCK -->
							<?php
							$args = array (
							    'post_type' => 'post',
							    'post_status' => 'publish',
							    'posts_per_page' => 3,
							    'cat' => $categories[0]->cat_ID,
							    'post__not_in' => [get_the_ID()]
							);
							$the_query = new WP_Query($args);
							if ( $the_query->have_posts() ) : 
							?>
								<div class="posts-block widget">
									<p class="title" style="text-transform: none; font-family: var(--body-font);">Similar Reads</p>
				
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
										$id = get_the_ID();
										$link = get_the_permalink();
										$title = get_the_title();
										$feat_img_id = get_post_thumbnail_id($id);
								        $feat_img = get_the_post_thumbnail_url($id, 'medium_large');
								        $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
										?>
										<div class="item">
											<p class="date" style="margin-bottom: 4px;"><?php echo get_the_date('F j, Y'); ?></p>
											<a href="<?php echo $link; ?>" aria-label="read <?php echo $title; ?>"><img src="<?php echo $feat_img; ?>" class="feat-img" alt="<?php echo $alt; ?>" loading="lazy"></a>
											<p class="item-title"><a href="<?php echo $link; ?>" aria-label="read <?php echo $title; ?>"><?php echo wp_trim_words( $title, 15 ); ?></a></p>
										</div>
									<?php endwhile; ?>
									
								</div>
							<?php endif; wp_reset_postdata(); ?>

						</div>
					</div>

					<!-- BLOG POST CONTENT -->
					<div id="blogpost-content">
						<!-- SHARE BLOCK-->
						<div class="share-block widget">
							<span class="title">Share to:</span>
							<div class="icons">
								<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $pagelink; ?>" aria-label="share to linkedin" target="_blank"><i class="icon fa-brands fa-linkedin"></i></a>
								<a href="https://twitter.com/intent/tweet?text=&url=<?php echo $pagelink; ?>" aria-label="share to twitter" target="_blank"><i class="icon fa-brands fa-square-twitter"></i></a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $pagelink; ?>" aria-label="share to facebook" target="_blank"><i class="icon fa-brands fa-square-facebook"></i></a>
								<a href="mailto:?&body=<?php echo $pagelink; ?>" aria-label="share via email"><i class="icon fa-solid fa-square-envelope"></i></a>
							</div>
						</div>
		
						<!-- COPY LINK BLOCK-->
						<div class="copylink widget">
							<span class="title">Copy link:</span>
							<button type="button" class="copytext" value="<?php echo $pagelink; ?>"><?php echo substr($display_url,0,31).'...';; ?></button>
						</div>

						<?php the_content(); ?>

						<a href="#" class="backtop" aria-label="back to top">Back to top <i class="icon fa-sharp fa-solid fa-chevron-up"></i></a>
					</div>

				</div>

				<div class="spacer"></div>
	
			</div>
		</section>

	</main>

	<script src="https://kit.fontawesome.com/8ded1e9203.js" data-search-pseudo-elements crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

	<script>
		$(".blog-post-sidebar").stick_in_parent({
		    offset_top: 10
		}); 
	</script>

<?php
get_footer();
