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

$event_date = strtotime( $post_meta['event']['date'] );
$start_time = strtotime( $post_meta['event']['start_time'] );
$end_time = strtotime( $post_meta['event']['end_time'] );

echo "Blah!";
var_dump($post_meta);

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
        ?>
        <iframe src="https://fe3711727564047c711c74.pub.s6.sfmc-content.com/kebewevkwnm"></iframe>
        <?php
      }
			?>
			</div>
      <div class="col-sm-12 col-md-12 col-lg-4 single-article-sidebar">
        <div class="sidebar-content">
				  <p class="sidebar_title"><?php echo the_title(); ?></p>
          <p class="sidebar_title">Date And Time</p>
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
