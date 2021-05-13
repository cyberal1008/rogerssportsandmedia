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
<div class="container legal-main">
    <div class="legal-header">
        <h1><?php echo esc_html( get_the_title() ); ?></h1>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php 
        the_content();
        ?>
    </article>
</div>
<?php
get_footer();