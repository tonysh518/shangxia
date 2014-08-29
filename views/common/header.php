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
</head>
<body>
	<div class="wrap">
		<?php if ( isset($homepage) ) { ?>
		<?php include_once 'widget/home-slider.php';?>
		<?php } ?>
		<!-- head -->
		<div class="head">
			<div class="head-fixed" <?php if( isset($homepage) ){?> style="position:static" <?php } ?>>
				<div class="head-inner cs-clear">
					<img class="nav-bg" src="../SX/images/nav-bg.jpg"/>
					<ul class="nav nav1">
						<li><a data-a="nav-pop" href="#" title="">COLLECTIONS</a></li>
						<li><a data-a="nav-pop" href="#" title="">CRAFTS</a></li>
						<li><a data-a="nav-pop" href="#" title="">BOUTIQUES</a></li>
					</ul>
					<h1 class="logo"><a data-a="nav-link" href="./index.php"></a></h1>
					<ul class="nav nav2">
						<li><a data-a="nav-link" href="./news.php" title="">NEWS</a></li>
						<li><a data-a="nav-link" href="#" title="">ABOUT</a></li>
						<li><a data-a="nav-link" href="./contact.php" title="">CONTACT</a></li>
					</ul>
					<!--  -->
					<div class="hd_oter cs-clear">
						<div class="hd_language">
							<a href="#">中文</a>|<a href="#" class="on">EN</a>|<a href="#">FR</a>
						</div>
						<a href="#" data-a="show-search-form" class="hd_search"></a>
					</div>
				</div>
				<div class="searchform">
					<form action="" class="section cs-clear">
						<input type="text" value="SEARCH DEMO">
						<button>SEARCH</button>
					</form>
				</div>
				<div class="nav-pop nav-pop-collections">
					<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i> IN &amp; OUT</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>HUMAN &amp; NATURE</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>HERITAGE &amp; EMOTION</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./collections.php"><img src="../SX/images/nav_top.jpg"/> <span><i>GIFTS</i></span></a>
				</div>
				<div class="nav-pop nav-pop-crafts">
					<a class="nav-pop-item" data-a="nav-link" href="./craft.php"><img src="../SX/images/nav_top.jpg"/> <span><i>BAMBOO WEAVING</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./craft.php"><img src="../SX/images/nav_top.jpg"/> <span><i>CASHMERE FELT</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./craft.php"><img src="../SX/images/nav_top.jpg"/> <span><i>EGGSHELL PORCELAIN</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./craft.php"><img src="../SX/images/nav_top.jpg"/> <span><i>ZITAN WOOD</i></span></a>
				</div>
				<div class="nav-pop nav-pop-boutiques">
					<a class="nav-pop-item" data-a="nav-link" href="./boutique.php"><img src="../SX/images/nav_top.jpg"/> <span><i>SHANGHAI</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./boutique.php"><img src="../SX/images/nav_top.jpg"/> <span><i>BEIJING</i></span></a>
					<a class="nav-pop-item" data-a="nav-link" href="./boutique.php"><img src="../SX/images/nav_top.jpg"/> <span><i>PARIS</i></span></a>
				</div>
			</div>
		</div>
		<div class="nav-mask" data-a="nav-mask"></div>
		










