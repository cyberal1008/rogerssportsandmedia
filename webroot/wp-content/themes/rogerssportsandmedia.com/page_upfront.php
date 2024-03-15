<?php
/**
 * Template Name: Upfront
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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php
	get_header();
	global $post;
	$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

<main id="content" role="main">
	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'subtitle'		=> '',
				'title'     => isset($hero_title) ? $hero_title : get_the_title(),
			)
		);
	?>

	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<!-- INTRO -->
	<?php
		$intro_title = get_field('intro_title');
		$intro_content = get_field('intro_content');
		$brands_logos = get_field('brands_logos');
	?>
	<section class="our-difference alt nomargin">
		<div class="wrapper">
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

	<!-- UPFRONT CTA -->
	<?php
		$upfront_title = get_field('upfront_title');
		$upfront_link = get_field('upfront_link');
		$upfront_link_arialabel = get_field('upfront_link_arialabel');
		$upfront_image = get_field('upfront_image');
	?>
	<section id="upfront" class="tw-mb-16 tw-text-white tw-text-center tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 tw-relative tw-py-12 tw-h-[328px] md:tw-h-[500px] xl:tw-h-[612px]" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
		<?php if ($upfront_title) : ?>	
			<div class="tw-font-bold tw-text-4xl md:tw-text-5xl tw-mb-12">
				<?php echo $upfront_title; ?>
			</div>
		<?php endif; ?>
		<?php if ($upfront_image) : ?>
			<a href="<?php echo $upfront_link['url']; ?>" aria-label="<?php echo $upfront_link_arialabel ? $upfront_link_arialabel : ''; ?>" target="<?php echo $upfront_link['target'] ? $upfront_link['target'] : '_self'; ?>">
				<img src="<?php echo $upfront_image['sizes']['large']; ?>" alt="<?php echo $upfront_image['url']; ?>" loading="lazy">
			</a>
		<?php endif; ?>
		<?php if ($upfront_link) : ?>
			<div style="margin-top: 16px;">
				<a href="<?php echo $upfront_link['url']; ?>" class="button" aria-label="<?php echo $upfront_link_arialabel ? $upfront_link_arialabel : ''; ?>" target="<?php echo $upfront_link['target'] ? $upfront_link['target'] : '_self'; ?>"><?php echo $upfront_link['title'] ? $upfront_link['title'] : 'Watch Now'; ?></a>
			<div>
			<?php endif; ?>
	</section>
	
	<div class="tw-mb-16">&nbsp;</div>
	<div class="tw-mb-10">&nbsp;</div>
	<!-- PROGRAMMING -->
	<?php
		$prog_section_title = get_field('prog_section_title');
		$prog_section_button = get_field('prog_section_button');
	?>	
	<section id="programming" class="programming">
		<div class="portfolio-main">
			<div class=" portfolio-page">
				<div class="inner wrapper">
					<hr class="tw-mb-6 tw-bg-gray tw-w-3/4 md:tw-w-3/5" />
					<div class="top md:tw-space-x-12" style="gap: 0rem; justify-content: start;">
						<?php if ($prog_section_title) : ?>
							<h2 class="section-title" style="margin-bottom: 16px"><?php echo $prog_section_title; ?></h2>
						<?php endif; ?>
						<?php if ($prog_section_button) : ?>
							<a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a>
						<?php endif; ?>
					</div>
					<?php
						get_template_part(
							'template-parts/portfolio',
							'program-slider',
							array(
								'page_meta'     => $page_meta,
							)
						);
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- VIDEO SLIDER -->
	<?php
	$vid_section_visibility = get_field('vid_section_visibility');
	if ($vid_section_visibility == 'visible') :
		$vid_section_intro_title = get_field('vid_section_intro_title');
		$vid_section_intro_content = get_field('vid_section_intro_content');
		?>
		<section class="vidblock">
			<div class="inner wrapper">

				<div class="top">
					<?php if ($vid_section_intro_title) : ?>
						<h2 class="section-title"><?php echo $vid_section_intro_title; ?></h2>
					<?php endif; ?>
					<?php echo $vid_section_intro_content ? $vid_section_intro_content : ''; ?>
				</div>
				
				<?php if( have_rows('video_slider') ) : ?>
					<div class="slider">
						<div class="swiper vid-slider">
							<div class="swiper-wrapper">
								
								<?php while( have_rows('video_slider') ) : the_row(); $vid_ctr++;
									$title = get_sub_field('title');
									$description = get_sub_field('description');
									$video_embed_code = get_sub_field('video_embed_code');
									?>
									<div class="swiper-slide">
										<div class="inner">
											<div class="playbox">
												<img src="images/discover.jpg" alt="" loading="lazy">
												<a href="#vid-popup-<?php echo $vid_ctr; ?>" class="trigger" aria-label="<?php echo $title; ?>" data-fancybox><i class="icon fa-sharp fa-solid fa-play"></i></a>
											</div>
											<?php if ($title) : ?>
												<p class="title h4"><?php echo $title; ?></p>
											<?php endif; ?>
										</div>
										<div id="vid-popup-<?php echo $vid_ctr; ?>" class="vid-popup popup">
											<div class="inner">
												<a href="#" class="back" data-fancybox-close aria-label="Back to content">Back</a>
												<?php echo $video_embed_code ? $video_embed_code : ''; ?>
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
	$case_section_visibility = get_field('case_section_visibility');
	if ($case_section_visibility == 'visible') :
		$case_section_title = get_field('case_section_title');
		?>
		<section class="case-studies">
			<div class="inner wrapper">

				<?php if ($case_section_title) : ?>
					<h2 class="section-title"><?php echo $case_section_title; ?></h2>
				<?php endif; ?>

				<div class="slider">
					<div class="swiper case-slider">
						<div class="swiper-wrapper">
							
							<!-- SINGLE -->
							<div class="swiper-slide">
								<div class="inner">
									<div class="txtbox">
										<h4 class="title h4">Name of Case Study Here</h4>
										<p class="intro-line"><i>The case study’s introductory short blurb here, just only two sentences.</i></p>
										<p class="content-title"><strong>OVERVIEW</strong></p>
										<div class="content">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero id faucibus nisl tincidunt. Vulputate dignissim suspendisse in est ante in nibh mauris.</p>
											<p>Odio aenean sed adipiscing diam. Leo vel fringilla est ullamcorper eget nulla facilisi etiam.</p>
											<a href="#" class="button mobile" aria-label="">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
										</div>
										
									</div>
									<div class="imgbox">
										<img src="images/discover.jpg" alt="">
										<a href="#" class="button desktop" aria-label="">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
							<!-- SINGLE -->
							<div class="swiper-slide">
								<div class="inner">
									<div class="txtbox">
										<h4 class="title h4">Name of Case Study Here</h4>
										<p class="intro-line"><i>The case study’s introductory short blurb here, just only two sentences.</i></p>
										<p class="content-title"><strong>OVERVIEW</strong></p>
										<div class="content">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero id faucibus nisl tincidunt. Vulputate dignissim suspendisse in est ante in nibh mauris.</p>
											<p>Odio aenean sed adipiscing diam. Leo vel fringilla est ullamcorper eget nulla facilisi etiam.</p>
											<p>Urna nec tincidunt praesent semper feugiat nibh. Viverra adipiscing at in tellus integer feugiat scelerisque varius morbi. Molestie nunc non blandit massa enim nec. Elit pellentesque habitant morbi tristique senectus et netus.</p>
											<p>Tortor posuere ac ut consequat semper viverra nam. Amet risus nullam eget felis eget nunc lobortis. Facilisi nullam vehicula ipsum a arcu cursus vitae. Tempus urna et pharetra pharetra massa massa ultricies mi. Congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque. Ac tincidunt vitae semper quis lectus nulla at volutpat.</p>
											<a href="#" class="button mobile" aria-label="">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
										</div>
										
									</div>
									<div class="imgbox">
										<img src="images/discover.jpg" alt="">
										<a href="#" class="button desktop" aria-label="">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
	
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<div class="navi">
						<div class="swiper-button-prev case-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
						<div class="swiper-button-next case-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
					</div>
				</div>

			</div>
		</section>
	<?php endif; ?>

	<!-- WHAT'S HAPPENING -->
	<?php
		get_template_part(
			'template-parts/section-whats-happening', null,
		);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>

</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
