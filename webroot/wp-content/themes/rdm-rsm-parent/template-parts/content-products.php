<?php
/** @var array $args */

if ( empty ( $args['title'] ) ||
     empty ( $args['description'] ) ) {
	return '';
}
?>

<div class="products">
    <div class="container products-container pt-5">
        <div class="row ml-2 ml-md-0">
            <div class="col-md-6 mb-5 my-md-auto">
                <div class="products-container-main">
                    <h1 class="products-container-title"><?php echo esc_html( $args['title'] ); ?></h1>
                    <p class="lead products-container-desc"><?php echo esc_html( $args['description'] ); ?></p>
                </div>
            </div>
        </div>
        <div class="row ml-2 ml-md-0 mb-5">
            <div class="col-md-6 mb-5 my-md-auto">
            <?php
                if ( ! empty ( $args['more'] ) && ! empty ( $args['more']['url'] ) && ! empty ( $args['more']['text'] ) ) {
                    ?>
                    <a href="<?php echo esc_attr( $args['more']['url'] ); ?>"
                        class="card-button"><?php echo esc_html( $args['more']['text'] ); ?></a>
                    <?php
                } ?>
            </div>
            <div class="col-md-6 mb-5 my-md-auto text-right">
                <img id="slide-prev" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-left.svg")?>" alt="prev" />
                <img id="slide-next" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-right.svg")?>" alt="next" />
            </div>
        </div>
        <div class="row ml-2 ml-md-0">
            <div class="prod-slide-wrapper">
                <div id="products-slide">
                    <div class="products-slide-single"><h3>1</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                    <div class="products-slide-single"><h3>2</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                    <div class="products-slide-single"><h3>3</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                    <div class="products-slide-single"><h3>4</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                    <div class="products-slide-single"><h3>5</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                    <div class="products-slide-single"><h3>6</h3><img src="<?php echo get_template_directory_uri() . "/assets/images/missing-image-portrait.png"?>" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>


