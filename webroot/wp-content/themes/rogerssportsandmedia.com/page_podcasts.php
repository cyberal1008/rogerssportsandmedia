<?php
/**
 * Template Name: Podcasts
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
				'title'     => isset($hero_title) ? $hero_title : get_the_title(),
			)
		);
	?>
	
	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

	<!-- HIGHLIGHTS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 md:tw-py-28" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-text-white tw-gap-y-10 md:tw-gap-x-16">
				<?php while( have_rows('highlights') ) : the_row(); 
					$number = get_sub_field('number');
					$number_text = get_sub_field('number_text');
					$text = get_sub_field('text');
					$circle_color = get_sub_field('circle_color');
				?>
					<div class="tw-full">
						<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
							<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><sup><?php echo $number_text; ?></span></sup><?php endif; ?>
						</div>
						<?php if ($text) : ?>
							<div class="tw-text-lg"><?php echo $text; ?></div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
    	</section>
	<?php endif; ?>


	<!-- WHAT'S HAPPENING -->
	<?php
		get_template_part(
			'template-parts/section-whats-happening', null,
            array(
                'zone' => 'whats-happening-radio',
            )
		);
	?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
<?php
