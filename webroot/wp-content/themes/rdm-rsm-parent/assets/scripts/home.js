$(document).ready(function () {
    $('#products-slide').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: $('#slide-prev'),
        nextArrow: $('#slide-next'),
        // the magic
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
            }

        }, {

            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                arrows: false
            }

        }]
    });

});