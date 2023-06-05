<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
</head>
<?php get_header(); ?>

	<?php
	$hero_image = get_field('hero_image', 'category_1');
	$hero_mobile_image = get_field('hero_mobile_image', 'category_1');
	?>
	<section class="hero">
		<picture>
			<source srcset="<?php echo $hero_image['url']; ?>"
					media="(min-width: 640px)">
			<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
		</picture>

		<div class="wrapper">
			<span>What We Do</span>
			<h1>THE LATEST FROM RSM</h1>
		</div>
	</section>

	<!-- SKIP -->
	<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

	<main id="content" class="blog-post" role="main">

		<?php
		$id = get_the_ID();
		$feat_img_id = get_post_thumbnail_id($id);
        $feat_img = get_the_post_thumbnail_url($id);
        $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
        $feat_image_caption = get_field('feat_image_caption');
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category_name = esc_html( $categories[0]->name );
			$category_link = get_category_link( $categories[0]->cat_ID );
		}
		?>

		<!-- INTRO -->
		<section class="blog-post-intro">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/blog-post-deco.svg" alt="" class="deco">
			<div class="backwrap">
				<div class="wrapper">
					<a href="<?php echo get_home_url(); ?>/whats-happening" class="back-btn" aria-label="Go back to What's Happening"><i class="icon fa-sharp fa-regular fa-arrow-left"></i>What's Happening</a>
				</div>
			</div>
				
			<div class="wrapper">

				<div class="meta">
					<div class="date-cat">
						<?php echo get_the_date('F j, Y'); ?> / <a href="<?php echo $category_link; ?>" aria-label="Read more <?php echo $category_name; ?> posts"><?php echo $category_name; ?></a>
					</div>
				</div>

				<h1 class="title"><?php the_title(); ?></h1>
				<?php if ($feat_img) : ?>
					<div class="feat-wrap">
						<img src="<?php echo $feat_img; ?>" class="feat-img" alt="<?php echo $alt ? $alt : ''; ?>">
						<?php if ($feat_image_caption) : ?>
							<p class="caption"><?php echo $feat_image_caption; ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
					
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
							$pagelink = get_the_permalink();
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
									<p class="title">Similar Reads</p>
				
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
										$id = get_the_ID();
										$link = get_the_permalink();
										$title = get_the_title();
										$feat_img_id = get_post_thumbnail_id($id);
								        $feat_img = get_the_post_thumbnail_url($id, 'medium_large');
								        $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
										?>
										<div class="item">
											<a href="<?php echo $link; ?>" aria-label="read <?php echo $title; ?>"><img src="<?php echo $feat_img; ?>" class="feat-img" alt="<?php echo $alt; ?>" loading="lazy"></a>
											<p class="item-title"><a href="<?php echo $link; ?>" aria-label="read <?php echo $title; ?>"><?php echo wp_trim_words( $title, 15 ); ?></a></p>
											<p class="date"><?php echo get_the_date('F j, Y'); ?></p>
											<div class="btn-wrap">
												<a href="<?php echo $link; ?>" class="lined" aria-label="read more about <?php echo $title; ?>">Read More</a>
											</div>
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
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/triangles-green.svg" alt="" class="deco">

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
