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
<section class="tw-relative tw-h-96">
	<img src="<?php echo $hero_mobile_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" class="md:tw-hidden tw-object-cover tw-h-full tw-w-full tw-brightness-50">
	<img src="<?php echo $hero_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" class="tw-hidden md:tw-block tw-object-cover tw-h-full tw-w-full tw-brightness-50">
	<div class="tw-absolute tw-inset-0 tw-flex tw-items-center tw-justify-center tw-text-center">
		<div class="tw-text-white tw-text-4xl md:tw-text-5xl tw-font-bold"><?php echo $args['title'] ? $args['title'] : get_the_title(); ?></div>
	</div>
</section>