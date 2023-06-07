<?php
/**
 * Template Name: TV
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
<?php
get_header();
global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
$hero_title = get_field('hero_title');
$hero_image = get_field('hero_image');
$hero_mobile_image = get_field('hero_mobile_image');
?>
<section class="hero">
	<picture>
		<source srcset="<?php echo $hero_image['url']; ?>"
				media="(min-width: 640px)">
		<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
	</picture>

	<div class="wrapper">
		<span>What We Do</span>
		<h1><?php echo $hero_title ? $hero_title : get_the_title(); ?></h1>
	</div>
</section>

<!-- SKIP -->
<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

<main id="content" role="main">

	<section class="anchors desktop">
		<div class="wrapper">
			<div class="anchor-list">
				<a href="#statistics" aria-label="Statistics">Statistics</a>
				<a href="#featured" aria-label="Featured Products">Featured Products</a>
				<a href="#programming" aria-label="Programming">Programming</a>
				<a href="#trends" aria-label="What's Happening">What's Happening</a>
				<a href="#partner" aria-label="Partner With Us">Partner With Us</a>
			</div>
		</div>
	</section>

	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/curve-green1.svg" alt="curved green line" class="deco btm-left">
		<div class="wrapper">
			<div class="top">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content; ?>
			</div>
			<?php if ($brands_logos) : ?>
				<div class="swiper logo-slider">
					<div class="swiper-wrapper">
						<?php foreach ($brands_logos as $logo) : ?>
							<div class="swiper-slide">
								<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- COUNTERS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="statistics" class="highlights">
			<div class="wrapper">
				<div class="grid circle-stats">
					<?php while( have_rows('highlights') ) : the_row(); 
						$number = get_sub_field('number');
						$number_text = get_sub_field('number_text');
						$text = get_sub_field('text');
						$circle_color = get_sub_field('circle_color');
						?>
						<div class="item">
							<?php if ($number) : ?> 
								<div class="stat <?php echo $circle_color ? $circle_color : ''; ?>">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
									<?php if ($number_text) : ?>
										<span class="sign bold"><?php echo $number_text; ?></span>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ($text) : ?>
								<p class="desc"><?php echo $text; ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- STRETCH BOXES-->
	<?php
	$tv_section_button = get_field('tv_section_button');
	?>
	<section id="featured" class="stretchboxes">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/triangles-green.svg" class="deco" alt="green decorative triangles" loading="lazy">
		<div class="inner wrapper">

			<?php if( have_rows('tv_left_box') ) : while( have_rows('tv_left_box') ) : the_row(); 
				$image = get_sub_field('bg_image');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$link = get_sub_field('boxlink');
				?>
				<div class="box left">
					<div tabindex="0" class="boxlink" aria-label="<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>"></div>
					<?php if ($image) : ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="bg">
					<?php endif; ?>
					<div class="txt">
						<?php if ($title) : ?>
							<p class="title"><?php echo $title; ?></p>
						<?php endif; ?>
						<p class="hover">Hover for Details</p>
						<?php if ($description) : ?>
							<p class="desc"><?php echo $description; ?></p>
						<?php endif; ?>
						<span class="lined white mobile" aria-label="Learn More about <?php echo $title; ?>">Learn More</span>
					</div>
				</div>
			<?php endwhile; endif; ?>

			<?php if( have_rows('tv_right_box') ) : while( have_rows('tv_right_box') ) : the_row(); 
				$image = get_sub_field('bg_image');
				$title = get_sub_field('title');
				$description = get_sub_field('description');
				$link = get_sub_field('boxlink');
				?>
				<div class="box right">
					<div tabindex="0" class="boxlink" aria-label="<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>"></div>
					<?php if ($image) : ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="bg">
					<?php endif; ?>
					<div class="txt">
						<?php if ($title) : ?>
							<p class="title"><?php echo $title; ?></p>
						<?php endif; ?>
						<p class="hover">Hover for Details</p>
						<?php if ($description) : ?>
							<p class="desc"><?php echo $description; ?></p>
						<?php endif; ?>
						<span class="lined white mobile" aria-label="Learn More about <?php echo $title; ?>">Learn More</span>
					</div>
				</div>
			<?php endwhile; endif; ?>

		</div>
		<?php if ($tv_section_button) : ?>
			<div class="btn-wrap wrapper">
				<a href="<?php echo $tv_section_button['url']; ?>" class="button" aria-label="<?php echo $tv_section_button['title'] ? $tv_section_button['title'] : 'Explore Streaming Buyers Guide'; ?>"><?php echo $tv_section_button['title'] ? $tv_section_button['title'] : 'Explore Streaming Buyers Guide'; ?></a>
			</div>
		<?php endif; ?>
	</section>

	<!-- PROGRAMMING -->
	<?php
	$prog_section_title = get_field('program_section_title');
	$prog_section_button = get_field('program_section_button');
	?>	
	<section id="programming" class="programming">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/images/circle-yellow.svg" class="deco" alt="yellow ring decoration" loading="lazy">
		<div class="portfolio-main">
			<div class=" portfolio-page">
				<div class="inner wrapper">

					<div class="top">
						<?php if ($prog_section_title) : ?>
							<h2 class="section-title"><?php echo $prog_section_title; ?></h2>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<a href="<?php echo $prog_section_button['url']; ?>" class="lined" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a>
						<?php endif; ?>
					</div>

					<?php
					get_template_part(
						'template-parts/portfolio',
						'program-slider',
						array(
							'page_meta'     => $page_meta,
							'section_title' => $solutions_anchor_label,
						)
					);
					?>
				</div>
			</div>
		</div>
	</section>


	<!-- VIDEO SLIDER -->
			<?php
			$test = get_post_meta(get_the_ID(), 'vidslider_vis');
			$vidslider_vis = get_field('vidslider_vis');
			if ($vidslider_vis == 'Visible') :
				$vidslider_section_title = get_field('vidslider_section_title');
				$vidslider_intro_content = get_field('vidslider_intro_content');
				?>
				<section class="vidblock">
					<div class="inner wrapper">

						<div class="top">
							<?php if ($vidslider_section_title) : ?>
								<h2 class="section-title"><?php echo $vidslider_section_title; ?></h2>
							<?php endif; ?>
							<?php echo $vidslider_intro_content ? $vidslider_intro_content : ''; ?>
						</div>
						
						<?php if( have_rows('videoslider') ) : ?>
							<div class="slider">
								<div class="swiper vid-slider">
									<div class="swiper-wrapper">
										
										<?php while( have_rows('videoslider') ) : the_row(); $vid_ctr++;
											$title = get_sub_field('title');
											$description = get_sub_field('description');
											$video_embed_code = get_sub_field('video_embed_code');
											$preview_image = get_sub_field('preview_image');
											?>
											<div class="swiper-slide">
												<div class="inner">
													<div class="playbox">
														<img src="<?php echo $preview_image['sizes']['medium_large']; ?>" alt="<?php echo $preview_image['alt']; ?>" loading="lazy">
														<a href="#vid-popup-<?php echo $vid_ctr; ?>" class="trigger" aria-label="<?php echo $title; ?>" data-fancybox><i class="icon fa-sharp fa-solid fa-play"></i></a>
													</div>
													<?php if ($title) : ?>
														<p class="title h4"><?php echo $title; ?></p>
													<?php endif; ?>
												</div>
												<div id="vid-popup-<?php echo $vid_ctr; ?>" class="vid-popup popup">
													<div class="inner">
														<a href="#" class="back" data-fancybox-close aria-label="Back to content">Back</a>
														<?php if ($video_embed_code) : ?>
															<div class="iframe-wrap">
																<?php echo $video_embed_code; ?>
															</div>
														<?php endif; ?>
														<?php if ($title) : ?>
															<p class="title h4"><?php echo $title; ?></p>
														<?php endif; ?>
														<?php if ($description) : ?>
															<p><?php echo $description; ?></p>
														<?php endif; ?>
													</div>
												</div>
											</div>
										<?php endwhile; ?>

									</div>
									<div class="swiper-pagination"></div>
								</div>

								<div class="navi">
									<div class="swiper-button-prev vid-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
									<div class="swiper-button-next vid-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
								</div>
							</div>
						<?php endif; ?>

					</div>
				</section>
			<?php endif; ?>

			<!-- CASE STUDIES -->
			<?php
			$cs_vis = get_field('cs_vis');
			if ($cs_vis == 'Visible') :
				$cs_section_title = get_field('cs_section_title');
				?>
				<section class="case-studies">
					<div class="inner wrapper">

						<?php if ($cs_section_title) : ?>
							<h2 class="section-title"><?php echo $cs_section_title; ?></h2>
						<?php endif; ?>

						<?php if( have_rows('c_studies') ) : ?>
							<div class="slider">
								<div class="swiper case-slider">
									<div class="swiper-wrapper">
										
										<?php while( have_rows('c_studies') ) : the_row();
											$postitem = get_sub_field('post_item');
											$postid = $postitem->ID;
											$link = get_the_permalink($postitem->ID);
											$intro_text = get_sub_field('intro_text');
											$intro_description = get_sub_field('intro_description');
											$feat_img_id = get_post_thumbnail_id($postid);
				                            $feat_img = get_the_post_thumbnail_url($postid, 'large');
				                            $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
				                            $title = strlen($postitem->post_title) > 90 ? substr($postitem->post_title,0,90)."..." : $postitem->post_title;
				                            
											?>
											<div class="swiper-slide">
												<div class="inner">
													<div class="txtbox">
														<h3 class="title h4"><?php echo $title ?></h3>
														<?php if ($intro_text) : 
															$intro_title_trim = strlen($intro_text) > 80 ? substr($intro_text,0,80)."..." : $intro_text;
															?>
															<p class="intro-line"><i><?php echo $intro_title_trim; ?></i></p>
														<?php endif; ?>
														<p class="content-title"><strong>OVERVIEW</strong></p>
														<div class="content">
															<?php if ($intro_description) : 
																$desc_trim = strlen($intro_description) > 260 ? substr($intro_description,0,260)."..." : $intro_description;
																echo $desc_trim;
																?>
															<?php endif; ?>
															<a href="<?php echo $link; ?>" class="button mobile" aria-label="Read Full Story: <?php echo $postitem->post_title; ?>">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
														</div>
														
													</div>
													<div class="imgbox">
														<?php if ($feat_img) : ?>
															<img src="<?php echo $feat_img; ?>" alt="<?php echo $alt; ?>" loading="lazy">
														<?php endif; ?>
														<a href="<?php echo $link; ?>" class="button desktop" aria-label="Read Full Story: <?php echo $postitem->post_title; ?>">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
													</div>
												</div>
											</div>
										<?php endwhile; ?>
				
									</div>
									<div class="swiper-pagination"></div>
								</div>
								<div class="navi">
									<div class="swiper-button-prev case-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
									<div class="swiper-button-next case-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
								</div>
							</div>
						<?php endif; ?>

					</div>
				</section>
			<?php endif; ?>

			<!-- WHAT'S HAPPENING -->
			<?php
			get_template_part(
				'template-parts/whats-happening', null,
				array(
					'deco'   => array(
						'url' => get_stylesheet_directory_uri() . '/assets/home/images/circle-white.svg',
						'class'    => 'deco',
						'alt'     => 'grey decorative rings'
					),
				)
			);
			?>

			<!-- PARTNER -->
			<section id="partner" class="partner">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/group-red.png" alt="" class="bg bg3" loading="lazy">
				<div class="wrapper">
					<h2 class="section-title">PARTNER WITH US TODAY</h2>

					<iframe src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/r2bks1awm2k" width="100%" height="820" allowfullscreen sandbox="allow-same-origin allow-scripts allow-popups allow-forms" title="partner with us today by filling out the form below">
						<p>Sorry, your browser does not support iframes.</p>
					</iframe>

				</div>
			</section>
	</main>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/8ded1e9203.js" data-search-pseudo-elements crossorigin="anonymous"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
