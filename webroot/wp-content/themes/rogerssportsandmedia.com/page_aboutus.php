<?php
/**
 * Template Name: About Us
 *
 * @package Rogers Digital Media
 * @subpackage rdm-rsm-parent
 * @since Ver 1.0
 */
 get_header();
?>

<main>
    <style>
        .brand-box {
            border: 1px solid #fff;
            height: 220px;
            padding: 30px;
            @media screen and (max-width: 768px) {
                height: 160px;
                padding: 10px;
            }
        }
    </style>

    <?php
        $headline = get_field('headline');
        $headline_content = get_field('content');
        $headline_button = get_field('headline_button');
    ?>
    <section class="tw:relative tw:overflow-hidden tw:h-[672px] tw:md:h-[532px]">
        <video autoplay muted loop class="tw:absolute tw:top-0 tw:left-0 tw:w-full tw:h-full tw:object-cover">
            <source src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/videos/mobius-black.mp4" type="video/mp4">
        </video>
        <div class="tw:absolute tw:top-0 tw:left-0 tw:w-full tw:h-full" style="background-color: color-mix(in oklab, var(--tw-color-white) 10%, transparent);">
            <div class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:py-12 tw:text-white">
                <div class="tw:grid tw:grid-cols-1 tw:md:grid-cols-2">
                    <div style="margin-top: 30px;">
                        <?php if ($headline): ?>
                            <h2><?php echo $headline; ?></h2>
                        <?php endif; ?>
                        <?php if ($headline_content): ?>
                            <div class="tw:text-2xl tw:font-semibold tw:!mb-12">
                                <?php echo $headline_content; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($headline_button): ?>
                            <div class="tw:flex tw:gap-x-6">
                                <a class="tw:btn-primary" target="_blank" href="<?php echo $headline_button['url'] ?>"><?php echo $headline_button['title'] ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($headline && $headline_content): ?>
                        <div class="tw:hidden tw:md:flex tw:flex-col tw:justify-end tw:items-start">
                            <a class="tw:hover:no-underline tw:cursor-pointer" href="#brands">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/ad-manager-new/images/arrow-down.png" class="tw:h-20">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section id="brands" style="padding-bottom: 120px;" class="tw:px-4 tw:md:px-32 tw:lg:px-32 tw:xl:px-40 tw:2xl:px-48 tw:bg-black tw:text-white tw:overflow-hidden">
        <?php
            $brands_section_title = get_field('brands_section_title');
            $brand_logos = get_field('brand_logos');
        ?>
        <div style="margin-top: 80px;">
            <?php if ($brands_section_title): ?>
                <h2 class="tw:text-center" style="font-size: 52px; margin-bottom: 48px;"><?php echo $brands_section_title; ?></h2>
            <?php endif; ?>
            <div class="tw:grid tw:grid-cols-2 tw:md:grid-cols-2 tw:lg:grid-cols-3 tw:xl:grid-cols-4 tw:2xl:grid-cols-5 tw:gap-x-12 tw:gap-y-12">
                <?php if (!empty($brand_logos)): ?>
                    <?php foreach ($brand_logos as $logo): ?>
                        <div class="brand-box tw:flex tw:justify-center tw:items-center">
                            <img
                                style="object-fit: contain;"
                                class="tw:w-full tw:h-full"
                                src="<?php echo esc_url($logo['url']); ?>"
                                alt="<?php echo esc_attr($logo['alt'] ?? 'Brand Logo'); ?>"
                            />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
