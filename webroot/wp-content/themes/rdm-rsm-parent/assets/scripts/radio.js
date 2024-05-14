$(document).ready(function () {
    var programming_item = $('.radio-grid .radio-item');
    if(programming_item.length > 0) {

        programming_item.click(function () {

            var modal_wrapper = $('.radio-modal'),
                template = $('#tmplRadioModal').html(),
                program_id = $(this).data('program-id');

            // get the information for show, from the js vars
            // if no information exists, nothing happens
            if (radio_programs[program_id]) {

                // empty radio modal
                var rendered = Mustache.render(template, radio_programs[program_id]);
                $(rendered).appendTo(modal_wrapper);
                var modal_ = $('.portfolio-modal');
                modal_.modal('show');
                modal_.on('hidden.bs.modal', function (e) {
                    // we will be creating new modal everytime
                    $(this).modal('dispose');
                    modal_wrapper.empty();

                });
            }
        });
        
        $("input.selectopt").change(function () {
            var category_term = $('input[name="radio-category"]:checked').val();
            var region_term = $('input[name="region"]:checked').val();
            $('.grid-filters .select').blur();

            var radio_grid = $('.radio-grid')
                .find('.radio-item')
                .hide()
                .filter(function () {
                    var category = true;
                    if (category_term !== 'all') {
                        category = $(this).data('catetory').indexOf(category_term) > -1;
                    }

                    var region = true;
                    if (region_term !== 'all') {
                        region = $(this).data('region').indexOf(region_term) > -1;
                    }

                    return category && region;
                });
            $('#grid-filter-head-total').text(radio_grid.length);
            if (radio_grid.length > 0) {
                $('.programming-none').hide();
                radio_grid.fadeIn();
            } else {
                $('.programming-none').show();
            }
        });
        /* 
        This is a temporary update for radio portfolio to load "featured stations and podcasts" as default selection on page load
        as per RSMW-117
        @TODO: redesign the programming grid function, give ability to order drop down filter "types" in the programming grid
        */
        if (window.location.href.indexOf("podcast") !== -1) {
            $("input.selectopt#radio-category-podcast").prop('checked', true);
        } else {
            $("input.selectopt#radio-category-featured-stations-and-podcasts").prop('checked', true);
        }
        $("input.selectopt").trigger('change');
    }
    else{
        $('.programming-none').show();
    }
    $('.grid-filters .select').click(function(){
        $('.select').not(this).css('z-index', 1);
        $(this).css('z-index', 99);
    })
});
