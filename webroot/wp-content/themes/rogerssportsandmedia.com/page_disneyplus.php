<?php
/**
 * Template Name: Disney Plus
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
</head>
<?php
	get_header();
?>

<main id="content" role="main" class="tw-bg-gray">

	<!-- HERO -->
	<?php
        if (is_category()) : 
            $term = get_queried_object();
            $hero_image = get_field('hero_image', $term);
            $hero_mobile_image = get_field('hero_mobile_image', $term);
        else :
            $hero_image = get_field('hero_image');
            $hero_mobile_image = get_field('hero_mobile_image');
        endif; 
	?>
    <section class="tw-w-full">
        <img class="tw-hidden md:tw-block" src="<?php echo $hero_image['url']; ?>" />
        <img class="md:tw-hidden" src="<?php echo $hero_mobile_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" />
    </section>

	<!-- INTRO -->
    <?php
        get_template_part('template-parts/section-intro');
    ?>

    <section class="tw-mt-12">&nbsp;</section>

	<!--- SHOWS SECTION -->
	<?php if( have_rows('shows') ) : ?>
	<?php
		$shows_section_title = get_field('shows_section_title');
		$show_section_content = get_field('shows_content_copy');
        $shows_section_button = get_field('shows_section_button');
	?>
        <section class="tw-bg-white tw-px-8 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80 tw-py-12">
            <div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4"><?php echo $shows_section_title; ?></div>
            <div class="tw-mb-6">
                <?php echo $show_section_content; ?>
            </div>
            <?php if ($shows_section_button) : ?>
                <div class="tw-mb-8">
                    <a href="<?php echo $shows_section_button['url']; ?>" class="button" aria-label="<?php echo $shows_section_button['title'] ? $shows_section_button['title'] : 'Download Schedule'; ?>" target="<?php echo $shows_section_button['target'] ? $shows_section_button['target'] : '_self'; ?>"><?php echo $shows_section_button['title'] ? $shows_section_button['title'] : 'Download Schedule'; ?></a>
                </div>
            <?php endif; ?>
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
        </section>
	<?php endif; ?>

	<!-- COUNTERS -->
    <?php if( have_rows('highlights') ) : ?>
        <section id="highlights" class="tw-w-full" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
            <div class="tw-px-12 md:tw-py-24 lg:tw-px-24 xl:tw-px-40 2xl:tw-px-60 tw-py-12">
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16">
                    <?php while( have_rows('highlights') ) : the_row();
                        $number = get_sub_field('number');
                        $number_text = get_sub_field('number_text');
                        $text = get_sub_field('text');
                        $circle_color = get_sub_field('circle_color');
                    ?>
                        <div class="tw-full md:tw-w-1/4">
                        <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
                            <span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
                        </div>
                            <div><?php echo $text; ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
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
<?php
