<?php
$title            = get_sub_field( 'title' );
$background_color = get_sub_field( 'background_color' );
$text_color       = get_sub_field( 'text_color' ) ?: '#000';
$max_width        = get_sub_field( 'max_width' );
$images           = get_sub_field( 'images' );

if ( empty( $images ) ) {
	return;
}

$inner_style = $max_width ? 'max-width: ' . esc_attr( $max_width ) . '; margin-left: auto; margin-right: auto;' : '';
?>
<section class="programming" style="background-color: <?php echo $background_color ?: 'transparent'; ?>; margin: 0; padding: 50px 0;">
	<div class="portfolio-main">
		<div class="portfolio-page">
			<div class="inner wrapper">
				<?php if ( $title ) : ?>
					<h2 class="flex-section-title" style="color: <?php echo $text_color; ?>"><?php echo $title; ?></h2>
				<?php endif; ?>
				<div style="<?php echo $inner_style; ?>">
					<div class="tw-flex tw-flex-col md:tw-flex-row" style="gap: 32px;">
						<?php foreach ( $images as $item ) :
							$img = $item['image'];
						?>
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" style="flex: 1 1 0; min-width: 0; width: 100%; height: auto; display: block;">
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
