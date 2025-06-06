<?php
    $featured_video = get_field('featured_video');
    if ($featured_video) :
?>
    <section class="tw-bg-gray">
        <div class="wrapper">
            <video class="tw:w-full" controls>
                <source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
         <div style="padding-bottom: 20px;">&nbsp;</div>
    </section>
<?php endif; ?>