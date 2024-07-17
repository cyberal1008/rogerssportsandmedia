<div class="tw-w-full tw-flex tw-flex-row tw-justify-center tw-items-center tw-py-3 tw-text-white tw-bg-red tw-space-x-1 md:tw-space-x-16 tw-px-2 md:tw-px-0">
    <span class="tw-w-3/4 md:tw-w-fit tw-text-sm md:tw-text-base tw-mb-1 md:tw-mb-0">Get a $250 ad credit to use towards your first campaign of $500 or more.*</span>
    <a id="signupNowNavButton" target="_blank" href="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/rvs5ls1u4zg" class="tw-w-1/4 md:tw-w-fit tw-text-xs tw-text-red tw-border tw-bg-white tw-py-3 tw-px-3 md:tw-px-4 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-red-dark">
        Sign Up Now
    </a>
</div>
<nav class="tw-flex tw-flex-row tw-px-16 md:tw-px-32 tw-py-2 md:tw-py-6 tw-justify-between">
    <div>
        <img class="tw-h-12 md:tw-h-16" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/logo-landing.svg" />
    </div>
    <div class="tw-hidden md:tw-flex tw-flex-row tw-items-center tw-space-x-16 tw-font-semibold">
        <a target="_blank" href="https://go.rogerssportsandmedia.com/contact-us" class="hover:tw-no-underline hover:tw-text-black">Support</a>
        <a id="loginNavLink" target="_blank" href="https://go.rogerssportsandmedia.com" class="hover:tw-no-underline hover:tw-text-black ">Log in</a>
        <a id="getStartedNavLink" target="_blank" href="https://go.rogerssportsandmedia.com/sign-up/with-email" class="tw-text-white tw-border-red tw-bg-red tw-py-3 tw-px-6 tw-font-semibold tw-cursor-pointer hover:tw-no-underline hover:tw-text-white hover:tw-bg-red-dark">
            Get started
        </a>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        document.getElementById("signupNowNavButton").addEventListener("click", function () {
            if (typeof _satellite !== "undefined") {
                _satellite.track('signup');
            }
        });

        document.getElementById("loginNavLink").addEventListener("click", function () {
            if (typeof _satellite !== "undefined") {
                _satellite.track('login');
            }
        });

        document.getElementById("getStartedNavLink").addEventListener("click", function () {
            if (typeof _satellite !== "undefined") {
                _satellite.track('getstarted');
            }
        });

        document.getElementById("getStartedTodayBtn").addEventListener("click", function () {
            if (typeof _satellite !== "undefined") {
                _satellite.track('getstarted');
            }
        });

        const advertiseNowButtons = document.querySelectorAll('.advertise-now-btn');
        advertiseNowButtons.forEach(el => el.addEventListener('click', event => {
            console.log("Advertise now click Nav link");
            if (typeof _satellite !== "undefined") {
                _satellite.track('advertisenow');
            }
        }));
    });
</script>