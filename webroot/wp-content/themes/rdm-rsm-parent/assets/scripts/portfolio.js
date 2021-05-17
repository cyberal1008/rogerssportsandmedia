$(document).ready(function () {

    function timeText(time) {
        var minutes = Math.floor(time / 60);
        var seconds = Math.floor(time - minutes * 60);

        var timedText = minutes + "m";
        if (seconds) {
            timedText += " " + seconds + "s";
        }

        return timedText;
    }

    if (video_settings
        && video_settings['account']
        && video_settings['player']) {

        var portfolio_video_wrapper = $('.portfolio-video');
        var portfolio_video_player = $('.portfolio-video-player');
        var portfolio_video_chapters = $('.portfolio-video-chapters');
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
                    onSuccess: function (success) {
                        var player = success.ref,
                            chapters = [],
                            template = $('#tmplTvChapters').html();

                        function removeActiveStatus() {
                            $(".video-chapter").removeClass("active");
                        }

                        function setActiveStatus(elem) {
                            elem.addClass("active");
                            $(".video-chapters").scrollTo($(".video-chapter.active"), 500);
                        }

                        player.on("loadedmetadata", function () {
                            chapterTT = [].filter.call(
                                player.textTracks(),
                                function (tt) {
                                    if (tt.kind === "chapters") {
                                        tt.oncuechange = function (t) {
                                            console.log(
                                                "yes cuechanged"
                                            )
                                            removeActiveStatus();
                                            var currChapterStartTime = (tt.activeCues[0].startTime),
                                                cueelem = $(".video-chapter[data-start='" + currChapterStartTime + "']");
                                            setActiveStatus(cueelem);
                                        };
                                        return true;
                                    }
                                    return false;
                                }
                            );


                            if (chapterTT && chapterTT[0] && chapterTT[0].cues) {
                                var cuesAra = chapterTT[0].cues;
                                for (var i = 0; i < cuesAra.length; i++) {
                                    chapters[i] = {
                                        time: timeText(cuesAra[i].startTime),
                                        title: cuesAra[i].text,
                                        startTime: cuesAra[i].startTime
                                    };
                                }
                                
                                var rendered = Mustache.render(template, {
                                    title: player.mediainfo.name,
                                    chapters: chapters
                                });
                                
                                
                                // remove loader
                                portfolio_video_chapters.empty();
                                $(rendered).appendTo(portfolio_video_chapters);
                                portfolio_video_chapters.on("click", ".video-chapter", function () {
                                    var startTime = $(this).data("start");
                                    player.currentTime(startTime);
                                    if(player.paused()){
                                        player.play();
                                    }
                                });

                                // covering basess
                                player.on("dispose", function () {
                                    portfolio_video_chapters.off("click", ".video-chapter");
                                });

                            } else {
                                //remove block, center video
                                portfolio_video_chapters.remove();
                                
                                // center the video player
                                portfolio_video_wrapper.addClass("justify-content-center")
                            }
                        });
                    }
                });
            }
        }
    }

});