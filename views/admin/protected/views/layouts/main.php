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
    <img src="<?php echo Yii::app()->getBaseUrl()?>/css/loader.gif" alt="" />
  </div>

<div class="container-fluid" id="page">

  <div id="header" class="clearfix">
    <div id="logo"><a href="<?php echo Yii::app()->createUrl("index/index")?>"><img src="<?php echo Yii::app()->getBaseUrl()?>/images/logo.png" alt="" /></a></div>

    <div class="lang-bar">
        <a class="<?php if (Yii::app()->language == "zh_cn") echo "active"; ?>" href="javascript:void(0)" lang="zh_cn" class="lang_cn">中文</a>
        <a class="<?php if (Yii::app()->language == "en_us") echo "active";?>" href="javascript:void(0)" lang="en_us" class="lang_en">English</a>
        <a class="<?php if (Yii::app()->language == "fr") echo "active";?>" href="javascript:void(0)" lang="fr" class="lang_en">French</a>
    </div>
	</div>
  
  <div id="sidebar" class="">
    <ul class="nav nav-list">
      
      <!-- News -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "News")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "news"))?>"><?php echo Yii::t("strings", "Add News")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "news"))?>"><?php echo Yii::t("strings", "News")?></a></li>
      
      <!-- News End -->  
      
      <!--  Slideshow -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Slideshow")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "slideShow"))?>"><?php echo Yii::t("strings", "Add Slideshow (Home)")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "slideShow"))?>"><?php echo Yii::t("strings", "Slideshow(Home)")?></a></li>
      <!-- End Slideshow-->
      
      <!-- Video -->
      
<!--      <li class="nav-header">
        <?php echo Yii::t("strings", "Home Video")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "home_video"))?>"><?php echo Yii::t("strings", "Add Home Video")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "home_video"))?>"><?php echo Yii::t("strings", "Home Video")?></a></li>
     -->
      <!-- End Video-->
      
      <!-- Collection  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Collection")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "collection"))?>"><?php echo Yii::t("strings", "Add Collection")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "collection"))?>"><?php echo Yii::t("strings", "Collection")?></a></li>
      <!-- End Collection-->
      
      <!-- Product  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Product")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "product"))?>"><?php echo Yii::t("strings", "Add product")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "product"))?>"><?php echo Yii::t("strings", "product")?></a></li>
      <!-- End Product-->
      
      <!-- Craft  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Craft")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "craft"))?>"><?php echo Yii::t("strings", "Add craft")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "craft"))?>"><?php echo Yii::t("strings", "craft")?></a></li>
      <!-- End Craft-->
      
      <!-- boutique  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Boutique")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "boutique"))?>"><?php echo Yii::t("strings", "Add boutique")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "boutique"))?>"><?php echo Yii::t("strings", "boutique")?></a></li>
      <!-- End boutique-->
      
      <!-- Job  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Job")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "job"))?>"><?php echo Yii::t("strings", "Add Job")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "job"))?>"><?php echo Yii::t("strings", "Job")?></a></li>
      <!-- End Job-->
      
      <!-- Press  -->
      <li class="nav-header">
        <?php echo Yii::t("strings", "Press")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/addcontent", array("type" => "press"))?>"><?php echo Yii::t("strings", "Add Press")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/content", array("type" => "press"))?>"><?php echo Yii::t("strings", "Press")?></a></li>
      <!-- End Press-->
      
      <li class="nav-header">
        <?php echo Yii::t("strings", "System")?>
      </li>
      <li><a href="<?php echo Yii::app()->createUrl("page/contact", array("type" => "contact"))?>"><?php echo Yii::t("strings", "Contact")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/newsletter", array("type" => "newsletter"))?>"><?php echo Yii::t("strings", "Newsletter")?></a></li>
      <li><a href="<?php echo Yii::app()->createUrl("page/wantobuy", array("type" => "buy"))?>"><?php echo Yii::t("strings", "Want To Buy")?></a></li>
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
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/ui-bootstrap-tpls.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/scripts/script.js"></script>
  <script type="text/ng-template" id="myModalContent.html">
      <div class="modal-header">
          <h3 class="modal-title"><?php echo Yii::t("strings","Confirm Box")?></h3>
      </div>
      <div class="modal-body">
          <?php echo Yii::t("strings" ,"Are you sure to delete it?")?>
           <p>{{message}}</p>
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary" ng-click="ok()"><?php echo Yii::t("strings" ,"Delete")?></button>
          <button class="btn btn-warning" ng-click="cancel()"><?php echo Yii::t("strings" ,"Cancel")?></button>
      </div>
  </script>
  
  <script type="text/ng-template" id="previewcontent.html">
      <div class="modal-header" ng-init="init()">
          <h3 class="modal-title"><?php echo Yii::t("strings","Contact Box")?></h3>
      </div>
      <div class="modal-body">
        <p><?php echo Yii::t("strings", "Name")?>: {{title}}</p>
        <p><?php echo Yii::t("strings", "Email")?>: {{email}}</p>
        <p><?php echo Yii::t("strings", "Body")?>: {{body}}</p>
      </div>
      <div class="modal-footer">
          <button class="btn btn-warning" ng-click="cancel()"><?php echo Yii::t("strings" ,"Cancel")?></button>
      </div>
  </script>
  
  <script type="text/ng-template" id="imagepreview.html">
      <div class="modal-header" ng-init="init()">
          <h3 class="modal-title"><?php echo Yii::t("strings","Preview Box")?></h3>
      </div>
      <div class="modal-body">
        <img src="{{src}}" alt="" />
      </div>
      <div class="modal-footer">
          <button class="btn btn-warning" ng-click="cancel()"><?php echo Yii::t("strings" ,"Close")?></button>
      </div>
  </script>
</body>
</html>
