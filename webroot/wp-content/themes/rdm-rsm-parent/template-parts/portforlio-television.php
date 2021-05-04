<?php      
$page_meta = get_post_meta( $args['page_id'], RSM\Broadcast\PageMeta::METADATA_SLUG, true );      
$pdf_url   = "";
if ( isset( $page_meta['broadcast'] ) && isset( $page_meta['broadcast']['schedule_uri'] ) ) {
    $pdf_url = $page_meta['broadcast']['schedule_uri'];
}
$default_image = get_template_directory_uri() . "assets/images/missing-image-portrait.png";
// schedule and header urls
$tv_posts = new WP_Query( array(
    'post_type'   => RSM\Broadcast\PostType\Shows::SLUG,
    'post_status' => 'publish',
    'orderby'     => 'title',
) );
?>
<div class="row television-header justify-content-md-between">
    <div class="col-12 col-md-3">
        <h2>Programming</h2>
    </div>
    <div class="col-12 col-md-3 d-flex align-items-center justify-content-center">
        <a href="<?php echo $pdf_url; ?>" target="_blank" class="download-link">Download TV schedule</a>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 program-grid-filter">
    <?php
        get_template_part( 
            'template-parts/portforlio', 
            'filter', 
            array(
                'total' => 104,
                'unit-text' => 'stations and podcasts',
                'filters' => array(
                    'radio-category' => array(
                        'all' => "Featured Stations and Podcasts",
                        'all-stations' => "All Stations",
                        'all-podcasts' => "All Podcasts",
                    ),
                    'region' => array(
                        'all' => "All regions",
                        'toronto' => "Toronto",
                        'ottwa' => "Ottwa",
                        'calgary' => "Calgary",
                    ),
                ),
            ));
    ?>
    </div>
</div>

<div class="row television-grid">
    <?php
    foreach ( $tv_posts->posts as $post ) {
        $post_meta = get_post_meta( $post->ID, RSM\Broadcast\PostType\Shows::METADATA_SLUG, true );
        if ( isset( $post_meta['image'] ) && isset( $post_meta['image']['tile'] ) ) {
            $img_srcset = wp_get_attachment_image_srcset( $post_meta['image']['tile'], 'portrait' );
            $img_src    = wp_get_attachment_image_src( $post_meta['image']['tile'], 'portrait' )[0];

        } else {
            $img_srcset = '';
            $img_src    = $default_image;
        }
        ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="card">
                <img class="card-img-top" src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>"
                        alt="<?php echo esc_attr( $post->post_title ); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo esc_html( $post->post_title ); ?></h5>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>