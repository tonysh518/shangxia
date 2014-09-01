<?php

/**
 * 产品对象
 */
class ProductContentAR extends ContentAR {
  
  const TYPE_APPAREL = 1;
  const TYPE_JEWELRY = 2;
  const TYPE_FURNITURE = 3;
  const TYPE_HOMEWARE = 4;
  
  public $type = "product";
  public function getFields() {
    $this->hasContentField("video_title");
    $this->hasContentField("video_description", array("type" => "textarea"));
    
    $this->hasContentField("product_type", array("type" => "select", "options" => array(
        self::TYPE_APPAREL => Yii::t("strings", "aprarel"),
        self::TYPE_JEWELRY => Yii::t("strings", "jewelry"),
        self::TYPE_FURNITURE => Yii::t("strings", "furniture"),
        self::TYPE_HOMEWARE => Yii::t("strings", "homeware"),
        )));
    
    $collection = CollectionContentAR::model()->getList();
    $options = array();
    foreach ($collection as $item) {
      $options[$item->cid] = $item->title;
    }
    $this->hasContentField("collection", array("type" => "select", "options" => $options));
    
    return parent::getFields();
  }
  
  public function getImageFields() {
    $this->hasImageField("product_slide_image");
    return parent::getImageFields();
  }
  
  public function getVideoFields() {
    $this->hasVideoField("product_video");
    return parent::getVideoFields();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
}
