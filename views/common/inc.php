<?php
// 载入 Yii / 后台系统
$root = (dirname(dirname(__FILE__)));

define("ROOT_PATH", $root);

require_once(ROOT_PATH."/admin/yii/yii.php");

$config = ROOT_PATH.'/admin/protected/config/main.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

$app = Yii::createWebApplication($config);

$scriptUrl = Yii::app()->getRequest()->getScriptUrl();

$ret = Yii::app()->getRequest()->getBaseUrl();
Yii::app()->getRequest()->setBaseUrl("/admin");

global $language;
// 获取语言
$cookies = Yii::app()->request->cookies;
$lang = $cookies["sx-lang"];
if ($lang) {
  Yii::app()->language = (string)$lang;
}
else {
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      if ($lang == "zh") {
        Yii::app()->language = "zh_cn";
      }
      else {
        Yii::app()->language = "en_us";
      }
    }
    // 如果没有Cookie , 那就用默认得英文.
    Yii::app()->language = "en_us";
}

// 测试代码
//Yii::app()->language = "zh_cn";

if (Yii::app()->language == "zh_cn") {
  $language = "cn";
}
else if (Yii::app()->language == "fr") {
  $language = "fr";
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


function getSlideImageHtml( $uri , $percent = 1) {
  // $width = image_size($uri, "width");
  // $height = image_size($uri, "height");
  $per = array( 0 , 600, 1214 ,1800 );
  $tarW = $per[$percent];
  if( !$tarW ){
      $tarW = 600;
  }
  $tarH = 570;

  // if ($percent !== FALSE) {
  //   $tarW = $per[$percent];
  // }
  // else {
  //   $tarW = $per[ round( $width / $height ) ];
  // }
  // if( !$tarW ){
  //   $tarW = 600;
  // }
  // $tarW = min( $tarW , $width );
  // $tarH = min( 570 , $height );
  return  "<img data-width=\"$percent\" data-height=\"1\"  src=\"" . makeThumbnail($uri, array($tarW, $tarH)) . "\" width=\"100%\" />";
}
/**
 * 返回在某个系列下的某个类型的产品
 * @param string $type
 * @param CollectionContentAR $collection
 * @return 
 */
function getProductInTypeWithCollection($type = "", $collection = NULL) {
  global $language;
  if ($type && $collection) {
    $sql = 'select * from content left join field on field_name="product_type" and field.cid = content.cid where field_content="'.$type.'" AND  type="product" and language="'.$language.'" and content.cid in (select cid from field where field_name="collection" and field_content="'.$collection.'")';
  }
  else if ($type && !$collection) {
    $sql = 'select * from content left join field on field_name="product_type" and field.cid = content.cid where field_content="'.$type.'" AND  type="product" and language="'.$language.'"';
  }
  else if ($collection && !$type) {
    $sql = 'select * from content left join field on field_name="collection" and field.cid = content.cid where field_content="'.$collection.'" AND  type="product" and language="'.$language.'"';
  }
  // 没有任何条件 就直接返回一个空数组
  else {
    return array();
  }
  $cids = array();
  $res = Yii::app()->db->createCommand($sql)->queryAll();
  foreach ($res as $item) {
    $cids[] = $item["cid"];
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
  if (!$product_ids || !is_array($product_ids)) {
    return array();
  }
  $query = new CDbCriteria();
  $query->limit = "5";
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

/**
 * 加载所有的Press. 如果参数Year 没有提供 则把所有的加载进来，否则只加载Year 所表示的Press
 * @param type $year
 * @param type $limit
 */
function loadPressWithYearGroup($yearGroup = FALSE, $limit = 10) {
  $presses = PressContentAR::model()->getList();
  $pressGroup = array();
  foreach ($presses as $press) {
    $year = date("Y", strtotime($press->publish_date));
    if ($yearGroup && $yearGroup == $year) {
      continue;
    }
    if (isset($pressGroup[$year]) && count($pressGroup[$year]) > $limit) 
      continue;
    $pressGroup[$year] = $press;
  }
  
  return $pressGroup;
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
   $query->addCondition("type=:type")
           ->addCondition("status=:status")
           ->addInCondition("cid", $cids);
   //$query->params[":language"] = $language;
   $query->params[":type"] = "product";
   $query->params[":status"] = ContentAR::STATUS_ENABLE;
   $query->limit = "5";
   $products = ProductContentAR::model()->findAll($query);
   return $products;
}

//加载Job 
function loadJob() {
  return JobContentAR::model()->getList();
}

// 搜索关键字
function searchWithKeyword($keyword) {
   if ($keyword) {
     $keyword = trim($keyword);
     $types = array("'collection'", "'craft'");
     global $language;
     $intype = implode(",", $types);
     $sql = "SELECT * FROM content where type in (".$intype.")";
     $sql .= " AND language = '".$language."'";
     $keyword = addslashes($keyword);
     $sql .= " AND ( title COLLATE UTF8_GENERAL_CI like binary '%".strtolower($keyword)."%' OR body COLLATE UTF8_GENERAL_CI like binary '%".  strtolower($keyword)."%') ";
     
     $query = Yii::app()->db->createCommand($sql);
     $rows = $query->queryAll();
     
     $cids = array();
     foreach ($rows as $row) {
       $cids[$row["type"]][] = $row["cid"];
     }
     $rets = array();
     foreach ($cids as $type => $cidArray) {
       $class = ucfirst($type)."ContentAR";
         $ar = new $class();
         $query = new CDbCriteria();
         $query->addInCondition("cid", $cidArray);
         $rets += $ar->findAll($query);
      }
     return $rets;
   }
}

function getCity() {
  $userIp = (isset($_SERVER["HTTP_VIA"])) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]; 
  $city = Yii::app()->ip->toCity($userIp);
  if ($city == "上海市") {
    $city = "shanghai";
  }
  else if ($city == "北京市") {
    $city = "beijing";
  }
  else if ($city === FALSE && $userIp != "127.0.0.1"){
    $city = "paris";
  }
  // 默认是上海. 
  else {
    $city = "shanghai";
  }
  
  return strtolower($city);
}

// 生成一个URL
function url($uri, $params = array()) {
  if (( $pos = strpos($uri, ".php")) !== FALSE) {
    $simple_uri = substr($uri, 0, $pos);
  }
  else {
    $simple_uri = $uri;
  }
  if (isset($params["cid"])) {
    $content = ContentAR::model()->findByPk($params["cid"]);
    if ($content) {
      return '/'.$simple_uri."/".$content->cid."/". $content->title;
    }
  }
}


function is_weaving() {
  //           中       英     , 法
  $ids = array("20322", "20315");
  if (isset($_GET["cid"]) && in_array($_GET["cid"], $ids)) {
    return TRUE;
  }
}

function is_zitan() {
  //           中       英     , 法
  $ids = array("20321", "20316");
  if (isset($_GET["cid"]) && in_array($_GET["cid"], $ids)) {
    return TRUE;
  }
}

function is_cashmere() {
  //           中       英     , 法
  $ids = array("20319", "20318");
  if (isset($_GET["cid"]) && in_array($_GET["cid"], $ids)) {
    return TRUE;
  }
}

function is_eggshell() {
  //           中       英     , 法
  $ids = array("20320", "20317");
  if (isset($_GET["cid"]) && in_array($_GET["cid"], $ids)) {
    return TRUE;
  }
}

function image_size($uri, $what = "width") {
  static $sizes = array();
  if (isset($sizes[$uri])) {
    $size = $sizes[$uri];
  }
  else {
    $size = MediaAR::model()->getImageSize($uri);
    $sizes[$uri] = $size;
  }
  return $what == "width" ?  $size[0]: $size[1];
}

