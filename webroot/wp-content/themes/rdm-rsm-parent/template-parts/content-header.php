<div class="cat-header">
	<?php
	if ( ! empty( $args['title'] ) ) { ?>
        <p class="cat-page-title text-center"><?php echo esc_html( $args['title'] ); ?></p>
		<?php
	}
	if ( ! empty( $args['subtitle'] ) ) { ?>
        <div class="cat-page-desc text-center"><?php echo esc_html( $args['subtitle'] ) ?></div>
		<?php
	}
	?>
</div>
