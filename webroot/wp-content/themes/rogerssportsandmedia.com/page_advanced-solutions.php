<?php
/**
 * Template Name: Advanced Solutions
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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css?v=1.0.7">
</head>
<?php get_header(); ?>

<main id="content" role="main" class="tw-bg-gray">
	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'title' => get_the_title(),
			)
		);
	?>

	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<!-- ADVANCED LIST -->
	<?php get_template_part('template-parts/section-advanced-list'); ?>

	<!-- R.E.D. -->
	<?php
		$red_section_title = get_field('red_section_title');
		$red_content = get_field('red_content');
		$red_image = get_field('red_image');
	?>
	<section id="red" class="tw-w-full tw-text-white tw-px-4 tw-py-12 md:tw-py-24 md:tw-px-12 lg:tw-px-24 xl:tw-px-40 2xl:tw-px-80" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
        <div class="tw-flex tw-flex-col md:tw-flex-row md:tw-space-x-20">
            <div class="tw-w-full md:tw-w-1/3 tw-mb-12 md:tw-mb-0 tw-flex tw-items-center tw-justify-center">
				<?php if ($red_image) : ?>
                	<img src="<?php echo $red_image['sizes']['large']; ?>" alt="<?php echo $red_image['alt']; ?>" loading="lazy" class="tw-w-80 tw-h-80 tw-rounded-full">
				<?php endif; ?>
            </div>
            <div class="tw-w-full md:tw-w-2/3 tw-flex-col tw-justify-center">
                <hr class="tw-w-5/6 tw-mb-4 tw-border-t-2 tw-border-white" />
				<?php if ($red_section_title) : ?>
                	<div class="tw-mb-4 tw-text-3xl md:tw-text-4xl tw-font-semibold"><?php echo $red_section_title; ?></div>
				<?php endif; ?>
                <div class="tw-mb-8 md:tw-text-xl">
					<?php echo $red_content; ?>
                </div>
            </div>
        </div>
    </section>

	<!-- ICON COLUMNS -->
	<?php
		if( have_rows('icon_columns') ) : 
			$icon_section_title = get_field('icon_section_title');
			$icon_section_intro = get_field('icon_section_intro');
			$icon_number_of_columns = get_field('icon_number_of_columns');
	?>
	    <section id="suite" class="tw-bg-white tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96">
			<?php if ($icon_section_title) : ?>
				<div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-12"><?php echo $icon_section_title; ?></div>
			<?php endif; ?>
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-y-12 md:tw-gap-y-0 md:tw-gap-x-8">
				<?php while( have_rows('icon_columns') ) : the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$description = get_sub_field('description');
				?>
					<div class="tw-flex-col">
						<?php if ($title) : ?>
							<div class="tw-mb-6 tw-text-center tw-text-xl md:tw-text-2xl tw-font-bold"><?php echo $title; ?></div>
						<?php endif; ?>
						<?php if ($image) : ?>
							<div class="tw-flex tw-items-center tw-justify-center tw-mb-6">
								<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy" class="tw-rounded-full tw-h-24 tw-w-24">
							</div>
						<?php endif; ?>
						<?php if ($description) : ?>
							<div><?php echo $description; ?></div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
	get_footer();
?>
</html>
<?php
