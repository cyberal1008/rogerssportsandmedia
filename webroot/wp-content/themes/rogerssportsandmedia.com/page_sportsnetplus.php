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
		get_template_part('template-parts/section-hero');
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
            <div class="tw-text-4xl tw-text-black tw-font-bold tw-mb-8">
                <?php echo $buyers_guide_section_title; ?>
            </div>
            <?php if ($buyers_guide_button) : ?>
                <div><a href="<?php echo $buyers_guide_button['url']; ?>" class="button" aria-label="<?php echo $buyers_guide_button['title'] ? $buyers_guide_button['title'] : 'Download Buyers Guide'; ?>" target="<?php echo $buyers_guide_button['target'] ? $buyers_guide_button['target'] : '_self'; ?>"><?php echo $buyers_guide_button['title'] ? $buyers_guide_button['title'] : 'Download Buyers Guide'; ?></a></div>
            <?php endif; ?>
        </div>
	</div>
    

    <!-- HIGHLIGHTS -->
	<?php get_template_part('template-parts/section-highlights'); ?>

	<!-- PARTNER -->
	<?php get_template_part('template-parts/section-partner'); ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<?php
get_footer();
?>
</html>
