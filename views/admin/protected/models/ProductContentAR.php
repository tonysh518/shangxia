<?php

/**
 * 产品对象
 */
class ProductContentAR extends ContentAR {
  
  const TYPE_APPAREL = 1;
  const TYPE_JEWELRY = 2;
  const TYPE_FURNITURE = 3;
  const TYPE_HOMEWARE = 4;
  const TYPE_TEAWARE = 5;
  
  public $type = "product";
  public function getFields() {
    $this->hasContentField("video_title");
    $this->hasContentField("video_description", array("type" => "textarea"));
    
    $this->hasContentField("product_type", array("type" => "select", "options" => self::getType()));
    
    $collection = CollectionContentAR::model()->getList();
    $options = array();
    foreach ($collection as $item) {
      $options[$item->cid] = $item->title;
    }
    $this->hasContentField("collection", array("type" => "select", "options" => $options));
    
     $this->hasContentField("craft", array("type" => "select", "options" => CraftContentAR::model()->loadCraftOption()));
    
    return parent::getFields();
  }
  
  public static function getType() {
    return array(
        self::TYPE_APPAREL =>  "apparel",
        self::TYPE_JEWELRY => "jewelry",
        self::TYPE_TEAWARE => "teaware",
        self::TYPE_HOMEWARE => "homeware",
        self::TYPE_FURNITURE => "furniture",
        );
  }
  
  public function getImageFields() {
    $this->hasImageField("product_slide_image", array("multi" => TRUE));
    $this->hasImageField("video_poster");
    $this->hasImageField("thumbnail");
    return parent::getImageFields();
  }
  
  public function getVideoFields() {
    $this->hasVideoField("product_video");
    return parent::getVideoFields();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function getList($limit = 10, $offset = FALSE) {
    return parent::getList($limit, $offset);
  }
}

