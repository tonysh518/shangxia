<?php

class FieldAR extends CActiveRecord {
  
  public static $caches = array();
  
  public function tableName() {
    return "field";
  }
  
  public function primaryKey() {
    return "fid";
  }
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
  public static function getCache($key) {
    $max_size_in_chunk = 200;
    // 初始化缓存
    if (!self::$caches) {
      $res = Yii::app()->db->createCommand("SELECT * FROM field")->queryAll();
      $chunk = array();
      foreach ($res as $row) {
        $key = "{$row["cid"]}_{$row["field_name"]}";
        $chunk[$key] = FieldAR::model()->findByPk($row["fid"]);
        if (count($chunk) > $max_size_in_chunk) {
          self::$caches[] = $chunk;
          $chunk = array();
        }
      }
      if (count($chunk) < $max_size_in_chunk) {
        self::$caches[] = $chunk;
      }
    }
    
    foreach (self::$caches as $chunk) {
      if (isset($chunk[$key])) {
        return $chunk[$key];
      }
    }
  }
  
  public function rules() {
    return array(
        array("mdate, cdate, fid, field_name, field_content, cid", "safe"),
    );
  }
  
  public function beforeSave() {
    if ($this->isNewRecord) {
      $this->cdate = date("Y-m-d H:i:s");
    }
    $this->mdate = date("Y-m-d H:i:s");
    return TRUE;
  }
  
  /**
   * Content 添加之后 添加 这个方法 可以保存对应的 Field 数据
   * @param type $content
   * @param type $field_name
   */
  public function afterContentSave($content, $field_name) {
    $options = $content->getContentFieldOption($field_name);
    // 如果没有传这个field 得值，则不要保存数据了
    if (!isset($_REQUEST[$field_name])) {
      return;
    }
    if (isset($options["select_multi"]) && $options["select_multi"]) {
      $field_data = array(
          "mdate" =>  date("Y-m-d H:i:s"),
          "field_name" => $field_name,
          "cid" => $content->cid,
          "field_content" => json_encode($_REQUEST[$field_name]),
      );
    }
    else {
      $field_data = array(
          "mdate" =>  date("Y-m-d H:i:s"),
          "field_name" => $field_name,
          "cid" => $content->cid,
          "field_content" => $_REQUEST[$field_name],
      );
    }
        
    $fieldInstance = $this->getFieldInstance($content, $field_name);
    if ($fieldInstance) {
      $fieldInstance->setAttributes($field_data);
      $fieldInstance->update();
      return TRUE;
    }
    
    $this->setAttributes($field_data);
    if($this->save()) {
      return TRUE;
    }
    else {
      $errors = $this->getErrors();
      if ($errors["field_content"]) {
        $errors[$field_name] = $errors["field_content"];
      }
      return $errors;
    }
  }
  
  /**
   * 获取Field 实例
   * @param type $field
   */
  public function getFieldInstance($content, $field) {
    if (!self::$caches) {
      self::getCache("");
    }
    $key = "{$content->cid}_{$field}";
    $fieldInstance = self::getCache($key);
    if ($fieldInstance) {
      return $fieldInstance;
    }
    $query = new CDbCriteria();
    $query->addCondition("field_name=:field_name");
    $query->params[":field_name"] = $field;
    $query->addCondition("cid=:cid");
    $query->params[":cid"] = $content->cid;
    
    return FieldAR::model()->find($query);
  }
}

