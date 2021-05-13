<?php
/** @var array $args */

if ( empty ( $args['video_id'] ) ) {
	return '';
}
?>

<div class="row portfolio-video justify-content-center align-items-center">
    <div class="col-12 col-md-8 portfolio-video-player" data-video-id="<?php echo $args['video_id']; ?>">
    </div>
</div>
