<!DOCTYPE HTML>
<html lang="<?php echo (string)Yii::app()->getLanguage()?>"  ng-app="adminModule">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables_themeroller.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/fonts/fontawesome/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	<title><?php echo Yii::t("strings", "Shangxia Backend Office")?></title>
  <script type="text/javascript">
    window.baseurl = "<?php echo Yii::app()->baseUrl?>";
    window.brand = "<?php echo Yii::app()->getRequest()->getParam("brand")?>";
  </script>
  <script type="text/javascript">
    var language = {};
    language.updatesuccess = "<?php echo Yii::t("strings" ,"Update Success")?>";
    language.confirmdelete = "<?php echo Yii::t("strings", "Are you sure to delete it ?")?>";
  </script>

</head>

<body>
  <div class="preview-image hideme">
    <div class="close-icon"><i class="fa fa-times"></i></div>
    <div class="arrow">
      <div class="left">
        <i class="fa fa-arrow-left"></i>
      </div>
      <div class="right">
        <div class="fa fa-arrow-right"></div>
      </div>
    </div>
    <img src="" alt="">
  </div>
  
  <div class="loading hideme">
    <img src="/css/loader.gif" alt="" />
  </div>

<div class="container-fluid" id="page">

  <div id="header" class="clearfix">
    <div id="logo"><a href="<?php echo Yii::app()->createUrl("index/index")?>"><img src="/images/logo.png" alt="" /></a></div>

    <div class="lang-bar">
        <a class="<?php if (Yii::app()->language == "zh_cn") echo "active"; ?>" href="javascript:void(0)" lang="zh_cn" class="lang_cn">中文</a>
        <a class="<?php if (Yii::app()->language == "en_us") echo "active";?>" href="javascript:void(0)" lang="en_us" class="lang_en">English</a>
    </div>
	</div>
  
  <div id="sidebar" class="">
    <ul class="nav nav-list">
      
      <!-- Brand -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Brands")?>
      </li>
      <?php foreach (Yii::app()->params["brands"] as $brand_name): ?>
      <li><a class="<?php echo $this->getActiveClass("page/lookbook", array("brand" => strtolower($brand_name)))?>" href="<?php echo Yii::app()->createUrl("page/lookbook", array("brand" => strtolower($brand_name)))?>"><?php echo $brand_name?></a></li>
      <?php endforeach;?>
     <!-- Brand End -->
     
      <!-- Corporate -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Corporate")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/navigation")?>" class="<?php echo $this->getActiveClass("page/navigation")?>"><?php echo Yii::t("strings", "Homepage (Navigation)")?></a></li>
<!--       <li><a href="<?php echo Yii::app()->createUrl("page/corporate")?>" class="<?php echo $this->getActiveClass("page/corporate")?>"><?php echo Yii::t("strings", "Corporate Information")?></a></li>
 -->      <li><a href="<?php echo Yii::app()->createUrl("page/brandinfo")?>" class="<?php echo $this->getActiveClass("page/brandinfo")?>"><?php echo Yii::t("strings", "Brand Information")?></a></li>
      <!-- Corporate End -->
      
      <!-- News -->
      <!-- <li class="nav-header">
        <?php echo Yii::t("strings", "News")?>
      </li>
      <li><a class="<?php echo $this->getActiveClass("page/news")?>" href="<?php echo Yii::app()->createUrl("page/news")?>"><?php echo Yii::t("strings", "All News")?></a></li>
      <li><a class="<?php echo $this->getActiveClass("page/addnews")?>" href="<?php echo Yii::app()->createUrl("page/addnews")?>"><?php echo Yii::t("strings", "Add New")?></a></li>
      -->
      <!-- News End -->  
      
      <!-- Media -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Media")?>
      </li>
      <li><a class="<?php echo $this->getActiveClass("page/video")?>" href="<?php echo Yii::app()->createUrl("page/video")?>"><?php echo Yii::t("strings", "All Media")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addvideo")?>" class="<?php echo $this->getActiveClass("page/addvideo")?>"><?php echo Yii::t("strings", "Add Media")?></a></li>
      <!-- Media End -->
      
      <!-- Careers -->
      <li class="nav-header"><?php echo Yii::t("strings", "Careers")?></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/careers")?>" class="<?php echo $this->getActiveClass("page/careers")?>"><?php echo Yii::t("strings", "All Positions")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcareer")?>" class="<?php echo $this->getActiveClass("page/addcareer")?>"><?php echo Yii::t("strings", "Add New")?></a></li>
      <!-- Careers End -->
      
      <!-- Store -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Stores")?>
      </li>
      <li><a class="<?php echo $this->getActiveClass("shop/index")?>" href="<?php echo Yii::app()->createUrl("shop/index")?>"><?php echo Yii::t("strings", "All Stores")?></a></li>
      <li><a class="<?php echo $this->getActiveClass("shop/add")?>" href="<?php echo Yii::app()->createUrl("shop/add")?>"><?php echo Yii::t("strings", "Add New")?></a></li>
      <!-- Store End -->
      
      <!-- Other -->
      <li class="nav-header"><?php echo Yii::t("strings", "Other")?></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/qrcode")?>" class="<?php echo $this->getActiveClass("page/qrcode")?>"><?php echo Yii::t("strings", "QRCode")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/contact")?>" class="<?php echo $this->getActiveClass("page/contact")?>"><?php echo Yii::t("strings", "Contact")?></a></li>
      <!-- Other End -->
      
      <li class="nav-header">
        <?php echo Yii::t("strings", "System")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/logout")?>"><?php echo Yii::t("strings", "Logout")?></a></li>
    </ul>
  </div>
  

  <?php if (UserAR::isLogin()) :?>
  <div id="body">
    <div id="content"><?php echo $content; ?></div>
  </div>
  <?php else: ?>
    <div id="content" class="span9 offset3"><?php echo $content; ?></div>
  <?php endif;?>

	<div class="clear"></div>

<!--	<div id="footer">
	</div>-->
</div>

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/jquery_ui/js/jquery-ui-1.10.4.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/config.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/angular.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/script.js"></script>
</body>
</html>
