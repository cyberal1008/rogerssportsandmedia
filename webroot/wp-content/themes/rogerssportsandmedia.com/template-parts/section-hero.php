<?php
if (is_category()) : 
	$term = get_queried_object();
	$hero_title = get_field('hero_title', $term);
	$hero_image = get_field('hero_image', $term);
	$hero_mobile_image = get_field('hero_mobile_image', $term);
else : 
	$hero_title = get_field('hero_title');
	$hero_image = get_field('hero_image');
	$hero_mobile_image = get_field('hero_mobile_image');
endif; 
?>
<section class="hero">
	<picture>
		<source srcset="<?php echo $hero_image['url']; ?>"
				media="(min-width: 640px)">
		<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
	</picture>

	<div class="wrapper">
		<?php if ($args['subtitle']) : ?>
			<span><?php echo $args['subtitle']; ?></span>
		<?php endif; ?>
		<h1><?php echo $args['title'] ? $args['title'] : get_the_title(); ?></h1>
	</div>
</section>