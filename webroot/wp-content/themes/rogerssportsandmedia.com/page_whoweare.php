<?php
/**
 * Template Name: Who We Are (Reskin)
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
?>
<?php
	get_header();
	global $post;
	$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

<main id="content" role="main" class="">

	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'title' => get_the_title(),
			)
		);
	?>
	
	<!-- INTRO -->
	<?php
		get_template_part('template-parts/section-intro');
	?>

    <section class="tw-bg-gray tw-py-12">&nbsp;</section>
    <section class="tw-bg-white tw-py-1">&nbsp;</section>
</main>

<?php
    get_footer();
?>
</html>
<?php
