<div id="newsletter-modal" class="tw-hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div style="background-color: rgb(107 114 128 / var(--tw-bg-opacity))" class="tw-fixed tw-inset-0 tw-bg-opacity-75 tw-transition-opacity"></div>
  <div class="tw-fixed tw-inset-0 tw-z-10 tw-w-screen tw-overflow-y-auto">
    <div class="tw-flex tw-min-h-full tw-items-center tw-justify-center tw-p-4 tw-text-center sm:tw-p-0">
      <div class="tw-relative tw-transform tw-overflow-hidden tw-rounded-lg tw-bg-white tw-text-left tw-shadow-xl tw-transition-all sm:tw-my-8 sm:tw-w-full sm:tw-max-w-lg">
          <div class="tw-bg-red tw-px-4 tw-py-3 tw-flex tw-justify-center">
              <img class="tw-h-12 md:tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/logo-landing-white.png" />
          </div>
          <div class="tw-py-6 tw-px-6 sm:tw-px-12">
            <div class="tw-flex tw-mb-6 tw-justify-center">
              <img class="tw-h-12 md:tw-h-24" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-circle.png" />
              <img class="tw-h-12 md:tw-h-24" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-triange.png" />
              <img class="tw-h-12 md:tw-h-24" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/helper-square.svg" />
            </div>
            <p class="tw-text-xl tw-font-semibold tw-text-center tw-mb-6">
                Get a $250 ad credit to use towards your first campaign of $500 or more*
            </p>
            <div class="tw-mb-4">
              <input 
              type="text" 
              class="tw-py-4 tw-px-4 tw-block tw-w-full tw-text-base tw-bg-gray focus:tw-border-none focus:tw-outline-none disabled:tw-opacity-50 disabled:tw-pointer-events-none"
              placeholder="Enter your email address"
            />
            </div>
            <div class="tw-mb-4">
              <input type="checkbox" class="tw-shrink-0 tw-mt-0.5 tw-border-gray disabled:opacity-50 disabled:tw-pointer-events-none" id="newsletter-opt-in-checkbox">
              <label for="newsletter-opt-in-checkbox" class="tw-text-sm tw-inline">I want to stay up-to-date on Rogers Sports & Media news, events, and more. <a target="_blank" class="tw-underline" href="https://www.rogers.com/support/privacy/rogers-privacy-policy#scope-%26-application-of-this-policy">View Privacy Policy</a></label>
            </div>
            <button onclick="closeNewsletterModal()" type="button" class="tw-inline-flex tw-w-full tw-justify-center tw-bg-red tw-px-3 tw-py-3 tw-text-base tw-font-semibold tw-text-white tw-shadow-sm hover:tw-bg-red-dark">Sign Up Now</button>
          </div>
          <div class="tw-text-xs tw-bg-gray tw-px-4 tw-py-3 sm:tw-flex sm:tw-flex-row-reverse sm:tw-px-6">
              *GET250 promo code is valid until 12/31/2024 and can be used on orders of $500CAD or more (before taxes) placed on RSM Ad Manager. Promo code valid for one-time use per account.
          </div>
      </div>
    </div>
  </div>
</div>