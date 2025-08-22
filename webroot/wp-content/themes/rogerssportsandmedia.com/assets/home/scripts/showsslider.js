$(document).ready(function () {
    // Initialize the main "hgtv-canadian-originals-slider" Swiper
    new Swiper(".shows-slider-1-slider", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 10,
        speed: 500,
        preventClicks: true,
        a11y: false,
        threshold: 20,
        navigation: {
            nextEl: ".shows-slider-1-next",
            prevEl: ".shows-slider-1-prev"
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
    // Initialize the main "hgtv-shows-slider" Swiper
    new Swiper(".shows-slider-2-slider", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 10,
        speed: 500,
        preventClicks: true,
        a11y: false,
        threshold: 20,
        navigation: {
            nextEl: ".shows-slider-2-next",
            prevEl: ".shows-slider-2-prev"
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
    // Initialize "hgtv-videos-slider" Swiper
    new Swiper(".videos-slider-1-slider", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 10,
        speed: 500,
        preventClicks: true,
        a11y: false,
        threshold: 20,
        navigation: {
            nextEl: ".videos-slider-1-next",
            prevEl: ".videos-slider-1-prev"
        },
        breakpoints: {
            768: {
            centeredSlides: false,
            slidesPerView: 3,
            spaceBetween: 30
            }
        }
    });
    $('.programming').each(function () {
        var $container = $(this);
        var $slider = $container.find('.show-slider');
        var programming_item = $slider.find('.swiper-slide');

        if (programming_item.length > 0) {
            var progsubmit = $container.find('.progsubmit');
            var progsliderWrap = $container.find('.slider');
            var progSwiper = $slider[0].swiper;

            progsubmit.on('click', function () {
                var network_term = $container.find('input[name="networks-category"]:checked').val();
                var day_term = 'all';
                var show_term = 'all';
                var prog_navi = $container.find('.navi')[0];
                var nextBtn = $container.find('.swiper-button-next')[0];

                $container.find('.grid-filters .select').blur();

                var filteredSlides = $slider.find('.swiper-slide')
                    .hide()
                    .filter(function () {
                        var $slide = $(this);

                        var network = network_term === 'all' || $slide.data('networks').split('|').includes(network_term);
                        var day = day_term === 'all' || $slide.data('day').split('|').includes(day_term);
                        var show = show_term === 'all' || $slide.data('show').split('|').includes(show_term);

                        return network && day && show;
                    });

                if (filteredSlides.length > 0) {
                    if (filteredSlides.length <= 5) {
                        nextBtn.classList.add('swiper-button-disabled');
                    } else {
                        nextBtn.classList.remove('swiper-button-disabled');
                    }
                    $container.find('.no-shows').hide();
                    prog_navi.style.opacity = 1;
                    filteredSlides.fadeIn();
                    progSwiper.update();
                } else {
                    $container.find('.no-shows').show();
                    prog_navi.style.opacity = 0;
                }
            });

            // Trigger default filtering on load
            progsubmit.trigger('click');
            progsliderWrap.addClass('ready');
        } else {
            $container.find('.no-shows').show();
        }

        // Handle custom select dropdowns
        $container.find('.grid-filters .select').click(function () {
            $container.find('.select').not(this).removeClass('active').css('z-index', 1);
            $(this).addClass('active').css('z-index', 99);
        });

        $container.find('.grid-filters .select .option').click(function () {
            $(this).parent('.select').blur();
        });
    });
});
