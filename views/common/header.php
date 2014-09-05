<?php require_once "inc.php";?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>SX</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="../SX/css/style.css" />
  <link rel="stylesheet" type="text/css" href="./css/editme.css" />
  <script type="text/javascript" src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/jquery.form.js"></script>
  <script type="text/javascript">
  	 var SOURCE_PATH = '../SX';
  </script>
</head>
<body>
	<div class="loading-wrap" style="display:block;"><div class="loading"></div></div>
	<div class="wrap">
		<?php if ( isset($homepage) ) { ?>
		<?php include_once 'widget/home-slider.php';?>
		<?php } ?>
		<!-- head -->
		<div class="head" <?php if ( isset($pagename) ) { ?>data-page="<?php echo $pagename;?>"<?php } ?>>
			<div class="head-fixed" <?php if( isset($homepage) ){?> style="position:static" <?php } ?>>
				<div class="head-inner cs-clear">
					<ul class="nav nav1">
						<li><a data-a="nav-pop" href="#" title="">COLLECTIONS</a><img class="nav-bg" src="../SX/images/nav-bg.jpg"/></li>
						<li><a data-a="nav-pop" href="#" title="">CRAFTS</a><img class="nav-bg" src="../SX/images/nav-bg.jpg"/></li>
						<li><a data-a="nav-pop" href="#" title="">BOUTIQUES</a><img class="nav-bg" src="../SX/images/nav-bg.jpg"/></li>
					</ul>
					<h1 class="logo"><a data-a="nav-link" href="./index.php"></a></h1>
					<ul class="nav nav2">
						<li><a data-a="nav-link" href="./news.php" title="">NEWS</a><img class="nav-bg" src="../SX/images/nav-bg.jpg"/></li>
						<li><a data-a="nav-link" href="./about.php" title="">ABOUT</a><img class="nav-bg" src="../SX/images/nav-bg.jpg"/></li>
						<li><a data-a="nav-link" href="./contact.php" title="">CONTACT</a></li>
					</ul>
					<!--  -->
					<div class="hd_oter cs-clear">
						<div class="hd_language">
							<a href="javascript:void(0)" data-lang="zh_cn">中文</a>|<a href="javascript:void(0)" data-lang="en_us" class="on">EN</a>|<a href="javascript:void(0)" data-lang="fr">FR</a>
						</div>
						<a href="#" data-a="show-search-form" class="hd_search"></a>
					</div>
				</div>
				<div class="searchform">
					<form action="./search.php" class="section cs-clear">
						<input type="text" placeholder="SEARCH DEMO" name="s" value="">
						<button>SEARCH</button>
					</form>
				</div>
				<div class="nav-pop nav-pop-collections">
					<div class="nav-pop-inner">
						<div class="nav-pop-nav">
              <?php foreach (ProductContentAR::getType() as $id => $name):  ?>
              <p><a href="./product-type.php?id=<?php echo $id?>"><?php echo ucfirst($name)?> &gt;</a></p>
              <?php endforeach;?>
						</div>
            <?php $collectiones = CollectionContentAR::model()->getList();?>
            <?php foreach($collectiones as $item):?>
              <a class="nav-pop-item" data-a="nav-link" href="./collections.php?id=<?php echo $item->cid?>"><img src="<?php echo $item->nav_image?>"/> <span><i> <?php echo $item->title?></i></span></a>
            <?php endforeach;?>
					</div>
				</div>
				<div class="nav-pop nav-pop-crafts">
					<div class="nav-pop-inner">
            <?php $crafts = CraftContentAR::model()->getList();?>
            <?php foreach($crafts as $craft): ?>
            <a class="nav-pop-item" data-a="nav-link" href="./craft.php?id=<?php echo $craft->cid?>"><img src="<?php echo $craft->nav_image?>"/> <span><i><?php echo $craft->title?></i></span></a>
            <?php endforeach;?>
					</div>
				</div>
				<div class="nav-pop nav-pop-boutiques">
					<div class="nav-pop-inner">
            <?php $first = TRUE;?>
            <?php foreach (BoutiqueContentAR::getLocation() as $key => $name): ?>
              <?php $boutique = BoutiqueContentAR::model()->loadByAddressKey($key);?>
              <?php if ($boutique): ?>
                <a class="nav-pop-item" <?php if ($first) echo 'style="margin-left: 12%;"'?> data-a="nav-link" href="./boutique.php?key=<?php echo urlencode($key)?>"><img src="<?php //echo ($boutique->nav_image) ?>"/> <span><i><?php echo $name?></i></span></a>
              <?php endif;?>
            <?php $first = FALSE;?>
            <?php endforeach;?>
						</div>
				</div>
				<!-- <div class="nav-pop nav-pop-news">
					<div class="nav-pop-inner">
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>PAOLO REVERSI</i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>LATEST NEWS</i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>PRESS</i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>EVENTS</i></span></a>
					</div>
				</div>
				<div class="nav-pop nav-pop-about">
					<div class="nav-pop-inner">
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i> BRAND STORY</i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>ARTISTIC DIRECTOR</i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>HERITAGE &amp; ENCOUNTER </i></span></a>
						<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>JOBS</i></span></a>
					</div>
				</div> -->
			</div>
		</div>
		<div class="nav-mask" data-a="nav-mask"></div>
		










