$(document).ready(function () {

    var programming_item = $('.prog-slider .swiper-slide');

    if (programming_item.length > 0) {

        var progsubmit = document.querySelector('#progsubmit');
        var progsliderWrap = document.querySelector('.programming .slider');

        $("#progsubmit").click(function () {

            var network_term = $('input[name="networks-category"]:checked').val();
            var day_term = $('input[name="days-category"]:checked').val();
            var show_term = $('input[name="shows-category"]:checked').val();
            var prog_navi = document.querySelector('.programming .navi');
            var nextBtn = prog_navi.querySelector('.swiper-button-next');
            $('.grid-filters .select').blur();

            var program_slider = $('.prog-slider')
                .find('.swiper-slide')
                .hide()
                .filter(function () {
                    var network = true;
                    if (network_term !== 'all') {
                        network = $(this).data('networks').indexOf(network_term) > -1;
                    }

                    var day = true;
                    if (day_term !== 'all') {
                        day = $(this).data('day').indexOf(day_term) > -1;
                    }

                    var show = true;
                    if (show_term !== 'all') {
                        show = $(this).data('show').indexOf(show_term) > -1;
                    }

                    return network && day && show;
                });
                if (program_slider.length > 0) {
                    if (program_slider.length <= 5) {
                        nextBtn.classList.add('swiper-button-disabled');
                    } else {
                        nextBtn.classList.remove('swiper-button-disabled');
                    }
                    $('.no-shows').hide();
                    prog_navi.style.opacity = 1;
                    program_slider.fadeIn();
                } else {
                    $('.no-shows').show();
                    prog_navi.style.opacity = 0;
                }
        });

        progsubmit.click();
        progsliderWrap.classList.add('ready');

    } else {
        $('.no-shows').show();
    }

    $('.grid-filters .select').click(function () {
        // if (window.innerWidth < 1024) {
            $('.select').not(this).removeClass('active');
            $('.select').not(this).css('z-index', 1);
            $(this).addClass('active');
            $(this).css('z-index', 99);
        // }
    })
    $('.grid-filters .select .option').click(function () {
        // remove focus
        $(this).parent('.select').blur();
    })
});
