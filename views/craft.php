<?php 

if (isset($_GET["cid"])) {
  require_once 'common/inc.php';
  $loadedCraft = CraftContentAR::model()->findByPk($_GET["cid"]);
  if (!$loadedCraft || $loadedCraft->type != CraftContentAR::model()->type) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
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
					<h2 class="intoview-effect" data-effect="fadeup"><?php echo $loadedCraft->title?></h2>
					<p class="intoview-effect" data-effect="fadeup"><?php echo $loadedCraft->body?></p>
				</div>
				<div class="arrows detailnext" data-a="page-next"></div>
			</div>
		</div>
		
		<!-- video -->
		<div class="video intoview-effect" data-mp4="/video/small.mp4" data-webm="/video/small.webm" style="position:relative;overflow:hidden;"  data-effect="fadeup">
			<img src="<?php echo $loadedCraft->video_poster?>" width="100%" />
		</div>
		<!-- barbg -->
		<div class="barbg"></div>
		<!-- detail -->
		<div class="section ">
			<div class="detail detailW6 cs-clear">
					<h2 class="intoview-effect" data-effect="fadeup"><?php echo $loadedCraft->head_title?></h2>
					<p class="intoview-effect" data-effect="fadeup"><?php echo $loadedCraft->head_body?></p>
			</div>
		</div>
		<!-- know how -->
    <?php if (is_weaving()): ?>
      <?php include_once 'widget/how-weaving.php';?>
    <?php elseif (is_cashmere()): ?>
      <?php include_once 'widget/how-cashmere_felt.php';?>
    <?php elseif (is_eggshell()): ?>
      <?php include_once 'widget/how-eggshell_porcelain.php';?>
    <?php else: ?>
      <?php include_once 'widget/how-zitan.php';?>
    <?php ?>
    <?php endif;?>
    <?php $products = loadCraftRelatedProducts($loadedCraft);?>
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
                  <img <?php if ($index > 3) echo "data-nopreload"?> class="slideitem" src="/images/product_related.jpg" width="100%" />
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
							<a href="#" data-a="craft-read" class="btn transition-wrap"><span class="transition">Read more<br><br>Read more</span></a>
							<textarea style="display:none;">
								<h2>Construction</h2>
								<div class="popcontxt">
									<p>All Chinese furniture bases its construction on ancient architecture. The bridge, beam, post, pole and sparrow brace in architecture all have their equivalent within chair making, as the seat frame, edge, stretcher and brace are similar to elements in architecture.</p>
									<p>Metal nails are never used when connecting components, instead, mortise and tenons are used to fit legs and waists together in waisted furniture, and also together with stretchers. </p>
									<p>Ancient people used the expression “will not fall in eternity” to describe the strength of mortise and tenons. Mortise and tenons can endure pressure from several directions making the furniture as stable and enduring as Mount Tai. </p>
									<p>In ancient times, due to the technical limit of carpentry, mortise and tenons were difficult to make and joints came loose easily. </p>
									<p>Today, with the help of precise mechanisms,Master Gu has improved the accuracy of the joints by perfecting the quality of the mortise and tenons so that indeed they “will not fall in eternity”.</p>
								</div>
							</textarea>
						</div>
						<div class="proinforpic intoview-effect" data-effect="fadeup" data-effect-delay="400">
							<div class="slide">
								<div class="slidebox cs-clear">
									<img class="slideitem" src="/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="/images/proinfopic.jpg" width="100%" />
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
