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
        <div class="tw-flex tw-justify-center tw-py-12">
            <img class="tw-w-80" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_tagline_logo.png" />
        </div>
    </div>
    <section class="tw-px-4 tw-py-12 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-60 md:tw-py-10" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_01.jpg'); background-size: cover; background-position: center;">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-24">
            <div class="tw-full md:tw-px-2 md:tw-w-1/2">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_circle_img.png" />
            </div>
            <div class="tw-full md:tw-w-1/2">
                <hr class="tw-mt-12 tw-w-1/2 tw-mb-6">
                <div class="tw-text-4xl md:tw-text-5xl tw-font-bold tw-mb-8">Canada's Most Multi-Channel Retailer</div>
                <div class="tw-text-lg tw-mb-10">As a 35-year-old trusted Canadian retailer, TSC is an e-commerce first business, with over 4 million visitors to TSC.ca per month, over 70% of sales completed online, and a mobile shopping app that makes shopping and saving fun and easy.
                <br /><br />TSC is Canada’s only televised retailer, distributed nationally in 10 million households across the country, with over 600,000 viewers per week.</div>
                <div class="tw-mb-10 tw-grid tw-grid-cols-1 md:tw-grid-cols-4">
                    <div class="tw-flex tw-justify-center md:tw-justify-normal">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_facebook.png" alt="TSC Facebook" class="tw-rounded-full tw-h-24">
                    </div>
                    <div class="tw-hidden md:tw-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_instagram.png" alt="TSC Instagram" class="tw-rounded-full tw-h-24">
                    </div>
                    <div class="tw-hidden md:tw-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_youtube.png" alt="TSC Youtube" class="tw-rounded-full tw-h-24">
                    </div>
                    <div class="tw-hidden md:tw-block">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_pinterest.png" alt="TSC Pinterest" class="tw-rounded-full tw-h-24">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tw-w-full tw-bg-red tw-px-4 tw-py-12 md:tw-py-24 md:tw-px-10 lg:tw-px-24">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-5 tw-w-full tw-text-white md:tw-gap-x-8 tw-gap-y-12 md:tw-gap-y-0">
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">35+</div>
                <div class="tw-text-xl">TSC was born in 1987</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">10M</div>
                <div class="tw-text-xl">Distributed nationally in 10M households</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">630K</div>
                <div class="tw-text-xl">Weekly viewers</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">4.2M</div>
                <div class="tw-text-xl">Web visits per month & Over 70% of sales online</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-2" style="-webkit-text-stroke: 2px white;">10K</div>
                <div class="tw-text-xl">Orders shipped everyday</div>
            </div>
        </div>
    </section>
    <section class="tw-bg-white tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80">
        <div class="tw-mb-10 tw-grid tw-grid-cols-1 md:tw-grid-cols-4">
            <div class="tw-flex tw-justify-center md:tw-justify-normal">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_1.png" alt="TSC Image 1" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
            <div class="tw-hidden md:tw-block">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_2.png" alt="TSC Image 2" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
            <div class="tw-hidden md:tw-block">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_4.png" alt="TSC Image 3" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
            <div class="tw-hidden md:tw-block">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_3.png" alt="TSC Image 4" class="tw-rounded-full tw-h-52 tw-w-52">
            </div>
        </div>
        <div class="tw-text-3xl tw-font-bold tw-mb-2">Your one-stop-shop for top brands & products</div>
        <div class="tw-mb-12 tw-text-lg">TSC is home to hundreds of amazing brands and products. From favourites like Apple, Dyson, KitchenAid, L’Occitane and Clarks, to exclusive brands like Elizabeth Grant, Brian Bailey & Evera Diamonds. With thousands of incredible products there’s always something new to discover at TSC.</div>
        <div>
            <img class="md:tw-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tsc_logos_dt.jpg" />
        </div>
    </section>
</main>

<?php
    get_footer();
?>
</html>
<?php
