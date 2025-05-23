<?php
/**
 * Template Name: HGTV
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
        if (is_category()) : 
            $term = get_queried_object();
            $hero_image = get_field('hero_image', $term);
            $hero_mobile_image = get_field('hero_mobile_image', $term);
        else :
            $hero_image = get_field('hero_image');
            $hero_mobile_image = get_field('hero_mobile_image');
        endif;
        
        if ( $hero_image && $hero_mobile_image ) {
            ?>
            <section class="tw-w-full">
                <img class="tw-hidden md:tw-block" src="<?php echo $hero_image['url']; ?>" />
                <img class="md:tw-hidden" src="<?php echo $hero_mobile_image['url']; ?>" alt="<?php echo $hero_image['alt']; ?>" />
            </section>
            <?php
        }
    ?>

	<!-- INTRO -->
    <?php
        get_template_part('template-parts/section-intro');
    ?>

    <section class="tw-mt-12">&nbsp;</section>

    <!-- Show Sliders -->
	<?php
	$show_sliders = get_field( 'show_sliders' );
	if ( !empty($show_sliders) ) {
		// echo '<pre>';
		// print_r($show_sliders);
		// echo '</pre>';
		// exit;
		$count = 1;
		foreach ( $show_sliders as $slider ) {
			$slider_title = $slider['title'];
			$slider_button_link = $slider['button_link'];
			$slider_background_color = $slider['background_color'];
			$slider_text_color = $slider['text_color'];
			$slider_shows = $slider['shows'];

			?>
			<section class="programming" style="background-color: <?php echo $slider_background_color; ?>; color: <?php echo $slider_text_color; ?>; margin: 0; padding: 100px 0;">
				<div class="portfolio-main">
					<div class="portfolio-page">
						<div class="inner wrapper">
							<div class="top md:tw-space-x-12" style="gap: 0rem; justify-content: start;">
								<?php if ($slider_title) : ?>
									<div class="tw-text-4xl md:tw-text-5xl tw-font-bold tw-mb-4 md:tw-mb-4" style="color: <?php echo $slider_text_color; ?>"><?php echo $slider_title; ?></div>
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
	?>

	<!-- Highlights -->
    <?php if( have_rows('highlights') ) : 
		$highlights_numbers_text_color = !empty( get_field( 'highlights_numbers_text_color' ) ) ? get_field( 'highlights_numbers_text_color' ) : '#da291c';
		$highlights_background_color = !empty( get_field( 'highlights_background_color' ) ) ? get_field( 'highlights_background_color' ) : '#000';
		$highlights_descriptions_text_color = !empty( get_field( 'highlights_descriptions_text_color' ) ) ? get_field( 'highlights_descriptions_text_color' ) : '#fff' ;
		
		?>
        <section id="highlights" class="tw-w-full" style="background-color: <?php echo $highlights_background_color ?>">
            <div class="wrapper" style="padding: 60px 0;">
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16">
                    <?php while( have_rows('highlights') ) : the_row();
                        $number = get_sub_field('number');
                        $number_text = get_sub_field('number_text');
                        $text = get_sub_field('text');
                        $circle_color = get_sub_field('circle_color');
                    ?>
                        <div class="tw-full md:tw-w-1/4">
                        <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="-webkit-text-stroke: 2px <?php echo $highlights_numbers_text_color ?>;">
                            <?php if ($number) : ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php endif; ?>
                            <?php if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
                        </div>
                            <div style="color: <?php echo $highlights_descriptions_text_color ?>"><?php echo $text; ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
