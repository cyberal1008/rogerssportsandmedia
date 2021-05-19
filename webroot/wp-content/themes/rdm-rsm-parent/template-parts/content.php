<?php
/**
 * Template part for displaying posts
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<p class="article-cat-date"><?php echo get_the_date( get_option( 'date_format' ) ); ?>
		<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			echo ' / ' . esc_html( $categories[0]->name );
		}
		?>
	</p>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
	</header>
	<div class="post-thumbnail">
		<?php the_post_thumbnail( array( 697, 380 ) ); ?>
	</div>

	<div class="entry-content">
		<?php
		if ( is_single() ) :
			the_content();
		else :
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rdm-rsm-parent' ) );
		endif;
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rdm-rsm-parent' ),
					'after'  => '</div>',
				)
			);
			?>
	</div>
</article>
