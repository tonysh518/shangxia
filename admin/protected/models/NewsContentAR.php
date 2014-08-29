<?php

/**
 * Slideshow Content
 */
class NewsContentAR extends ContentAR {
  
  public $type = "news";
  
  public function getImageFields() {
    //$this->hasImageField("image");
    
    return parent::getImageFields();
  }
  
  public function getFields() {
    $this->hasContentField("summary");
    return parent::getFields();
  }
  
//  public static function model($class = __CLASS__) {
//    return parent::model($class);
//  }
  
}

