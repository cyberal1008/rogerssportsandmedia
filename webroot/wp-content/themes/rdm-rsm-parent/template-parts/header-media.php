<?php
/** @var array $args */
global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>
<div class="bgimg">
	<div class="fullscreen-video ">
		<div class=" element"></div>
		<?php if ( is_home() ) { ?>
		<header class="j-main">
			<div class="container head-container">
				<h1 class="display-3 j-title"><?php echo $args['hero_title']; ?></h1>
				<p class="lead j-desc"><?php echo $args['hero_desc']; ?></p>
				<?php if ( ! empty( $args['home_hero_btn_url'] ) && ! empty( $args['home_hero_btn_text'] ) ) { ?>
				<a href="<?php echo $args['home_hero_btn_url']; ?>" class="btn btn-primary btn-lg j-button"><?php echo $args['home_hero_btn_text']; ?></a>
				<?php } ?>
			</div>
		</header>
	<?php } else { ?>
		<div class="portfolio-header jumbotron j-main d-flex justify-content-center align-items-center">
			<div>
				<?php
				if ( $post->post_parent ) {
					?>
					<div class="text-center parent-url">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>">
							<?php echo get_the_title( $post->post_parent ); ?>
						</a>
					</div>
					<?php
				}
				if ( get_post_field( 'post_name' ) === 'television-and-streaming' || get_post_field( 'post_name' ) === 'upfront' ) {
					?>
					<div class="upfronts">
						<img
								src="<?php echo get_template_directory_uri() . '/assets/images/logo-upfront.png'; ?>"
								alt="<?php echo esc_attr( get_the_title() ); ?>"/>
						<h1><?php echo esc_html( get_the_title() ); ?></h1>
					</div>
					<?php
				} else {
					?>
					<h1 class="display-3 j-title text-center">
						<?php echo esc_html( get_the_title() ); ?>
					</h1>
					<?php
				}
				?>
			</div>
		</div>
	<?php } ?>
		<video id="video" muted playsinline autoplay loop
			   poster="<?php echo $args['image_url']; ?>" class="">
			<source id="mp4" src="<?php echo $args['video_url']; ?>" type="video/mp4">
			<p>Your user agent does not support the HTML5 Video element.</p>
		</video>
	</div>
</div>
