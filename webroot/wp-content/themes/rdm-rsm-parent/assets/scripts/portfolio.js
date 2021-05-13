$(document).ready(function () {

    if (video_settings
        && video_settings['account']
        && video_settings['player']) {

        var portfolio_video_player = $('.portfolio-video-player');
        // if there is a portfolio video player
        if (portfolio_video_player.length) {
            var video_id = portfolio_video_player.data('video-id');
            if (video_id) {
                brightcovePlayerLoader({
                    refNode: portfolio_video_player[0],
                    accountId: video_settings['account'],
                    playerId: video_settings['player'],
                    videoId: video_id,
                    embedOptions: {
                        responsive: true
                    },
                });
            }
        }
    }

});