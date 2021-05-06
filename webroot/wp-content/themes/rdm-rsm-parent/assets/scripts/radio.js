$(document).ready(function () {
    
    if($('.television-grid .radio-item').length > 0) {
        
        $("input.selectopt").change(function () {

            var category_term = $('input[name="radio-category"]:checked').val();
            var region_term = $('input[name="region"]:checked').val();

            console.log(category_term);
            console.log(region_term);

            var television_grid = $('.television-grid')
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
