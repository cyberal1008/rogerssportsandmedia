<?php
    $featured_video = get_field('featured_video');
    $featured_video_title = get_field('featured_video_title');
    $featured_video_background_color = get_field('featured_video_background_color');
    $featured_video_text_color = get_field('featured_video_text_color');
    if ($featured_video) :
?>
    <section style="<?php 
                        echo get_field('featured_video_at_page_bottom') ? 'padding-top: 44px; ' : '';
                        echo 'background-color: '.(!empty($featured_video_background_color) ? $featured_video_background_color : 'rgb(245, 245, 245)').'; ';
                    ?> padding-bottom: 44px;">
        <div class="wrapper">
            <?php if ( !empty($featured_video_title) ) : ?>
                <div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4 md:tw-mb-4" style="color: <?php echo !empty($featured_video_text_color) ? $featured_video_text_color : '#000'; ?>"><?php echo $featured_video_title; ?></div>
            <?php endif; ?>
            <video class="tw:w-full" controls>
                <source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
<?php endif; ?>