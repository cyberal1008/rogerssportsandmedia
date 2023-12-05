<?php
/**
 * Template Name: Ad Solutions X
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
    <section class="tw-py-2 tw-px-4 mb:tw-px-20 tw-mb-20">
        <div class="tw-mb-4 tw-text-center tw-text-2xl tw-font-semibold tw-text-red">
            Display Advertising
        </div>
        <div class="tw-mb-4 tw-text-lg tw-text-center">
            Deliver impactful brand messaging across our network of premium owned and partner sites
        </div>
        <div class="tw-flex tw-text-center tw-justify-center">
            <img class="tw-w-3/4" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-hero.png" />
        </div>
        <div class="tw-mb-6 tw-py-2 tw-px-4 md:tw-px-60">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-space-y-4 md:tw-space-y-0 md:tw-space-x-16">
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/unique-views.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">26 million unique visitors every month</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/rsm-difference-scale.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">Scale that enables you drive awareness and impact with a local audience</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/rsm-difference-lock.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">Premium content that ensures a brand-safe environment for your ads</div>
                </div>
            </div>
        </div>
        <div class="tw-text-center tw-mb-10 md:tw-px-72">
            <span class="tw-font-semibold">Create a set of display ads at no extra cost.</span> Use our ad builder to create a set of display ads in just a few clicks. Or simply upload ad creative that you already have.
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
    <section class="tw-bg-gray tw-px-4 tw-py-10">
        <div class="tw-mb-4 tw-text-center tw-text-2xl tw-font-semibold tw-text-red">
            Podcast & Streaming Radio Advertising
        </div>
        <div class="tw-mb-12 tw-text-lg tw-text-center">
            Reach our engaged audiences as they listen to premium podcast and streaming audio content
        </div>
        <div class="tw-px-4 md:tw-px-48">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-10 tw-items-stretch tw-space-y-8 md:tw-space-y-0 md:tw-space-x-10">
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Streaming news, entertainment and music content from our 50+ market-leading radio stations</p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-kiss-radio.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Award winning news and lifestyle podcast content such as <i>The Big Story, Teach Me How to Adult, and Island Crime</i></p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-big-story.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">7 of the top 20 sports podcasts in Canada including <i>32 Thoughts and The Raptors Show with Will Lou</i></p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-32-thoughts.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Exclusive access to partner podcasts from around the world including <i>Dateline NBC, Conan O'Brien Needs a Friend, Hidden Brain,</i> and many more</p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-nbc-dateline.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-mb-6 tw-py-2 tw-px-4 md:tw-px-60">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-space-y-4 md:tw-space-y-0 md:tw-space-x-16">
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/candian-flag-red-white.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold tw-text-lg">8 million Canadians reached per month</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/ad-solutions-percentage.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold tw-text-lg">95% audio ad listen-through rates</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/unique-views.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold tw-text-lg">Reach educated, diverse, affluent adults and young adults</div>
                </div>
            </div>
        </div>
        <div class="tw-text-center tw-mb-10 md:tw-px-72">
            <span class="tw-font-semibold">Create an audio ad for no extra cost.</span> We make it easy to engage with our production team, from creative brief through to final ad. <p>Or simply upload a 30-second audio ad you already have.</p>
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
    <section class="tw-px-4 tw-py-10">
        <div class="tw-mb-4 tw-text-center tw-text-2xl tw-font-semibold tw-text-red">
            Radio Advertising
        </div>
        <div class="tw-mb-12 tw-text-lg tw-text-center">
            Drive top-of-mind awareness for your business in the markets that matter to you most
        </div>
        <div class="tw-px-4 md:tw-px-48">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-mb-10 tw-items-stretch tw-space-y-8 md:tw-space-y-0 md:tw-space-x-10">
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-1/3">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-chfi.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-1/3">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-kiss-radio.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-1/3">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-citynews.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/4 tw-flex tw-flex-col tw-bg-gray tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-1/3">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-sn590.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-mb-6 tw-py-2 tw-px-4 md:tw-px-60">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-space-y-4 md:tw-space-y-0 md:tw-space-x-16">
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-50-plus.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">Over 50 top radio stations across Canada</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/radio-advertising-fire.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">The most listened to Sports, News and Music radio programming in Canada</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/candian-flag-red-white.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">59% of Canadians reached every month</div>
                </div>
            </div>
        </div>
        <div class="tw-text-center tw-mb-10 md:tw-px-72">
            <span class="tw-font-semibold">Create a radio ad for no extra cost.</span> We make it easy to engage with our production team, from creative brief through to final ad. <p>Or simply upload a 15-second or 30-second radio ad you already have.</p>
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
    <section class="tw-px-4 tw-py-10 tw-bg-gray">
        <div class="tw-mb-4 tw-text-center tw-text-2xl tw-font-semibold tw-text-red">
            Video & Streaming TV Advertising
        </div>
        <div class="tw-mb-12 tw-text-lg tw-text-center">
            Reach audiences engaged in the best streaming and video content in Canada
        </div>
        <div class="tw-px-4 md:tw-px-72">
            <div class="md:tw-px-20 tw-flex tw-flex-col md:tw-flex-row tw-mb-10 tw-items-stretch tw-space-y-8 md:tw-space-y-0 md:tw-space-x-10">
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Premium streaming TV content from <i>Sportsnet, Citytv, Cityline, Citynews, Breakfast Television</i> and more</p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/video-streaming-tv-citytv.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Action-packed <i>NHL, MLB</i> and <i>NBA</i> live sports programming or <i>Sportsnet+</i></p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/video-streaming-tv-snnow.png" />
                    </div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-bg-white tw-px-8 tw-py-6 tw-text-center tw-items-center tw-rounded-2xl tw-space-y-8 md:tw-space-y-12">
                    <div class="tw-h-3/5">
                        <p class="tw-font-semibold tw-text-lg tw-mb-2">Popular entertainment content from <i>TUBI</i>. One of the fastest growing ad-supported streaming services</p>
                    </div>
                    <div class="tw-h-2/5">
                        <img class="tw-h-32" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/video-streaming-tv-tubi.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-mb-6 tw-py-2 tw-px-4 md:tw-px-72">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-space-y-4 md:tw-space-y-0 md:tw-space-x-16">
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/candian-flag-red-white.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">18 million Canadians reached per month</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/unique-views.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">Reach well-educated, diverse, affluent adults, parents and young adults</div>
                </div>
                <div class="tw-w-full md:tw-w-1/3 tw-flex tw-flex-col tw-items-center tw-text-center tw-py-2">
                    <div class="tw-mb-3">
                        <img class="tw-h-12" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/video-streaming-tv-percentage.png" />
                    </div>
                    <div class="tw-px-16 tw-font-semibold">97% Video ad completion rates</div>
                </div>
            </div>
        </div>
        <div class="tw-text-center tw-mb-10 md:tw-px-72">
            <span class="tw-font-semibold">Required Ad Creative:</span> You will need a video ad that is 30-seconds or less. Simply upload your ad into your campaign and we'll ensure it meets our specifications.
        </div>
        <div class="tw-flex tw-justify-center">
            <a target="_blank" href="https://go.rogerssportsandmedia.com" class="tw-text-white tw-border-red tw-bg-red tw-py-4 tw-px-8 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
                Advertise Now
            </a>
        </div>
    </section>
</body>

<?php
get_footer();
