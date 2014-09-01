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

/**
 * 返回在某个系列下的某个类型的产品
 * @param string $type
 * @param CollectionContentAR $collection
 * @return 
 */
function getProductInTypeWithCollection($type = "", $collection = NULL) {
  $query = new CDbCriteria();
  
  if ($type) {
    $query->addCondition("field_name=:field_name")
          ->addCondition("field_content=:field_content");
    $query->params[":field_name"] = "product_type";
    $query->params[":field_content"] = $type;
    
    $res1 = FieldAR::model()->findAll($query);
  }
  if ($collection) {
    $query->addCondition("field_name=:field_name")
          ->addCondition("field_content=:field_content");
    $query->params[":field_name"] = "product_type";
    $query->params[":field_content"] = $type;
    $res2 = FieldAR::model()->findAll($query);
  }
  $res = array();
  // 如果同时查找2个条件，则取并集
  if (isset($res1) && isset($res2)) {
    foreach ($res1 as $item) {
      foreach ($res2 as $item2) {
        if ($item->cid == $item2->cid) {
          $res[] = $item;
        }
      }
    }
  }
  else if (isset($res1)) {
    $res = $res1;
  }
  else if (isset($res2)) {
    $res = $res2;
  }
  
  $cids = array();
  foreach ($res as $item) {
    $cids[] = $item->cid;
  }
 
  $query = new CDbCriteria();
  $query->addInCondition("cid", $cids);
  return ProductContentAR::model()->findAll($query);
}

/**
 * 加载Craft 相关联的产品
 * @param type $craft
 */
function loadCraftRelatedProducts($craft) {
  $product_ids = json_decode($craft->product, TRUE);
  $query = new CDbCriteria();
  $query->addInCondition("cid", $product_ids);
  
  $products = ProductContentAR::model()->findAll($query);
  return $products;
}

/**
 * 加载其他的Craft. 排除参数所指示的Craft
 * @param int $craft_id
 */
function loadOtherCraft($craft_id = 0) {
  $query = new CDbCriteria();
  $query->addNotInCondition("cid", array($craft_id));
  
  return CraftContentAR::model()->findAll($query);
}