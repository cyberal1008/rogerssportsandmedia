<?php
/**
 * Template Name: Tubi
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

<main id="content" role="main" class="">

	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'subtitle'		=> '',
				'title'     => ' ',
			)
		);
	?>
	
	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<!-- FEATURED VIDEO -->
	<?php
		$featured_video_title = get_field('featured_video_title');
		$featured_video_url = get_field('featured_video_url');
	?>
	<div class="tw-bg-gray tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80 md:tw-py-24">
        <?php if ($featured_video_title) : ?>
            <h2><?php echo $featured_video_title; ?></h2>
        <?php endif; ?>
        <?php if ($featured_video_url) : ?>
            <video controls>
                <source src="<?php echo $featured_video_url; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php endif; ?>
	</div>

	<!-- PLATFORMS -->
	<?php 
		if( have_rows('brands') ) : 
			$brands_section_title = get_field('brands_section_title');
		?>
		<section id="brands" class="service-grid">
			<div class="wrapper">
				<?php if ($brands_section_title) : ?>
					<h2 class="section-title"><?php echo $brands_section_title; ?></h2>
				<?php endif; ?>

				<div class="swiper plat-slider">
					<div class="swiper-wrapper grid tight">

						<?php while( have_rows('brands') ) : the_row(); 
							$title = get_sub_field('title');
							$description = get_sub_field('description');
							$link = get_sub_field('link');
							$link_arialabel = get_sub_field('link_arialabel');
							$image = get_sub_field('image');
							?>
							<div class="swiper-slide">
								<div class="item">
									<?php if ($image) : ?>
										<?php if ($link) : ?>
											<a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : $link['title']; ?>"><img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy"></a>
										<?php else : ?>
											<img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
										<?php endif; ?>
									<?php endif; ?>
									<div class="txtbox">
										<?php if ($title) : ?>
											<?php if ($link) : ?>
												<p class="title h4"><a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : $link['title']; ?>"><?php echo $title; ?></a></p>
											<?php else : ?>
												<p class="title h4"><?php echo $title; ?></p>
											<?php endif; ?>
										<?php endif; ?>
										<?php if ($description) : ?>
											<div class="excerpt"><?php echo $description; ?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- SHOWS -->
	<?php
		$prog_section_title = get_field('shows_section_title');
		$prog_section_button = get_field('shows_section_button');
	?>
        <section class="tw-bg-gray">
            <section id="programming" class="programming">
                <div class="portfolio-main">
                    <div class="portfolio-page">
                        <div class="inner wrapper">
                            <hr class="tw-mb-6 tw-bg-gray tw-w-3/4 md:tw-w-3/5" />
                            <div class="top md:tw-space-x-12" style="gap: 0rem; justify-content: start;">
                                <?php if ($prog_section_title) : ?>
                                    <div class="tw-text-4xl md:tw-text-5xl tw-text-gray-dark tw-font-bold tw-mb-4 md:tw-mb-4"><?php echo $prog_section_title; ?></div>
                                <?php endif; ?>
                                <?php if ($prog_section_button) : ?>
                                    <a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download TV Schedule'; ?></a>
                                <?php endif; ?>
                            </div>

							<div class="tw-grid tw-grid-cols-2 sm:tw-grid-cols-3 md:tw-grid-cols-5 tw-gap-8">
								<?php while( have_rows('shows') ) : the_row(); 
									$show_title = get_sub_field('show_title');
									$show_image = get_sub_field('show_image');
								?>
									<div>
										<img class="tw-mb-1" src="<?php echo $show_image['url']; ?>" alt="<?php echo $show_image['alt']; ?>" loading="lazy">
										<div class="tw-text-center tw-text-base md:tw-text-lg"><?php echo $show_title; ?></div>
									</div>
								<?php endwhile; ?>
							</div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="tw-mb-12">&nbsp;</div>
        </section>

    <!-- ICON COLUMNS -->
    <?php
		if( have_rows('icon_columns') ) : 
			$icon_section_title = get_field('icon_section_title');
	?>
	    <section id="suite" class="tw-bg-white tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80 md:tw-py-20">
			<?php if ($icon_section_title) : ?>
				<div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-16"><?php echo $icon_section_title; ?></div>
			<?php endif; ?>
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-y-12 md:tw-gap-y-0 md:tw-gap-x-8">
				<?php while( have_rows('icon_columns') ) : the_row(); 
					$image = get_sub_field('image');
					$content = get_sub_field('content');
				?>
					<div class="tw-flex-col">
						<?php if ($image) : ?>
							<div class="tw-flex tw-items-center tw-justify-center tw-mb-6">
								<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy" class="tw-rounded-full tw-w-24">
							</div>
						<?php endif; ?>
						<?php if ($content) : ?>
							<div class="tw-font-medium"><?php echo $content; ?></div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>


    <!-- COUNTERS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80 md:tw-py-24" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-text-white tw-gap-y-10 md:tw-gap-x-16">
				<?php while( have_rows('highlights') ) : the_row();
					$number = get_sub_field('number');
					$number_text = get_sub_field('number_text');
					$text = get_sub_field('text');
				?>
					<div class="tw-full">
						<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
							<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
						</div>
						<?php if ($text) : ?>
							<div class="tw-text-lg"><?php echo $text; ?></div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
    	</section>
	<?php endif; ?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
