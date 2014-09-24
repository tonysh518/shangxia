<?php include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows arrows4 detailprev" data-a="page-prev"></div>
				<div class=" detailcon ">
					<h2 class="colllisticon intoview-effect" data-effect="fadeup">shang xia gift corner</h2>
					<p>The products below are available in out boutiques. They are great gifts for your beloved ones. <br />Please select the products you would be interested in, and give us your contact information. You will then receive a personal call from someone at Shang Xia who will help you bare your gift delivered</p>
				</div>
				<div class="arrows arrows4 detailnext" data-a="page-next"></div>
			</div>
		</div>
		
		<!-- collection list -->
		<div class="section ">
			<div class="colllistbox ">
				<!--  -->
					<ul class="piclist cs-clear">
            <?php $gifts = GiftContentAR::model()->getList();?>
            <?php foreach ($gifts as $gift): ?>r
              <li class="piclistitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo $gift->thumbnail?>" width="100%" />
                <p><span class=""><?php echo $gift->title?></span></p>
                <a href="#" data-a="i-want-to-buy" data-d="product=<?php echo $gift->cid?>" class="btn transition-wrap"><i class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></i></a>
              </li>
            <?php endforeach;?>
					</ul>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>
