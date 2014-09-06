<?php

// 邮件订阅
class NewsletterContentAR extends ContentAR {
  public $type = "newsletter";
  
  public function getFields() {
    $this->hasContentField("phone");
    $this->hasContentField("email");
    return parent::getFields();
  }
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
}

