<?php

Yii::import("application.models.ContentAR");
/**
 * 招聘 , 继承 ContentAR 
 */
class NewsAR extends ContentAR {
  
  public $type = "news";
  
  // 发布状态
  public $status = 1;
  
  // thumbnail media 字段
  public $thumbnail;
  
  public $master_image;
  
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
    $mediaAr->saveMediaToObject($this, "master_image");
    
    parent::afterSave();
    return TRUE;
  }
  
  public function afterFind() {
    $mediaAr = new MediaAR();
    $mediaAr->attachMediaToObject($this, "thumbnail");
    $mediaAr->attachMediaToObject($this, "master_image");
    
    parent::afterFind();
  }

  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $attributes["thumbnail"] = $this->thumbnail;
    $attributes["master_image"] = $this->master_image;
    
    return $attributes;
  }
  
  public function searchWithKeyword($keyword) {
    global $language;
    $command = Yii::app()->db->createCommand();
    $command->select("*")
            ->from("content")
            ->where("language=:language AND type=:type AND ( lower(title) like binary :keyword OR lower(body) like binary :keyword )", 
                    array(":type" => $this->type,":language" => $language, ":keyword" => "%".strtolower($keyword)."%"));
    
    
    $rows = $command->queryAll();
    $cids = array();
    foreach ($rows as $row) {
      $cids[] = $row["cid"];
    }
    $query = new CDbCriteria();
    $query->addInCondition("cid", $cids);
    return $this->findAll($query);
  }
  
  public function getNewsInCategory($category = FALSE) {
    $query = new CDbCriteria();
    
    $type = $this->type;
    
    if ($type) {
      $query->addCondition("type=:type", $type);
      $query->params[":type"] = $type;
    }
    
    global $language;
    $query->addCondition("language=:language");
    $query->params[":language"] = $language;
    
    $query->order = "weight DESC";
    
    $query->addCondition("status=:status");
    $query->params[":status"] = self::STATUS_ENABLE;
    
    if ($category) {
      $fieldQuery = new CDbCriteria();
      $fieldQuery->addCondition("field_content=:field_content")
              ->addCondition("field_name=:field_name");
      $fieldQuery->params[":field_content"] = $category;
      $fieldQuery->params[":field_name"] = "category";
      
      $result = FieldAR::model()->findAll($fieldQuery);
      $cids = array();
      foreach ($result as $item) {
        $cids[] = $item->cid;
      }
      $query->addInCondition("cid", $cids);
    }
    
    $rows = $this->findAll($query);
    
    return $rows;
  } 
  
}

