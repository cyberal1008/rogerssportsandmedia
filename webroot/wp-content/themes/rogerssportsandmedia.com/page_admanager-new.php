<?php
/**
 * Template Name: Ad Manager New
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
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/main.css">
	<?php google_tracking_code(); ?>
	<?php facebook_pixel_code(); ?>
</head>

<body>
    <nav class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-4 tw:bg-black">
      <div class="tw:flex tw:justify-between tw:items-center">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo.png" class="tw:h-12" />
        <ul class="tw:hidden tw:md:flex tw:justify-center tw:items-center tw:gap-x-24 tw:text-white">
          <li><a class="tw:text-base tw:md:text-lg tw:font-semibold" target="_blank" href="https://rogers-help-center.scrollhelp.site/docs">Help Center</a></li>
          <li><a class="tw:text-base tw:md:text-lg tw:font-semibold" target="_blank" href="https://go.rogerssportsandmedia.com/contact-us">Contact Us</a></li>
          <li><a class="tw:text-base tw:md:text-lg tw:font-semibold" target="_blank" href="https://go.rogerssportsandmedia.com">Log in</a></li>
          <li><a class="tw:btn-primary" target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email" >Get started</a></li>
        </ul>
      </div>
    </nav>
    <section class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-4 tw:bg-white">
      <div class="tw:flex tw:flex-col tw:md:flex-row tw:md:gap-x-6 tw:gap-y-2">
        <div class="tw:flex tw:flex-row tw:gap-x-6">
          <span class="tw:font-bold tw:text-lg">Explore our Ad Solutions</span>
          <span class="tw:text-primary tw:text-lg">&#8594;</span>
        </div>
        <div class="tw:flex tw:flex-row tw:gap-x-8 tw:md:gap-x-16">
          <a class="tw:font-semibold tw:text-base tw:md:text-lg tw:hover-no-underline tw:hover:border-b-2" href="#podcast-streaming-radio">Podcast</a>
          <a class="tw:font-semibold tw:text-base tw:md:text-lg tw:hover-no-underline tw:hover:border-b-2" href="#radio">Radio</a>
          <a class="tw:font-semibold tw:text-base tw:md:text-lg tw:hover-no-underline tw:hover:border-b-2" href="#streaming">Streaming</a>
          <a class="tw:font-semibold tw:text-base tw:md:text-lg tw:hover-no-underline tw:hover:border-b-2" href="#display">Display</a>
        </div>
      </div>
    </section>
    <section class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:text-white" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/mobius-red-on-red-bg.jpg'); background-size: cover; background-position: center;">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2">
        <div>
          <h2>Rogers Sports & Media <br />Ad Buying Platform</h2>
          <p class="tw:text-2xl tw:font-semibold tw:!mb-12">
            Businesses of all sizes can harness our
            ad buying platform to reach customers
            and drive advertising impact.
            <br /><br />
            Connect with millions of Canadians who
            trust Rogers Sports & Media to deliver
            the best streaming, audio and digital
            content in the game.
          </p>
          <div class="tw:flex tw:gap-x-6">
            <a class="tw:btn-black" target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email">Advertise now</a>
          </div>
        </div>
          <div class="tw:hidden tw:md:flex tw:flex-col tw:justify-end tw:items-start">
            <a class="tw:hover:no-underline tw:cursor-pointer" href="#advertise-brands">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/arrow-down.png" class="tw:h-20">
            </a>
          </div>
      </div>
    </section>
    <section id="advertise-brands" class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:bg-white">
      <h2 class="tw:text-primary tw:text-center tw:mb-12">Advertise in Canada's most loved content.</h2>
      <div class="tw:grid tw:grid-cols-4 tw:gap-6 tw:md:grid-cols-6">
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-sportsnet-plus.png" alt="Sportsnet+ logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-citytv.png" alt="Citytv logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-chfi.png" alt="CHFI logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-kiss-radio.png" alt="KiSS Radio logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-frequency.png" alt="Frequency logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-citynews.png" alt="CityNews logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-sn-the-fan.png" alt="SN The Fan logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-wondery.png" alt="Wondery logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-tubi.png" alt="Tubi logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-jack-radio.png" alt="Jack Radio logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-sonic.png" alt="SONiC logo" class="tw:h-auto">
          </div>
          <div class="tw:flex tw:justify-center tw:items-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo-news-radio.png" alt="News Radio logo" class="tw:h-auto">
          </div>
      </div>
    </section>
    <section id="podcast-streaming-radio" class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:bg-black tw:text-white tw:overflow-hidden">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:gap-x-12 tw:gap-y-12 tw:md:gap-y-0">
        <div class="tw:grid tw:grid-cols-2 tw:gap-6">
          <div class="tw:flex tw:flex-col tw:gap-12 tw:pt-12">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/AbbeySharp_BiteBack_FINAL_3000x3000-scaled.jpg" alt="Image 1" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/TheBigStory.png" alt="Image 2" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/DATELINE.jpeg" alt="Image 2" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
          <div class="tw:flex tw:flex-col tw:gap-12 tw:translate-y-[-3%]">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/RAPS_SHOW24_1x1_logo.jpg" alt="Image 3" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/APPLE_Hero-Cover_1920x1920.jpg" alt="Image 4" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/ArmchairExpert.jpeg" alt="Image 4" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
        </div>
        <div class="tw:py-12">
          <h2>Podcast & Streaming Radio</h2>
          <p class="tw:text-2xl tw:font-semibold tw:!mb-12">
            With over 8M Canadians listening every
            month, drive impact when you advertise
            in chart-topping podcasts and the most
            popular streaming radio stations.
            <br /><br />
            <span class="tw:font-bold">68% of consumers are more willing
              to consider a product or service after
              hearing it on a podcast*</span>
            <br /><br />
            Get results with best-in-class audio ad creative,
            produced for you by us, at no extra cost.
          </p>
          <div class="tw:flex tw:gap-x-6 tw:mb-8">
            <a class="tw:btn-primary" target="_blank" href="https://go.rogerssportsandmedia.com">Advertise now</a>
            <a target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email" class="tw:bg-transparent tw:border-2 tw:px-4 tw:py-3 tw:text-white tw:text-lg tw:font-semibold tw:rounded-full tw:hover:cursor-pointer tw:hover:text-white">$250 ad credit</a>
          </div>
          <br />
          <p class="tw:text-base tw:font-medium">Source: Medium Moves The Message, Sounds Profitable, Feb 2023</p>
        </div>
      </div>
    </section>
    <section id="radio" class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:bg-gray">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:gap-x-12 tw:gap-y-12 tw:md:gap-y-0">
        <div>
          <h2>Radio Advertising</h2>
          <p class="tw:text-2xl tw:font-semibold tw:!mb-12">
            In big cities and small communities, radio
            reaches the widest audiences. We boast some
            of the most popular music, news and sports
            radio stations in the country, <span class="tw:font-bold">reaching over
            59% of Canadians every month.</span>
            <br /><br />
            <span class="tw:font-bold">4-in-10 Canadians have taken some sort
              of action after hearing an ad on radio*</span>
            <br /><br />
            Get results with best-in-class radio ad creative,
            produced for you by us, at no extra cost
          </p>
          <div class="tw:flex tw:gap-x-6 tw:mb-8">
            <a class="tw:btn-primary" target="_blank" href="https://go.rogerssportsandmedia.com">Advertise now</a>
            <a class="tw:btn-secondary" target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email">$250 ad credit</a>
          </div>
          <br />
          <p class="tw:text-base tw:font-medium">Source: Radio Connects, Rediscover the Power of Live Radio, 2024</p>
        </div>
        <div class="tw:grid tw:grid-cols-2 tw:gap-6">
          <div class="tw:flex tw:flex-col tw:gap-8">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/KiSS_925_RM_Fall2024_Astral_TSA_47x68_RGB_B.jpg" alt="Image 1" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/SONIC1029_Fall2024Campaign_Social_1080x1080_02.jpg" alt="Image 2" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
          <div class="tw:flex tw:flex-col tw:gap-8">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/SONIC1029_Fall2024Campaign_Social_1080x1080_02.jpg" alt="Image 3" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/CHFI_Spring2024_SocialFeed_PoojaGurdeep.jpg" alt="Image 4" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
        </div>
      </div>
    </section>
    <section id="streaming" class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:bg-black tw:text-white">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:gap-x-12 tw:gap-y-12 tw:md:gap-y-0">
        <div class="tw:grid tw:grid-cols-2 tw:gap-6">
          <div class="tw:flex tw:flex-col tw:gap-8">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/GoldenBachelorette_V2.jpg" alt="Image 1" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/Sportsnet.jpg" alt="Image 2" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
          <div class="tw:flex tw:flex-col tw:gap-8">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/TUBI.png" alt="Image 3" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/photos/LO_S24_Rogers_630x945.jpg" alt="Image 4" class="tw:w-full tw:h-auto tw:rounded-xl tw:object-cover">
          </div>
        </div>
        <div>
          <h2>Streaming</h2>
          <p class="tw:text-2xl tw:font-semibold tw:!mb-12">
            As the home of Sportsnet+, Citytv and Tubi,
            <span class="tw:font-bold">18M Canadians trust us</span> to deliver the biggest
            moments in live sports and entertainment
            every month.
            <br /><br />
            <span class="tw:font-bold">RSM streamers are 33% more likely to
            purchase a product after seeing an ad
            vs. all other streamers*</span>
            <br /><br />
            Our premier streaming experience delivers
            positive impact for your video advertising.
            90% of our audience stream on the big TV
            screen and our non-skippable ad formats
            mean high completion rates for your ads.
          </p>
          <div class="tw:flex tw:gap-x-6 tw:mb-8">
            <a class="tw:btn-primary" target="_blank" href="https://go.rogerssportsandmedia.com">Advertise now</button>
            <a target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email" class="tw:bg-transparent tw:border-2 tw:px-4 tw:py-3 tw:text-white tw:text-base tw:font-semibold tw:rounded-full tw:hover:cursor-pointer tw:hover:text-white">$250 ad credit</a>
          </div>
          <br />
          <p class="tw:text-base tw:font-medium">Source: RSM Full Stream Ahead 2024 Survey, April 2024</p>
        </div>
      </div>
    </section>
    <section id="display" class="tw:px-4 tw:md:px-32 tw:lg:pl-32 tw:xl:pl-40 tw:2xl:pl-48 tw:py-12 tw:bg-gray">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-5 tw:gap-y-12 tw:md:gap-y-0">
        <div class="tw:md:col-span-2">
          <h2>Display</h2>
          <p class="tw:text-2xl tw:font-semibold tw:!mb-12">
            With <span class="tw:font-bold">over 26M visitors monthly,</span> reach
            customers locally or nationally across our
            sites and apps.
            <br /><br />
            Trust that your ads are in a brand-safe
            environment, appearing within premium
            sports, news and entertainment content.
            <br /><br />
            Getting started is easy! Access our display
            ad inventory with entry-level budgets. Use
            your existing creatives or our ad builder
            tool to create ads at no extra cost.
          </p>
          <div class="tw:flex tw:gap-x-6">
            <a class="tw:btn-primary" target="_blank" href="https://go.rogerssportsandmedia.com">Create an ad</a>
            <a class="tw:btn-secondary" target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email">$250 ad credit</a>
          </div>
        </div>
        <div class="tw:md:col-span-3 tw:flex tw:justify-center tw:items-center">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/LAPTOP.png" class="tw:w-full" />
        </div>
      </div>
    </section>
    <section class="tw:px-4 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:bg-black tw:text-white">
      <h2>Partner with us to achieve your advertising goals</h2>
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-3 tw:gap-y-12 tw:md:gap-y-0 tw:[&>*:nth-child(even)]:md:border-x">
        <div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/GRAPHICS-02.png" class="tw:h-16 tw:mb-6" />
          <p class="tw:text-xl tw:font-bold tw:mb-6">Drive positive impact for your brand</p>
          <p class="tw:text-xl tw:font-semibold">Drive impact for your brand when it appears within the most trusted and consumed content in Canada</p>
        </div>
        <div class="tw:md:px-8">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/GRAPHICS-03.png" class="tw:h-16 tw:mb-6" />
          <p class="tw:text-xl tw:font-bold tw:mb-6">Reach the audience that matters most</p>
          <p class="tw:text-xl tw:font-semibold">Target the locations, demographics and content that best aligns with your business</p>
        </div>
        <div class="tw:md:px-8">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/GRAPHICS-04.png" class="tw:h-16 tw:mb-6" />
          <p class="tw:text-xl tw:font-bold tw:mb-6">Getting started is easy & support is available</p>
          <p class="tw:text-xl tw:font-semibold">Start with entry-level budgets, produce your ad for free and trust that support is a click away</p>
        </div>
      </div>
    </section>
    <section class="tw:px-4 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:bg-white">
      <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2 tw:md:gap-x-8">
        <div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/campaign-setup.png" class="tw:mb-6" />
        </div>
        <div class="tw:md:px-4">
          <h2>Reach customers in 4 easy steps</h2>
          <div class="tw:grid tw:grid-cols-1 tw:gap-y-8 tw:mb-12">
            <div class="tw:flex tw:items-center tw:gap-x-8 tw:md:gap-x-6">
              <div class="tw:w-1/12">
                <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-black tw:text-white tw:text-xl tw:font-bold tw:rounded-full">1</span>
              </div>
              <div class="tw:w-11/12">
                <span class="tw:text-xl tw:font-semibold">Select where your ads will run and who they will reach</span>
              </div>
            </div>
            <div class="tw:flex tw:items-center tw:gap-x-8 tw:md:gap-x-6">
              <div class="tw:w-1/12">
                <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-black tw:text-white tw:text-xl tw:font-bold tw:rounded-full">2</span>
              </div>
              <div class="tw:w-11/12">
                <span class="tw:text-xl tw:font-semibold">Set your schedule and budget</span>
              </div>
            </div>
            <div class="tw:flex tw:items-center tw:gap-x-8 tw:md:gap-x-6">
              <div class="tw:w-1/12">
                <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-black tw:text-white tw:text-xl tw:font-bold tw:rounded-full">3</span>
              </div>
              <div class="tw:w-11/12">
                <span class="tw:text-xl tw:font-semibold">Produce or upload your ad creative</span>
              </div>
            </div>
            <div class="tw:flex tw:items-center tw:gap-x-8 tw:md:gap-x-6">
              <div class="tw:w-1/12">
                <span class="tw:flex tw:items-center tw:justify-center tw:w-12 tw:h-12 tw:bg-black tw:text-white tw:text-xl tw:font-bold tw:rounded-full">4</span>
              </div>
              <div class="tw:w-11/12">
                <span class="tw:text-xl tw:font-semibold">Pay for, launch and monitor your campaign</span>
              </div>
            </div>
          </div>
          <a class="tw:btn-primary" href="https://go.rogerssportsandmedia.com/sign-up/with-email">Get started</a>
        </div>
      </div>
    </section>
</body>

<?php
get_footer();
