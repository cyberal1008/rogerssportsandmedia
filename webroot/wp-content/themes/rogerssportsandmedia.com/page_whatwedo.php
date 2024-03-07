<?php
/**
 * Template Name: What We Do
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin.css">
</head>
<?php get_header(); ?>

<main id="content" role="main" class="tw-bg-gray">

	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'subtitle'		=> 'What We Do',
				'title'     => 'Our Products',
			)
		);
	?>

	<!-- INTRO -->
	<?php
		$intro_title = get_field('intro_title');
		$intro_content = get_field('intro_content');
	?>
	<section class="tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96">
		<div class="tw-relative -tw-mt-16">
			<div class="tw-bg-white tw-px-6 md:tw-px-16 tw-py-6 md:tw-py-10 tw-mb-8">
				<?php if ($intro_title) : ?>
					<div class="tw-text-3xl md:tw-text-4xl tw-text-gray-dark tw-font-bold tw-mb-6"><?php echo $intro_title; ?></div>
				<?php endif; ?>
				<p class="tw-text-base tw-leading-7">
					<?php echo $intro_content; ?>
				</p>
			</div>
		</div>
	</section>

	<!-- SERVICES -->
	<?php if( have_rows('products') ) : ?>
		<section class="tw-bg-white tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96 tw-py-12">
			<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-16">
				<?php while( have_rows('products') ) : the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$excerpt = get_sub_field('excerpt');
					$link = get_sub_field('link');
					$link_arialabel = get_sub_field('link_arialabel');
				?>
					<div class="tw-flex tw-flex-col">
						<?php if ($image) : ?>
							<a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><img src="<?php echo $image['sizes']['large']; ?>"  class="tw-mb-4 tw-object-cover tw-object-center tw-h-[350px] tw-w-full" alt="<?php echo $image['alt']; ?>" loading="lazy"></a>
						<?php endif; ?>
						<?php if ($title) : ?>
							<div class="tw-text-3xl tw-mb-4 tw-font-bold tw-text-gray-dark"><?php echo $title; ?></div>
						<?php endif; ?>
						<?php if ($excerpt) : ?>
							<div class="tw-mb-3"><?php echo $excerpt; ?></div>
						<?php endif; ?>
						<?php if ($link) : ?>
							<a href="<?php echo $link['url']; ?>" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>" class="tw-text-gray-dark tw-font-bold tw-no-underline hover:tw-no-underline focus:tw-no-underline hover:tw-text-black visited:tw-text-black">
								<span class="tw-border-b-[3px] tw-py-1 tw-border-gray-light hover:tw-border-red">
									<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>
								</span>
							</a>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>

				<?php if( have_rows('products_grey_box') ) : while( have_rows('products_grey_box') ) : the_row(); 
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$excerpt = get_sub_field('excerpt');
					$link = get_sub_field('link');
					$link_arialabel = get_sub_field('link_arialabel');
				?>
					<div class="tw-text-white tw-px-6 md:tw-px-16 tw-py-24 md:tw-py-0 tw-flex tw-flex-col tw-justify-center" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bkg_red_03.jpg'); background-size: cover; background-position: center;">
						<?php if ($title) : ?>	
							<div class="tw-text-3xl tw-mb-6 tw-font-bold" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>"><?php echo $title; ?></div>
						<?php endif; ?>
						<?php if ($excerpt) : ?>
							<div class="tw-mb-16"><?php echo $excerpt; ?></div>
						<?php endif; ?>
						<?php if ($link) : ?>
						<div class="tw-inline-block">
							<a href="<?php echo $link['url']; ?>" class="tw-bg-white tw-px-4 tw-py-2 tw-text-base tw-font-medium tw-text-black tw-no-underline hover:tw-no-underline focus:tw-no-underline hover:tw-text-black visited:tw-text-black" aria-label="<?php echo $link_arialabel ? $link_arialabel : ''; ?>">
								<?php echo $link['title'] ? $link['title'] : 'Learn More'; ?>
							</a>
						</div>
						<?php endif; ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</section>
	<?php endif; ?>

</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
