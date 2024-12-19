<?php
/**
 * Template Name: Sportsnet Plus
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
		$featured_video = get_field('featured_video');
        $buyers_guide_section_title = get_field('buyers_guide_section_title');
        $buyers_guide_button = get_field('buyers_guide_button');
	?>
	<div class="tw-bg-gray tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80">
        <?php if ($featured_video) : ?>
            <video controls>
                <source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php endif; ?>

        <div class="tw-mt-12 tw-w-5/6 tw-mb-16">
            <hr />
            <div class="tw-text-4xl tw-text-gray-dark tw-font-bold tw-mb-8">
                <?php echo $buyers_guide_section_title; ?>
            </div>
            <?php if ($buyers_guide_button) : ?>
                <div><a href="<?php echo $buyers_guide_button['url']; ?>" class="button" aria-label="<?php echo $buyers_guide_button['title'] ? $buyers_guide_button['title'] : 'Download Buyers Guide'; ?>" target="<?php echo $buyers_guide_button['target'] ? $buyers_guide_button['target'] : '_self'; ?>"><?php echo $buyers_guide_button['title'] ? $buyers_guide_button['title'] : 'Download Buyers Guide'; ?></a></div>
            <?php endif; ?>
        </div>
	</div>
    

    <!-- COUNTERS -->
	<?php if( have_rows('highlights') ) : ?>
		<section id="highlights" class="tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-48 2xl:tw-px-80 md:tw-py-24" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-text-white tw-gap-y-10 md:tw-gap-x-16">
				<?php while( have_rows('highlights') ) : the_row();
					$number = get_sub_field('number');
					$number_text = get_sub_field('number_text');
					$number_text_position = get_sub_field('number_text_position');
					$text = get_sub_field('text');
				?>
					<div class="tw-full">
						<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
							<?php if ($number_text_position == 'left') : ?>
								<?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?><?php if ($number) : ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php endif; ?>
							<?php else: ?>
								<?php if ($number) : ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php endif; ?><?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
							<?php endif; ?>
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
