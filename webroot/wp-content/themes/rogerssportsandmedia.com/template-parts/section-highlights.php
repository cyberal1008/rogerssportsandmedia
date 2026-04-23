<!-- Highlights -->
<?php if( have_rows('highlights') ) : 
    $highlights_numbers_text_color = !empty( get_field( 'highlights_numbers_text_color' ) ) ? get_field( 'highlights_numbers_text_color' ) : '#da291c';
    $highlights_background_color = !empty( get_field( 'highlights_background_color' ) ) ? get_field( 'highlights_background_color' ) : '#000';
    $highlights_descriptions_text_color = !empty( get_field( 'highlights_descriptions_text_color' ) ) ? get_field( 'highlights_descriptions_text_color' ) : '#fff' ;    
?>
    <section id="highlights" class="tw-w-full" style="background-color: <?php echo $highlights_background_color ?>">
        <div class="wrapper" style="padding: 60px 0;">
            <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-full tw-text-white tw-space-y-10 md:tw-space-y-0 md:tw-space-x-16 tw-justify-center">
                <?php while( have_rows('highlights') ) : the_row();
                    $number = get_sub_field('number');
                    $number_text = get_sub_field('number_text');
                    $text = get_sub_field('text');
                    $circle_color = get_sub_field('circle_color');
                ?>
                    <div class="tw-full md:tw-w-1/4 tw-text-center">
                    <div class="tw-text-7xl tw-font-bold tw-text-transparent tw-mb-1" style="color: <?php echo $highlights_numbers_text_color ?>;">
                        <?php
                        if ($number) : ?><span class="num scroll-counter" data-counter-time="1200"><?php echo $number; ?></span><?php endif; 
                        if ($number_text) : ?><span class="sign bold"><?php echo $number_text; ?></span><?php endif;
                        ?>
                    </div>
                        <div style="color: <?php echo $highlights_descriptions_text_color ?>"><?php echo $text; ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>