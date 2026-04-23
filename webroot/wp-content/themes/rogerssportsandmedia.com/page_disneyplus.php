<?php
/**
 * Template Name: Disney Plus
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

 get_header();
?>

<main id="content" role="main" class="tw-bg-gray">

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
        get_template_part('template-parts/section-featured-video');
    ?>

	<!--- SHOWS SECTION -->
	<?php if( have_rows('shows') ) : ?>
	<?php
		$shows_section_title = get_field('shows_section_title');
		$show_section_content = get_field('shows_content_copy');
        $shows_section_button = get_field('shows_section_button');
	?>
        <section class="tw-bg-black tw-text-white tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80 tw-py-12">
            <div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4"><?php echo $shows_section_title; ?></div>
            <div class="tw-mb-6">
                <?php echo $show_section_content; ?>
            </div>
            <?php if ($shows_section_button) : ?>
                <div class="tw-mb-8">
                    <a href="<?php echo $shows_section_button['url']; ?>" class="button" aria-label="<?php echo $shows_section_button['title'] ? $shows_section_button['title'] : 'Download Schedule'; ?>" target="<?php echo $shows_section_button['target'] ? $shows_section_button['target'] : '_self'; ?>"><?php echo $shows_section_button['title'] ? $shows_section_button['title'] : 'Download Schedule'; ?></a>
                </div>
            <?php endif; ?>
            <div class="programming slider">
                <div class="swiper prog-slider">
                    <div class="swiper-wrapper">
                        <?php while( have_rows('shows') ) : the_row(); 
                            $show_title = get_sub_field('show_title');
                            $show_image = get_sub_field('show_image');
                        ?>
                            <div class="swiper-slide">
                                <img class="tw-mb-1" src="<?php echo esc_attr($show_image['url']); ?>" alt="<?php echo esc_attr($show_image['alt']); ?>" loading="lazy">
                                <div class="tw-text-center tw-text-base md:tw-text-lg"><?php echo esc_html($show_title); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="navi">
                    <div class="swiper-button-prev prog-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
                    <div class="swiper-button-next prog-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
                </div>
            </div>
        </section>
	<?php endif; ?>

	<!-- COUNTERS -->
    <?php if( have_rows('highlights') ) : ?>
        <section id="highlights" class="tw-w-full tw-bg-red">
            <div class="tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80 tw-py-12">
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16">
                    <?php while( have_rows('highlights') ) : the_row();
                        $number = get_sub_field('number');
                        $number_text = get_sub_field('number_text');
                        $text = get_sub_field('text');
                        $circle_color = get_sub_field('circle_color');
                    ?>
                        <div class="tw-full md:tw-w-1/<?php echo count(get_field('highlights')); ?> tw-text-center">
                            <div class="tw-text-7xl tw-font-bold tw-text-white tw-mb-1">
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
