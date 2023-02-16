<div class="homehero bgimg">
	<?php if( have_rows('hero_slides') ): ?>
		<img id="header-slide-prev" class="slide-control" src="<?php echo (get_stylesheet_directory_uri() . "/assets/home/images/slider-prev.svg")?>" alt="prev" />
		<div id="hero-carousel" class="">
			<?php while( have_rows('hero_slides') ): the_row(); 
				$image = get_sub_field('image');
				$mobile_image = get_sub_field('mobile_image');
				$title = get_sub_field('title');
				$blurb = get_sub_field('blurb');
				$button = get_sub_field('button');
				$button_arialabel = get_sub_field('button_arialabel');
				?>
				<div class="slide">
					<picture class="bg">
						<source srcset="<?php echo $image['url']; ?>"
								media="(min-width: 640px)">
						<img src="<?php echo $mobile_image ? $mobile_image['url'] : $image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
					</picture>
					<div class="wrapper">
						<div class="txtbox" role="region" aria-label="<?php echo $title; ?>">
							<?php if ($title) : ?>
								<h1 class="title"><?php echo $title; ?></h1>
							<?php endif; ?>
							<?php if ($blurb) : ?>
								<p><?php echo $blurb; ?></p>
							<?php endif; ?>
							<?php if ($button) : ?>
								<a href="<?php echo $button['url']; ?>" class="button" aria-label="<?php echo $button_arialabel ? $button_arialabel : ''; ?>" target="<?php echo $button['target'] ? $button['target'] : '_self'; ?>"><?php echo $button['title'] ? $button['title'] : 'Learn More'; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<img id="header-slide-next" class="slide-control" src="<?php echo (get_stylesheet_directory_uri() . "/assets/home/images/slider-next.svg")?>" alt="next" />
	<?php endif; ?>
</div>
