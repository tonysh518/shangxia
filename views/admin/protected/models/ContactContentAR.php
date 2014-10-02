<?php

class ContactContentAR extends ContentAR {
  public $type = "contact";
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
  public function getFields() {
    $this->hasContentField("email");
    return parent::getFields();
  }
  
  public function getFileFields() {
    $this->hasFileField("file");
    
    return parent::getFileFields();
  }
}

