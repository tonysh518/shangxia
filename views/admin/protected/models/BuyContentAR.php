<?php

class BuyContentAR extends ContentAR {
  public $type = "buy";
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
  public function getFields() {
    $this->hasContentField("phone");
    $this->hasContentField("email");
    $this->hasContentField("product");
    $this->hasContentField("product_type");
    return parent::getFields();
  }
  
  
}

