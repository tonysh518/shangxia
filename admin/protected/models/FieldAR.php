<?php

class FieldAR extends CActiveRecord {
  public function tableName() {
    return "field";
  }
  
  public function primaryKey() {
    return "fid";
  }
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
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
    $field_data = array(
        "mdate" =>  date("Y-m-d H:i:s"),
        "field_name" => $field_name,
        "cid" => $content->cid,
        "field_content" => $_REQUEST[$field_name],
    );
        
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
    $query = new CDbCriteria();
    $query->addCondition("field_name=:field_name");
    $query->params[":field_name"] = $field;
    $query->addCondition("cid=:cid");
    $query->params[":cid"] = $content->cid;
    
    return FieldAR::model()->find($query);
  }
}

