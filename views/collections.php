<?php
if (isset($_GET["cid"])) {
  require_once 'common/inc.php';
  $collection = CollectionContentAR::model()->findByPk($_GET["cid"]);
  if (!$collection || $collection->type != CollectionContentAR::model()->type) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
}


// fix has slider
$has_slider = array('apparel','homeware');
?>

<?php include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section intoview-effect" data-effect="fadeup">
			<div class="detail cs-clear">
				<div class="arrows arrows3 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo $collection->title?></h2>
					<div class="Garamond"><?php echo $collection->public_date?></div>
				</div>
				<div class="arrows arrows3 detailnext" data-a="page-next"></div>
			</div>
		</div>

		<!-- slide -->
		<div class="slide intoview-effect" data-effect="fadeup">
			<div class="slidebox cs-clear">
        <?php foreach ($collection->slide_image as $image): ?>
        <a href="#" class="slideitem"><img src="<?php echo $image?>" width="100%" /></a>
        <?php endforeach;?>
			</div>
			<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
		</div>
		<!-- barbg -->
		<div class="barbg intoview-effect" data-effect="fadeup"></div>
    <?php $types = ProductContentAR::getType(); ?>
    
    <?php foreach($types as $type_id => $type): ?>
		<!-- <?php echo $type?> -->
		<div class="collpiclist cs-clear">
			<!--  -->
			<div class="section">
				<div class="products ">
					<div class="productstit collpictit intoview-effect" data-effect="fadeup">
						<h2><?php echo $type?></h2>
					</div>
					<!--  -->
					<div class="products-wrap js-horizontal-slide intoview-effect" data-effect="fadeup" data-num="3">
						<?php if ( in_array( strtolower($type), $has_slider ) ){ ?>
						<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
						<?php }?>
						<div class="slide-con">
              <?php $products = getProductInTypeWithCollection($type_id, $collection->cid);?>
              <?php if ($_GET["cid"] == 20331 && strtolower($type) == 'apparel'): ?>
                <ul class="slide-con-inner piclist cs-clear slider-type-3">
                  <?php foreach (array_values($products) as $index => $product): ?>
                    <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                      <a href="./product-detail.php?id=<?php echo $product->cid?>">
                        <?php if ($_GET["cid"] == 20331 && strtolower($type) == 'apparel'): ?>
                          <?php echo getSlideImageHtml( $product->thumbnail, 3); ?>
                        <?php endif;?>
                          <p><span class="collicon"><?php echo $product->title?></span></p>
                      </a>
                    </li>
                  <?php endforeach;?>
                </ul>
              <?php elseif ($_GET["cid"] == 20331 && strtolower($type) == "teaware"): ?>
                <ul class="slide-con-inner piclist cs-clear slider-type-2">
                  <?php foreach (array_values($products) as $index => $product): ?>
                    <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                      <a href="./product-detail.php?id=<?php echo $product->cid?>">
                          <?php if ($index % 2 == 0): ?>
                            <?php echo getSlideImageHtml( $product->thumbnail, 1); ?>
                          <?php else: ?>
                            <?php echo getSlideImageHtml( $product->thumbnail, 2); ?>
                          <?php endif;?>
                          <p><span class="collicon"><?php echo $product->title?></span></p>
                      </a>
                    </li>
                  <?php endforeach;?>
                </ul>
              <?php elseif ($_GET["cid"] == 20331 && strtolower($type) == "jewelry"): ?>
                  <ul class="slide-con-inner piclist cs-clear slider-type-2">
                  <?php foreach (array_values($products) as $index => $product): ?>
                    <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                      <a href="./product-detail.php?id=<?php echo $product->cid?>">
                          <?php if ($index % 2 == 0): ?>
                            <?php echo getSlideImageHtml( $product->thumbnail, 2); ?>
                          <?php else: ?>
                            <?php echo getSlideImageHtml( $product->thumbnail, 1); ?>
                          <?php endif;?>
                          <p><span class="collicon"><?php echo $product->title?></span></p>
                      </a>
                    </li>
                  <?php endforeach;?>
                  </ul>
              <?php else: ?>
                <ul class="slide-con-inner piclist cs-clear">
                  <?php foreach (array_values($products) as $index => $product): ?>
                    <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                      <a href="./product-detail.php?id=<?php echo $product->cid?>">
                          <img data-width="1" data-height="1"  src="<?php echo makeThumbnail($product->thumbnail, array(600, 570))?>" width="100%" />
                          <p><span class="collicon"><?php echo $product->title?></span></p>
                      </a>
                    </li>
                  <?php endforeach;?>
                </ul>
              <?php endif;?>
						</div>
						<?php if ( in_array( strtolower($type), $has_slider ) ){ ?>
						<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
    <?php endforeach;?>
    <div style="height:100px;"></div>
<?php include_once 'common/footer.php';?>
