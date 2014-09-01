<?php

// 载入 Yii / 后台系统
$root = dirname(dirname(dirname(__FILE__)));

define("ROOT_PATH", $root);

require_once(ROOT_PATH."/admin/yii/yii.php");

$config = ROOT_PATH.'/admin/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

$app = Yii::createWebApplication($config);

$scriptUrl = Yii::app()->getRequest()->getScriptUrl();

$ret = Yii::app()->getRequest()->getBaseUrl();
Yii::app()->getRequest()->setBaseUrl("/admin");

Yii::app()->language = "zh_cn";

if (Yii::app()->language == "zh_cn") {
  $language = "cn";
}
else {
  $language = "en";
}

/**
 * 生成一个编辑我的区块
 */
function editme($key, $field = array("body"), $media = array(), $video = array()) {
  // 先禁用掉 Editme 功能
  return;
  $content = ContentAR::model()->loadByKey($key);
  ob_start();
  // 要修改的
  include(ROOT_PATH."/views/widget/editme.phtml");
  
  print ob_get_clean();
}

/**
 * 获取内容的字段
 */
function renderContentField($key, $fieldName) {
  $content = ContentAR::model()->loadByKey($key);
  
  if (isset($content->{$fieldName})) {
    return $content->{$fieldName};
  }
  
  $content->hasContentField($filedName);
  $content->reload();
  
  return $content->{$fieldName};
}


function loadContentList($type) {
  $class = ucfirst($type).'ContentAR';
  if (!class_exists($class)) {
    throw Exception("Class with name ". $type . " is not exist");
  }
  else {
    $model = new $class();
    return $model->getList();
  }
}

function makeThumbnail($uri, $size = array()) {
  if (!$size) {
    return $uri;
  }
  return MediaAR::thumbnail($uri, $size);
}