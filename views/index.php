<?php  $homepage = 1; $pagename = 'home-page';?>
<?php include_once 'common/header.php';?>

	<!-- intro -->
	<div class="section intoview-effect" data-effect="fadeup" data-editme-key="home_brand_story_summary">
    <?php editme("home_brand_story_summary")?>
		<div class="intro">
			<p class="introtxt" data-editme-body=".introtxt">SHANG XIA IS A BRAND FOR ART OF LIVING
THAT PROMISES A UNIQUE ENCOUNTER WITH THE HERITAGE OF CHINESE DESIGN AND CRAFTSMANSHIP.</p>
			<a href="./about.php" title="" class="introbtn transition-wrap"><span class="transition"><?php echo Yii::t("strings" ,"Brand story")?><br/><br/><?php echo Yii::t("strings", "Brand story")?></span></a>
		</div>
	</div>
	<!-- piclist -->
	<div class="section">
		<ul class="piclist home-piclist cs-clear">
			<li class="piclistitem intoview-effect" data-effect="fadeup" data-editme-key="home_middle_slide_one">
        		<a href="">
					<img src="/images/homepage01.jpg" width="100%" />
					<p>shang xia is now opening <br/> its maison in shanghai</p>
				</a>
			</li>
			<li class="piclistitem intoview-effect" data-effect="fadeup" data-editme-key="home_middle_slide_two">
        <?php editme("home_middle_slide_two" ,array("title", "link_to"), array("image"))?>
        		<a href="">
					<img src="/images/homepage02.jpg" width="100%" />
					<p>THE FIRST SHANG XIA BAG</p>
				</a>
			</li>
			<li class="piclistitem intoview-effect marginR0" data-effect="fadeup" data-editme-key="home_middle_slide_third">
        <?php editme("home_middle_slide_third" ,array("title", "link_to"), array("image"))?>
        		<a href="">
					<img src="/images/homepage03.jpg" width="100%" />
					<p>GIFT CORNER</p>
				</a>
			</li>
		</ul>
	</div>
	<!-- slide -->
	<div class="slide-wrap section intoview-effect" data-effect="fadeup">
		<div class="collarrows collarrowsprev home-collarrowsprev" data-a="home-collarrowsprev"></div>
		<div class="slide" id="homepage-video-slide" data-auto="false">
			<ul class="slidebox cs-clear">
				<li href="#" class="slideitem" data-tit="<?php echo Yii::t("strings", "Bamboo Weaving")?>" data-video="/video/Bamboo_Weaving_竹丝扣瓷_30s_1">
					<img src="/images/homepage_demo2.jpg" width="100%" />
				</li>
				<li href="#" class="slideitem" data-tit="<?php echo Yii::t("strings", "Cashmere Felt")?>" data-video="/video/Cashmere_Felt_羊绒毡_30s_1">
					<img src="/images/homepage_demo2.jpg" width="100%" />
				</li>
				<li href="#" class="slideitem" data-tit="<?php echo Yii::t("strings", "Eggshell Porcelain")?>" data-video="/video/Eggshell_Porcelain_薄胎瓷_30s_1">
					<img src="/images/homepage_demo2.jpg" width="100%" />
				</li>
				<li href="#" class="slideitem" data-tit="<?php echo Yii::t("strings", "Zitan")?>" data-video="/video/Zitan_紫檀_30s_1">
					<img src="/images/homepage_demo2.jpg" width="100%" />
				</li>
			</ul>
			<div class="slidetip intoview-effect" data-effect="fadeup">
				<span class="slidetip2-tit"><?php echo Yii::t("strings", "Bamboo Weaving")?></span> <br>
				<span class="slidetip2-index">1/4</span> <br>
				<a href="#" title="" data-a="homepage-watch-video" class="btn btn-white transition-wrap"><i class="transition">Watch video<br/><br/>Watch video</i></a>
			</div>
			<ul class="slidetab cs-clear">
				<li class="on"></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
		</div>
		<div class="collarrows collarrowsnext home-collarrowsnext" data-a="home-collarrowsnext"></div>
	</div>
	<!-- barbg -->
	<!-- <div class="barbg intoview-effect" data-effect="fadeup"></div>	 -->

<?php include_once 'common/footer.php';?>
