<?php
/** @var array $args */

if ( empty ( $args['video_id'] ) ) {
	return '';
}
?>

<div class="row portfolio-video no-gutters">
    <div class="col-12 col-md-8 px-auto px-md-4 portfolio-video-player align-self-center" data-video-id="<?php echo $args['video_id']; ?>"></div>
    <div class="col-12 col-md-4 portfolio-video-chapters d-flex">
        <div class="loading-wrapper">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
