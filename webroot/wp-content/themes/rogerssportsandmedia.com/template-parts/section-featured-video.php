<?php
    $featured_video = get_field('featured_video');
    $featured_video_title = get_field('featured_video_title');
    if ($featured_video) :
?>
    <section class="tw-bg-gray" style="<?php echo get_field('featured_video_at_page_bottom') ? 'padding-top: 44px;' : '';?> padding-bottom: 44px;">
        <div class="wrapper">
            <?php if ( !empty($featured_video_title) ) : ?>
                <div class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-mb-4 md:tw-mb-4" style="color: #000"><?php echo $featured_video_title; ?></div>
            <?php endif; ?>
            <video class="tw:w-full" controls>
                <source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
<?php endif; ?>