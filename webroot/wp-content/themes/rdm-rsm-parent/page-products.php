<?php
/**
 * Template Name: Products
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */

get_header();
global $post;
$blocks    = array();
$subheader = '';
if ( has_blocks( $post->post_content ) ) {
	$blocks       = parse_blocks( $post->post_content );
	$header_block = array_filter( $blocks, function ( $block ) {
		return $block['blockName'] === 'core/heading';
	} );

	$header_block = end( $header_block );

	if ( ! empty ( $header_block['innerHTML'] ) ) {
		$subheader = strip_tags( $header_block['innerHTML'] );
	}
}

get_template_part(
	'template-parts/content',
	'header',
	array(
		'title'    => get_the_title(),
		'subtitle' => $subheader,
	) );

$class_circle  = array(
	'blue',
	'yellow',
	'red'
);
$circular_size = count( $class_circle );
$circle_count  = 0;
?>
    <div class="container" id="main">
		<?php
		if ( ! empty ( $blocks ) ) {
			$product_blocks = array_filter( $blocks, function ( $block ) {
				return $block['blockName'] === 'rsm/products-block';
			} );
			$total_blocks   = count( $product_blocks );
			$iterator       = 0;
			foreach ( $product_blocks as $key => $block ) {
				?>
                <div class="rsm-product-block">
					<?php
					echo $block['innerHTML'];
					if ( ( ++ $iterator ) % 2 !== 0 ) {
						?>
                        <div class="circle-container<?php echo ( ($iterator === $total_blocks) ? "-half" : "-quarter" ). " " . $class_circle[ $circle_count ++ % $circular_size ] ?>">
                            <div class="circle">
                                <div class="<?php echo $iterator === $total_blocks ? 'half' : 'quarter'; ?>"></div>
                                <div class="cut"></div>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
			<?php }
		}
		?>
    </div>
<?php
get_footer();

