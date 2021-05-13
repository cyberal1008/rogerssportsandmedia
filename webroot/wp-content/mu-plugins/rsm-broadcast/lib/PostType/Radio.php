<?php
/**
 * Custom post type for Radio programs
 */

namespace RSM\Broadcast\PostType;

/**
 * Class Radio
 * @package PostType
 *
 */
class Radio {

    /**
     * @var string
     *
     * Set post type params
     */
    const SLUG  = 'radios';
    const TYPE = 'rsm-radio';
    const NAME  = 'Radios';
    const SINGULAR_NAME= 'Radio';

    /**
     * Register post type
     */
    public function register() {
        $labels = array(
            'name'                  => self::NAME,
            'singular_name'         => self::SINGULAR_NAME,
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New '   . self::SINGULAR_NAME,
            'edit_item'             => 'Edit '      . self::SINGULAR_NAME,
            'new_item'              => 'New '       . self::SINGULAR_NAME,
            'all_items'             => 'All '       . self::NAME,
            'view_item'             => 'View '      . self::NAME,
            'search_items'          => 'Search '    . self::NAME,
            'not_found'             => 'No '        . strtolower(self::NAME) . ' found',
            'not_found_in_trash'    => 'No '        . strtolower(self::NAME) . ' found in Trash',
            'parent_item_colon'     => '',
            'menu_name'             => self::NAME
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => self::SLUG ),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => 8,
            'menu_icon'             => 'dashicons-format-audio',
            'supports'              => array( 'title', 'editor', 'thumbnail')
        );

        register_post_type( self::TYPE, $args );
    }

//    public function init_metaboxes(){
//        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes'));
//        add_action( 'save_post', array( $this, 'save_metabox_data' ), 10, 2 );
//    }

    public function add_metaboxes(){
        add_meta_box(
            'radio-type-metabox',
            __( 'Radio Property Format' ),
            array( $this, 'render_type_meta_box' ),
            'rsm-radio',
            'normal',
            'high'
        );
        add_meta_box(
            'radio-logo-metabox',
            __( 'Brand Logo (tile logo shows on grid)' ),
            array( $this, 'render_logo_meta_box' ),
            'rsm-radio',
            'normal',
            'high'
        );
    }

    public function render_type_meta_box($post){
        $format = get_post_meta($post->ID, '_rsm_radio_format', true);
    ?>
        <input type="radio" name="rsm-radio-format" <?php if (isset($format) && $format=="station") echo "checked";?> value="station">Station
        <input type="radio" name="rsm-radio-format" <?php if (isset($format) && $format=="podcast") echo "checked";?> value="podcast">Podcast
    <?php 
    }

    public function render_logo_meta_box($post){
        $image_id = get_post_meta($post->ID, '_rsm_radio_logo_id', true);
        if( $image = wp_get_attachment_image_src( $image_id, 'square-375') ) {
            echo '<a href="#" class="radio-logo-upl"><img src="' . $image[0] . '" style="max-width:10%;"/></a>
                  <a href="#" class="radio-logo-rmv" style="display:block">Remove Logo</a>
                  <input type="hidden" name="rsm-radio-logo" value="' . $image_id . '">';
         
        } else {        
            echo '<a href="#" class="radio-logo-upl">Upload Logo</a>
                  <a href="#" class="radio-logo-rmv" style="display:none">Remove Logo</a>
                  <input type="hidden" name="rsm-radio-logo" value="">';        
        }
        ?>
        <script>
        jQuery(function($){
            // on upload button click
            $('body').on( 'click', '.radio-logo-upl', function(e){

                e.preventDefault();

                var button = $(this),
                custom_uploader = wp.media({
                    title: 'Insert image',
                    library : {
                        // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                        type : 'image'
                    },
                    button: {
                        text: 'Use this image' // button label text
                    },
                    multiple: false
                }).on('select', function() { // it also has "open" and "close" events
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    button.html('<img src="' + attachment.url + '" style="max-width:10%;">').next().show().next().val(attachment.id);
                }).open();

            });

            // on remove button click
            $('body').on('click', '.radio-logo-rmv', function(e){

                e.preventDefault();

                var button = $(this);
                button.next().val(''); // emptying the hidden field
                button.hide().prev().html('Upload Logo');
            });

        });
        </script>

        <?php
    }

    /**
     * Handles saving the meta boxes.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox_data( $post_id, $post ) {

        if($post->post_type != "rsm-radio"){
            return;
        }
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        if(isset($_POST['rsm-radio-logo'])){
            $logo_id = sanitize_text_field( $_POST['rsm-radio-logo'] );

            update_post_meta( $post_id, '_rsm_radio_logo_id', $logo_id );
        }

        if(isset($_POST['rsm-radio-format'])){
            update_post_meta( $post_id, '_rsm_radio_format', $_POST['rsm-radio-format'] );
        }
    }

//    /**
//     * Radio constructor.
//     *
//     * When class is instantiated
//     */
//    public function __construct() {
//
//        // Register the post type
//        add_action('init', array($this, 'register'));
//
//        // Admin Add metaboxes
//        $this->init_metaboxes();
//
//    }
}
