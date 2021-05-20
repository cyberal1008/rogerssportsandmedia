$(document).ready(function () {
    var solutions_item = $('.solutions-grid .solution-item');
    var modal_video_player = null;

    if (solutions_item.length > 0) {

        solutions_item.click(function () {
            var modal_wrapper = $('.solutions-modal'),
                template = $('#tmplSolutionsModal').html(),
                id = $(this).data('solution-id');
            console.log(solutions[id]);
            // get the information for show, from the js vars
            // if no information exists, nothing happens
            if (solutions[id]) {

                // empty television modal
                var rendered = Mustache.render(template, solutions[id]);
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

                if (solutions[id]['video_id']
                    && video_settings
                    && video_settings['account']
                    && video_settings['player']) {
                    // load video player, once the modal is shown
                    brightcovePlayerLoader({
                        refNode: $('.solutions-modal .modal-video-player')[0],
                        accountId: video_settings['account'],
                        playerId: video_settings['player'],
                        videoId: solutions[id]['video_id'],
                        embedOptions: {
                            responsive: true
                        },
                        onSuccess: function (success) {
                            $('.solutions-modal .modal-video-player .loading-wrapper').hide();
                            modal_video_player = success.ref;
                        },
                    });
                }
            }
        });

    } 
});
