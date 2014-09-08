<?php 
  $map = 'baidu';
  $city = getCity();
  if ($city == "paris") {
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
            <?php echo Yii::t("strings", "CRAFTS")?>
            <?php foreach (CraftContentAR::model()->getList() as $craft): ?>
              <a data-a="nav-link" href="/craft.php?a=<?php echo $craft->cid?>"><?php echo $craft->title?></a>
            <?php endforeach;?>
					</div>
					<div class="sitelinkitem sitelinkitemS intoview-effect" data-effect="fadeup">
            <?php echo Yii::t("strings", "BOUTIQUES")?>
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
						<a data-a="nav-link" href="#">brand story</a>
						<a data-a="nav-link" href="#">artstic director</a>
						<a data-a="nav-link" href="#">hertage & encounter</a>
						<a data-a="nav-link" href="#">jobs</a>
					</div>
					<div class="sitelinkitem sitelinkitemXS intoview-effect" data-effect="fadeup">
						<h2>CONTACT</h2>
						<a href="#" class="ft_wx">weixin</a>
						<a href="#" class="ft_wb">weibo</a>
						<br>
						<a href="#" style="width: auto;line-height: initial;height: auto;margin-top: 48px;" data-a="newsletter">subscribe to shang xia newsletter</a>
					</div>
				</div>
				<!-- copyright -->
				<div class="copyright">
					<p>ICP LICENCE 12345678 - PRIVACY POLICY LEGAL INFORMATION - <a href="#" data-a="newsletter">NEWSLETTER</a></p>
				</div>
			</div>
		</div>
		<!--  -->
	</div>

<script type="text/tpl" id="newsletter">
	<h2>I want to buy</h2>
	<div class="popcontxt">
		<p>You are interested by buying this product? <br/>
		Let us contact you back and we will arrange a way to provide you this prodcut</p>
		<form class="buy-form conformbox">
			<div class="conformtit">YOUR NAME</div>
			<input type="text" />
			<div class="conformtit">YOUR EMAIL</div>
			<input type="text" />
			<div class="conformtit">YOUR PHONE</div>
			<input type="text" />
			<button class="conformbtn">CONTACT ME BACK</button>

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
<script type="text/javascript" src="/js/script.js"></script>

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