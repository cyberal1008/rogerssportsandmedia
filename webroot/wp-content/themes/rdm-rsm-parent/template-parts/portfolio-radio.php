<?php      
$default_image = get_template_directory_uri() . "assets/images/missing-image-square.png";

$radio_posts = new WP_Query( array(
    'post_type'   => RSM\Broadcast\PostType\Radio::TYPE,
    'post_status' => 'publish',
    'order'       => 'ASC',
    'orderby'     => 'title',
) ); 
?>
<div class="row television-header radio-header justify-content-md-between">
    <div class="col-12 col-lg-12 col-md-3">
        <h2>Our Stations & Podcasts</h2>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 program-grid-filter">
    <?php
        get_template_part( 
            'template-parts/portfolio', 
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

<div class="row television-grid radio-grid">
    <?php
    foreach ( $radio_posts->posts as $post ) {
        $post_meta = get_post_meta( $post->ID, '', true );
        $post_radio_category = get_the_terms( $post->ID, RSM\Broadcast\Taxonomy\RadioCategory::SLUG);
        $post_region = get_the_terms( $post->ID, RSM\Broadcast\Taxonomy\Region::SLUG);
        if ( isset( $post_meta['_rsm_radio_logo_id'] ) ) {
            $img_srcset = wp_get_attachment_image_srcset( $post_meta['_rsm_radio_logo_id'][0], 'square' );
            $img_src    = wp_get_attachment_image_src( $post_meta['_rsm_radio_logo_id'][0], 'square' )[0];

        } else {
            $img_srcset = '';
            $img_src    = $default_image;
        }
        $post_subtitle = isset($post_meta['_rsm_radio_format']) && !empty($post_meta['_rsm_radio_format'][0]) ? $post_meta['_rsm_radio_format'][0] : "";
        $post_subtitle = isset($post_region) && !empty($post_region) ? $post_region[0]->name : $post_subtitle;
        $post_subtitle = ucfirst($post_subtitle);
                            
        /* echo ("<!--");
        print_r($post);
        print_r($post_meta);
        print_r($post_radio_category);
        print_r($post_region);
        echo ("-->"); */
    ?>
        <div class="col-6 col-sm-4 col-md-2 col-lg-1 radio-card-col">
            <div class="card radio-card">
                <img class="card-img-top" src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>"
                        alt="<?php echo esc_attr( $post->post_title ); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo esc_html( $post->post_title ); ?></h5>
                    <h6 class="card-subtitle"><?php echo esc_html( $post_subtitle ); ?></h6>
                </div>
            </div>
        </div>
    <?
    }
    ?>
</div>