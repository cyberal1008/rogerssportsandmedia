<?php
/**
 * Template Name: Who We Are
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

global $post;
$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );

$anchors = array(
 	'whoweare-about-anchor' => 'About',
 	'community-causes-anchor' => 'Community & Causes',
);

$whats_happening_exists = ! empty( $page_meta['zones'] ) && ! empty( $page_meta['zones']['whats_happening'] );

// html for community & causes header (should be embedded in page content)
// <div class="community-causes-container-main"><h2 id="community-causes-anchor" class="community-causes-title" tabindex="-1">COMMUNITY &amp; CAUSES</h2></div>

get_header(); ?>
	<div class="whoweare-main">
		<div class="cat-header">
			<p class="cat-page-title text-center">Who We Are</p>
			<div class="cat-page-desc text-center"><p>WE ARE RSM</p></div>
		</div>
		<div class="whoweare-anchors">
			<?php get_template_part( 'template-parts/portfolio', 'anchors', $anchors ); ?>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-11 col-lg-8 single-article-container mx-auto" role="main">
					<div class="about-container-main">
						<h2 class="about-container-title" id="whoweare-about-anchor" tabindex="-1">ABOUT</h2>
					</div>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<?php if ( $whats_happening_exists ) {
			$zone = $page_meta['zones']['whats_happening'];
			$zone = ( function_exists( 'z_get_zone' ) && z_get_zone( $zone ) ) ? $zone : '';
			get_template_part( 'template-parts/content', 'happening', $zone );
		}
		get_template_part( 'template-parts/content', 'join-our-team' ); ?>
	</div>
<?php
get_footer();
