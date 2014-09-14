<?php 
  $map = 'baidu';
  $city = getCity();
  if ($city == "paris" || ( isset($_GET["type"]) && $_GET["type"] == "paris")) {
    $map = "google";
  }
?>
<!-- footer -->
		<div class="footer">		
			<!-- location -->
			<?php
			// <div class="location intoview-effect" data-effect="fadeup">
			// 	<div class="range">
			// 		<p class="rangetxt">In addition to the range of homeware and accessories</p>
			// 		<a href="#" title="" class="rangebtn transition-wrap"><span class="transition">Enter the gift corner<br/><br/>Enter the gift corner</span></a>
			// 	</div>			
			// </div>
			?>
			<!-- store -->
			<div class="section store cs-clear ">
        <?php 
          $store = BoutiqueContentAR::model()->loadByAddressKey($city);
          // 如果没有找到，拿认为Shanghai 是默认的
          if (!$store) {
            $store = BoutiqueContentAR::model()->loadByAddressKey("shanghai");
          }
          $cities = array_diff(array_keys(BoutiqueContentAR::getLocation()), array($store->location));
          
        ?>
        <?php if ($store): ?>
				<div class="storechoose intoview-effect" data-effect="fadeup">
					<h2><?php echo $store->title?></h2>
          <p><?php echo $store->body?></p>
					<ul class="storechooselist cs-clear">
            <?php foreach ($cities as $city): ?>
            <li><a href="/boutique.php?type=<?php echo $city?>" title="" class="transition-wrap">
                <span class="transition"><?php echo Yii::t("strings", "{city} Store", array("{city}" => ucfirst($city)))?>
                  <br/><br/><?php echo Yii::t("strings", "{city} Store", array("{city}" => ucfirst($city)))?>
                </span>
              </a>
            </li>
            <?php endforeach;?>
					</ul>
				</div>
				<div class="storemap intoview-effect" data-effect="fadeup" style="height:400px;position:relative;">
					<div class="storemap-wrap" id="map" data-map-type="<?php echo $map;?>" data-map="<?php echo $store->latlng?>" >
					</div>
				</div>
      <?php endif;?>
				
			</div>
			<!-- sitelinks -->
			<div class="footer-bottom">
				<div class="section sitelinks cs-clear">
					<div class="sitelinkitem intoview-effect" data-effect="fadeup">
						<h2><?php echo Yii::t("strings", "COLLECTIONS")?></h2>
            <?php foreach (CollectionContentAR::model()->getList() as $collection): ?>
              <a data-a="nav-link" href="/collections.php?cid=<?php echo $collection->cid?>"><?php echo $collection->title?></a>
            <?php endforeach;?>
					</div>
					<div class="sitelinkitem intoview-effect" data-effect="fadeup">
            <h2><?php echo Yii::t("strings", "CRAFTS")?></h2>
            <?php foreach (CraftContentAR::model()->getList() as $craft): ?>
              <a data-a="nav-link" href="/craft.php?a=<?php echo $craft->cid?>"><?php echo $craft->title?></a>
            <?php endforeach;?>
					</div>
					<div class="sitelinkitem sitelinkitemS intoview-effect" data-effect="fadeup">
            <h2><?php echo Yii::t("strings", "BOUTIQUES")?></h2>
            <?php foreach (BoutiqueContentAR::getLocation() as $key => $name): ?>
              <a data-a="nav-link" href="/boutique.php?type=<?php echo $key?>"><?php echo $name?></a>
            <?php endforeach;?>
					</div>
					<div class="sitelinkitem sitelinkitemS intoview-effect" data-effect="fadeup">
						<h2><?php echo Yii::t("strings", "NEWS")?></h2>
						<a data-a="nav-link" href="/news.php"><?php echo Yii::t("strings", "news")?></a>
						<a data-a="nav-link" href="/news-event.php"><?php echo Yii::t("strings", "events")?></a>
						<a data-a="nav-link" href="/news-press.php"><?php echo Yii::t("strings", "press")?></a>
					</div>
					<div class="sitelinkitem intoview-effect" data-effect="fadeup">
						<h2><?php echo Yii::t("strings", "ABOUT")?></h2>
						<a data-a="nav-link" href="/about.php#bran">brand story</a>
						<a data-a="nav-link" href="/about.php#arts">artstic director</a>
						<a data-a="nav-link" href="/about.php#hert">hertage & encounter</a>
						<a data-a="nav-link" href="/about.php#jobs">JOIN SHANG XIA</a>
					</div>
					<div class="sitelinkitem sitelinkitemXS intoview-effect" data-effect="fadeup">
						<h2><?php echo Yii::t("strings", "CONTACT")?></h2>
						<a href="#" class="ft_wx">weixin</a>
						<a href="http://www.weibo.com/shangxia" target="_blank" class="ft_wb">weibo</a>
						<br>
						<a href="#" style="width: auto;line-height: initial;height: auto;margin-top: 48px;" data-a="newsletter">subscribe to shang xia newsletter</a>
					</div>
				</div>
				<!-- copyright -->
				<div class="copyright">
					<p><a href="http://www.sgs.gov.cn/lz/licenseLink.do?method=licenceView&entyId=20120529122952909">ICP LICENCE 20120529122952909</a> - PRIVACY POLICY LEGAL INFORMATION</p>
				</div>
			</div>
		</div>
		<!--  -->
	</div>

