<?php
/**
 * Template Name: Flexible Page Builder
 *
 */

get_header();
?>

<main id="content" role="main" class="tw-bg-gray">

	<?php
	$show_section_nav = ! (bool) get_field( 'disable_section_nav' );
	$section_count    = 0;

	if ( have_rows( 'page_sections' ) ) :
		$count = 1;
		while ( have_rows( 'page_sections' ) ) : the_row();
			$layout = get_row_layout();
			echo '<div id="flex-section-' . (int) $count . '" class="flex-section" data-layout="' . esc_attr( $layout ) . '">';
			switch ( $layout ) {
				case 'hero':
					get_template_part( 'template-parts/layout-hero' );
					break;
				case 'intro':
					get_template_part( 'template-parts/layout-intro' );
					break;
				case 'featured_video':
					get_template_part( 'template-parts/layout-featured-video', null, array( 'count' => $count ) );
					break;
				case 'show_slider':
					get_template_part( 'template-parts/layout-show-slider', null, array( 'count' => $count ) );
					break;
				case 'video_slider':
					get_template_part( 'template-parts/layout-video-slider', null, array( 'count' => $count ) );
					break;
				case 'images':
					get_template_part( 'template-parts/layout-images' );
					break;
				case 'highlights':
					get_template_part( 'template-parts/layout-highlights' );
					break;
				case 'hero_wipe_slider':
					get_template_part( 'template-parts/layout-hero-wipe-slider' );
					break;
				case 'story_slider':
					get_template_part( 'template-parts/layout-story-slider' );
					break;
				case 'video_hero':
					get_template_part( 'template-parts/layout-video-hero' );
					break;
				case 'cta':
					get_template_part( 'template-parts/layout-cta' );
					break;
			}
			echo '</div>';
			$count++;
		endwhile;
		$section_count = $count - 1;
	endif;

	if ( $show_section_nav && $section_count > 1 ) {
		get_template_part( 'template-parts/section-dot-nav', null, array( 'count' => $section_count ) );
	}
	?>

</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
