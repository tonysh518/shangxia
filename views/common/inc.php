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
Yii::app()->getRequest()->setBaseUrl("/shangxia/admin");

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
    throw new Exception("Class with name ". $type . " is not exist");
  }
  else {
    $model = new $class();
    // 加一个Limit 10
    return $model->getList(10);
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
  if ($type !== "") {
    $query->addCondition("field_name=:field_name")
          ->addCondition("field_content=:field_content");
    $query->params[":field_name"] = "product_type";
    $query->params[":field_content"] = $type;
    
    $tmp = FieldAR::model()->findAll($query);
    $res1 = array();
    foreach ($tmp as $item) {
      $res1[] = $item->cid;
    }
  }
  
  if ($collection) {
    $query->addCondition("field_name=:field_name")
          ->addCondition("field_content=:field_content");
    $query->params[":field_name"] = "product_type";
    $query->params[":field_content"] = $type;
    $tmp = FieldAR::model()->findAll($query);
    foreach ($tmp as $item) {
      $res2[] = $item->cid;
    }
  }
  $cids = array();
  // 如果同时查找2个条件，则取并集
  if (isset($res1) && isset($res2)) {
    $cids = array_intersect($res1, $res2);
  }
  else if (isset($res1)) {
    $cids = $res1;
  }
  else if (isset($res2)) {
    $cids = $res2;
  }
 
  $query = new CDbCriteria();
  $query->addInCondition("cid", $cids);
  $query->limit = "3";
  return ProductContentAR::model()->findAll($query);
}

/**
 * 加载Craft 相关联的产品
 * @param type $craft
 */
function loadCraftRelatedProducts($craft) {
  $product_ids = json_decode($craft->product, TRUE);
  if (!$product_ids || !is_array($product_ids)) {
    return array();
  }
  $query = new CDbCriteria();
  $query->limit = "3";
  $query->addInCondition("cid", $product_ids);
  
  $products = ProductContentAR::model()->findAll($query);
  return $products;
}

/**
 * 加载其他的Craft. 排除参数所指示的Craft
 * @param int $craft_id
 */
function loadOtherCraft($craft_id = 0) {
  global $language;
  $query = new CDbCriteria();
  $query->addNotInCondition("cid", array($craft_id));
  $query->addCondition("language=:language");
  $query->params[":language"] = $language;
  
  return CraftContentAR::model()->findAll($query);
}

// 加载新闻
function loadFirstNews() {
  $news = NewsContentAR::model()->getList(1);
  if (count($news)) {
    return $news[0];
  }
  return FALSE;
}

// 加载新闻列表，用年份来分组
function loadNewsWithYearGroup($teaser = FALSE) {
  $newsItems = NewsContentAR::model()->getList();
  $firstNews = loadFirstNews();
  $newsGroup = array();
  foreach ($newsItems as $newsItem) {
    if ($newsItem->cid == $firstNews->cid) {
      continue;
    }
    if ($teaser) {
      if (isset($newsGroup[date("Y", strtotime($newsItem->date))]) &&  count($newsGroup[date("Y", strtotime($newsItem->date))])< 3) {
        continue;
      }
    }
    $newsGroup[date("Y", strtotime($newsItem->date))][] = $newsItem;
  }
  
  return $newsGroup;
}

// 从产品中加载对应的系列
function loadCollectionFromProduct($product) {
  return CollectionContentAR::model()->findByPk($product->collection);
}

// 加载相似的产品
// 同一个类型下／同一个分类下的所有产品
function loadSimilarProducts($product) {
   $collectionId = $product->collection;
   $product_type = $product->product_type;
   
   $query = new CDbCriteria();
   $query->addCondition("field_name=:field_name");
   $query->params[":field_name"] = "collection";
   $query->addCondition("field_content=:value");
   $query->params[":value"] = $collectionId;
   $res = FieldAR::model()->findAll($query);
   $cids1 = array();
   foreach ($res as $item) {
     $cids1[$item->cid] = $item->cid;
   }
   
   $query = new CDbCriteria();
   $query->addCondition("field_name=:field_name");
   $query->params[":field_name"] = "product_type";
   $query->addCondition("field_content=:value");
   $query->params[":value"] = $product_type;
   $res = FieldAR::model()->findAll($query);
   $cids2 = array();
   foreach ($res as $item) {
     $cids2[$item->cid] = $item->cid;
   }
   
   // 取交集
   global $language;
   $cids = array_intersect($cids1, $cids2);
   $query = new CDbCriteria();
   $query->addCondition('language=:language')
           ->addCondition("type=:type")
           ->addCondition("status=:status")
           ->addInCondition("cid", $cids);
   $query->params[":language"] = $language;
   $query->params[":type"] = "product";
   $query->params[":status"] = ContentAR::STATUS_ENABLE;
   $query->limit = "3";
   return ProductContentAR::model()->findAll($query);
}

//加载Job 
function loadJob() {
  return JobContentAR::model()->getList();
}
