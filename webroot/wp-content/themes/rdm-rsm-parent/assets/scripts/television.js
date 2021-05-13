$(document).ready(function () {
    var programming_item = $('.television-grid .programming-item');
    var modal_video_player = null;

    if (programming_item.length > 0) {

        programming_item.click(function () {

            var modal_wrapper = $('.television-modal'),
                template = $('#tmplTvModal').html(),
                show_id = $(this).data('show-id');

            // get the information for show, from the js vars
            // if no information exists, nothing happens
            if (tv_shows[show_id]) {

                // empty television modal
                var rendered = Mustache.render(template, tv_shows[show_id]);
                $(rendered).appendTo(modal_wrapper);
                var modal_ = $('.portfolio-modal');
                modal_.modal('show');
                modal_.on('hidden.bs.modal', function (e) {

                    if (modal_video_player) {
                        // dispose player if it exists
                        modal_video_player.dispose();
                        modal_video_player = null;
                    }
                    // we will be creating new modal everytime
                    $(this).modal('dispose');
                    modal_wrapper.empty();

                });

                if (tv_shows[show_id]['video_id']
                    && video_settings
                    && video_settings['account']
                    && video_settings['player']) {
                    // load video player, once the modal is shown
                    brightcovePlayerLoader({
                        refNode: $('.television-modal .modal-video-player')[0],
                        accountId: '2226196965001',
                        playerId: 'jDWgkhq9Ii',
                        videoId: tv_shows[show_id]['video_id'],
                        embedOptions: {
                            responsive: true
                        },
                        onSuccess: function (success) {
                            $('.television-modal .modal-video-player .loading-wrapper').hide();
                            modal_video_player = success.ref;
                        },
                    });
                }
            }
        });

        $("input.selectopt").change(function () {

            var network_term = $('input[name="networks-category"]:checked').val();
            var day_term = $('input[name="days-category"]:checked').val();
            var show_term = $('input[name="shows-category"]:checked').val();
            $('.grid-filters .select').blur();

            var television_grid = $('.television-grid')
                .find('.programming-item')
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
            $('#grid-filter-head-total').text(television_grid.length);
            if (television_grid.length > 0) {
                $('.programming-none').hide();
                television_grid.fadeIn();
            } else {
                $('.programming-none').show();
            }
        });
    } else {
        $('.programming-none').show();
    }
    $('.grid-filters .select').click(function () {
        $('.select').not(this).css('z-index', 1);
        $(this).css('z-index', 99);
    })
});
