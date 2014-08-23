<?php

class ShopAR extends CActiveRecord {
  
  // 开张营业中
  const STATUS_OPEN = 1;
  // 店铺已关闭
  const STATUS_CLOSED = 0;
  // 店铺正在开张中但没有正式营业
  const STATUS_OPENING = 2;
  
  // 普通店铺
  const SHOP_NORMAL = 0;
  // 明星店铺
  const SHOP_STAR = 1;
  
  public $type = "shop";
  
  const SHOP_STAR_IMAGE = "shop_star_image";
  
  public $shop_star_image;
  
  public function tableName() {
    return "shop";
  }
  
  public function primaryKey() {
    return "shop_id";
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function rules() {
    return array(
        array("title, address, lat, lng", "required"),
        array("lat, lng", "isfloat"),
        array("shop_id, country, city, distinct, phone, cdate, mdate, status, category", "safe"),
    );
  }
  
  public function isfloat($attr) {
    $value = $this->{$attr};
    if (!$value) {
      return TRUE;
    }
    if (is_float($value)) {
      return TRUE;
    }
    return FALSE;
  }
  
  public function beforeSave() {
    if ($this->isNewRecord) {
      $this->cdate = date("Y-m-d H:i:s");
    }
    $this->mdate = date("Y-m-d H:i:s");
    
    global $language;
    $this->language = $language;
    return TRUE;
  }
  
  public function afterSave() {
//    $mediaAr = new MediaAR();
//    $mediaAr->saveMediaToObject($this, self::SHOP_STAR_IMAGE);
  }
  
  public function afterFind() {
//    $mediaAr = new MediaAR();
//    $mediaAr->attachMediaToObject($this, self::SHOP_STAR_IMAGE);
  }
  
  /**
   * 添加搜索条件
   * @staticvar type $search_values
   * @param type $key
   * @param type $val
   * @return array
   */
  public function andSearch($key = "", $val = "") {
    static $search_values;
    if (!is_array($search_values)) {
      $search_values = array();
    }
    if (!$key) {
      return $search_values;
    }
    $search_values[$key] = $val;
    
    return $search_values;
  }
  
  /**
   * 获取店铺列表
   * @param type $status 店铺状态
   * @param type $limit 分页的每页数目
   * @param type $offset  分页的offset
   */
  public function getList($status = FALSE, $limit = FALSE, $offset = FALSE) {
    $query = new CDbCriteria();
    if ($status !== FALSE) {
      $query->addCondition("status=:status");
      $query->params[":status"] = $status;
    }
    if ($limit !== FALSE) {
      $query->limit = $limit;
    }
    if ($offset !== FALSE) {
      $query->offset = $offset;
    }
    
    $query->order = "shop_id DESC";
    
    global $language;
    if ($language) {
      $query->addCondition("language=:language");
      $query->params[":language"] = $language;
    }
    
    return $this->findAll($query);
  }
  
  /**
   * 用搜索条件查找店铺
   * @param type $search
   */
  public function locateShop($search = NULL) {
    if (!$search) {
      $search = $this->andSearch();
    }
    
    //暂时搜索条件只支持 国家 / 城市 / 区 
    $query = new CDbCriteria();
    if (isset($search["country"])) {
      $query->addCondition("country=:country");
      $query->params[":country"] = $search["country"];
    }
    if (isset($search["city"])) {
      $query->addCondition("city=:city");
      $query->params[":city"] = $search["city"];
    }
    if (isset($search["distinct"])) {
      $query->addCondition("`distinct`=:distinct");
      $query->params[":distinct"] = $search["distinct"];
    }
    
    if (isset($search["star"])) {
      $query->addCondition("`star`=:star");
      $query->params[":star"] = $search["star"];
    }
    
    global $language;
    $query->addCondition("language=:language");
    $query->params[":language"] = $language;
    
    $rows = $this->findAll($query);
    
    // 允许其他方法修改查询结果
    if (method_exists($this, "beforeSearch")) {
      $this->beforeSearch($rows);
    }
    
    // 最后返回结果
    return $rows;
  }
  
  // 返回Media
  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $attributes[self::SHOP_STAR_IMAGE] = $this->{self::SHOP_STAR_IMAGE};
    return $attributes;
  }
  
  public function closeShop() {
    if ($this->shop_id) {
      $this->status = self::STATUS_CLOSED;
    }
    $this->update();
    
    return TRUE;
  }

  /**
   * 获取城市名字
   */
  public static function getCityWithID($city_id) {
    $chinacity = require Yii::app()->getBasePath()."/data/chinacity.php";
    foreach ($chinacity as $index => $province) {
      foreach ($province[1] as $index_2 => $city) {
        if ($index_2 == $city_id) {
          return $city;
        }
      }
    }
  }

  /**
   * 获取省份名字
   */
  public static function getProvinceWithID($province_id) {
    $chinacity = require Yii::app()->getBasePath()."/data/chinacity.php";
    foreach ($chinacity as $index => $province) {
      if ($index == $province_id) {
        return $province[0];
      }
    }
  } 
}
