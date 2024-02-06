<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

global $post;
$post_meta = get_post_meta( $post->ID, "events_metadata", true );
$show_form = isset( $_GET['register'] );

$event_id = $post_meta['event']['id'];
$event_date = strtotime( $post_meta['event']['date'] );
$start_time = strtotime( $post_meta['event']['start_time'] );
$end_time = strtotime( $post_meta['event']['end_time'] );

$address_parameter = '';
$classes = '';
if (isset( $post_meta['event']['show_address_fields'] ) ) {
	$address_parameter = "&address=yes";
	$classes .= "address";
}

get_header(); ?>
	<div class="container" id="main">
		<div class="row">
			<div class="col-sm-12 col-md-11 col-lg-8 single-article-container mx-auto" role="main">
			<?php
      if( ! $show_form ) {
        while ( have_posts() ) {
  				the_post();
  				get_template_part( 'template-parts/content', get_post_format() );
        }
      } else {
        if( strpos( $_SERVER["REQUEST_URI"], "omni" ) !== false ){
          get_template_part('template-parts/omni-event-form');
        }
        else if( strpos( $_SERVER["REQUEST_URI"], "disney-launch" ) !== false ){
          get_template_part('template-parts/disney-launch-event-form');
        }
        else if( strpos( $_SERVER["REQUEST_URI"], "sn-hockey-classic-2024" ) !== false ){
          ?>
            <iframe class = "single-event-iframe <?php echo $classes; ?>" src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/glcynrk4h21"></iframe>
          <?php
        } 
        else if( strpos( $_SERVER["REQUEST_URI"], "rsm-dinner" ) !== false ){
          ?>
            <iframe class = "single-event-iframe <?php echo $classes; ?>" src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/vuog3325cb2"></iframe>
          <?php
        } else {
          ?>
            <iframe class = "single-event-iframe <?php echo $classes; ?>" src="https://mcdjql80kmghrjj6lg68bbtqbgv1.pub.sfmc-content.com/fjvu0tj21uh?campaign=<?php echo $event_id . $address_parameter; ?>"></iframe>
          <?php
        }
      }
			?>
			</div>
      <div class="col-sm-12 col-md-12 col-lg-4 single-article-sidebar">
        <div class="sidebar-content">
				  <p class="sidebar_title"><?php echo the_title(); ?></p>
          <p class="sidebar_title">Date & Time</p>
          <p><?php echo date( "D, F j, Y", $event_date ); ?></p>
          <p><?php echo date( "g:iA", $start_time ) . " - " . date( "g:iA", $end_time ); ?></p>
          <div class="event_register_button">
            <a href="<?php echo get_permalink(); ?>?register">Register now</a>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
