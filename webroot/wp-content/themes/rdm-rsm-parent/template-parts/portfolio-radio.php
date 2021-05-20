<?php  

$default_image = get_template_directory_uri() . "assets/images/missing-image-square.png";

$radio_posts = new WP_Query( array(
    'post_type'   => RSM\Broadcast\PostType\Radio::TYPE,
    'post_status' => 'publish',
    'order'       => 'ASC',
    'orderby'     => 'title',
    'nopaging'    => true,
) ); 

$radio_terms = get_terms( array(
	'taxonomy'   => RSM\Broadcast\Taxonomy\RadioCategory::SLUG,
	'hide_empty' => false,
) );

$radio_category = array_merge( array( 'all' => 'Featured Stations and Podcasts' ), wp_list_pluck( $radio_terms, 'name', 'slug' ) );

$region_terms = get_terms( array(
	'taxonomy'   => RSM\Broadcast\Taxonomy\Region::SLUG,
	'hide_empty' => false,
) );

$regions = array_merge( array( 'all' => 'All Regions' ), wp_list_pluck( $region_terms, 'name', 'slug' ) );
?>
<div class="row television-header radio-header justify-content-md-between">
    <div class="col-12 col-lg-12 col-md-3">
        <h2 id="portfolio-grid-anchor">Our Stations & Podcasts</h2>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 program-grid-filter">
    <?php
        get_template_part( 
            'template-parts/portfolio', 
            'filter', 
            array(
                'total' => $radio_posts->found_posts,
                'unit-text' => 'stations and podcasts',
                'filters' => array(
                    'radio-category' => $radio_category,
                    'region' => $regions,
                ),
            ));
    ?>
    </div>
</div>

<div class="row television-grid radio-grid">
    <?php
    //js var for programming grid modal
	$jsvar = array();
    foreach ( $radio_posts->posts as $post ) {
        $post_meta = get_post_meta( $post->ID, '', true );
        $post_radio_category = get_the_terms( $post->ID, RSM\Broadcast\Taxonomy\RadioCategory::SLUG);
        $post_region = get_the_terms( $post->ID, RSM\Broadcast\Taxonomy\Region::SLUG);

        $tmpjsvar = array(
			"title"       => $post->post_title,
			"description" => strip_tags( $post->post_content ),
			"format"      => isset($post_meta['_rsm_radio_format']) && !empty($post_meta['_rsm_radio_format'][0]) ? $post_meta['_rsm_radio_format'][0] : "",
			"location"    => isset($post_region) && !empty($post_region) ? $post_region[0]->name : "",
		);
        if ( isset( $post_meta['_rsm_radio_logo_id'] ) ) {
            $img_srcset = wp_get_attachment_image_srcset( $post_meta['_rsm_radio_logo_id'][0], 'square' );
            $img_src    = wp_get_attachment_image_src( $post_meta['_rsm_radio_logo_id'][0], 'square' )[0];

        } else {
            $img_srcset = '';
            $img_src    = $default_image;
        }

        if(!empty($img_srcset)){
            $tmpjsvar['logo'] = array(
				'src'    => $img_src,
				'srcset' => $img_srcset,
			);
        }

        // featured image
		$featured_image_id = get_post_thumbnail_id( $post->ID );
		if ( ! empty ( $featured_image_id ) ) {
			$size              = "large";
			$tmpjsvar['featured_image'] = array(
				'src'    => wp_get_attachment_image_src( $featured_image_id, $size ),
				'srcset' => wp_get_attachment_image_srcset( $featured_image_id, $size ),
				'sizes'  => wp_get_attachment_image_sizes( $featured_image_id, $size )
			);
		}

        $jsvar[ $post->ID ] = $tmpjsvar;

        $post_subtitle = isset($post_meta['_rsm_radio_format']) && !empty($post_meta['_rsm_radio_format'][0]) ? $post_meta['_rsm_radio_format'][0] : "";
        $post_subtitle = isset($post_region) && !empty($post_region) ? $post_region[0]->name : $post_subtitle;
        $post_subtitle = ucfirst($post_subtitle);
        
    ?>
        <div class="col-4 col-sm-4 col-md-2 col-lg-1 radio-card-col radio-item" 
            data-program-id="<?php echo $post->ID ?>"
            data-catetory="<?php echo get_data_items( $post->ID, RSM\Broadcast\Taxonomy\RadioCategory::SLUG ) ?>"
            data-region="<?php echo get_data_items( $post->ID, RSM\Broadcast\Taxonomy\Region::SLUG ) ?>"
        >
            <div class="card radio-card" data-toggle="modal" data-target="#radio-modal">
                <img class="card-img-top" src="<?php echo $img_src; ?>" srcset="<?php echo $img_srcset; ?>"
                        alt="<?php echo esc_attr( $post->post_title ); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo esc_html( $post->post_title ); ?></h5>
                    <h6 class="card-subtitle"><?php echo esc_html( $post_subtitle ); ?></h6>
                </div>
            </div>
        </div>
    <?php 
    }
    //programming grids info
	wp_localize_script( 'radio-js', 'radio_programs', $jsvar );
    ?>
</div>
<div class="col-12 programming-none">
    <h3>No programs found.</h3>
</div>

<!-- Modal -->
<div class="portfolio-modal-wrapper radio-modal"></div>