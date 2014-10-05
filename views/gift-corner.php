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
                <p>The products below are available in out boutiques. They are great gifts for your beloved ones. <br />Please select the products you would be interested in, and give us your contact information. You will then receive a personal call from someone at Shang Xia who will help you bare your gift delivered</p>
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
					<ul class="piclist cs-clear">
						<li class="piclistitem intoview-effect" data-effect="fadeup">
                <img src="/images/colldemo.jpg" width="100%" />
                <p><span class="">hahaha</span></p>
                <div class="price">¥ 1,000</div>
                <a href="#" data-a="i-want-to-buy" data-d="product=1&pics=/images/colldemo.jpg,/images/colldemo.jpg,/images/colldemo.jpg" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></span></a>
                <textarea style="display:none;">{
                	"name": "\"Bridge\ Bamboo Wasdasdasdasd",
                	"pics":["/images/colldemo.jpg","/images/colldemo.jpg","/images/colldemo.jpg"],
                	"product":1,
                	"price": 5000,
                	"color" : "proccc color",
                	"material": "bamboo",
                	"size": "146*169mm",
                	"unit": "1pc",
                	"desc": 'Forasdasdk kjasd jahs dhjas dasdhask dahskj dkjashd kasjh djhas dkahs djashkd ahsj djaghs djasgh djsagjd aghsj dgjas dgjash gdjas djags djghas djas '
                }</textarea>
              </li>
              <li class="piclistitem intoview-effect" data-effect="fadeup">
                <img src="/images/colldemo.jpg" width="100%" />
                <p><span class="">hahaha</span></p>
                <div class="price">¥ 1,000</div>
                <a href="#" data-a="i-want-to-buy" data-d="product=1&pics=/images/colldemo.jpg,/images/colldemo.jpg,/images/colldemo.jpg" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></span></a>
                <textarea style="display:none;">{
                	"name": "\"Bridge\ Bamboo Wasdasdasdasd",
                	"pics":["/images/colldemo.jpg","/images/colldemo.jpg","/images/colldemo.jpg"],
                	"product":1,
                	"price": 5000,
                	"color" : "proccc color",
                	"material": "bamboo",
                	"size": "146*169mm",
                	"unit": "1pc",
                	"desc": 'Forasdasdk kjasd jahs dhjas dasdhask dahskj dkjashd kasjh djhas dkahs djashkd ahsj djaghs djasgh djsagjd aghsj dgjas dgjash gdjas djags djghas djas '
                }</textarea>
              </li>
              <li class="piclistitem intoview-effect" data-effect="fadeup">
                <img src="/images/colldemo.jpg" width="100%" />
                <p><span class="">hahaha</span></p>
                <div class="price">¥ 1,000</div>
                <a href="#" data-a="i-want-to-buy" data-d="product=1&pics=/images/colldemo.jpg,/images/colldemo.jpg,/images/colldemo.jpg" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "I Want To Buy")?><br/><br/><?php echo Yii::t("strings", "I Want To Buy")?></span></a>
                <textarea style="display:none;">{
                	"name": "\"Bridge\ Bamboo Wasdasdasdasd",
                	"pics":["/images/colldemo.jpg","/images/colldemo.jpg","/images/colldemo.jpg"],
                	"product":1,
                	"price": 5000,
                	"color" : "proccc color",
                	"material": "bamboo",
                	"size": "146*169mm",
                	"unit": "1pc",
                	"desc": 'Forasdasdk kjasd jahs dhjas dasdhask dahskj dkjashd kasjh djhas dkahs djashkd ahsj djaghs djasgh djsagjd aghsj dgjas dgjash gdjas djags djghas djas '
                }</textarea>
              </li>
              
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
