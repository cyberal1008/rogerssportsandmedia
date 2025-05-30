<?php
/**
 * Template Name: Upfront 2025
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
?>

<main id="content" role="main" class="tw-bg-gray">

	<!-- HERO -->
	<?php
		get_template_part('template-parts/section-hero');
	?>

	<!-- Upfront CTA -->
	<?php
	$upfront_cta_background_color = get_field( 'upfront_cta_background_color' );
	$upfront_cta_text_color = get_field( 'upfront_cta_text_color' );
	$upfront_cta_title = get_field( 'upfront_cta_title' );
	$upfront_cta_link = get_field( 'upfront_cta_link' );
	$upfront_cta_image = get_field( 'upfront_cta_image' );
	
	if( $upfront_cta_link && $upfront_cta_image ) :
		?>
		<section class="upfront-cta-section" style="background-color: <?php echo $upfront_cta_background_color ? $upfront_cta_background_color : '#000'; ?>">
            <div class="wrapper">
				<?php if ( $upfront_cta_title ) : ?>
					<h2 class="upfront-cta-title tw-text-3xl md:tw-text-4xl tw-font-bold" style="color: <?php echo $upfront_cta_text_color ? $upfront_cta_text_color : '#fff'; ?>"><?php echo $upfront_cta_title; ?></h2>
				<?php endif ?>
				<a href="<?php echo $upfront_cta_link['url']; ?>">
					<img src="<?php echo $upfront_cta_image['url']; ?>" width="800"/>
				</a>
			</div>
		</section>
		<?php
	endif;
	?>

	<!-- Upfront Highlights -->
    <?php if( have_rows('upfront_highlights') ) : 
		$highlights_title = get_field( 'upfront_highlights_title' );
		$highlights_background_color = !empty( get_field( 'upfront_highlights_background_color' ) ) ? get_field( 'upfront_highlights_background_color' ) : '#000';
		$highlights_descriptions_text_color = !empty( get_field( 'upfront_highlights_descriptions_text_color' ) ) ? get_field( 'upfront_highlights_descriptions_text_color' ) : '#fff' ;
		
		?>
        <section class="upfront-highlights-section" style="background-color: <?php echo $highlights_background_color ?>">
            <div class="wrapper">
				<h2 class="upfront-highlights-title tw-text-3xl md:tw-text-4xl tw-font-bold" style="color: <?php echo $highlights_descriptions_text_color ?>"><?php echo $highlights_title; ?></h2>
                <div class="upfront-highlights">
                    <?php while( have_rows('upfront_highlights') ) : the_row();
                        $thumbnail = get_sub_field('thumbnail');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                    ?>
                        <div class="upfront-highlight-card">
                            <div class="upfront-highlight-image-wrap">
								<img src="<?php echo $thumbnail['url']; ?>" alt="<?php echo $thumbnail['alt']; ?>">
							</div>
							<hr/>
							<h3 class="tw-text-2xl md:tw-text-3xl" style="color: <?php echo $highlights_descriptions_text_color ?>"><?php echo $title; ?></h3>
							<p style="color: <?php echo $highlights_descriptions_text_color ?>"><?php echo $description; ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Show Sliders -->
	<?php
	$show_sliders = get_field( 'show_sliders' );
	if ( !empty($show_sliders) ) {
		$count = 1;
		foreach ( $show_sliders as $slider ) {
			$slider_title = $slider['title'];
			$slider_button_link = $slider['button_link'];
			$slider_background_color = $slider['background_color'];
			$slider_text_color = $slider['text_color'];
			$slider_shows = $slider['shows'];

			?>
			<section class="programming" style="background-color: <?php echo $slider_background_color; ?>; color: <?php echo $slider_text_color; ?>; margin: 0; padding: 50px 0;">
				<div class="portfolio-main">
					<div class="portfolio-page">
						<div class="inner wrapper">
							<div class="top md:tw-space-x-12" style="gap: 0rem; justify-content: start;">
								<?php if ($slider_title) : ?>
									<h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold" style="color: <?php echo $slider_text_color; ?>"><?php echo $slider_title; ?></h2>
								<?php endif; ?>
								<?php if ($slider_button_link) : ?>
									<a href="<?php echo $slider_button_link['url']; ?>" class="button" aria-label="<?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?>" target="<?php echo $slider_button_link['target'] ? $slider_button_link['target'] : '_self'; ?>"><?php echo $slider_button_link['title'] ? $slider_button_link['title'] : 'Download TV Schedule'; ?></a>
								<?php endif; ?>
							</div>

							<?php
								get_template_part(
									'template-parts/shows',
									'slider',
									array(
										'slider_name'  => 'shows-slider-'.$count,
										'filter'       => false,	
										'slider_shows' => $slider_shows,
										'text_color'   => $slider_text_color
									)
								);
							?>
						</div>
					</div>
				</div>
			</section>
			<?php
			$count++;
		}
	}

	$upfront_calendar_title = get_field( 'upfront_calendar_title' );
	$upfront_calendar_image = get_field( 'upfront_calendar_image' );
	if ( $upfront_calendar_image ) {
		?>
		<section class="upfront-calendar">
			<?php if ( $upfront_calendar_title ) : ?>
				<h2 class="upfront-calendar-title tw-text-3xl md:tw-text-4xl tw-font-bold"><?php echo $upfront_calendar_title; ?></h2>
			<?php endif; ?>
			<div class="wrapper">
				<img class="calendar-image" src="<?php echo $upfront_calendar_image['url']; ?>"/>
			</div>
		</section>
		<?php
	}
	?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
