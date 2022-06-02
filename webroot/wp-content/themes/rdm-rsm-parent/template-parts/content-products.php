<?php
/** @var array $args */

if ( empty ( $args['title'] ) ||
     empty ( $args['description'] ) ) {
	return '';
}

$shortDescriptions = array(
  "sports" => "Home to Canada's #1 sports media brand, Sportsnet",
  "tv & streaming" => "Reaching 76% of total Canadian TV audience",
  "radio & podcasts" => "Broadcasting over 55 Radio Stations and 29+ Podcasts",
  "creative solutions" => "Helping clients and partners deliver breakthrough, innovative content",
  "today's shopping choice" => "Leading interactive, multi-channel, Canada's only televised retailer",
  "out of home" => "Maximize your brand impact",
  "advanced solutions" => "Leverage data to develop the next generation of ad experiences",
);

$product_page = get_page_by_title('What We Do');
$product_block_arr = array();
if ( has_blocks( $product_page->post_content ) ) {
	$blocks = parse_blocks( $product_page->post_content );
    $product_blocks = array_filter( $blocks, function ( $block ) {
        return $block['blockName'] === 'rsm/products-block';
    } );
    if(!empty($product_blocks)){
        foreach($product_blocks as $block){
            $block_info = array();
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($block['innerHTML']);
            $xp = new DOMXpath($dom);
            //we only have one set of element, so use the first of each block
            $block_info['title'] = $xp->query('//h2')->item(0)->nodeValue;
            $block_info['link'] = $xp->query('//a')->item(0)->getAttribute('href');
            $block_info['img_src'] = $xp->query('//img')->item(0)->getAttribute('src');
            $block_info['short_description'] = $shortDescriptions[strtolower($block_info['title'])];
            $product_block_arr[] = $block_info;
        }
    }
}

?>

<div class="products">
    <div class="container products-container pt-5">
        <div class="row ml-2 ml-md-0">
            <div class="col-md-6 mb-5 my-md-auto">
                <div class="products-container-main">
                    <h2 class="products-container-title"><?php echo esc_html( $args['title'] ); ?></h2>
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
            <div class="d-none d-sm-block col-md-6 mb-5 my-md-auto text-right">
                <img id="slide-prev" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-left.svg")?>" alt="prev" />
                <img id="slide-next" class="slide-control" src="<?php echo (get_template_directory_uri() . "/assets/images/btn-arrow-right.svg")?>" alt="next" />
            </div>
        </div>
        <?php if (!empty($product_block_arr)){ ?>
            <div class="row ml-2 ml-md-0">
                <div class="prod-slide-wrapper">
                    <div id="products-slide">
                        <?php foreach($product_block_arr as $block) {?>
                        <div class="products-slide-single">
                            <a href="<?php echo $block['link'];?>" >
                                <h3><?php echo $block['title'];?></h3>
                            </a>
                            <a href="<?php echo $block['link'];?>" >
                                <img src="<?php echo $block['img_src'];?>" alt="<?php echo $block['title'];?>">
                            </a>
                            <p class="products-slide-text"><?php echo $block['short_description']; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
