<?php
/** @var array $args */
?>
<div class="fullscreen-video ">
    <div class=" element"></div>
    <video id="video" muted playsinline autoplay loop
           poster="<?php echo $args['image_url']; ?>" class="">
        <source id="mp4" src="<?php echo $args['video_url']; ?>" type="video/mp4">
        <p>Your user agent does not support the HTML5 Video element.</p>
    </video>
</div>