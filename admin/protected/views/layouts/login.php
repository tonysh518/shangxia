<!DOCTYPE HTML>
<html lang="en"  ng-app="adminModule">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables_themeroller.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	<title><?php echo Yii::t("strings", "Shangxia Backend Office")?></title>
  <script type="text/javascript">
    window.baseurl = "<?php echo Yii::app()->baseUrl?>";
  </script>
</head>

<body>

<div class="container-fluid" id="login">

	<div id="header">
		<div id="logo"><?php echo Yii::t("strings", "Shangxia Backend Office")?></div>
	</div>
  <style type="text/css">
  	#body {
		width: 100%;
  	}
  </style>
  <div id="body" class="row-fluid">
    <div id="content" class=""><?php echo $content; ?></div>
  </div>

	<div class="clear"></div>

<!--	<div id="footer">
	</div>-->
</div>
</body>
</html>
