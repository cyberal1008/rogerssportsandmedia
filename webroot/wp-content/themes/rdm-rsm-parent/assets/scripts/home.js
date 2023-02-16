$(document).ready(function () {
    // $('#header-carousel').slick({
    //   prevArrow: $('#header-slide-prev'),
    //   nextArrow: $('#header-slide-next'),
    //   autoplay: true,
    //   autoplaySpeed: 2000,
    // });

    $('#hero-carousel').slick({
      prevArrow: $('#header-slide-prev'),
      nextArrow: $('#header-slide-next'),
      autoplay: true,
      autoplaySpeed: 10000,
      cssEase: 'linear',
      fade: true,
      speed: 1000
    });

    // $('#products-slide').slick({
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     autoplay: true,
    //     autoplaySpeed: 1500,
    //     variableWidth: true,
    //     prevArrow: $('#slide-prev'),
    //     nextArrow: $('#slide-next'),
    //     // the magic
    //     responsive: [{
    //         breakpoint: 768,
    //         settings: {
    //             slidesToShow: 3,
    //         }

    //     }, {

    //         breakpoint: 576,
    //         settings: {
    //             slidesToShow: 3,
    //             arrows: false,
    //             variableWidth: false,
    //         }

    //     }]
    // });

});
