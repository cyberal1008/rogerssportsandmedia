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
<html lang="en" class="audio-landing">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php
	get_header();
	global $post;
	$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

<div class="portfolio-main">
    <main id="content" role="main">
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

        <!-- INTRO -->
        <?php
            $brands_logos = get_field('brands_logos');
        ?>
        <section class="our-difference alt nomargin">
            <div class="wrapper">
                <?php if ($brands_logos) : ?>
                    <div class="swiper logo-slider-mobile">
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

        <!-- PODCASTS & TITLES -->
        <?php if( have_rows('podcasts') ) :
            $section_title = get_field('podcasts_section_title');
        ?>
        <section class="tw-bg-white tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80 tw-py-12">
                <div class="tw-mb-16">
                    <h2 class="title2 tw-text-black"><?php echo $section_title ?></h2>
                    <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-4 tw-gap-x-4 tw-gap-y-6">
                        <?php while( have_rows('podcasts') ) : the_row(); 
                            $image = get_sub_field('show_image');
                        ?>
                            <img class="tw-w-52" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( have_rows('titles') ) : 
                $section_title = get_field('titles_section_title');
            ?>
                <div>
                    <div class="tw-text-2xl md:tw-text-3xl tw-text-black tw-font-bold tw-mb-6"><?php echo $section_title ?></div>
                    <div class="tw-grid tw-grid-cols-3 md:tw-grid-cols-6 tw-gap-x-4 tw-gap-y-6">
                        <?php while( have_rows('titles') ) : the_row();
                            $title = get_sub_field('show_title');
                            $image = get_sub_field('show_image');
                            $link = get_sub_field('show_link');
                        ?>
                            <div class="tw-flex tw-flex-col tw-space-y-4 tw-items-center">
                                <?php if ($link) : ?>
                                    <a href="<?php echo $link; ?>">
                                <?php endif; ?>
                                    <img class="tw-w-36" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                                <?php if ($link) : ?>
                                    </a>
                                <?php endif; ?>
                                    <div class="tw-text-center tw-font-semibold"><?php echo $title ?></div>
                                </div>
                        <?php endwhile; ?>
                    </div>
                </div>
        </section>
        <?php endif; ?>

        <!-- HIGHLIGHTS -->
        <?php if( have_rows('highlights') ) : ?>
            <section id="highlights" class="tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 md:tw-py-28" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bkg.jpg'); background-size: cover; background-position: center;">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-text-white tw-gap-y-10 md:tw-gap-x-16">
                    <?php while( have_rows('highlights') ) : the_row(); 
                        $number = get_sub_field('number');
                        $number_text = get_sub_field('number_text');
                        $number_text_position = get_sub_field('number_text_position');
                        $text = get_sub_field('text');
                    ?>
                        <div class="tw-full">
                            <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">
                                <?php if ($number_text_position == 'prepend'): ?>
                                    <?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
                                <?php elseif ($number_text_position == 'superscript'): ?>
                                    <span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><sup><?php echo $number_text; ?></span></sup><?php endif; ?>
                                <?php else: ?>
                                    <span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
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

        <!-- CAPABILITIES -->
        <?php if( have_rows('capabilities') ) : 
            $section_title = get_field('capabilities_section_title');
        ?>
            <section class="tw-bg-white tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80 tw-py-12">
                <h2 class="title2 tw-text-black"><?php echo $section_title ?></h2>
                <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-4 tw-gap-12">
                    <?php while( have_rows('capabilities') ) : the_row();
                        $subtitle = get_sub_field('subtitle');
                        $image = get_sub_field('image');
                    ?>
                        <div class="tw-flex tw-flex-col tw-space-y-4 tw-items-center tw-px-2">
                            <img class="tw-w-48" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                            <div class="tw-text-xl tw-text-center tw-font-bold"><?php echo $subtitle ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
            $prog_section_title = get_field('program_section_title');
            $prog_section_button = get_field('program_section_button');
        ?>
        <section id="stations-podcasts" class="stations-podcasts">
            <div class="wrapper">
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-6 md:tw-mb-4 md:tw-space-x-12">
                    <?php if ($prog_section_title) : ?>
                        <h2 class="title2 tw-text-black tw-font-bold tw-mb-3 md:tw-mb-0"><?php echo $prog_section_title; ?></h2>
                    <?php endif; ?>
                    <?php if ($prog_section_button) : ?>
                        <div><a href="<?php echo $prog_section_button['url']; ?>" class="button" aria-label="<?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download Buyers Guide'; ?>" target="<?php echo $prog_section_button['target'] ? $prog_section_button['target'] : '_self'; ?>"><?php echo $prog_section_button['title'] ? $prog_section_button['title'] : 'Download Buyers Guide'; ?></a></div>
                    <?php endif; ?>
                </div>
                <div class="portfolio-page">
                        <?php
                            $original_post = $post;
                            $page_id = get_the_ID();
                            get_template_part(
                                'template-parts/portfolio',
                                'radio',
                                array(
                                    'page_id' => $page_id
                                )
                            );
                            $post = $original_post;
                        ?>
                </div>
            </div>
        </section>

        <!-- PARTNER -->
        <?php get_template_part('template-parts/section-partner'); ?>
    </main>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.js"></script>
</div>
<?php
get_footer();
