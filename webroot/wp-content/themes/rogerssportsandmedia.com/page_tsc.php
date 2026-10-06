<?php
/**
 * Template Name: Today's Shopping Choice
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
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

	<?php
		get_template_part(
			'template-parts/section-intro'
		);
	?>

    <section class="tw-w-full tw-bg-black tw-py-12 tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-w-full tw-text-white md:tw-gap-x-8 tw-gap-y-12">
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-red tw-mb-2">35+</div>
                <div class="tw-text-xl">TSC was born in 1987</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-red tw-mb-2">10M</div>
                <div class="tw-text-xl">Distributed nationally in 10M households</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-red tw-mb-2">630K</div>
                <div class="tw-text-xl">Weekly viewers</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-red tw-mb-2">4.2M</div>
                <div class="tw-text-xl">Web visits per month & Over 70% of sales online</div>
            </div>
            <div>
                <div class="tw-text-7xl tw-font-bold tw-text-red tw-mb-2">10K</div>
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
        <h2 class="title2 tw-text-black">Your one-stop-shop for top brands & products</h2>
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
