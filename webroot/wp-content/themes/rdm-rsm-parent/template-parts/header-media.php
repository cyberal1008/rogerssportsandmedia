<?php
/** @var array $args */
global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>
<div class="bgimg">
	<?php if ( is_home() ) { ?>
		<img id="header-slide-prev" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-left.svg")?>" alt="prev" />
		<div id="header-carousel">
			<div class="fullscreen-video ">
				<div class=" element"></div>
				<header class="j-main">
					<div class="container head-container">
						<h1 class="display-3 j-title"><?php echo $args['hero_title']; ?></h1>
						<p class="lead j-desc"><?php echo $args['hero_desc']; ?></p>
						<?php if ( ! empty( $args['home_hero_btn_url'] ) && ! empty( $args['home_hero_btn_text'] ) ) { ?>
						<a href="<?php echo $args['home_hero_btn_url']; ?>" class="btn btn-primary btn-lg j-button"><?php echo $args['home_hero_btn_text']; ?></a>
						<?php } ?>
					</div>
				</header>
				<video id="video" muted playsinline autoplay loop
					   poster="<?php echo $args['image_url']; ?>" class="">
					<source id="mp4" src="" type="video/mp4">
					<p>Your user agent does not support the HTML5 Video element.</p>
				</video>
			</div>
			<div class="fullscreen-video ">
				<div class=" element"></div>
				<header class="j-main">
					<div class="container head-container">
						<h1 class="display-3 j-title"><?php echo $args['hero_title_2']; ?></h1>
						<p class="lead j-desc"><?php echo $args['hero_desc_2']; ?></p>
						<?php if ( ! empty( $args['home_hero_btn_url_2'] ) && ! empty( $args['home_hero_btn_text_2'] ) ) { ?>
						<a href="<?php echo $args['home_hero_btn_url_2']; ?>" class="btn btn-primary btn-lg j-button"><?php echo $args['home_hero_btn_text_2']; ?></a>
						<?php } ?>
					</div>
				</header>
				<video id="video" muted playsinline autoplay loop
					   poster="<?php echo $args['image_url_2']; ?>" class="">
					<source id="mp4" src="" type="video/mp4">
					<p>Your user agent does not support the HTML5 Video element.</p>
				</video>
			</div>
			<div class="fullscreen-video ">
				<div class=" element"></div>
				<header class="j-main">
					<div class="container head-container">
						<h1 class="display-3 j-title"><?php echo $args['hero_title_3']; ?></h1>
						<p class="lead j-desc"><?php echo $args['hero_desc_3']; ?></p>
						<?php if ( ! empty( $args['home_hero_btn_url_3'] ) && ! empty( $args['home_hero_btn_text_3'] ) ) { ?>
						<a href="<?php echo $args['home_hero_btn_url_3']; ?>" class="btn btn-primary btn-lg j-button"><?php echo $args['home_hero_btn_text_3']; ?></a>
						<?php } ?>
					</div>
				</header>
				<video id="video" muted playsinline autoplay loop
					   poster="<?php echo $args['image_url_3']; ?>" class="">
					<source id="mp4" src="" type="video/mp4">
					<p>Your user agent does not support the HTML5 Video element.</p>
				</video>
			</div>
		</div>
		<img id="header-slide-next" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-right.svg")?>" alt="next" />
	<?php } else { ?>
		<div class="fullscreen-video ">
			<div class=" element"></div>
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
					if ( ! empty( $page_meta['broadcast'] ) && ! empty( $page_meta['broadcast']['enable_image_uri'] ) && ! empty( $page_meta['broadcast']['enable_image_cb'] ) ) {
						?>
						<div class="upfronts">
							<img
									src="<?php echo esc_attr( $page_meta['broadcast']['enable_image_uri'] ); ?>"
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
			<video id="video" muted playsinline autoplay loop
					 poster="<?php echo $args['image_url']; ?>" class="">
				<source id="mp4" src="" type="video/mp4">
				<p>Your user agent does not support the HTML5 Video element.</p>
			</video>
		</div>
	<?php } ?>
</div>
