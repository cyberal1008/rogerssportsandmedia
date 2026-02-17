<div class="item test-class">
    <?php
    $link = get_the_permalink();
    $title = get_the_title();
    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    $feat_img_id = get_post_thumbnail_id(get_the_ID());
    $alt = get_post_meta ( $feat_img_id, '_wp_attachment_image_alt', true );
    $categories = get_the_category();
    ?>

    <?php if ($featured_img_url) : ?>
        <a href="<?php echo $link; ?>" class="imglink" aria-label="<?php echo $title; ?>"><img src="<?php echo $featured_img_url; ?>" alt="<?php echo $alt; ?>" loading="lazy"></a>
    <?php endif; ?>

    <div class="meta">
        <?php if ( ! empty( $categories ) ) : ?>
            <span class="cat"><?php echo $categories[0]->name; ?></span>
        <?php endif; ?>
        <span class="date"><?php echo get_the_date( get_option( 'date_format' ) ); ?></span>
    </div>

    <p class="title"><a href="<?php echo $link; ?>" aria-label="<?php echo $title; ?>"><?php echo wp_trim_words( $title, 15); ?></a></p>

    <div class="card-share">
        <a type="button" aria-label="share <?php echo $title; ?>" class="share-trigger" target="_blank" onclick="openShareDropdown(this);"><i class="icon fa-solid fa-arrow-up-from-bracket"></i></a>
        <div class="sharedrop">
            <button class="close" onclick="closeShareDropdown(this);"><i class="fa-regular fa-xmark"></i></button>
            <div class="links">
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $link; ?>" aria-label="Share on LinkedIn" target="_blank"><i class="icon fa-brands fa-linkedin"></i> LinkedIn</a>
                <a href="https://twitter.com/intent/tweet?text=&url=<?php echo $link; ?>" aria-label="Share on Twitter" target="_blank"><i class="icon fa-brands fa-square-twitter"></i> Twitter</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link; ?>" aria-label="Share on Facebook" target="_blank"><i class="icon fa-brands fa-square-facebook"></i> Facebook</a>
                <a href="mailto:?&body=<?php echo $link; ?>" aria-label="Share via email"><i class="icon fa-solid fa-square-envelope"></i> Email</a>
                <a type="button" class="sharecopy" aria-label="copy link" data-value="<?php echo $link; ?>" onclick="updateCopyLinkText(this);"><i class=" icon fa-solid fa-link-simple"></i> Copy Link</a>
            </div>
            <span class="success"><i class="icon fa-sharp fa-solid fa-square-check"></i> Linked Copied!</span>
        </div>
    </div>
</div>
