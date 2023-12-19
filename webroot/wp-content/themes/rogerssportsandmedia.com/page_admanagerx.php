<?php
/**
 * Template Name: Ad Manager X
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
    <title>Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/main.min.css">
	<?php google_tracking_code(); ?>
	<?php facebook_pixel_code(); ?>
</head>

<body>
    <?php get_template_part('template-parts/ad-manager-header'); ?>
    <section class="tw-py-10">
        <div class="tw-mb-10 tw-text-center tw-text-4xl tw-font-semibold">
            Grow Your Business with Rogers Sports & Media
        </div>
        <div class="tw-flex tw-flex-col md:tw-flex-row-reverse md:tw-px-32 2xl:tw-px-48 tw-mb-8 md:tw-mb-16">
            <div class="tw-w-full md:tw-w-3/5 tw-flex tw-px-4 md:tw-px-0 tw-mb-4 md:tw-mb-0">
                <video controls>
                    <source src="https://www.rogerssportsandmedia.com/wp-content/uploads/2022/08/RSM_Explainer_AUG-18_BP_1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video> 
            </div>
            <div class="tw-w-full md:tw-w-2/5 tw-flex tw-flex-col tw-px-4 md:tw-px-16">
                <p class="tw-mb-6">With our self-serve ad buying platform, businesses of all sizes can:</p>
                <div class="tw-space-y-8 md:tw-space-y-12 tw-px-4 md:tw-px-0">
                    <div class="tw-flex tw-flex-row tw-space-x-8 tw-items-center tw-font-semibold">
                        <div class="tw-w-1/5">
                            <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/book_adslots.png" />
                        </div>
                        <div class="tw-w-4/5">Book streaming, podcast, radio or display advertising</div>
                    </div>
                    <div class="tw-flex tw-flex-row tw-space-x-8 tw-items-center tw-font-semibold">
                        <div class="tw-w-1/5">
                            <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad_creative_triangles.png" />
                        </div>
                        <div class="tw-w-4/5">
                            Produce ad creative
                        </div>
                    </div>
                    <div class="tw-flex tw-flex-row tw-space-x-8 tw-items-center tw-font-semibold">
                        <div class="tw-w-1/5">
                            <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/performance_graph.png" />
                        </div>
                        <div class="tw-w-4/5">
                            Monitor campaign performance in real time
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-flex-col md:tw-items-center tw-px-4">
            <p class="tw-text-lg tw-mb-4">Your advertising will run on brands such as:</p>
            <div class="tw-grid tw-grid-cols-6 tw-gap-4 md:tw-gap-10 md:tw-flex md:tw-flex-row tw-mb-8">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Breakfast-Television.png" alt="Breakfast Television logo" loading="lazy">
                <img class="tw-h-8 tw-grayscale" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Frequency-Podcast.png" alt="Frequency Podcast Network logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/logo-citynews.png" alt="CityNews logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Citytv.png" alt="CityTV logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/SN.png" alt="Sportsnet logo" loading="lazy">
                <img class="tw-h-12 -tw-mt-2" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/98.1-CHFI.png" alt="98.1 CHFI logo" loading="lazy">
                <img class="tw-h-10 -tw-mt-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Kiss-Radio.png" alt="KiSS radio logo" loading="lazy">
                <img class="tw-h-10 -tw-mt-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Jack-Radio.png" alt="Jack radio logo" loading="lazy">
                <img class="tw-h-10 -tw-mt-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/NHL.png" alt="NHL logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/MLB.png" alt="MLB logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Tubi.png" alt="Tubi logo" loading="lazy">
                <img class="tw-h-8" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/FX.png" alt="FX logo" loading="lazy">
            </div>
            <div class="tw-flex tw-justify-center">
                <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-black tw-border-yellow tw-bg-yellow tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-black hover:tw-bg-yellow-dark">
                    Get Started today
                </a>
            </div>
        </div>
    </section>
    <section class="tw-py-12 md:tw-py-20 tw-px-4 md:tw-px-48 tw-bg-gray">
        <div class="tw-flex tw-flex-col md:tw-flex-row-reverse tw-items-center md:tw-justify-center tw-mb-6 md:tw-space-x-8">
            <div>
                <img class="tw-w-32 md:tw-w-40 tw--mt-20 md:tw--mt-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-circle.png" />
            </div>
            <div class="tw-text-4xl tw-text-center tw-font-semibold">Drive Impact, Make an Impression</div>
        </div>
        <div class="tw-flex tw-flex-col tw-mb-10 tw-items-center">
            <div class="tw-w-full md:tw-w-3/5 tw-text-center">
                <p>Run your advertising in specific geographical locations, or reach across Canada.</p>
                <p>
                    Our ad solutions are designed to build brand awareness, drive traffic to your site and boost in-store visits.
                </p>
            </div>
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
    <section class="tw-py-12 md:tw-py-20 tw-px-4 md:tw-px-32 2xl:tw-px-48">
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-8 md:tw-space-x-4 md:tw-px-48">
            <div class="tw-w-full md:tw-w-1/5 tw-flex tw-flex-row tw-justify-center">
                <img class="tw-w-32 md:tw-w-40 tw--mt-20 md:tw--mt-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-square.svg" />
            </div>
            <div class="tw-w-full md:tw-w-4/5 tw-text-3xl md:tw-text-4xl tw-text-center tw-font-semibold">RSM Ad Manager is Your Starting Point for Our Ad Solutions</div>
        </div>
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-10 tw-items-stretch tw-space-y-8 md:tw-space-y-0 md:tw-space-x-10">
            <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8">
                <div class="tw-h-2/3">
                    <p class="tw-font-semibold tw-text-lg tw-mb-2">Display Advertising</p>
                    <p>Deliver impactful brand messaging across our network of sites.</p>
                    <a href="/ad-solutions/#display-advertising" class="tw-mb-16 tw-text-red tw-text-sm tw-underline hover:tw-text-red-dark">
                        Learn More
                    </a>
                </div>
                <div class="tw-h-1/3 tw-flex tw-justify-center">
                    <img class="tw-h-32 md:tw-h-full" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/starting-point-1.png" />
                </div>
            </div>
            <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8">
                <div class="tw-h-2/3">
                    <p class="tw-font-semibold tw-text-lg tw-mb-2">Podcast Advertising</p>
                    <p>Reach our engaged audiences as they listen to premium podcast and streaming radio content.</p>
                    <a href="/ad-solutions/#podcast-advertising" class="tw-mb-16 tw-text-red tw-text-sm tw-underline hover:tw-text-red-dark">
                        Learn More
                    </a>
                </div>
                <div class="tw-h-1/3 tw-flex tw-justify-center">
                    <img class="tw-h-32 md:tw-h-full" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/starting-point-2.png" />
                </div>
            </div>
            <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8">
                <div class="tw-h-2/3">
                    <p class="tw-font-semibold tw-text-lg tw-mb-2">Radio Advertising</p>
                    <p>Drive top-of-mind awareness for your business in the markets that matter to you.</p>
                    <a href="/ad-solutions/#radio-advertising" class="tw-mb-16 tw-text-red tw-text-sm tw-underline hover:tw-text-red-dark">
                        Learn More
                    </a>
                </div>
                <div class="tw-h-1/3 tw-flex tw-justify-center">
                    <img class="tw-h-32 md:tw-h-full" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/starting-point-3.png" />
                </div>
            </div>
            <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8">
                <div class="tw-h-2/3">
                    <p class="tw-font-semibold tw-text-lg tw-mb-2">Streaming Video Advertising</p>
                    <p>Reach audiences engaged in the best streaming and video content in Canada.</p>
                    <a href="/ad-solutions/#streaming-video-advertising" class="tw-mb-16 tw-text-red tw-text-sm tw-underline hover:tw-text-red-dark">
                        Learn More
                    </a>
                </div>
                <div class="tw-h-1/3 tw-flex tw-justify-center">
                    <img class="tw-h-32 md:tw-h-full" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/starting-point-4.png" />
                </div>
            </div>
        </div>
    </section>
    <section class="tw-py-12 md:tw-py-10 tw-px-4 md:tw-px-48 tw-bg-gray">
        <div class="tw-flex tw-flex-col tw-items-center tw-text-center tw-mb-3 tw-space-x-4">
            <span class="tw-text-4xl tw-font-semibold">Take Full Control of How You Advertise Your Business</span>
        </div>
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-4">
            <div class="tw-w-full md:tw-w-3/5">
                <img id="take-control-image" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/take_control-1.png" alt="Take control app screenshot" />
            </div>
            <div class="tw-w-full md:tw-w-2/5 tw-flex tw-flex-col tw-space-y-12 tw-px-12 tw-pt-0 md:tw-pt-16">
                <div id="take-control-content-1" class="take-control-content tw-flex tw-flex-row tw-items-end tw-space-x-8 tw-cursor-pointer">
                    <span class="take-control-content-number tw-text-5xl tw-font-semibold tw-text-gray-400">1</span>
                    <span class="take-control-content-text tw-text-gray-400">Select where your ads will run</span>
                </div>
                <div id="take-control-content-2" class="take-control-content tw-flex tw-flex-row tw-items-end tw-space-x-8 tw-cursor-pointer">
                    <span class="take-control-content-number tw-text-5xl tw-font-semibold tw-text-gray-400">2</span>
                    <span class="take-control-content-text tw-text-gray-400">Set your schedule and budget</span>
                </div>
                <div id="take-control-content-3" class="take-control-content tw-flex tw-flex-row tw-items-end tw-space-x-8 tw-cursor-pointer">
                    <span class="take-control-content-number tw-text-5xl tw-font-semibold tw-text-gray-400">3</span>
                    <span class="take-control-content-text tw-text-gray-400">Produce or upload your ad creative</span>
                </div>
                <div id="take-control-content-4" class="take-control-content tw-flex tw-flex-row tw-items-end tw-space-x-8 tw-cursor-pointer">
                    <span class="take-control-content-number tw-text-5xl tw-font-semibold tw-text-gray-400">4</span>
                    <span class="take-control-content-text tw-text-gray-400">Pay for, launch and monitor your campaign</span>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
    <section class="tw-py-12 md:tw-py-20 tw-px-4 md:tw-px-32 2xl:tw-px-48">
        <div class="tw-flex tw-flex-col md:tw-flex-row-reverse tw-items-center md:tw-justify-center tw-mb-6 md:tw-space-x-8">
            <div>
                <img class="tw-w-32 md:tw-w-40 tw--mt-20 md:tw--mt-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-triange.png" />
            </div>
            <div class="tw-text-4xl tw-text-center tw-font-semibold">The Rogers Sports & Media Difference</div>
        </div>
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-space-y-4 md:tw-space-y-0 md:tw-space-x-16">
            <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                <div class="tw-mb-3">
                    <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/candian-flag-red-white.png" />
                </div>
                <div class="tw-px-16"><p>Reach real Canadians.</p> We connect your business with the audiences you want.</div>
            </div>
            <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                <div class="tw-mb-3">
                    <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/rsm-difference-lock.png" />
                </div>
                <div class="tw-px-16">Align your advertising with premium content that is always brand safe.</div>
            </div>
            <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                <div class="tw-mb-3">
                    <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/rsm-difference-scale.png" />
                </div>
                <div class="tw-px-16">Take advantage of scale that enables you to drive awareness and impact your local market.</div>
            </div>
        </div>
    </section>
    <?php get_template_part('template-parts/ad-manager-footer-text'); ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function deactivateTakeControlElements() {
            const takeControlDivs = document.querySelectorAll('.take-control-content');
            takeControlDivs.forEach(el => {
                const contentNumberElement = el.querySelector('.take-control-content-number');
                const contentTextElement = el.querySelector('.take-control-content-text');
                contentNumberElement.classList.remove('tw-text-red');
                contentNumberElement.classList.add('tw-text-gray-400');
                contentTextElement.classList.add('tw-text-gray-400');
            });
        }

        function activateTakeControlElement(el) {
            deactivateTakeControlElements();
            const contentNumberElement = el.querySelector('.take-control-content-number');
            const contentTextElement = el.querySelector('.take-control-content-text');
            contentNumberElement.classList.remove('tw-text-gray-400');
            contentNumberElement.classList.add('tw-text-red');
            contentTextElement.classList.remove('tw-text-gray-400');

            // Update Image
            const elementId = el.id;
            const elementNumber = elementId.split('take-control-content-')[1].trim();
            const imageElement = document.getElementById('take-control-image');
            imageElement.src = `<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/take_control-${elementNumber}.png`;
        }

        // Activate first element
        const takeControlFirstElement = document.getElementById("take-control-content-1");
        activateTakeControlElement(takeControlFirstElement);

        // Add event listener to other elements
        const takeControlDivs = document.querySelectorAll('.take-control-content');
        takeControlDivs.forEach(el => el.addEventListener('click', event => {
            activateTakeControlElement(el);
        }));
    });
</script>

<?php
get_footer();
