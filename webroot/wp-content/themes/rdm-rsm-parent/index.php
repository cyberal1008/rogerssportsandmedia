<?php
/**
 * The main template file
 * @package rdm-rsm-parent
 */

get_header();?>

	<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-8">
		<div id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</div>
	</section>




<div class="container-fluid">
	<h1>Basic Grid Structure</h1>
	<p>Resize the browser window to see the effect.</p>
	<p></p>

	<div class="container-fluid">
		<!-- Control the column width, and how they should appear on different devices -->
		<div class="row">
			<div class="col-xl-6" style="background-color:yellow;">50% - XL 1366px </div>
			<div class="col-xl-6" style="background-color:orange;">50%</div>
		</div>
		<br>

		<div class="row">
			<div class="col-lg-6" style="background-color:yellow;">50% LG 1024px </div>
			<div class="col-lg-6" style="background-color:orange;">50%</div>
		</div>
		<br>

		<div class="row">
			<div class="col-sm-6" style="background-color:yellow;">50% SM 768px</div>
			<div class="col-sm-6" style="background-color:orange;">50%</div>
		</div>
		<br>

		<div class="row">
			<div class="col-sm-4" style="background-color:yellow;">33.33%</div>
			<div class="col-sm-4" style="background-color:orange;">33.33%</div>
			<div class="col-sm-4" style="background-color:yellow;">33.33%</div>
		</div>
		<br>

		<!-- Or let Bootstrap automatically handle the layout -->
		<div class="row">
			<div class="col-sm-6 col-lg-3" style="background-color:yellow;">25%
				<div class="card">
					<p class="card-block">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam velit quisquam veniam excepturi temporibus inventore corporis dicta sit culpa veritatis placeat earum, dolorum asperiores, delectus dolore voluptatibus, at magnam nobis!
					</p>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3" style="background-color:orange;">25%
			<div class="card">
					<p class="card-block">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam velit quisquam veniam excepturi temporibus inventore corporis dicta sit culpa veritatis placeat earum, dolorum asperiores, delectus dolore voluptatibus, at magnam nobis!
					</p>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3" style="background-color:yellow;">25%
			<div class="card">
					<p class="card-block">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam velit quisquam veniam excepturi temporibus inventore corporis dicta sit culpa veritatis placeat earum, dolorum asperiores, delectus dolore voluptatibus, at magnam nobis!
					</p>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3" style="background-color:orange;">25%
			<div class="card">
					<p class="card-block">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam velit quisquam veniam excepturi temporibus inventore corporis dicta sit culpa veritatis placeat earum, dolorum asperiores, delectus dolore voluptatibus, at magnam nobis!
					</p>
				</div>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col" style="background-color:yellow;">25%</div>
			<div class="col" style="background-color:orange;">25%</div>
			<div class="col" style="background-color:yellow;">25%</div>
			<div class="col" style="background-color:orange;">25%</div>
		</div>
	</div>
</div>

<?php
//get_sidebar();
get_footer();
