<?php
/**
 * The template for displaying all pages
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
get_template_part(
	'template-parts/content',
	'header',
	array(
		'title' => '',
		'subtitle' => get_the_title(),
		'allow_empty_title' => true,
	) );

?>
<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        the_content();
        ?>
    </article>
</div>
<?php
get_footer();
