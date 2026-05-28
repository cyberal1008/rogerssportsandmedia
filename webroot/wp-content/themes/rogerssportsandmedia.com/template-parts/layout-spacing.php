<?php
/**
 * Flexible Layout: Spacing
 *
 * Responsive vertical spacer between flex sections. All sizes scale fluidly
 * between mobile and desktop via clamp(); the "medium" preset matches the
 * CTA section's own internal padding so spacing reads consistently.
 */

$size             = get_sub_field( 'size' ) ?: 'medium';
$background_color = get_sub_field( 'background_color' );

$presets = array(
	'small'  => 'clamp(12px, 1.5vw, 24px)',
	'medium' => 'clamp(22px, 2.25vw, 32px)',
	'large'  => 'clamp(40px, 4vw, 60px)',
	'xlarge' => 'clamp(60px, 6vw, 100px)',
);

$height = isset( $presets[ $size ] ) ? $presets[ $size ] : $presets['medium'];

$style = 'height: ' . $height . ';';
if ( $background_color ) {
	$style .= ' background-color: ' . $background_color . ';';
}
?>

<div class="flex-spacer flex-spacer--<?php echo esc_attr( $size ); ?>" aria-hidden="true" style="<?php echo esc_attr( $style ); ?>"></div>
