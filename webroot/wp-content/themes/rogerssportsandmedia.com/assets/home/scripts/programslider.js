document.addEventListener('DOMContentLoaded', function () {
    var slides = document.querySelectorAll('.prog-slider .swiper-slide');

    if (slides.length > 0) {
        var progsubmit = document.querySelector('#progsubmit');
        var progsliderWrap = document.querySelector('.programming .slider');
        var progSwiper = document.querySelector('.prog-slider').swiper;

        function applyFilter() {
            var networkInput = document.querySelector('input[name="networks-category"]:checked');
            var network_term = networkInput ? networkInput.value : 'all';
            var day_term = 'all';
            var show_term = 'all';
            var prog_navi = document.querySelector('.programming .navi');
            var nextBtn = prog_navi ? prog_navi.querySelector('.swiper-button-next') : null;

            var selectEl = document.querySelector('.grid-filters .select');
            if (selectEl) selectEl.blur();

            var visible = [];
            slides.forEach(function (slide) {
                slide.style.display = 'none';

                var network = network_term === 'all' || slide.dataset.networks.split('|').indexOf(network_term) > -1;
                var day = day_term === 'all' || slide.dataset.day.split('|').indexOf(day_term) > -1;
                var show = show_term === 'all' || slide.dataset.show.split('|').indexOf(show_term) > -1;

                if (network && day && show) visible.push(slide);
            });

            if (visible.length > 0) {
                if (nextBtn) {
                    nextBtn.classList.toggle('swiper-button-disabled', visible.length <= 5);
                }
                var noShows = document.querySelector('.no-shows');
                if (noShows) noShows.style.display = 'none';
                if (prog_navi) prog_navi.style.opacity = 1;
                visible.forEach(function (slide) { slide.style.display = ''; });
                if (progSwiper) progSwiper.update();
            } else {
                var noShows = document.querySelector('.no-shows');
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
        var noShows = document.querySelector('.no-shows');
        if (noShows) noShows.style.display = '';
    }

    document.querySelectorAll('.grid-filters .select').forEach(function (select) {
        select.addEventListener('click', function () {
            document.querySelectorAll('.grid-filters .select').forEach(function (s) {
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
