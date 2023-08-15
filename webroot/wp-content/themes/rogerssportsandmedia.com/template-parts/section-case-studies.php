<?php
$cs_vis = get_field('cs_vis');
if ($cs_vis == 'Visible') :
	$cs_section_title = get_field('cs_section_title');
	?>
	<section class="case-studies">
		<div class="inner wrapper">

			<?php if ($cs_section_title) : ?>
				<h2 class="section-title"><?php echo $cs_section_title; ?></h2>
			<?php endif; ?>

			<?php if( have_rows('c_studies') ) : ?>
				<div class="slider">
					<div class="swiper case-slider">
						<div class="swiper-wrapper">
										
							<?php while( have_rows('c_studies') ) : the_row();
								$postitem = get_sub_field('post_item');
								$postid = $postitem->ID;
								$link = get_the_permalink($postitem->ID);
								$intro_text = get_sub_field('intro_text');
								$intro_description = get_sub_field('intro_description');
								$feat_img_id = get_post_thumbnail_id($postid);
				                $feat_img = get_the_post_thumbnail_url($postid, 'large');
				                $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
				                $title = strlen($postitem->post_title) > 90 ? substr($postitem->post_title,0,90)."..." : $postitem->post_title;          
								?>
								<div class="swiper-slide">
									<div class="inner">
										<div class="txtbox">
											<h3 class="title h4"><?php echo $title ?></h3>
											<?php if ($intro_text) : 
												$intro_title_trim = strlen($intro_text) > 80 ? substr($intro_text,0,80)."..." : $intro_text;
												?>
												<p class="intro-line"><i><?php echo $intro_title_trim; ?></i></p>
											<?php endif; ?>
											<p class="content-title"><strong>OVERVIEW</strong></p>
											<div class="content">
												<?php if ($intro_description) : 
													$desc_trim = strlen($intro_description) > 260 ? substr($intro_description,0,260)."..." : $intro_description;
													echo $desc_trim;
													?>
												<?php endif; ?>
												<a href="<?php echo $link; ?>" class="button mobile" aria-label="Read Full Story: <?php echo $postitem->post_title; ?>">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
											</div>		
										</div>
										<div class="imgbox">
											<?php if ($feat_img) : ?>
												<img src="<?php echo $feat_img; ?>" alt="<?php echo $alt; ?>" loading="lazy">
											<?php endif; ?>
											<a href="<?php echo $link; ?>" class="button desktop" aria-label="Read Full Story: <?php echo $postitem->post_title; ?>">Read Full Story <i class="icon fa-sharp fa-regular fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
				
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<div class="navi">
						<div class="swiper-button-prev case-prev"><i class="icon fa-solid fa-sharp fa-chevron-left"></i></div>
						<div class="swiper-button-next case-next"><i class="icon fa-solid fa-sharp fa-chevron-right"></i></div>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</section>
<?php endif; ?>