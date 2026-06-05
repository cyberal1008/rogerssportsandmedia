<?php

$default_image = get_template_directory_uri() . 'assets/images/missing-image-portrait.png';

if ( ! isset( $args ) || empty( $args['slider_videos'] ) || empty( $args['slider_name'] ) ) {
	return '';
}
$slider_videos = $args['slider_videos'];
$slider_name = $args['slider_name'];
$text_color = empty( $args['text_color'] ) ? '#000' : $args['text_color'];
?>
<div class="slider" style="opacity: 1;">
	<div class="swiper <?php echo $slider_name; ?>-slider show-slider videos-slider">
		<div class="swiper-wrapper">
			<?php
			// js var for programming grid modal
			$jsvar = array();
			$prog_ctr = 0;
			foreach ( $slider_videos as $video ) : $prog_ctr++;
				$video_title = $video['title'];
				$video_description = $video['description'];
				$video_image = $video['image']; //size 214 x 120px
				$video_id = $video_image['id'];
				$video_file = $video['file'];

				if( !empty( $video_image ) ) {
					$img_tag = '<img src="' . esc_url($video_image['url']) . '" alt="' . esc_attr($video_image['alt']) . '" width="214" height="120" />';
				}
				?>
				<div class="swiper-slide">
					<div class="inner">
						<div class="imgbox">
							<a href="#prog-popup-<?php echo $video_id; ?>" aria-label="read about <?php echo esc_html( $video_title ); ?>" data-fancybox>
								<?php echo $img_tag; ?>
							</a>
						</div>
						<p class="title h4"><a style="color: <?php echo $text_color; ?>" href="#prog-popup-<?php echo $prog_ctr; ?>" aria-label="read about <?php echo esc_html( $video_title ); ?>" data-fancybox><?php echo esc_html( $video_title ); ?></a></p>
					</div>
					<div id="prog-popup-<?php echo $video_id; ?>" class="prog-popup popup">
						<div class="inner" style="position: relative;">
							<a href="#" class="back" data-fancybox-close aria-label="Back to content">Back</a>

							<p class="title h2"><?php echo esc_html( $video_title ); ?></p>
							<p><?php echo esc_html( $video_description ); ?></p>
							<video style="display:block; width:auto; height:auto; max-width:100%; max-height:60vh; margin:20px auto 0;" controls>
								<source src="<?php echo $video_file['url']; ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
					</div>
				</div>
			<?php endforeach; wp_reset_query(); ?>
		</div>
	</div>
	<div class="navi">
		<div class="swiper-button-prev <?php echo $slider_name; ?>-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
		<div class="swiper-button-next <?php echo $slider_name; ?>-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
	</div>
</div>
<?php
