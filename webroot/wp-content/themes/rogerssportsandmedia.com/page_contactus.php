<?php
/**
 * Template Name: Contact Us (Reskin)
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
    <title><?php echo get_the_title(); ?> | Rogers Sports & Media</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/main.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/reskin-alt.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/styles/custom.css">
</head>
<?php
	get_header();
	global $post;
	$page_meta = get_post_meta( $post->ID, RSM\Broadcast\PageMeta::METADATA_SLUG, true );
?>

<main id="content" role="main">

	<!-- HERO -->
	<?php
		get_template_part(
			'template-parts/section-hero', null,
			array(
				'title' => get_the_title(),
			)
		);
	?>
	
    <div class="row" style="margin-top: 24px">
        <div class="col-sm-12 col-md-12 col-lg-12 single-article-container" role="main">
            <div class="contactus-form-text">
                <p>Want to advertise with Rogers Sports & Media?</p>
                <p>Complete the form below and a sales representative will be in touch.</p>
                <p>
                    If you're looking for our self-serve ad buying platform, RSM Ad Manager click <a target="_blank" href="https://www.rogerssportsandmedia.com/ad-manager">here</a>
                </p>
            </div>
        </div>
    </div>
    <div class="tw-flex tw-flex-col contactus-main">
        <iframe src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/drlrqqp5mtl"></iframe>
    </div>
</main>

<?php
    get_footer();
?>
</html>
<?php
