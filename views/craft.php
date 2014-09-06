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
		<div class="video intoview-effect" data-video-render="../SX/video/small" style="position:relative;overflow:hidden;"  data-effect="fadeup"><img src="<?php echo $craft->video_poster?>" width="100%" /></div>
		<!-- barbg -->
		<div class="barbg intoview-effect" data-effect="fadeup"></div>
		<!-- detail -->
		<div class="section ">
			<div class="detail detailW6 cs-clear">
					<h2 class="intoview-effect" data-effect="fadeup"><?php echo $craft->head_title?></h2>
					<p class="intoview-effect" data-effect="fadeup"><?php echo $craft->head_body?></p>
			</div>
		</div>
		<!-- know how -->
	<?php include_once 'widget/how-weaving.php';?>
	<?php include_once 'widget/how-felt.php';?>
	<?php include_once 'widget/how-weaving.php';?>
	<?php include_once 'widget/how-weaving.php';?>
	<?php include_once 'widget/how-weaving.php';?>
	<?php include_once 'widget/how-weaving.php';?>
    <?php $products = loadCraftRelatedProducts($craft);?>
		<!-- related products -->
    <?php if (count($products)) : ?>
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
                  <?php foreach ($product->product_slide_image as $index => $slide_image): ?>
                  <img <?php if ($index > 3) echo "data-nopreload"?> class="slideitem" src="../SX/images/product_related.jpg" width="100%" />
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
                <img src="<?php echo makeThumbnail($product->thumbnail, array(600, 570))?>" width="100%" />
                <p><?php echo $product->title?></p>
              </a>
            <?php endfor;?>
					</div>
				</div>
			</div>
		</div>
    <?php endif;?>

    	<!-- related products -->
		<div class="section">
			<div class="products">
				<div class="productstit">
					<h2><?php echo Yii::t("strings", "related products");?></h2>
				</div>
				<div class="productscom">
					<div class="productsinfor cs-clear">
						<div class="proinfortxt aboutinfortxt intoview-effect" data-effect="fadeup">
							<!-- <h2> </h2> -->
							<p>As Artistic Director and CEO of SHANG XIA, Ms. Jiang Qiong Er is a Chinese contemporary designer of international reputation infusing the subtlety, beauty and heritage of Chinese culture. Her designs breathe elegance of innovation and imagination. Her international vision and open mind, along with her multi-cultural background, naturally allow her creativity to express itself; preserving and respecting tradition, both Eastern and Western.Jiang Qiong Er was introduced to traditional painting when she was only two and later became a student of famous painter Cheng Shi Fa and calligrapher Han Tian Hong. After graduation from Tong Ji University in Art & Design, she went on to the Decorative Arts School in Paris to further her studies in furniture and interior design.</p>
							<a href="#" class="btn transition-wrap"><span class="transition">Read more<br><br>Read more</span></a>
						</div>
						<div class="proinforpic intoview-effect" data-effect="fadeup">
							<div class="slide">
								<div class="slidebox cs-clear">
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
								</div>
								<ul class="slidetab">
									<li></li>
									<li class="on"></li>
									<li></li>
									<li></li>
								</ul>
								<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
							</div>
						</div>
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
