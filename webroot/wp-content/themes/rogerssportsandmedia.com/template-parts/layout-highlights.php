<?php
$numbers_text_color      = get_sub_field( 'numbers_text_color' ) ?: '#da291c';
$background_color        = get_sub_field( 'background_color' ) ?: '#000';
$descriptions_text_color = get_sub_field( 'descriptions_text_color' ) ?: '#fff';
$highlights              = get_sub_field( 'highlights' );

if ( empty( $highlights ) ) {
	return;
}
?>
<section id="highlights" class="tw-w-full" style="background-color: <?php echo $background_color; ?>">
	<div class="wrapper" style="padding: 60px 0;">
		<div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16 tw-justify-center">
			<?php foreach ( $highlights as $item ) :
				$number      = $item['number'];
				$number_text = $item['number_text'];
				$text        = $item['text'];
			?>
				<div class="tw-full md:tw-w-1/4 tw-text-center">
					<div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="color: <?php echo $numbers_text_color; ?>">
						<?php if ( $number ) : ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php endif; ?>
						<?php if ( $number_text ) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif; ?>
					</div>
					<div style="color: <?php echo $descriptions_text_color; ?>"><?php echo $text; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
