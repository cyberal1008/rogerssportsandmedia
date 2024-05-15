<?php
$vidslider_vis = get_field('vidslider_vis');
if ($vidslider_vis == 'Visible') :
	$vidslider_section_title = get_field('vidslider_section_title');
	$vidslider_intro_content = get_field('vidslider_intro_content');
	?>
	<section id="capabilities" class="vidblock">
		<div class="inner wrapper">

			<div class="topblock">
				<?php if ($vidslider_section_title) : ?>
					<h2 class="section-title tw-text-gray-dark"><?php echo $vidslider_section_title; ?></h2>
				<?php endif; ?>
				<?php echo $vidslider_intro_content ? $vidslider_intro_content : ''; ?>
			</div>
						
			<?php if( have_rows('videoslider') ) : ?>
				<div class="slider">
					<div class="swiper vid-slider">
						<div class="swiper-wrapper">
										
							<?php $vid_ctr = 0; while( have_rows('videoslider') ) : the_row(); $vid_ctr++;
								$title = get_sub_field('title');
								$description = get_sub_field('description');
								$video_embed_code = get_sub_field('video_embed_code');
								$preview_image = get_sub_field('preview_image');
								?>
								<div class="swiper-slide">
									<div class="inner">
										<div class="playbox">
											<img src="<?php echo $preview_image['sizes']['medium_large']; ?>" alt="<?php echo $preview_image['alt']; ?>" loading="lazy">
											<a href="#vid-popup-<?php echo $vid_ctr; ?>" class="trigger" aria-label="<?php echo $title; ?>" data-fancybox><i class="icon fa-sharp fa-solid fa-play"></i></a>
										</div>
										<?php if ($title) : ?>
											<p class="title h4"><?php echo $title; ?></p>
										<?php endif; ?>
									</div>
									<div id="vid-popup-<?php echo $vid_ctr; ?>" class="vid-popup popup">
										<div class="inner">
											<a href="#" class="back" data-fancybox-close aria-label="Back to content">Back</a>
											<?php if ($video_embed_code) : ?>
												<div class="iframe-wrap">
													<?php echo $video_embed_code; ?>
												</div>
											<?php endif; ?>
											<?php if ($title) : ?>
												<p class="title h4"><?php echo $title; ?></p>
											<?php endif; ?>
											<?php if ($description) : ?>
												<p><?php echo $description; ?></p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endwhile; ?>

						</div>
						<div class="swiper-pagination"></div>
					</div>

					<div class="navi">
						<div class="swiper-button-prev vid-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
						<div class="swiper-button-next vid-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>