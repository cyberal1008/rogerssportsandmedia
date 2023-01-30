<?php
/**
 * Template Name: Ad Manager
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
    <title>Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/main.min.css">
	<?php facebook_pixel_code(); ?>
</head>

	<body>

	    <!-- SKIP -->
		<a role="banner" href="#content" class="skip-to-content button">Skip to Content</a>

		<?php
		$header_link_text = get_field('header_link_text');
		$header_link = get_field('header_link');
		$grey_button_text = get_field('grey_button_text');
		$grey_button_link = get_field('grey_button_link');
		$red_button_text = get_field('red_button_text');
		$red_button_link = get_field('red_button_link');
		?>

	    <!-- HEADER -->
		<div class="header-wrapper">
			<a href="https://go.rogerssportsandmedia.com/sign-up" class="top-banner">To help get you started, we'll give you $250 CAD in ad credit when you spend $500 CAD. Use <b>Promo Code GET250</b> at checkout.</a>
			<header>
				<a id="logo" role="button" class="logo" aria-label=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/logo-landing.svg" alt="logo"></a>
				<nav class="main">
					<ul id="aoda_nav" aria-label="main navigation" role="group">
						<?php if ($header_link && $header_link_text) : ?>
							<li role="listitem"><a href="<?php echo $header_link; ?>" aria-label="<?php echo $header_link_text; ?>" target="_blank"><?php echo $header_link_text; ?></a></li>
						<?php endif; ?>
						<?php if ($grey_button_link && $grey_button_text) : ?>
							<li role="listitem"><a href="<?php echo $grey_button_link; ?>" class="button light" aria-label="<?php echo $grey_button_text; ?>" target="_blank"><?php echo $grey_button_text; ?></a></li>
						<?php endif; ?>
						<?php if ($red_button_link && $red_button_text) : ?>
							<li role="listitem"><a href="<?php echo $red_button_link; ?>" class="button" aria-label="<?php echo $red_button_text; ?>" target="_blank"><?php echo $red_button_text; ?></a></li>
						<?php endif; ?>
					</ul>
				</nav>
			</header>
		</div>

		<main id="content">

			<?php
			$hero_title = get_field('hero_title');
			$hero_subtitle = get_field('hero_subtitle');
			$video = get_field('video');
			$logos = get_field('logos');
			$hero_button_text = get_field('hero_button_text');
			$hero_button_link = get_field('hero_button_link');
			?>
			<section class="hero">
				<div class="wrapper">
					<?php if ($hero_title) : ?>
						<h1 class="title"><?php echo $hero_title; ?></h1>
					<?php endif; ?>
					<div class="hero-left">
						<?php if ($hero_subtitle) : ?>
							<p class="desc"><?php echo $hero_subtitle; ?></p>
						<?php endif; ?>
					</div>
					<div class="hero-right">
						<iframe width="100%" src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/jsnbuusei3e"></iframe>
					</div>
					<?php if ($video) : ?>
						<div class="vid-wrap">
							<video controls>
								<source src="<?php echo $video['url']; ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
					<?php endif; ?>
					<div class="logos">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Breakfast-Television.png" alt="Breakfast Television logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Cityline.png" alt="Cityline logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/logo-citynews.png" alt="CityNews logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Citytv.png" alt="CityTV logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/SN.png" alt="Sportsnet logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/98.1-CHFI.png" alt="98.1 CHFI logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Kiss-Radio.png" alt="KiSS radio logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Jack-Radio.png" alt="Jack radio logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/NHL.png" alt="NHL logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/MLB.png" alt="MLB logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/Tubi.png" alt="Tubi logo" loading="lazy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/FX.png" alt="FX logo" loading="lazy">
					</div>
					<?php if ($hero_button_text && $hero_button_link) : ?>
						<a href="<?php echo $hero_button_link; ?>" class="button beta" aria-label="<?php echo $hero_button_text; ?>" target="_blank"><?php echo $hero_button_text; ?></a>
					<?php endif; ?>
				</div>
			</section>

			<?php
			$columns_section_title = get_field('columns_section_title');
			?>
			<section class="columns default text-center">
				<div class="wrapper">
					<h2 class="section-title"><?php echo $columns_section_title; ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/helper-circle.svg" alt="Red Circle with face, arms and legs" class="helper-img" loading="lazy" data-aos="fade-up" data-aos-duration="2000"></h2>
					
					<div class="grid">
						<?php if( have_rows('cols_left_column') ) : while( have_rows('cols_left_column') ) : the_row(); 
							$image = get_sub_field('image');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('cols_mid_column') ) : while( have_rows('cols_mid_column') ) : the_row(); 
							$image = get_sub_field('image');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('cols_right_column') ) : while( have_rows('cols_right_column') ) : the_row(); 
							$image = get_sub_field('image');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</section>

			<?php
			$steps_section_title = get_field('steps_section_title');
			$steps_button_text = get_field('steps_button_text');
			$steps_button_link = get_field('steps_button_link');
			?>
			<section class="columns steps text-center bg-light">
				<div class="wrapper">
					<?php if ($steps_section_title) : ?>
						<h2 class="section-title"><?php echo $steps_section_title; ?></h2>
					<?php endif; ?>
					
					<div class="grid four">
						<?php if( have_rows('step_1') ) : while( have_rows('step_1') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<div class="img-wrap">
									<span class="num">1</span>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								</div>
								<?php if ($title) : ?>
									<p class="title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('step_2') ) : while( have_rows('step_2') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<div class="img-wrap">
									<span class="num">2</span>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								</div>
								<?php if ($title) : ?>
									<p class="title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('step_3') ) : while( have_rows('step_3') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<div class="img-wrap">
									<span class="num">3</span>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								</div>
								<?php if ($title) : ?>
									<p class="title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('step_4') ) : while( have_rows('step_4') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							$blurb = get_sub_field('blurb');
							?>
							<div class="item">
								<div class="img-wrap">
									<span class="num">4</span>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="icon" loading="lazy">
								</div>
								<?php if ($title) : ?>
									<p class="title"><?php echo $title; ?></p>
								<?php endif; ?>
								<?php if ($blurb) : ?>
									<p class="desc"><?php echo $blurb; ?></p>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
					<?php if ($steps_button_text && $steps_button_link) : ?>
						<a href="<?php echo $steps_button_link; ?>" class="button beta" aria-label="<?php echo $steps_button_text; ?>" target="_blank"><?php echo $steps_button_text; ?></a>
					<?php endif; ?>
				</div>
			</section>

			<?php
			$products_section_title = get_field('products_section_title');
			?>
			<section class="columns text-center products">
				<div class="wrapper">
					<h2 class="section-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/helper-tri.svg" alt="Blue Triangle with face, arms and legs" class="helper-img left" loading="lazy" data-aos="fade-up" data-aos-duration="2000"><?php echo $products_section_title; ?></h2>
					
					<div class="grid two">
						<?php if( have_rows('products_left_column') ) : while( have_rows('products_left_column') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							?>
							<div class="item">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
								<?php if ($title) : ?>
									<h3 class="item-title"><?php echo $title; ?></h3>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
						<?php if( have_rows('products_right_column') ) : while( have_rows('products_right_column') ) : the_row();
							$image = get_sub_field('image');
							$title = get_sub_field('title');
							?>
							<div class="item">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
								<?php if ($title) : ?>
									<h3 class="item-title"><?php echo $title; ?></h3>
								<?php endif; ?>
							</div>
						<?php endwhile; endif; ?>
					</div>
				</div>
			</section>

			<?php
			$support_section_title = get_field('support_section_title');
			$support_content = get_field('support_content');
			$support_button_text = get_field('support_button_text');
			$support_button_link = get_field('support_button_link');
			?>
			<section class="supporting text-center bg-light">
				<div class="wrapper">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/helper-heart.svg" alt="Red Heart with face, arms and legs" class="helper-img" loading="lazy" data-aos="fade-up" data-aos-duration="2000">
					<?php if ($support_section_title) : ?>
						<h2 class="section-title"><?php echo $support_section_title; ?></h2>
					<?php endif; ?>
					<?php echo $support_content; ?>
					<?php if ($support_button_text && $support_button_link) : ?>
						<a href="<?php echo $support_button_link; ?>" class="button beta" aria-label="<?php echo $support_button_text; ?>" target="_blank"><?php echo $support_button_text; ?></a>
					<?php endif; ?>
				</div>
			</section>

			<?php
			$bottom_title = get_field('bottom_title');
			$bottom_content = get_field('bottom_content');
			$bottom_button_text = get_field('bottom_button_text');
			$bottom_button_link = get_field('bottom_button_link');
			?>
			<section class="cta">
				<div class="wrapper">
					<div class="grid two">
						<div class="item">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/helper-square.svg" alt="Yellow Square with face, arms and legs" class="helper-img" loading="lazy" data-aos="fade-up" data-aos-duration="2000">
							<?php if ($bottom_title) : ?>
								<h2 class="section-title"><?php echo $bottom_title; ?></h2>
							<?php endif; ?>
							<div class="item-content">
								<?php echo $bottom_content; ?>
							</div>
						</div>
					</div>
					<?php if ($bottom_button_text && $bottom_button_link) : ?>
						<a href="<?php echo $bottom_button_link; ?>" class="button beta" aria-label="<?php echo $bottom_button_text; ?>" target="_blank"><?php echo $bottom_button_text; ?></a>
					<?php endif; ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/cta-bg.svg" alt="Mobile device and latop" class="bg desktop" loading="lazy">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/images/laptop-phone.png" alt="Mobile device and latop" class="bg desktop-lg" loading="lazy">
				</div>
			</section>

		</main>

	    <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/landing/main.min.js"></script>

	</body>
<?php
linkedin_pixel_code();
wp_footer();
