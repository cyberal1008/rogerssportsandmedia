<?php
	/**
	 * The template for displaying home page.
	 *
	 * @package Rogers Digital Media
	 * @subpackage rdm-rsm-parent
	 * @since Ver 1.0
	 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>

<?php 
get_header();
$home_hero_btn_url  = get_theme_mod( 'desktop_vid_link_button_url' );
$home_hero_btn_text = get_theme_mod( 'desktop_vid_link_button_text' );
?>

<main id="content" role="main">
	<!-- INTRO -->
	<?php
	$intro_title = get_field('intro_title');
	$intro_content = get_field('intro_content');
	$intro_button = get_field('intro_button');
	$intro_button_arialabel = get_field('intro_button_arialabel');
	$intro_column_1 = get_field('intro_column_1');
	$intro_column_2 = get_field('intro_column_2');
	$intro_column_3 = get_field('intro_column_3');
	$intro_column_4 = get_field('intro_column_4');
	?>
	<section id="our-difference" class="our-difference" style="margin-top: 4rem;">
		<div class="wrapper">
			<div class="top">
				<?php if ($intro_title) : ?>
					<h2 class="title"><?php echo $intro_title; ?></h2>
				<?php endif; ?>
				<?php echo $intro_content ? $intro_content : ''; ?>
			</div>
			<div class="grid four">
				<?php if( have_rows('intro_column_1') ) : while( have_rows('intro_column_1') ): the_row(); 
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$blurb = get_sub_field('blurb');
					?>
					<div class="item">
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-1" aria-expanded="false" aria-controls="accordion-1-content">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $title ? $title : ''; ?>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
								<i class="fa-sharp fa-solid fa-minus status minus"></i>
							</button>
							<div class="accordion-content" id="accordion-1-content" aria-labelledby="accordion-1">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $blurb ? $blurb : ''; ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>

				<?php if( have_rows('intro_column_2') ) : while( have_rows('intro_column_2') ): the_row(); 
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$blurb = get_sub_field('blurb');
					?>
					<div class="item">
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-2" aria-expanded="false" aria-controls="accordion-2-content">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $title ? $title : ''; ?>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
								<i class="fa-sharp fa-solid fa-minus status minus"></i>
							</button>
							<div class="accordion-content" id="accordion-2-content" aria-labelledby="accordion-2">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $blurb ? $blurb : ''; ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>

				<?php if( have_rows('intro_column_3') ) : while( have_rows('intro_column_3') ): the_row(); 
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$blurb = get_sub_field('blurb');
					?>
					<div class="item">
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-3" aria-expanded="false" aria-controls="accordion-3-content">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $title ? $title : ''; ?>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
								<i class="fa-sharp fa-solid fa-minus status minus"></i>
							</button>
							<div class="accordion-content" id="accordion-3-content" aria-labelledby="accordion-3">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $blurb ? $blurb : ''; ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>
				<?php if( have_rows('intro_column_4') ) : while( have_rows('intro_column_4') ): the_row(); 
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$blurb = get_sub_field('blurb');
					?>
					<div class="item">
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-4" aria-expanded="false" aria-controls="accordion-4-content">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="mobile" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $title ? $title : ''; ?>
								<i class="fa-sharp fa-solid fa-plus-large status plus"></i>
								<i class="fa-sharp fa-solid fa-minus status minus"></i>
							</button>
							<div class="accordion-content" id="accordion-4-content" aria-labelledby="accordion-4">
								<?php if ($icon) : ?>
									<img src="<?php echo $icon['url']; ?>" class="desktop" alt="<?php echo $icon['alt']; ?>" loading="lazy">
								<?php endif; ?>
								<?php echo $blurb ? $blurb : ''; ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</section>

		<!-- BRAND -->
		<?php 
		$brands_section_title = get_field('brands_section_title'); 
		$brands_logos = get_field('brands_logos');
		if ($brands_logos) :
		?>
			<section class="logos">
				<div class="wrapper">
					<?php if ($brands_section_title) : ?>
						<h2 class="title"><?php echo $brands_section_title; ?></h2>
					<?php endif; ?>
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

				</div>
			</section>
		<?php endif; ?>

		<!-- DISCOVER -->
		<?php
			$disc_section_title = get_field('disc_section_title');
			$disc_content = get_field('disc_content');
			$disc_button = get_field('disc_button');
			$disc_button_arialabel = get_field('disc_button_arialabel');
			$disc_image = get_field('disc_image');
		?>
		<section class="tw-w-full tw-text-white tw-px-4 tw-py-12 md:tw-py-24 md:tw-px-12 lg:tw-px-24 xl:tw-px-40 2xl:tw-px-80" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
			<div class="tw-flex tw-flex-col md:tw-flex-row md:tw-space-x-20">
				<div class="tw-w-full md:tw-w-1/3 tw-mb-12 md:tw-mb-0 tw-flex tw-items-center tw-justify-center">
					<?php if ($disc_image) : ?>
						<img src="<?php echo $disc_image['sizes']['large']; ?>" alt="<?php echo $disc_image['alt']; ?>" loading="lazy" class="tw-h-64">
					<?php endif; ?>
				</div>
				<div class="tw-w-full md:tw-w-2/3 tw-flex-col tw-justify-center">
					<hr class="tw-w-5/6 tw-mb-4 tw-border-t-2 tw-border-white" />
					<?php if ($disc_section_title) : ?>
						<div class="tw-mb-4 tw-text-4xl md:tw-text-5xl tw-font-semibold"><?php echo $disc_section_title; ?></div>
					<?php endif; ?>
					<div class="tw-mb-12 md:tw-text-xl">
						<?php echo $disc_content; ?>
					</div>
					<?php if ($disc_button) : ?>
						<a href="<?php echo $disc_button['url']; ?>" class="tw-bg-white tw-px-6 tw-py-3 tw-text-base tw-font-medium tw-text-black tw-shadow-sm tw-no-underline hover:tw-no-underline focus:tw-no-underline hover:tw-text-black visited:tw-text-black" aria-label="<?php echo $disc_button_arialabel ? $disc_button_arialabel : ''; ?>">
							<?php echo $disc_button['title']; ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- EXPLORE -->
		<?php
		$exp_section_title = get_field('exp_section_title');
		$exp_content = get_field('exp_content');
		$exp_button = get_field('exp_button');
		$exp_button_arialabel = get_field('exp_button_arialabel');
		?>
		<section id="products" class="explore">
			<div class="wrapper">
				<div class="intro">
					<?php if ($exp_section_title) : ?>
						<h2 class="title"><?php echo $exp_section_title; ?></h2>
					<?php endif; ?>
					<?php echo $exp_content ? $exp_content : ''; ?>
					<?php if ($exp_button) : ?>
						<a href="<?php echo $exp_button['url']; ?>" aria-label="<?php echo $exp_button_arialabel ? $exp_button_arialabel : ''; ?>" class="button"><?php echo $exp_button['title']; ?></a>
					<?php endif; ?>
				</div>

				<!-- DESKTOP -->
				<?php if( have_rows('exp_tabs') ): ?>
					<div class="tabs">
						<div class="tablist" role="tablist" aria-label="">
							<?php $tab_ctr=0; while( have_rows('exp_tabs') ): the_row(); $tab_ctr++;
								$title = get_sub_field('title');
								?>
								<button class="trigger exp" role="tab" aria-selected="<?php echo $tab_ctr == 1 ? 'true' : 'false'; ?>" aria-controls="tab-content-<?php echo $tab_ctr; ?>" id="tab-<?php echo $tab_ctr; ?>" tabindex="<?php echo $tab_ctr == 1 ? '' : '-1'; ?>">
									<?php echo $title; ?>
								</button>
							<?php endwhile; ?>
						</div>
						<div class="content">
							<?php $con_ctr=0; while( have_rows('exp_tabs') ): the_row(); $con_ctr++;
								$content = get_sub_field('content');
								$button = get_sub_field('button');
								$button_arialabel = get_sub_field('button_arialabel');
								$image = get_sub_field('image');
								?>
								<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-<?php echo $con_ctr; ?>" aria-labelledby="tab-<?php echo $con_ctr; ?>" <?php echo $con_ctr == 1 ? '' : 'hidden'; ?>>
									<?php if ($image) : ?>
										<img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>">
									<?php endif; ?>
									<?php echo $content ? $content : ''; ?>
									<?php if ($button) : ?>
										<a href="<?php echo $button['url']; ?>" class="lined" aria-label="<?php echo $button_arialabel ? $button_arialabel : ''; ?>"><?php echo $button['title'] ? $button['title'] : 'Learn More'; ?></a>
									<?php endif; ?>
								</div>
							<?php endwhile; ?>
						</div>
						
					</div>

					<!-- MOBILE -->
					<div class="mobile">
						<?php 
						$mobtab_ctr = 20;
						while( have_rows('exp_tabs') ): the_row(); $mobtab_ctr++;
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							$button = get_sub_field('button');
							$button_arialabel = get_sub_field('button_arialabel');
							$image = get_sub_field('image');
							?>
							<div class="accordion">
								<button class="accordion-trigger" id="accordion-<?php echo $mobtab_ctr; ?>" aria-expanded="false" aria-controls="accordion-<?php echo $mobtab_ctr; ?>-content">
									<?php echo $title; ?>
									<i class="fa-sharp fa-solid fa-plus-large status"></i>
								</button>
								<div class="accordion-content" id="accordion-<?php echo $mobtab_ctr; ?>-content" aria-labelledby="accordion-<?php echo $mobtab_ctr; ?>">
									<?php if ($image) : ?>
										<img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
									<?php endif; ?>
									<div class="txtbox">
										<?php echo $content ? $content : ''; ?>
										<?php if ($button) : ?>
											<a href="<?php echo $button['url']; ?>" class="lined" aria-label="<?php echo $button_arialabel ? $button_arialabel : ''; ?>"><?php echo $button['title'] ? $button['title'] : 'Learn More'; ?></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>

			</div>
		</section>

	<?php
	$happening_section_title = get_field('happening_section_title');
	$happening_content = get_field('happening_content');
	?>
	<section id="trends" class="trends">
		<div class="wrapper">
			<hr class="tw-bg-gray-light tw-w-3/4 md:tw-w-3/5" />
			<?php if ($happening_section_title) : ?>
				<h2 class="section-title"><?php echo $happening_section_title; ?></h2>
			<?php endif; ?>
			<?php echo $happening_content; ?>
			<?php
			$zone = 'happening-home';
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
			<div class="grid">
				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
					$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
					$categories         = get_the_category();
					$post_meta          = get_post_meta( get_the_ID(), 'blog', true );
					?>
					<div class="item">
						<?php $title_formatted = ucwords(strtolower(get_the_title())); ?>
						<p class="date" style="margin-bottom: 6px;"><?php echo get_the_date( get_option( 'date_format' ) ); ?> / <?php echo $categories ? $categories[0]->name : ''; ?></p>
						<a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><img src="<?php echo $featured_img_url; ?>" alt="" loading="lazy"></a>
						<h3 class="post-title"><a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><?php echo $title_formatted; ?></a></h3>
						<div class="btn-wrap">
							<a href="<?php the_permalink(); ?>" class="lined" aria-label="Read More about <?php echo $title_formatted; ?>">Read More</a>
						</div>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</section>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>

</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
