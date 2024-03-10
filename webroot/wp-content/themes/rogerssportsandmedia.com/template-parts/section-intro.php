<?php
    $intro_title = get_field('intro_title');
    $intro_content = get_field('intro_content');
?>
<section class="tw-px-4 md:tw-px-16 lg:tw-px-32 xl:tw-px-40 2xl:tw-px-96">
    <div class="tw-relative -tw-mt-16">
        <div class="tw-bg-white tw-px-6 md:tw-px-16 tw-py-6 md:tw-py-10 tw-mb-8">
            <?php if ($intro_title) : ?>
                <div class="tw-text-3xl md:tw-text-4xl tw-text-gray-dark tw-font-bold tw-mb-6"><?php echo $intro_title; ?></div>
            <?php endif; ?>
            <p class="tw-text-base tw-leading-7">
                <?php echo $intro_content; ?>
            </p>
        </div>
    </div>
</section>