<?php

class CraftContentAR extends ContentAR {
  public $type = "craft";
  
  public function getImageFields() {
    $this->hasImageField("thumbnail_image");
    $this->hasImageField("video_poster");
    return parent::getImageFields();
  }
  
  public function getVideoFields() {
    $this->hasVideoField("craft_video");
    return parent::getVideoFields();
  }
  
  public function getFields() {
    $options = array();
    foreach (ProductContentAR::model()->getList() as $product) {
      $options[$product->cid] = $product->title;
    }
    $this->hasContentField("product", array("type" => "select", "options" => $options,  "select_multi" => TRUE));
    return parent::getFields();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
}

