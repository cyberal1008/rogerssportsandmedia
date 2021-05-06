$(document).ready(function () {
    
    if($('.television-grid .programming-item').length > 0) {
        
        $("input.selectopt").change(function () {

            var network_term = $('input[name="networks-category"]:checked').val();
            var day_term = $('input[name="days-category"]:checked').val();
            var show_term = $('input[name="shows-category"]:checked').val();

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
    }
    else{
        $('.programming-none').show();
    }
});
