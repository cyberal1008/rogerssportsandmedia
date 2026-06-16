<?php
$featured_video                  = get_sub_field( 'featured_video' );
$featured_video_title            = get_sub_field( 'featured_video_title' );
$featured_video_thumbnail        = get_sub_field( 'featured_video_thumbnail' );
$featured_video_background_color = get_sub_field( 'featured_video_background_color' );
$featured_video_text_color       = get_sub_field( 'featured_video_text_color' );

if ( ! $featured_video ) {
	return;
}
?>
<section
	style="background-color: <?php echo ! empty( $featured_video_background_color ) ? $featured_video_background_color : 'rgb(245, 245, 245)'; ?>; margin: 0; padding: 50px 0;"
	class="featured-video-section"
>
	<div class="wrapper">
		<?php if ( ! empty( $featured_video_title ) ) : ?>
			<h2 class="flex-section-title" style="color: <?php echo ! empty( $featured_video_text_color ) ? $featured_video_text_color : '#000'; ?>"><?php echo $featured_video_title; ?></h2>
		<?php endif; ?>
		<video class="tw:w-full" controls<?php echo $featured_video_thumbnail ? ' poster="' . esc_url( $featured_video_thumbnail['url'] ) . '"' : ''; ?>>
			<source src="<?php echo $featured_video['url']; ?>" type="video/mp4">
			Your browser does not support the video tag.
		</video>
	</div>
</section>
