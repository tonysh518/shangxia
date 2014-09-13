<?php 
require_once "inc.php";?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>SHANG XIA</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/css/editme.css" />
</head>
<body class="<?php if ( isset($pagename) ) {echo $pagename;}?>">
	<div class="loading-wrap" style="display:block;"><div class="loading loading_small"></div></div>
	<div class="wrap">
		<?php if ( isset($homepage) ) { ?>
		<?php include_once 'widget/home-slider.php';?>
		<?php } ?>
		<!-- head -->
		<div class="head" <?php if ( isset($pagename) ) { ?>data-page="<?php echo $pagename;?>"<?php } ?>>
			<div class="head-fixed" <?php if( isset($homepage) ){?> style="position:static" <?php } ?>>
				<div class="head-inner-wrap">
					<div class="head-inner cs-clear">
						<ul class="nav nav1">
							<li data-type="collections"><a data-a="nav-pop" data-d="type=collections" href="javascript:;"><?php echo Yii::t("strings", "COLLECTIONS")?></a><img class="nav-bg" src="/images/nav-bg.jpg"/></li>
							<li data-type="crafts"><a data-a="nav-pop" data-d="type=crafts" href="javascript:;"><?php echo Yii::t("strings", "CRAFTS")?></a><img class="nav-bg" src="/images/nav-bg.jpg"/></li>
							<li data-type="boutiques"><a data-a="nav-pop" data-d="type=boutiques" href="javascript:;"><?php echo Yii::t("strings", "BOUTIQUES")?></a><img class="nav-bg" src="/images/nav-bg.jpg"/></li>
						</ul>
						<h1 class="logo"><a data-a="nav-link" href="/index.php"></a></h1>
						<ul class="nav nav2">
							<li><a data-a="nav-link" href="/news.php"><?php echo Yii::t("strings", "NEWS")?></a><img class="nav-bg" src="/images/nav-bg.jpg"/></li>
							<li><a data-a="nav-link" href="/about.php"><?php echo Yii::t("strings", "ABOUT")?></a><img class="nav-bg" src="/images/nav-bg.jpg"/></li>
							<li><a data-a="nav-link" href="/contact.php"><?php echo Yii::t("strings", "CONTACT")?></a></li>
						</ul>
						<!--  -->
						<div class="hd_oter cs-clear">
							<div class="hd_language">
								<a href="javascript:void(0)" class="<?php global $language; if ($language == "cn") echo "active"?>" data-a="chang-lang" data-lang="zh_cn">中文</a>|<a href="javascript:void(0)" class="<?php global $language; if ($language == "en") echo "active"?>" data-a="chang-lang" data-lang="en_us" class="on">EN</a>|<a href="javascript:void(0)" class="<?php global $language; if ($language == "fr") echo "active"?>" data-a="chang-lang" data-lang="fr">FR</a>
							</div>
							<a href="#" data-a="show-search-form" class="hd_search"></a>
						</div>
					</div>
				</div>
				<div class="searchform">
					<form action="/search.php" class="section cs-clear">
						<input type="text" placeholder="<?php echo Yii::t("strings" ,"SEARCH DEMO")?>" name="s" value="">
						<button><?php echo Yii::t("strings" ,"SEARCH")?></button>
					</form>
				</div>
				<div class="nav-pop nav-pop-collections">
					<div class="nav-pop-inner">
						<div class="nav-pop-nav">
              <?php foreach (ProductContentAR::getType() as $id => $name):  ?>
              <p><a href="/product-type.php?name=<?php echo $name?>"><?php echo ucfirst($name)?> &gt;</a></p>
              <?php endforeach;?>
						</div>
						<div class="nav-pop-wrap">
			            <?php $collectiones = CollectionContentAR::model()->getList();?>
			            <?php foreach($collectiones as $item):?>
			              <a class="nav-pop-item inout-effect" data-a="nav-link" href="/collections.php?cid=<?php echo $item->cid?>">
			              	<img src="<?php echo $item->nav_image?>"/> 
			              	<span class="nav-text"><i> <?php echo $item->title?></i></span>
			              	<span class="home-inout-bg inout-bg"></span>
			              </a>
			            <?php endforeach;?>
			            </div>
					</div>
				</div>
				<div class="nav-pop nav-pop-crafts">
					<div class="nav-pop-inner">
            <?php $crafts = CraftContentAR::model()->getList();?>
            <?php foreach($crafts as $craft): ?>
            <a class="nav-pop-item inout-effect" data-a="nav-link" href="/craft.php?cid=<?php echo $craft->cid?>">
            	<img src="<?php echo $craft->nav_image?>"/>
            	<span class="nav-text"><i><?php echo $craft->title?></i></span>
            	<span class="home-inout-bg inout-bg"></span>
            </a>
            <?php endforeach;?>
					</div>
				</div>
				<div class="nav-pop nav-pop-boutiques">
					<div class="nav-pop-inner">
            <?php $first = TRUE;?>
            <?php foreach (BoutiqueContentAR::getLocation() as $key => $name): ?>
              <?php $boutique = BoutiqueContentAR::model()->loadByAddressKey($key);?>
              <?php if ($boutique): ?>
                <a class="nav-pop-item inout-effect" <?php if ($first) echo 'style="margin-left: 12%;"'?> data-a="nav-link" href="/boutique.php?type=<?php echo urlencode($key)?>">
                	<img src="<?php echo ($boutique->nav_image) ?>"/>
                	<span class="nav-text"><i><?php echo $name?></i></span>
                	<span class="home-inout-bg inout-bg"></span>
                </a>
              <?php endif;?>
            <?php $first = FALSE;?>
            <?php endforeach;?>
						</div>
				</div>
			</div>
		</div>
		<div class="nav-mask" data-a="nav-mask"></div>
		










