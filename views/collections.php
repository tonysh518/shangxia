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
					<div><?php echo $collection->public_date?></div>
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
			<ul class="slidetab cs-clear">
				<?php foreach ($collection->slide_image as $key => $image): ?>
          <li class="<?php if ($key == 0) echo "on"?>"></li>
        <?php endforeach;?>
			</ul>
			<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
		</div>
		<!-- barbg -->
		<div class="barbg"></div>
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
							<ul class="slide-con-inner piclist cs-clear">
                <?php foreach (array_values($products) as $index => $product): ?>
                  <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
                    <a href="./product-detail.php?id=<?php echo $product->cid?>">
                      <img <?php if ($index > 3) echo "data-nopreload"?> src="<?php echo makeThumbnail($product->thumbnail, array(600, 570))?>" width="100%" />
                      <p><span class="collicon"><?php echo $product->title?></span></p>
                    </a>
                  </li>
                <?php endforeach;?>
							</ul>
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
