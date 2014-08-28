<?php

/**
 * Collection 内容类型
 */
class CollectionContentAR extends ContentAR {
  public $type = "collection";
  
  public function getImageFields() {
    $this->hasImageField("master_image");
    $this->hasImageField("thumbnail_image");
    return parent::getImageFields();
  }
  
  public function getFields() {
    $this->hasContentField("public_date");
    return parent::getFields();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
}

