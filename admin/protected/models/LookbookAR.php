<?php

class LookbookAR extends ContentAR {
  public $type = "lookbook";
  
  public $brand;
  
  public $image;
  
  
  public function getFields() {
    return array("brand");
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function afterSave() {
    parent::afterSave();
    $mediaAr = new MediaAR();
    $mediaAr->saveMediaToObject($this, "image");
    return TRUE;
  }
  
  public function afterFind() {
    parent::afterFind();
    $mediaAr = new MediaAR();
    $mediaAr->attachMediaToObject($this, "image");
  }

  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $attributes["image"] = $this->image;
    
    return $attributes;
  }
  
  /**
   * 找出品牌下的Lookbook
   * @param type $brand
   * @return type
   */
  public function loadLookbookWithBrand($brand) {
    $table = $this->tableName();
    $sql = "SELECT * FROM ". $table. " as c";
    $sql .= " LEFT JOIN field f on f.field_name='brand' AND f.cid = c.cid";
    $sql .= " WHERE f.field_content=:brand AND c.type='lookbook'";
    
    $command = Yii::app()->db->createCommand($sql);
    $result = $command->queryAll(TRUE ,array(":brand" => $brand));
    $cids = array();
    foreach ($result as $row) {
      $cids[] = $row["cid"];
    }
    
    $query = new CDbCriteria();
    $query->addInCondition("cid", $cids);
    
    return $this->findAll($query);
  }
}

