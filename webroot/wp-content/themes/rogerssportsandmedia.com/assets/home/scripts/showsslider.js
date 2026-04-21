document.addEventListener('DOMContentLoaded', function () {
    // Dynamically initialize all show/video sliders present on the page
    document.querySelectorAll('.show-slider').forEach(function (el) {
        var isVideos = el.classList.contains('videos-slider');

        // Find the unique per-slider class (e.g. "shows-slider-1-slider")
        var sliderClass = Array.from(el.classList).find(function (c) {
            return c.endsWith('-slider') && c !== 'show-slider' && c !== 'videos-slider';
        });

        if (!sliderClass) return;

        // Derive the base name (e.g. "shows-slider-1") by stripping trailing "-slider"
        var sliderName = sliderClass.slice(0, -7);

        if (isVideos) {
            new Swiper('.' + sliderClass, {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 10,
                speed: 500,
                preventClicks: true,
                a11y: false,
                threshold: 20,
                navigation: {
                    nextEl: '.' + sliderName + '-next',
                    prevEl: '.' + sliderName + '-prev'
                },
                breakpoints: {
                    768: {
                        centeredSlides: false,
                        slidesPerView: 2,
                        spaceBetween: 30
                    },
                    1024: {
                        centeredSlides: false,
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                }
            });
        } else {
            new Swiper('.' + sliderClass, {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 10,
                speed: 500,
                preventClicks: true,
                a11y: false,
                threshold: 20,
                navigation: {
                    nextEl: '.' + sliderName + '-next',
                    prevEl: '.' + sliderName + '-prev'
                },
                breakpoints: {
                    768: {
                        centeredSlides: false,
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    1024: {
                        centeredSlides: false,
                        slidesPerView: 5
                    }
                }
            });
        }
    });

    document.querySelectorAll('.programming').forEach(function (container) {
        var slider = container.querySelector('.show-slider');
        if (!slider) return;

        var slides = slider.querySelectorAll('.swiper-slide');

        if (slides.length > 0) {
            var progsubmit = container.querySelector('.progsubmit');
            var progsliderWrap = container.querySelector('.slider');
            var progSwiper = slider.swiper;

            function applyFilter() {
                var networkInput = container.querySelector('input[name="networks-category"]:checked');
                var network_term = networkInput ? networkInput.value : 'all';
                var prog_navi = container.querySelector('.navi');
                var nextBtn = container.querySelector('.swiper-button-next');

                var selectEl = container.querySelector('.grid-filters .select');
                if (selectEl) selectEl.blur();

                var visible = [];
                slides.forEach(function (slide) {
                    slide.style.display = 'none';
                    var network = network_term === 'all' || slide.dataset.networks.split('|').includes(network_term);
                    if (network) {
                        visible.push(slide);
                    }
                });

                if (visible.length > 0) {
                    if (nextBtn) {
                        nextBtn.classList.toggle('swiper-button-disabled', visible.length <= 5);
                    }
                    var noShows = container.querySelector('.no-shows');
                    if (noShows) noShows.style.display = 'none';
                    if (prog_navi) prog_navi.style.opacity = 1;
                    visible.forEach(function (slide) { slide.style.display = ''; });
                    if (progSwiper) progSwiper.update();
                } else {
                    var noShows = container.querySelector('.no-shows');
                    if (noShows) noShows.style.display = '';
                    if (prog_navi) prog_navi.style.opacity = 0;
                }
            }

            if (progsubmit) {
                progsubmit.addEventListener('click', applyFilter);
                applyFilter();
            }

            if (progsliderWrap) progsliderWrap.classList.add('ready');
        } else {
            var noShows = container.querySelector('.no-shows');
            if (noShows) noShows.style.display = '';
        }

        // Handle custom select dropdowns
        container.querySelectorAll('.grid-filters .select').forEach(function (select) {
            select.addEventListener('click', function () {
                container.querySelectorAll('.grid-filters .select').forEach(function (s) {
                    if (s !== select) {
                        s.classList.remove('active');
                        s.style.zIndex = 1;
                    }
                });
                select.classList.add('active');
                select.style.zIndex = 99;
            });

            select.querySelectorAll('.option').forEach(function (option) {
                option.addEventListener('click', function () {
                    select.blur();
                });
            });
        });
    });
});
