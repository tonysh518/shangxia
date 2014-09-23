<?php

class GiftContentAR extends ContentAR {
  
  public $type = "gift";
  
  public function getFields() {
    return parent::getFields();
  }

  public function getImageFields() {
    $this->hasImageField("product_slide_image", array("multi" => TRUE));
    $this->hasImageField("thumbnail");
    return parent::getImageFields();
  }
  
  public function getVideoFields() {
    return parent::getVideoFields();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
}

