<?php
/**
 * Template Name: Flexible Page Builder
 *
 */

get_header();
?>

<main id="content" role="main" class="tw-bg-gray">

	<?php
	if ( have_rows( 'page_sections' ) ) :
		$count = 1;
		while ( have_rows( 'page_sections' ) ) : the_row();
			switch ( get_row_layout() ) {
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
			}
			$count++;
		endwhile;
	endif;
	?>

</main>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>

<?php
get_footer();
