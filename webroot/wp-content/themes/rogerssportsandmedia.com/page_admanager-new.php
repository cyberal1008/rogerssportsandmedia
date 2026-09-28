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
  <style>
    @media (min-width: 1072px) {
      .tw\:ad-nav-custom-width\:mb-0 {
        margin-bottom: calc(var(--tw-spacing) * 0);
      }
      .tw\:ad-nav-custom-width\:hidden {
        display: none;
      }
      .tw\:ad-nav-custom-width\:inline {
        display: inline;
      }
      .tw\:ad-nav-custom-width\:flex-row {
        flex-direction: row;
      }
      .tw\:ad-nav-custom-width\:items-center {
        align-items: center;
      }
      .tw\:ad-nav-custom-width\:justify-between {
        justify-content: space-between;
      }
      .tw\:ad-nav-custom-width\:justify-center {
        justify-content: center;
      }
      .tw\:ad-nav-custom-width\:gap-x-16 {
        column-gap: calc(var(--tw-spacing) * 16);
      }
      .tw\:ad-nav-custom-width\:px-32 {      
        padding-inline: calc(var(--tw-spacing) * 32);
      }
      .tw\:ad-nav-custom-width\:text-lg {
        font-size: var(--tw-text-lg);
        line-height: var(--tw-leading, var(--tw-text-lg--line-height));
      }
      .tw\:ad-nav-custom-width\:flex-row {
        flex-direction: row;
      }

      .tw\:ad-nav-custom-width\:gap-x-6 {
        column-gap: calc(var(--tw-spacing) * 6);
      }

      .tw\:ad-nav-custom-width\:block {
        display: block;
      }

      .tw\:ad-nav-custom-width\:flex {
        display: flex;
      }
    }
  </style>
</head>

<body>
<?php wp_body_open(); ?>
    <nav class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-4 tw:bg-black">
      <div class="tw:flex tw:flex-col tw:ad-nav-custom-width:flex-row tw:ad-nav-custom-width:justify-between">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/logo.png" class="tw:h-12 tw:mb-4 tw:ad-nav-custom-width:mb-0 tw:w-48" />
        </a>
      </div>
    </nav>
    <section class="tw:relative tw:overflow-hidden">
      <div class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12">
        <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-4">
          <div>
            <h2>RSM Ad Manager is no longer available.</h2>
            <p class="tw:text-lg tw:font-semibold tw:!mb-12">
              If you currently work with an Account Manager, they’ll be happy to support you with your next campaign.
              <br><br>
              If you’d like to be connected with a member of our sales team, please contact us at <a style="color: #007bff" href="mailto:adsupport@rogerssportsandmedia.com">adsupport@rogerssportsandmedia.com</a>
              <br><br>
              For all general inquiries, please contact us using the button below.
            </p>
            <div class="tw:flex tw:gap-x-6">
              <a class="tw:btn-black" target="_blank" href="/contact-us/">Contact us</a>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>

<?php
get_footer();
