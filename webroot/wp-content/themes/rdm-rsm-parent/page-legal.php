<?php
/**
 * Template Name: Legal
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
global $post;
?>
<div class="cat-header">
	<p class="cat-page-title text-center">Legal</p>
	<div class="cat-page-desc text-center"><?php echo esc_html( get_the_title() ); ?></div>
</div>
<div class="container legal-main">
<!--     <div class="legal-header">
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
    </div> -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php 
        the_content();
        ?>
    </article>
</div>
<?php
get_footer();