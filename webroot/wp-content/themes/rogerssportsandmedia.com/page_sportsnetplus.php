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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/sportsnet.css">
    <style>
        .wrapper {
            width: auto !important;
            max-width: none !important;
            margin: initial;
        }
        footer .wrapper {
            width: calc(100% - 10vw) !important;
            max-width: 1110px !important;
            margin: 0 auto !important;
        }
    </style>
</head>
<?php
	get_header();
?>
<main>
    <div class="tw-w-full">
        <img class="tw-hidden md:tw-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/snplus_hero_dt.jpg" />
        <img class="md:tw-hidden" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/snplus_hero_mb.jpg" />
    </div>
    <div class="md:tw-px-96">
        <div class="tw-relative tw-bg-white tw-px-8 md:tw-px-16 tw-py-12 -tw-mt-10 tw-mb-16">
            <div class="tw-text-4xl tw-font-bold tw-mb-8">Home of the most exciting live sports content in the country</div>
            <p class="tw-text-base tw-leading-7">We're changing the game with premium, live streaming sports content that drives impact.</p>
            <p class="tw-text-base tw-leading-7">
                Our partnerships with the most popular professional sports leagues enables us to connect
            </p>
            <p class="tw-text-base tw-leading-7">
                marketers to engaged and passionate sport fans in the most premier sporting events 365 days a year.
            </p>
            <p class="tw-text-base tw-leading-7">
                Partner with Rogers Sports & Media to drive advertising impact for your brand on the largest steaming network in Canada.
            </p>
        </div>
        <div class="tw-px-8 md:tw-px-0 tw-mb-16">
            <video controls>
                <source src="https://www.rogerssportsandmedia.com/wp-content/uploads/2024/02/Sportsnet-Brand-Sizzle.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video> 
        </div>
        <div class="tw-px-4 md:tw-px-0 tw-w-5/6 tw-border-t tw-border-gray-dark tw-py-6 tw-mb-16">
            <div class="tw-text-4xl tw-font-bold tw-mb-8">Reach your favourite fan with Sportsnet+ Advertising</div>
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-3 tw-px-6 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Download Our Buyers Guide
            </a>
        </div>
    </div>
    <div class="tw-w-full" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/red_bg.jpg'); background-size: cover; background-position: center;">
        <div class="tw-px-12 md:tw-px-72 tw-py-12 md:tw-py-24">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16">
                <div class="tw-full md:tw-w-1/4">
                    <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">2.5M</div>
                    <div>Canadians streamed a live event on Sportsnet+</div>
                </div>
                <div class="tw-full md:tw-w-1/4">
                    <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">70%</div>
                    <div>of Sportsnet+ audiences are exclusive streamers</div>
                </div>
                <div class="tw-full md:tw-w-1/4">
                    <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">1B</div>
                    <div>dynamically inserted ads delivered in 2023</div>
                </div>
                <div class="tw-full md:tw-w-1/4">
                    <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px white;">#1</div>
                    <div>sports streaming platform in Canada</div>
                </div>
            </div>
        </div>
    </div>
    <div class="tw-w-full tw-py-0 md:tw-py-12" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/snplus_signup_bg.jpg'); background-size: cover; background-position: center;">
        <div class="md:tw-px-96 tw-relative">
            <div class="tw-bg-white tw-flex tw-flex-col md:tw-flex-row tw-px-8 md:tw-space-x-12">
                <div class="tw-full md:tw-w-2/5 tw-mt-12 tw-px-2 md:tw-px-8">
                    <div class="tw-text-4xl tw-font-bold tw-mb-8">Partner With Us Today</div>
                    <p class="tw-font-semibold">Your success is our success. We are partners you can count on, today and in the future. Let's get started!</p>
                </div>
                <div class="tw-full md:tw-w-3/5">
                    <iframe src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/r2bks1awm2k" width="100%" height="950" allowfullscreen sandbox="allow-same-origin allow-scripts allow-popups allow-forms" title="Partner with us today by filling out the form below">
                        <p>Sorry, your browser does not support iframes.</p>
                    </iframe>
                </div>
            </div>
            <div class="tw-hidden md:tw-absolute tw-top-0 tw-right-0 tw-mt-4 tw-mr-16">
                <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-3 tw-px-6 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                    Advertise With Us
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
?>
</html>
<?php
