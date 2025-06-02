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
<div style="height: 40px"></div>
<?php
get_template_part(
	'template-parts/content',
	'header',
	array(
		'title' => '    ',
		'subtitle' => get_the_title(),
	) );

?>
<div class="container legal-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php 
        the_content();
        ?>
    </article>
</div>
<?php
get_footer();