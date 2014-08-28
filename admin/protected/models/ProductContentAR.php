<?php

/**
 * 产品对象
 */
class ProductContentAR extends ContentAR {
  
  public $type = "product";
  public function getFields() {
    $this->hasContentField("video_title");
    $this->hasContentField("video_description", array("full_html" => TRUE));
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
  
}

