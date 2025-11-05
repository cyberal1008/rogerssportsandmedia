$(document).ready(function () {
    // Initialize the main "hgtv-canadian-originals-slider" Swiper
    new Swiper(".presentation-slider-1-slider", {
        slidesPerView: "auto",
        centeredSlides: true,
        speed: 500,
        preventClicks: true,
        a11y: false,
        threshold: 20,
        navigation: {
            nextEl: ".presentation-slider-1-next",
            prevEl: ".presentation-slider-1-prev"
        },
    });
});
