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
  
  public function getListWithYear($year, $page = 1, $limit = 16) {
    $sql = ' select content.* from content left join field on field.cid = content.cid and field.field_name="publish_date"   where type="press" and year(field.field_content)="'.$year.'" ';
    
    $offset = ($page - 1) * $limit;
    $sql .= " limit $offset, $limit";
    $query = Yii::app()->db->createCommand($sql);
    $rows = $query->queryAll();
    
    $cids = array();
    foreach ($rows as $row) {
      $cids[] = $row["cid"];
    }
    
    $query = new CDbCriteria();
    $query->addInCondition("cid", $cids);
    global $language;
    $query->addCondition("language=:language");
    $query->addCondition("type=:type");
    $query->params[":language"] = $language;
    $query->params[":type"] = $this->type;
    
    return $this->findAll($query);
  }
}

