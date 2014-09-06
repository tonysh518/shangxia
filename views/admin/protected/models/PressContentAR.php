<?php

/**
 * Press Content
 */
class PressContentAR extends ContentAR {
  public $type = "press";
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function getImageFields() {
    $this->hasImageField("press_image");
    $this->hasImageField("master_image");
    return parent::getImageFields();
  }
  
  public function getFields() {
    $this->hasContentField("publish_date");
    return parent::getFields();
  }
}

