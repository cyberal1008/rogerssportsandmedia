<?php
$intro_title     = get_sub_field( 'intro_title' );
$intro_title_two = get_sub_field( 'intro_title_two' );
$intro_content   = get_sub_field( 'intro_content' );
$intro_button    = get_sub_field( 'intro_button' );
?>
<section class="intro-section tw-bg-gray">
	<div class="tw-relative wrapper">
		<div class="intro-section-text tw-py-6 md:tw-py-10 tw-mb-8">
			<?php if ( $intro_title ) : ?>
				<h2 class="intro-title flex-section-title" style="color: #000"><?php echo $intro_title; ?></h2>
			<?php endif; ?>
			<?php if ( $intro_title_two ) : ?>
				<h2 class="flex-section-title" style="color: #000"><?php echo $intro_title_two; ?></h2>
			<?php endif; ?>
			<p class="tw-text-base tw-leading-7">
				<?php echo $intro_content; ?>
			</p>
			<?php if ( $intro_button ) : ?>
				<div class="tw-mt-12">
					<a href="<?php echo esc_url( $intro_button['url'] ); ?>" class="button" aria-label="<?php echo esc_attr( $intro_button['title'] ); ?>" target="<?php echo esc_attr( $intro_button['target'] ); ?>"><?php echo $intro_button['title']; ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
