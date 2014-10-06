<?php 
$pagename='gift-corner';
include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail coll_product cs-clear">
				<div class="range">
			 	</div>	
				<h2 class="intoview-effect" data-effect="fadeup">shang xia gift corner</h2>
				<div class=" detailcon js-horizontal-slide intoview-effect" data-split="1" data-effect="fadeup" data-num="1" style="margin:0 auto;float:none;">
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<div class="slide-con">
						<ul class="slide-con-inner cs-clear">
							<li style="float:left;">
                <?php echo Yii::t("strings", "<p>The products below are available in out boutiques. They are great gifts for your beloved ones. <br />Please select the products you would be interested in, and give us your contact information. You will then receive a personal call from someone at Shang Xia who will help you bare your gift delivered</p>")?>
							</li>
						</ul>
					</div>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
				</div>
			</div>
		</div>
		
		<!-- collection list -->
		<div class="section ">
			<div class="colllistbox ">
				<!--  -->
        <?php $gifts = GiftContentAR::model()->getList();?>
					<ul class="piclist cs-clear">
            <?php foreach ($gifts as $gift): ?>
              <li class="piclistitem intoview-effect" data-effect="fadeup">
                <img data-a="i-want-to-buy" data-d="" src="<?php echo makeThumbnail($gift->thumbnail, array(414, 219))?>" width="100%" />
                  <p><span class=""><?php echo $gift->title?></span></p>
                  <div class="price">¥ <?php echo $gift->price;?></div>
                  <a href="#" data-a="i-want-to-buy" data-d="product=1&pics=/images/colldemo.jpg,/images/colldemo.jpg,/images/colldemo.jpg" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></span></a>
                  <textarea style="display:none;">
                  <?php echo json_encode(array("name" => $gift->title, 
                      "pics" => $gift->product_slide_image, 
                      "product" => $gift->cid, 
                      "price" => $gift->price,
                      "color" => $gift->color,
                      "material" => $gift->material,
                      "size" => $gift->size,
                      "unit" => $gift->unit,
                      "desc" => $gift->body))?>
                  </textarea>
                </li>
            <?php endforeach;?>
					</ul>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>
