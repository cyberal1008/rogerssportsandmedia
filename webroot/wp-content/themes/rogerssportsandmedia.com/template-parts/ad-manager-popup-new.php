<div id="newsletter-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div onclick="closeNewsletterModal()" style="background-color: rgb(107 114 128 / 0.75)" class="tw:fixed tw:inset-0"></div>
        <div style="transform: translate(calc(50vw - 50%), calc(50vh - 50%));" class="tw:fixed tw:z-10">
          <div class="tw:flex tw:min-h-full tw:items-center tw:justify-center tw:p-4 tw:text-center tw:sm:p-0">
            <div class="tw:relative tw:transform tw:overflow-hidden tw:rounded-lg tw:bg-white tw:text-left tw:shadow-xl tw:transition-all tw:sm:my-8 tw:sm:w-full tw:sm:max-w-lg">
                  <div class="tw:grid tw:grid-cols-12 tw:px-4 tw:py-3 tw:bg-primary">
                      <div class="tw:col-start-2 tw:col-span-10">
                          <img class="tw:h-12 tw:md:h-16 tw:mx-auto" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager/images/rsm_admanager_logo_red.png" />
                      </div>
                      <div class="tw:col-span-1 tw:flex tw:justify-center tw:items-center">
                          <button
                              onclick="closeNewsletterModal()"
                              type="button"
                              aria-label="Close">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="tw:w-6 tw:h-6 tw:text-white tw:font-semibold">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                              </svg>                
                          </button>
                      </div>
                  </div>
                <div class="tw:py-6 tw:px-6 tw:sm:px-12">
                      <p class="tw:text-xl tw:font-semibold tw:text-center tw:mb-6">
                          Get a $250 ad credit to use towards your first campaign of $500 or more*
                      </p>
                      <div id="newsletter-modal-success-section" class="tw:flex-col tw:text-center tw:hidden">
                          <div class="tw:flex tw:justify-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw:w-16 tw:h-16 tw:text-green">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                          </div>
                          <p class="tw:font-semibold tw:mb-4">
                              Check your email for your $250 ad credit!
                          </p>
                          <button onclick="closeNewsletterModal()" type="button" class="tw:inline-flex tw:w-full tw:justify-center tw:bg-primary tw:px-3 tw:py-3 tw:text-base tw:font-semibold tw:text-white tw:shadow-sm tw:hover:bg-primary-light">Close</button>
                      </div>
                      <div id="newsletter-modal-error-section" class="tw:flex-col tw:text-center tw:hidden">
                          <div class="tw:flex tw:justify-center">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw:w-16 tw:h-16 tw:text-red">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                          </div>
                          <p class="tw:font-semibold tw:mb-4">
                              Unable to complete request. Please try again.
                          </p>
                          <button onclick="closeNewsletterModal()" type="button" class="tw:inline-flex tw:w-full tw:justify-center tw:bg-primary tw:px-3 tw:py-3 tw:text-base tw:font-semibold tw:text-white tw:shadow-sm tw:hover:bg-primary-light">Close</button>
                      </div>
                      <form id="newsletter-modal-form-section" onsubmit="return submitNewsletterEmailForm()">
                          <div class="tw:mb-4">
                              <input
                                  id="email-address-input"
                                  type="text" 
                                  class="tw:py-4 tw:px-4 tw:block tw:w-full tw:text-base tw:bg-gray tw:focus:border-none tw:focus:outline-none tw:disabled:opacity-50 tw:disabled:pointer-events-none"
                                  placeholder="Enter your email address"
                              />
                          </div>
                          <div class="tw:mb-4 tw:flex tw:items-center">
                              <input type="checkbox" class="tw:disabled:pointer-events-none" id="newsletter-opt-in-checkbox">
                              <label for="newsletter-opt-in-checkbox" class="tw:text-sm tw:ml-4 tw:mb-0!">I want to stay up-to-date on Rogers Sports & Media news, events, and more. <a target="_blank" class="tw:underline!" href="https://www.rogers.com/support/privacy/rogers-privacy-policy#scope-%26-application-of-this-policy">View Privacy Policy</a></label>
                          </div>
                          <input type="hidden" name="action" value="submit_ad_manager_email_signup_form" />
                          <button type="submit" class="tw:inline-flex tw:w-full tw:justify-center tw:bg-primary tw:px-3 tw:py-3 tw:text-base tw:font-semibold tw:text-white tw:shadow-sm tw:hover:cursor-pointer tw:hover:no-underline tw:hover:bg-primary-dark tw:hover:border-primary-dark">Sign Up Now</button>
                      </form>
                  </div>
                <div class="tw:text-xs tw:bg-gray tw:px-4 tw:py-3 tw:sm:px-6 tw:italic">
                    *GET250 promo code is valid until 12/31/2025 and can be used on orders of $500CAD or more (before taxes) placed on RSM Ad Manager. Promo code valid for one-time use per account.
                </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        const newsletterModal = document.getElementById("newsletter-modal");
        function toggle(e) {
            e.stopPropagation();
            newsletterModal.classList.toggle("tw:hidden");
        }
        function closeNewsletterModal() {
            if (!newsletterModal.classList.contains("tw:hidden")) {
                newsletterModal.classList.toggle("tw:hidden");
            }
        }
          function submitNewsletterEmailForm () {
              event.preventDefault();
      
              // Adobe tracking
              if (typeof _satellite !== "undefined") {
                  _satellite.track('signup')
              }
      
              const emailInput = document.getElementById("email-address-input");
              const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      
              const email = emailInput.value.trim();
              if (!emailPattern.test(email)) {
                  alert("Please enter a valid email");
              } else {
                  const data = {
                      'email': email,
                      "opt_in": document.getElementById("newsletter-opt-in-checkbox").checked,
                      'action': document.getElementsByName("action")[0].value
                  }
                  console.log(data);
                  const formSection = document.getElementById("newsletter-modal-form-section");
                  const successMsgSection = document.getElementById("newsletter-modal-success-section");
                  const errorMsgSection = document.getElementById("newsletter-modal-error-section");
      
                  $.ajax({
                      type: "POST",
                      dataType: 'json',
                      url: "/wp-admin/admin-ajax.php",
                      data: data,
                      success: function(result) {
                          formSection.classList.add("tw:hidden");
                          if(result.hasOwnProperty('eventInstanceId')) {
                              successMsgSection.classList.remove("tw:hidden");
                          } else {
                              errorMsgSection.classList.remove("tw:hidden");
                          }
                      },
                      error : function(xhr, status, error) {
                          formSection.classList.add("tw:hidden");
                          errorMsgSection.classList.remove("tw:hidden");
                      }
                  });
              }
          }
      </script>