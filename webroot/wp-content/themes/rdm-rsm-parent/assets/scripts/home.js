$(document).ready(function () {
    $('#hero-carousel').slick({
      prevArrow: $('#header-slide-prev'),
      nextArrow: $('#header-slide-next'),
      autoplay: true,
      autoplaySpeed: 15000,
      cssEase: 'linear',
      fade: true,
      speed: 1000
    });
});
