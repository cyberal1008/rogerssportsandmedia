<?php
/**
 * Template Name: Iframe Passthrough
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

$iframe_url = get_field('iframe_url');
$iframe_height = get_field('iframe_height');
$get_string = http_build_query($_GET);

if(!empty($get_string)) {
    $iframe_url = $iframe_url . '?' . $get_string;
}

?>
<div class="container">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <iframe src="<?php echo $iframe_url; ?>" height="<?php echo $iframe_height; ?>" width="100%" style="border: none;"></iframe>
        <?php
        the_content();
        ?>
    </article>
</div>
<?php
get_footer();
