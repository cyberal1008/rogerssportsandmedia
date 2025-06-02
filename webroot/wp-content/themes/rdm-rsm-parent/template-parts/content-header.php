<div class="cat-header">
	<?php
	if ( ! empty( $args['title'] ) || ( isset( $args['allow_empty_title'] ) && $args['allow_empty_title'] ) ) { ?>
        <p class="cat-page-title text-center"><?php echo esc_html( $args['title'] ); ?></p>
		<?php
	}
	if ( ! empty( $args['subtitle'] ) ) { ?>
        <div class="cat-page-desc text-center tw-text-3xl md:tw-text-4xl"><?php echo esc_html( strip_tags(  $args['subtitle'] ) )  ?></div>
		<?php
	}
	?>
</div>
