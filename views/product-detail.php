<?php 

if (isset($_GET["id"])) {
  require_once 'common/inc.php';
  $product = ProductContentAR::model()->findByPk($_GET["id"]);
  if (!$product || $product->type != ProductContentAR::model()->type) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
}

$pagename = 'product-detail';
?>
<?php include_once 'common/header.php';?>
		<!--  -->
		<!-- newscrumbs -->
		<div class="newscrumbs">
      <p><?php echo Yii::t("strings", "collections")?>&nbsp;&gt;&nbsp;<?php $collection = loadCollectionFromProduct($product); ?><a data-a="nav-link" href="<?php echo "/collection.php?cid=". $collection->cid?>"><?php echo loadCollectionFromProduct($product)->title?></a>&nbsp;&gt;&nbsp;<?php echo $product->title?> </p>
		</div>
		<!-- detail -->
		<div class="section ">
			<div class="detail coll_product cs-clear">
				<h2 class="intoview-effect" data-effect="fadeup"><?php echo $product->title?></h2>
				<div class=" detailcon js-horizontal-slide intoview-effect" data-effect="fadeup" data-num="1" style="margin:0 auto;float:none;">
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<div class="slide-con">
						<ul class="slide-con-inner cs-clear">
							<li style="float:left;">
								<p><?php echo $product->body?></p>
							</li>
							<li style="float:left;">
								<p><?php echo $product->body?></p>
							</li>
						</ul>
					</div>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
				</div>
			</div>
			<a href="#" style="margin-top:0;margin-bottom:100px;" class="btn transition-wrap" data-id="<?php echo $product->cid?>" data-d="product=<?php echo $product->cid?>" data-a="i-want-to-buy"><span class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></span></a>
		</div>
		<!--  -->
		<!-- video -->
    <?php if ($product->product_slide_image): ?>
      <div class="slide">
        <div class="slidebox cs-clear">
          <?php foreach (($product->product_slide_image) as $slide_image):?>
            <div data-resize="1600:560" class="slideitem"><img src="<?php echo $slide_image?>" width="100%" /></div>
          <?php endforeach;?>
        </div>
        <ul class="slidetab cs-clear">
          <?php foreach (array($product->thumbnail) as $index => $slide_image):?>
            <li class="<?php if ($index == 0) echo "on"?>"></li>
          <?php endforeach;?>
        </ul>
        <!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
      </div>
    <?php endif;?>
    
			<!-- barbg -->
		<div class="barbg"></div>
		
		<!-- collpiclist -->
    <?php if ($product->craft):?>
		<div class="section">
			<div class="knowhow">
				<div class="knowhowtit coll_video">
					<h2><?php echo $product->video_title?></h2>
				</div>
				<div class="coll_videocom ">
          <p><?php echo $product->video_description?></p>
          <?php if (is_weaving($product->craft)): ?>
            <div class="video" data-video-render="1" data-mp4="/video/Bamboo_Weaving_竹丝扣瓷_30s_1.mp4" data-webm="Bamboo_Weaving_竹丝扣瓷_30s_1.webm" >
              <img src="/photo/video2.jpg" width="100%" />
            </div>
          <?php elseif (is_cashmere($product->craft)): ?>
            <div class="video" data-video-render="1" data-mp4="/video/Cashmere_Felt_羊绒毡_30s_1.mp4" data-webm="Cashmere_Felt_羊绒毡_30s_1.webm"  >
              <img src="/photo/video3.jpg" width="100%" />
            </div>
          <?php elseif (is_eggshell($product->craft)): ?>
            <div class="video"  data-video-render="1" data-mp4="/video/Eggshell_Porcelain_薄胎瓷_30s_1.mp4" data-webm="Eggshell_Porcelain_薄胎瓷_30s_1.webm">
              <img src="/photo/video4.jpg" width="100%" />
            </div>
          <?php else: ?>
            <div class="video" data-video-render="1" data-mp4="/video/Zitan_紫檀_30s_1.mp4" data-webm="Zitan_紫檀_30s_1.webm"  >
              <img src="/photo/video1.jpg" width="100%" />
            </div>
          <?php ?>
          <?php endif;?>
				</div>
				<a data-a="nav-link" href="<?php echo "/collections.php?cid=". $product->collection?>" class="btn transition-wrap" ><span class="transition"><?php echo Yii::t("strings", "View more")?><br/><br/><?php echo Yii::t("strings", "View more")?></span></a>
			</div>
		</div>
    <?php endif;?>
		<!-- collpiclist -->


	<div class="collpiclist cs-clear" style="position:relative">
		<div class="section">
			<div class="products ">
				<div class="productstit ">
					<h2><?php echo Yii::t("strings", "similar products")?></h2>
				</div>
				<!--  -->
				<div class="products-wrap js-horizontal-slide intoview-effect" data-effect="fadeup" data-num="3">
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<div class="slide-con">
						<ul class="slide-con-inner piclist cs-clear">
							<?php foreach (loadSimilarProducts($product) as $index => $p): ?>
			                <li class="piclistitem collpicitem intoview-effect" data-effect="fadeup">
			                  	<a data-a="nav-link" href="/product-detail.php?id=<?php echo $p->cid?>"><img <?php if ($index > 3) echo "data-nopreload"?> src="<?php echo makeThumbnail($p->thumbnail, array(600, 570))?>" width="100%" />
			                  		<p><span class="collicon"><?php echo $p->title?></span></p>
			                	</a> 
			                </li>
            	<?php endforeach;?>
						</ul>
					</div>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
				</div>
			</div>
		</div>
	</div>

<?php include_once 'common/footer.php';?>
