<?php
/**
 * Template Name: Audio
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<!DOCTYPE html>
<html lang="en" class="audio-landing">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/favicon.png" />
    <title>Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.css">
</head>
<?php get_header(); ?>

	<div class="portfolio-main">

		<?php
		$hero_title = get_field('hero_title');
		$hero_image = get_field('hero_image');
		$hero_mobile_image = get_field('hero_mobile_image');
		?>
		<section class="hero">
			<picture>
				<source srcset="<?php echo $hero_image['url']; ?>"
						media="(min-width: 640px)">
				<img src="<?php echo $hero_mobile_image['url']; ?>" class="bg" alt="<?php echo $hero_image['alt']; ?>" />
			</picture>

			<div class="wrapper">
				<span>What We Do</span>
				<h1><?php echo $hero_title ? $hero_title : get_the_title(); ?></h1>
			</div>
		</section>

		<!-- SKIP -->
		<a role="banner" href="#content" class="skip-to-content button" aria-label="Skip to main content" tabindex="0">Skip to main content</a>

		<main id="content" role="main">

			<section class="anchors">
				<div class="wrapper">
					<div class="anchor-list">
						<a href="#our-difference" aria-label="go to Our Difference content">Our Difference</a>
						<a href="#highlights" aria-label="go to Highlights content">Highlights</a>
						<a href="#trends" aria-label="go to Trends content">Trends</a>
						<a href="#stations-podcasts" aria-label="go to Stations and Podcasts content">Stations and Podcasts</a>
					</div>
				</div>
			</section>

			<?php
			$intro_title = get_field('intro_title');
			$intro_content = get_field('intro_content');
			$button_type = get_field('button_type');
			?>
			<section class="intro">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/curve-green.png" alt="" class="bg" loading="lazy">
				<div class="wrapper">
					<?php if ($intro_title) : ?>
						<h2 class="title h3"><?php echo $intro_title; ?></h2>
					<?php endif; ?>
					<?php echo $intro_content; ?>
					<?php
					if ($button_type == 'email') :
						$intro_button = get_field('intro_email');
						?>
						<a href="mailto:<?php echo $intro_button; ?>" class="button" aria-label="Get In Touch" target="_blank">Get In Touch</a>
						<?php
					else :
						$intro_button = get_field('intro_button');
						?>
						<a href="<?php echo $intro_button['url']; ?>" class="button" aria-label="<?php echo $intro_button['title']; ?>" target="<?php echo $intro_button['target']; ?>"><?php echo $intro_button['title']; ?></a>
						<?php
					endif;
					?>

					<div class="swiper logo-slider">
						<div class="swiper-wrapper">
							
							<!-- SINGLE -->
							<div class="swiper-slide">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/slide1.png" alt="Logos for CityNews 680, 98.1 CHFI, KiSS radio, Sportsnet 590 the Fan, Jack radio, 93.5 Country radio" loading="lazy">
							</div>
							<!-- SINGLE -->
							<div class="swiper-slide">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/slide2.png" alt="Logos for The Big Story podcast, 92.1 CITI, Sonic 102.9, 101.3 Easy radio, K Rock 105.7, Mountain FM" loading="lazy">
							</div>
						
						</div>
						<div class="swiper-pagination"></div>
					</div>

				</div>
			</section>

			<?php
			$diff_section_title = get_field('diff_section_title');
			$diff_content = get_field('diff_content');
			$diff_button = get_field('diff_button');
			?>
			<section id="our-difference" class="our-difference">
				<div class="wrapper">
					<div class="top">
						<?php if ($diff_section_title) : ?>
							<h2 class="title"><?php echo $diff_section_title; ?></h2>
						<?php endif; ?>
						<?php echo $diff_content; ?>
					</div>
					<div class="grid four">

						<?php if( have_rows('diff_column_1') ) : while( have_rows('diff_column_1') ) : the_row(); 
							$title = get_sub_field('title');
							$image = get_sub_field('image');
							$content = get_sub_field('content');
							?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-1" aria-expanded="false" aria-controls="accordion-1-content">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="mobile" loading="lazy">
										<?php echo $title; ?>
										<i class="fas fa-plus status plus"></i>
										<i class="fas fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-1-content" aria-labelledby="accordion-1">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="desktop" loading="lazy">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; endif; ?>

						<?php if( have_rows('diff_column_2') ) : while( have_rows('diff_column_2') ) : the_row(); 
							$title = get_sub_field('title');
							$image = get_sub_field('image');
							$content = get_sub_field('content');
							?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-2" aria-expanded="false" aria-controls="accordion-2-content">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="mobile" loading="lazy">
										<?php echo $title; ?>
										<i class="fas fa-plus status plus"></i>
										<i class="fas fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-2-content" aria-labelledby="accordion-2">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="desktop" loading="lazy">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; endif; ?>

						<?php if( have_rows('diff_column_3') ) : while( have_rows('diff_column_3') ) : the_row(); 
							$title = get_sub_field('title');
							$image = get_sub_field('image');
							$content = get_sub_field('content');
							?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-3" aria-expanded="false" aria-controls="accordion-3-content">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="mobile" loading="lazy">
										<?php echo $title; ?>
										<i class="fas fa-plus status plus"></i>
										<i class="fas fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-3-content" aria-labelledby="accordion-3">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="desktop" loading="lazy">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; endif; ?>

						<?php if( have_rows('diff_column_4') ) : while( have_rows('diff_column_4') ) : the_row(); 
							$title = get_sub_field('title');
							$image = get_sub_field('image');
							$content = get_sub_field('content');
							?>
							<div class="item">
								<div class="accordion">
									<button class="accordion-trigger" id="accordion-4" aria-expanded="false" aria-controls="accordion-4-content">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="mobile" loading="lazy">
										<?php echo $title; ?>
										<i class="fas fa-plus status plus"></i>
										<i class="fas fa-minus status minus"></i>
									</button>
									<div class="accordion-content" id="accordion-4-content" aria-labelledby="accordion-4">
										<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="desktop" loading="lazy">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						<?php endwhile; endif; ?>
					</div>
					<a href="#" aria-label="" class="button">Explore Our Buyers Guide</a>
				</div>
			</section>

			<section id="highlights" class="highlights">
				<div class="wrapper">
					<div class="grid four circle-stats">
						<?php if( have_rows('yellow_circle') ) : while( have_rows('yellow_circle') ) : the_row(); 
							$number = get_sub_field('number');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat yellow">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><span class="sign">+</span>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('green_circle') ) : while( have_rows('green_circle') ) : the_row(); 
							$number = get_sub_field('number');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat green">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('red_circle') ) : while( have_rows('red_circle') ) : the_row(); 
							$number = get_sub_field('number');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat red">
									<span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><span class="sign"><sup>%</sup></span>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('blue_circle') ) : while( have_rows('blue_circle') ) : the_row(); 
							$number = get_sub_field('number');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat teal">
									<span class="sign">#</span><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>

					<div class="grid banner-stats">
						<?php if( have_rows('banner_1') ) : while( have_rows('banner_1') ) : the_row(); 
							$number = get_sub_field('number');
							$number_text = get_sub_field('number_text');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat">
									<span class="num scroll-counter" data-counter-time="1000"><?php echo $number; ?></span><?php echo $number_text; ?>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('banner_2') ) : while( have_rows('banner_2') ) : the_row(); 
							$number = get_sub_field('number');
							$number_text = get_sub_field('number_text');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat">
									<span class="num scroll-counter" data-counter-time="1000"><?php echo $number; ?></span> <?php echo $number_text; ?>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('banner_3') ) : while( have_rows('banner_3') ) : the_row(); 
							$number = get_sub_field('number');
							$number_text = get_sub_field('number_text');
							$caption = get_sub_field('caption');
							?>
							<div class="item">
								<div class="stat">
									<span class="num scroll-counter" data-counter-time="1000"><?php echo $number; ?></span> <?php echo $number_text; ?>
								</div>
								<?php if ($caption) : ?>
									<p class="desc"><?php echo $caption; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</section>

			<?php
			$happening_section_title = get_field('happening_section_title');
			$happening_content = get_field('happening_content');
			?>
			<section id="trends" class="trends">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/triangles.svg" alt="" class="bg" loading="lazy">
				<div class="wrapper">
					<?php if ($happening_section_title) : ?>
						<h2 class="section-title"><?php echo $happening_section_title; ?></h2>
					<?php endif; ?>
					<?php echo $happening_content; ?>
					<?php
					$zone = 'whats-happening-radio';
					if ( function_exists( 'z_get_posts_in_zone' ) && ! empty( $zone ) ) {
						$the_query = z_get_zone_query( $zone );
					} else {
						$the_query = new WP_Query(
							array(
								'post_type'      => 'post',
								'posts_per_page' => 3,
								'post_status'    => 'publish',
								'post__not_in'   => array( get_the_ID() ),
							)
						);
					}
					?>
					<div class="grid">
						<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
							$featured_img_url   = get_the_post_thumbnail_url( get_the_ID(), 'wide-577' );
							$categories         = get_the_category();
							$post_meta          = get_post_meta( get_the_ID(), 'blog', true );
							?>
							<div class="item">
								<?php $title_formatted = ucwords(strtolower(get_the_title())); ?>
								<a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><img src="<?php echo $featured_img_url; ?>" alt="" loading="lazy"></a>
								<p class="date"><?php echo get_the_date( get_option( 'date_format' ) ); ?> / <?php echo $categories ? $categories[0]->name : ''; ?></p>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>" aria-label="read <?php echo $title_formatted; ?>"><?php echo $title_formatted; ?></a></h3>
								<div class="btn-wrap">
									<a href="<?php the_permalink(); ?>" aria-label="Read More">Read More</a>
								</div>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</section>

			<section id="stations-podcasts" class="stations-podcasts">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/curve-yellow.svg" alt="" class="bg" loading="lazy">
				<div class="wrapper">
					<h2 class="section-title">STATIONS AND PODCASTS</h2>
					<div class="portfolio-page">
							<?php
							get_template_part(
							'template-parts/portfolio',
							'radio',
							array(
								'page_id'       => get_the_ID()
							)
						); ?>
					</div>
				</div>
			</section>

			<section id="partner" class="partner">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/diamond-green.svg" alt="" class="bg bg1" loading="lazy">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/circle-white.svg" alt="" class="bg bg2" loading="lazy">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/images/group-red.png" alt="" class="bg bg3" loading="lazy">
				<div class="wrapper">
					<h2 class="section-title">PARTNER WITH US TODAY</h2>

					<iframe src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/r2bks1awm2k"
						width="100%" height="820" allowfullscreen sandbox="allow-same-origin allow-scripts allow-popups allow-forms" title="partner with us today by filling out the form below">
						<p>Sorry, your browser does not support iframes.</p>
					</iframe>

				</div>
			</section>

		</main>

		<script src="https://kit.fontawesome.com/b2f2db8aa3.js" data-search-pseudo-elements crossorigin="anonymous"></script>
	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/audio-landing/main.min.js"></script>

	</div>
<?php
get_footer();
