<?php

Yii::import("application.models.ContentAR");
/**
 * 招聘 , 继承 ContentAR 
 */
class QacodeAR extends ContentAR {
  
  public $type = "qacode";
  
  // 发布状态
  public $status = 1;
  
  // thumbnail media 字段
  public $thumbnail;
  
  public $category;
  
  /**
   * 返回Job 对应的Field
   */
  public function getFields() {
    return array("category");
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function afterSave() {
    $mediaAr = new MediaAR();
    $mediaAr->saveMediaToObject($this, "thumbnail");
    
    parent::afterSave();
    return TRUE;
  }
  
  public function afterFind() {
    $mediaAr = new MediaAR();
    $mediaAr->attachMediaToObject($this, "thumbnail");
    
    parent::afterFind();
  }

  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $attributes["thumbnail"] = $this->thumbnail;
    
    return $attributes;
  }
  
}

