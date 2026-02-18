<?php
/**
 * The Latest Category template.
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
    <title><?php echo single_cat_title("", false); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
</head>
<?php get_header(); ?>

<!-- MAIN -->
<main id="content" role="main">

	<?php
	if (isset($_GET["searchterm"])) {
		$searchterm = $_GET["searchterm"];
	} else {
		$searchterm = '';
	}
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$current_cat_id = get_query_var( 'cat' );
	$current_cat_link = get_category_link($current_cat_id);
	?>

	<!-- FILTERS -->
	<section class="posts-filters" style="background-color: var(--light-light); font-size: 10px;">
		<div class="inner wrapper">
			<p class="topic-label">Search articles or browse topics:</p>

				<form id="searchform" role="search" method="get" class="searchform" action="<?php echo $current_cat_link; ?>">
					<div class="keyword">
						<i class="icon fa-regular fa-magnifying-glass"></i>
						<input type="search" placeholder="Enter search term here..." name="searchterm" id="searchterm">
						<button id="searchsubmit" type="submit" class="button" value="Search" role="button" aria-label="submit search">Search</button>
					</div>
				</form>
				<div class="btns">
					<div class="tablist" role="tablist" aria-label="events, artsboards and news">
						<button class="trigger filter-tab button" role="tab" aria-selected="true" aria-controls="tab-content-all" id="tab-all">
							All Topics
						</button>
						<button class="trigger filter-tab button" role="tab" aria-selected="false" aria-controls="tab-content-it" id="tab-it" tabindex="-1">
							Insights & Trends
						</button>
						<div class="accordion">
							<button class="accordion-trigger" id="accordion-1" type="button" aria-expanded="false" aria-controls="accordion-1-content">
								Media Releases
								<i class="fa-solid fa-chevron-down status"></i>
							</button>
							<div class="accordion-content" id="accordion-1-content" aria-labelledby="accordion-1">
								<div class="droplinks">
									<button class="trigger filter-tab button" role="tab" aria-selected="false" aria-controls="tab-content-aud" id="tab-aud" tabindex="-1">
										Audio
									</button>
									<button class="trigger filter-tab button" role="tab" aria-selected="false" aria-controls="tab-content-sport" id="tab-sport" tabindex="-1">
										Sports
									</button>
									<button class="trigger filter-tab button" role="tab" aria-selected="false" aria-controls="tab-content-tv" id="tab-tv" tabindex="-1">
										TV + Streaming
									</button>
									<button class="trigger filter-tab button" role="tab" aria-selected="false" aria-controls="tab-content-oth" id="tab-oth" tabindex="-1">
										Other
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</section>

	<!-- HERO + FEATURED (visible only on All Topics) -->
	<div id="hero-block">
		<?php
			get_template_part(
				'template-parts/section-hero', null,
				array(
					'title' => 'The Latest',
				)
			);
		?>

		<?php
		$first_query = new WP_Query(
			array(
				'post__not_in'   => get_option( 'sticky_posts' ),
				'post_type'      => 'post',
				'orderby'        => 'date',
				'post_date'      => 'DESC',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'paged'          => $paged,
				'category__in'   => $current_cat_id,
			)
		);
		if ( $first_query->have_posts() ) : while ( $first_query->have_posts() ) : $first_query->the_post();
			$link = get_the_permalink();
			$title = get_the_title();
			$excerpt = get_the_excerpt();
			$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
			$feat_img_id = get_post_thumbnail_id(get_the_ID());
			$alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
			$categories = get_the_category();
			?>
			<section class="splitblock splitblock--hero">
				<a href="<?php echo $link; ?>" class="wrapper grid two" aria-label="<?php echo $title; ?>">
					<div class="imgbox">
						<img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt; ?>">
					</div>
					<div class="txtbox">
						<div class="meta">
							<?php if ( ! empty( $categories ) ) : ?>
								<span class="cat"><?php echo $categories[0]->name; ?></span>
							<?php endif; ?>
							<span class="date"><?php echo get_the_date( get_option( 'date_format' ) ); ?></span>
						</div>
						<p class="title"><?php echo $title; ?></p>
					</div>
				</a>
			</section>
		<?php endwhile; endif; wp_reset_postdata(); ?>
	</div>

	<!-- POSTS -->
	<section class="post-tabs">
		<!-- TAB - ALL -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-all" aria-labelledby="tab-all">
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="the-latest" scroll="false" transition_container="false" css_classes="wrapper grid" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

		<!-- TAB - INSIGHTS & TRENDS -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-it" aria-labelledby="tab-it" hidden>
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="events" scroll="false" transition_container="false" css_classes="wrapper grid" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

		<!-- TAB - AUDIO -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-aud" aria-labelledby="tab-aud" hidden>
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="the-latest" scroll="false" transition_container="false" css_classes="wrapper grid" tag="audio" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

		<!-- TAB - SPORTS -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-sport" aria-labelledby="tab-sport" hidden>
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="the-latest" scroll="false" transition_container="false" css_classes="wrapper grid" tag="sports" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

		<!-- TAB - TV & STREAMING -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-tv" aria-labelledby="tab-tv" hidden>
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="the-latest" scroll="false" transition_container="false" css_classes="wrapper grid" tag="television-and-streaming" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

		<!-- TAB - OTHER -->
		<div class="tabcontent" tabindex="0" role="tabpanel" id="tab-content-oth" aria-labelledby="tab-oth" hidden>
			<section class="posts-grid">
				<?php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="the-latest" scroll="false" transition_container="false" css_classes="wrapper grid " tag="other" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
				<?php //  do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="6" category="whats-happening,community" scroll="false" transition_container="false" css_classes="wrapper grid" search="' . $searchterm . '" no_results_text="Sorry, no posts matched your criteria."]'); ?>
			</section>
		</div>

	</section>

</main>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.js"></script>
<script>
(function() {
	var heroBlock = document.getElementById('hero-block');
	if (!heroBlock) return;
	document.querySelectorAll('.posts-filters .filter-tab').forEach(function(tab) {
		tab.addEventListener('click', function() {
			if (this.id === 'tab-all') {
				heroBlock.style.display = '';
			} else {
				heroBlock.style.display = 'none';
			}
		});
	});
})();
</script>

<?php
get_footer();
