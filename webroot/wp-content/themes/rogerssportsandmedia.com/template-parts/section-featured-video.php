<?php
    $featured_video = get_field('featured_video');
    if ($featured_video) :
?>
    <section class="tw-bg-gray" style="<?php echo get_field('featured_video_at_page_bottom') ? 'padding-top: 20px;' : '';?> padding-bottom: 20px;">
        <div class="wrapper">
            <video class="tw:w-full" controls>
                <source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>
<?php endif; ?>