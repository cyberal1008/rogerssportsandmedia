<?php
/**
 * Template Name: Today's Shopping Choice
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
	<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin.css"> -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php get_header(); ?>

<main id="content" role="main" class="tw-bg-gray">

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

	<?php
		get_template_part(
			'template-parts/section-intro'
		);
	?>
    <div class="tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80">
        <div class="tw-flex tw-justify-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_logo.png" />
        </div>
    </div>
    <section class="tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-60 md:tw-py-10" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-24">
            <div class="tw-full md:tw-px-2 md:tw-w-1/2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_app.png" />
            </div>
            <div class="tw-full md:tw-w-1/2">
                <hr class="tw-mt-12 tw-w-1/2 tw-mb-6">
                <div class="tw-text-4xl md:tw-text-5xl tw-font-bold tw-mb-8">Canada's Most Multi-Channel Retailer</div>
                <div class="tw-text-lg">As a 30-year-old, trusted Canadian retailer, TSC is an e-commerce first business, with 3.5 million TSC.ca visitors per month, over 65% of sales online, and a mobile shopping app to make shopping both easy and fun. 
                <br /><br />TSC is Canada’s only televised retailer, distributed nationally in 10M households across the country, with 800,000 viewers every week.</div>
            </div>
        </div>
    </section>
    <section class="tw-w-full tw-bg-red tw-px-4 tw-py-12 md:tw-py-24 md:tw-px-10 lg:tw-px-24 xl:tw-px-40 2xl:tw-px-80">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-24">
            <div class="tw-full md:tw-w-1/2">
                <div class="md:tw-text-right tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">10M</div>
                <div class="md:tw-text-right tw-text-xl">Distributed nationally in 10M households</div>
            </div>
            <div class="tw-full md:tw-w-1/2">
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">800K</div>
                <div class="tw-text-xl">Viewers every week</div>
            </div>
        </div>
    </section>
    <section class="tw-bg-white tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80">
        <div class="tw-mb-10 tw-grid tw-grid-cols-1 md:tw-grid-cols-3">
            <div class="tw-flex tw-justify-center md:tw-justify-normal">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_1.png" alt="Circular Image" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
            <div class="tw-hidden md:tw-block">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_1.png" alt="Circular Image" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
            <div class="tw-hidden md:tw-block">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_1.png" alt="Circular Image" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
        </div>
        <div class="tw-text-3xl tw-font-bold tw-mb-2">Your one-stop-shop for top brands & exclusive finds</div>
        <div class="tw-mb-12 tw-text-lg">TSC is home to hundreds of amazing brands. From family-favourites like Dyson, Kitchenaid, Samsung and Clarks, to exclusive brands like Elizabeth Grant, Brian Bailey & Heidi Daus. With thousands of incredble products, there’s always something to discover at TSC!</div>
        <div>
            <img class="tw-hidden md:tw-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_logos_dt.jpg" />
            <img class="md:tw-hidden" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_logos_mb.jpg" />
        </div>
    </section>

    <!-- WHAT'S HAPPENING -->
    <section class="tw-bg-white">
	<?php
		get_template_part(
			'template-parts/section-whats-happening'
		);
	?>
    </section>
</main>

<?php
    get_footer();
?>
</html>
<?php
