(function ($) {
    'use strict';

    /**
     * Image uploder for show edit page
     *
     **/
    
    $(document).ready(function () {
        var tile_image_text_set = 'Set tile image',
            tile_image_text_remove = 'Remove tile image',
            image_div_id = "rsmtileimg",
            // parent_img_selector = $( "#" + image_div_id),
            image_selector = $( "#" + image_div_id +" img"),
            button_selector = $(".rsm_action_button"),
            file_frame;
            
            
        var toggle_state = function(new_state, attachment){
            if(new_state === 'set'){
                button_selector.siblings('.rsm_show_img_hidden').val("");
                image_selector.attr('src', '');
                image_selector.hide();
                button_selector.data('action', 'set');
                button_selector.text(tile_image_text_set);
            }
            else{
                button_selector.siblings('.rsm_show_img_hidden').val(attachment.id);
                image_selector.attr('src', attachment.url);
                image_selector.show();
                button_selector.data("action", "remove");
                button_selector.text(tile_image_text_remove);
               
            }
        }
        
        $.fn.upload_tile_image = function () {

            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Choose and image',
                button: {
                    text: tile_image_text_set,
                },
                multiple: false
            });
            
            file_frame.on('select', function () {
                var attachment = file_frame.state().get('selection').first().toJSON();
                toggle_state('remove', attachment);
            });

            file_frame.open();
        };

        button_selector.on('click', function (event) {
            event.preventDefault();
            var action= $(this).data('action');
            
            if(action === 'set'){
                $.fn.upload_tile_image($(this));
            }
            else{
                toggle_state('set', null);
            }
        });
    });

})(jQuery);
