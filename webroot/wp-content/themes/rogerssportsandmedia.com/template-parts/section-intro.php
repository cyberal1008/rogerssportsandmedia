<?php
    $intro_title = get_field('intro_title');
    $intro_content = get_field('intro_content');
    $button_type = get_field('button_type');
?>
<section class="tw-bg-gray tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-80">
    <div>&nbsp;</div>
    <div class="tw-relative -tw-mt-16">
        <div class="tw-bg-white tw-px-6 md:tw-px-16 tw-py-6 md:tw-py-10 tw-mb-8">
            <?php if ($intro_title) : ?>
                <div class="tw-text-3xl md:tw-text-4xl tw-text-gray-dark tw-font-bold tw-mb-6"><?php echo $intro_title; ?></div>
            <?php endif; ?>
            <p class="tw-text-base tw-leading-7">
                <?php echo $intro_content; ?>
            </p>
            <?php if (isset($button_type)): ?>
                <?php
                    if ($button_type == 'email'):
                        $intro_button = get_field('intro_email');
                ?>
                    <div class="tw-mt-12"><a href="mailto:<?php echo $intro_button; ?>" class="button" aria-label="Get In Touch" target="_blank">Get In Touch</a></div>
                <?php
                    else:
                        $intro_button = get_field('intro_button');
                ?>
                    <div class="tw-mt-12"><a href="<?php echo $intro_button['url']; ?>" class="button" aria-label="<?php echo $intro_button['title']; ?>" target="<?php echo $intro_button['target']; ?>"><?php echo $intro_button['title']; ?></a></div>
                <?php
                    endif;
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>