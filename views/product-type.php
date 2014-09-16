<?php

if (isset($_GET["name"])) {
  require_once 'common/inc.php';
  if (ProductContentAR::isType($_GET["name"]) === FALSE) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
}

$productsGroupWithCollection = getProductInType(ProductContentAR::getKeyWithTypeName($_GET["name"]));
$product_type = $_GET["name"];

?>

  <?php include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "SHANG XIA ". $_GET["name"])?></h2>
				</div>
				<div class="arrows arrows2 detailnext" data-a="page-next"></div>
			</div>
		</div>
		<!-- slide -->
		<div class="banner scroll-lowheight" name="<?php echo $product_type?>">
      <?php if ($product_type == "apparel"): ?>
        <img class="scroll-lowheight-item" src="/photo/collection-apparels.jpg" width="100%" />
      <?php elseif ($product_type == "jewelry"): ?>
        <img class="scroll-lowheight-item" src="/photo/collection-jewelry.jpg" width="100%" />
      <?php elseif ($product_type == "teaware"): ?>
        <img class="scroll-lowheight-item" src="/photo/product_type-teaware.jpg" width="100%" />
      <?php elseif ($product_type == "homeware"): ?>
        <img class="scroll-lowheight-item" src="/photo/product_type-homeware.jpg" width="100%" />
      <?php else : ?>
        <img class="scroll-lowheight-item" src="/photo/product_type-furniture.jpg" width="100%" />
      <?php endif;?>
		</div>
		<!-- barbg -->
		<div class="barbg"></div>
		<!-- apparel -->

<?php foreach ($productsGroupWithCollection as $collection_id => $products): ?>
    
<?php
  $collection = CollectionContentAR::model()->findByPk($collection_id);
?>
	<div class="collpiclist cs-clear">
		<div class="collarrows collarrowsprev"></div>
		<!--  -->
		<div class="section">
			<div class="products ">
				<div class="productstit collpictit_app" style="line-height: 230px;">
					<h2 style="line-height: 20px;"><?php echo $collection->title?><span><?php echo $collection->public_date?></span></h2>					
				</div>	
				<!--  -->
				<div class="products-wrap js-horizontal-slide" data-num="3">
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<ul class="piclist cs-clear slide-con">
            <?php foreach ($products as $product):?>
              <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo makeThumbnail($product->thumbnail, array(412, 390))?>" width="100%" />
                <p><span class="collicon"><?php echo $product->title?></span></p>
              </li>
            <?php endforeach;?>
					</ul>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="collarrows collarrowsnext"></div>
	</div>
<?php endforeach;?>

<?php include_once 'common/footer.php';?>