<script type="text/tpl" id="newsletter">
	<h2>SUBSCRIBE TO <br/> SHANG XIA NEWSLETTER </h2>
	<div class="popcontxt">
		<p style="margin:5px 0;">To receive updates about SHANGXIA , <br/>
		please provide the following information:</p>
		<form class="buy-form conformbox" action="/admin/api/content/newsletter" method="post">
			<div class="conformtit">YOUR NAME <span class="error" id="name-tip"></span></div>
			<input type="text" name="name" data-required="name required"/>
			<div class="conformtit">YOUR EMAIL <span class="error" id="email-tip"></span></div>
			<input type="text" name="email" data-required="email required"/>
			<div class="conformtit">YOUR PHONE <span class="error" id="phone-tip"></span></div>
			<input type="text" name="phone" data-required="phone required"/>
			<p style="margin:30px -20px 0">SHANGXIA does not rent or sell customer <br/>
			email addresses to third parties.</p>
			<button class="conformbtn" data-a="newsletter-send">SEND</button>
		</form>
	</div>
</script>

<script type="text/tpl" id="i_want_to_buy">
	<h2>I want to buy</h2>
	<div class="popcontxt">
		<p>You are interested by buying this product? <br/>
		Let us contact you back and we will arrange a way to provide you this prodcut</p>
		<form class="buy-form conformbox" action="/admin/api/content/wantobuy" method="post">
			<input type="hidden" name="product" value="#[product]"/>
			<div class="conformtit">YOUR NAME <span class="error" id="name-tip"></span></div>
			<input type="text" name="name" data-required="name required"/>
			<div class="conformtit">YOUR EMAIL <span class="error" id="email-tip"></span></div>
			<input type="text" name="email" data-required="email required"/>
			<div class="conformtit">YOUR PHONE <span class="error" id="phone-tip"></span></div>
			<input type="text" name="phone" data-required="phone required"/>
			<button class="conformbtn" data-a="contact-me-back">CONTACT ME BACK</button>
			<a href="">VIEW ALL THE SHANG XIA GIFTS</a>
		</form>
	</div>
</script>

<!--  -->

<?php
if( $map == 'google' ) {?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<?php }?>
<script type="text/javascript" src="/js/plugin/modernizr-2.5.3.min.js"></script>
<script type="text/javascript" src="/js/sea/sea-debug.js" data-config="/js/config.js"></script>
<script type="text/javascript" src="/js/sea/plugin-shim.js"></script>
<script type="text/javascript" src="/js/lp.core.js"></script>
<script type="text/javascript" src="/js/lp.base.js"></script>

<!--IE6透明判断-->
<!--[if IE 6]>
<script src="../SX/js/DD_belatedPNG.js"></script>
<script>
    DD_belatedPNG.fix('*');
    document.execCommand("BackgroundImageCache", false, true);
</script>
<![endif]-->
</body>
</html>