<?php 
if (isset($_GET["id"])) {
  require_once 'common/inc.php';
  $craft = CraftContentAR::model()->findByPk($_GET["id"]);
  if (!$craft || $craft->type != CraftContentAR::model()->type) {
    exit(header("Location: ./index.php"));
  }
}
else {
  exit(header("Location: ./index.php"));
}
?>


<?php 
$pagename="craft-page";
include_once 'common/header.php';?>
<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2 class="intoview-effect" data-effect="fadeup"><?php echo $craft->title?></h2>
					<p class="intoview-effect" data-effect="fadeup"><?php echo $craft->body?></p>
				</div>
				<div class="arrows detailnext" data-a="page-next"></div>
			</div>
		</div>
		
		<!-- video -->
		<div class="video intoview-effect" data-video="../SX/video/small" style="position:relative;overflow:hidden;"  data-effect="fadeup"><img src="<?php echo $craft->video_poster?>" width="100%" /></div>
		<!-- barbg -->
		<div class="barbg intoview-effect" data-effect="fadeup"></div>
		<!-- detail -->
		<div class="section ">
			<div class="detail detailW6 cs-clear">
					<h2 class="intoview-effect" data-effect="fadeup">Body and Soul Together<br />Seamless Clothing</h2>
					<p class="intoview-effect" data-effect="fadeup">Felt making is an ancient technique invented by herdsman to make non-woven cloth. Herdsmen use felt to make their rugs, yurts, clothing and cooking utensils. As nomadic peoples used these skills used to make yurts, the same skills, combined with original innovative designs, are used to create seamless felted cashmere one-off and unique garments with no stitching.</p>
			</div>
		</div>
		<!-- know how -->
		<div class="section">
			<div class="knowhow">
				<div class="knowhowtit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "KNOW - HOW")?></h2>
				</div>
				<div class="knowhowcom ">
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro  knowhowL">GATHERING</div>
						<div class="knowhowpic  knowhowR"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro  knowhowR">SELECTING<br />THE CASHMERE</div>
						<div class="knowhowpic  knowhowL"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro2  knowhowL"><p>COMBING <a href="#">read</a> </p></div>
						<div class="knowhowpic  knowhowR"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro  knowhowR">ROLLING THE FELT</div>
						<div class="knowhowpic  knowhowL"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro  knowhowL">CREATING<br />CLOTHING</div>
						<div class="knowhowpic  knowhowR"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear intoview-effect" data-effect="fadeup">
						<div class="knowhowintro  knowhowR">SHRINKING<br />THE CLOTHING</div>
						<div class="knowhowpic  knowhowL"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
				</div>
			</div>
		</div>
    <?php $products = loadCraftRelatedProducts($craft);?>
		<!-- related products -->
		<div class="section">
			<div class="products">
				<div class="productstit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "related products")?></h2>
				</div>
				<div class="productscom">
					<div class="productsinfor cs-clear">
            <?php $product = $products[0];?>
						<div class="proinfortxt intoview-effect" data-effect="fadeup">
							<div class="proinfortxt-inner">
								<h2><?php echo $product->title?></h2>
                <p><?php echo $product->body?></p>
							</div>
							<a href="#"><?php echo Yii::t("strings", "read more")?></a>
						</div>
						<div class="proinforpic intoview-effect" data-effect="fadeup">
							<div class="slide">
								<div class="slidebox cs-clear">
                  <?php foreach ($product->product_slide_image as $slide_image): ?>
                    <img class="slideitem" src="<?php echo $slide_image?>" width="100%" />
                  <?php endforeach;?>
								</div>
								<ul class="slidetab">
                  <?php foreach ($product->product_slide_image as $index => $slide_image): ?>
                    <li class="<?php if ($index == 0) echo "on"?>"></li>
                  <?php endforeach;?>
								</ul>
								<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
							</div>
						</div>
					</div>
					<!--  -->
					<div class="productslist cs-clear">
            <?php for($i = 1; $i < count($products); $i++): ?>
            <?php $product = $products[$i];?>
              <a href="#" class="prolistitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo $product->thumbnail?>" width="100%" />
                <p><?php echo $product->title?></p>
              </a>
            <?php endfor;?>
					</div>
				</div>
			</div>
		</div>
		<!--  other crafts -->
		<div class="section">
			<div class="products othercraf">
				<div class="productstit othercraftit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "other crafts")?></h2>
				</div>
				<div class="productscom othercrafcom">
					<!--  -->
					<div class="productslist cs-clear">
            <?php foreach(loadOtherCraft($craft->cid) as $item): ?>
              <a href="#" class="prolistitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo $item->thumbnail_image?>" width="100%" />
                <p><?php echo $item->title?></p>
              </a>
            <?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
<?php include_once 'common/footer.php';?>
