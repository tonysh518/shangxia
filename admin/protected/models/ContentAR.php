<?php

class ContentAR extends CActiveRecord {
  
  public $meta;
  private $fields = array();
  private $imageFields = array();
  public function tableName() {
    return "content";
  }
  
  public function primaryKey() {
    return "cid";
  }
  
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }
  
  public function rules() {
    $fields = $this->getFields();
    $safe_attrs = "cid, body, summary, language, cdate, mdate, uid, status, weight, key_id" . implode(",", $fields);
    return array(
        array("title, type", "required"),
        array($safe_attrs, "safe"),
    );
  }
  
  /**
   * 返回类型对应的 Field 列表
   * field 类型这样数据结构 array("field_1_name", "field_2_name", "field_3_name" )
   * @return type
   */
  public function getFields() {
    return $this->fields;
  }
  
  public function getImageFields() {
    return array_keys($this->imageFields);
  }
  
  public function getImageFieldOption($fieldName) {
    return $this->imageFields[$fieldName];
  }
  
  public function getVideoFields() {
    return array();
  }
  
  public function hasContentField($field_name, $options = array()) {
    array_push($this->fields, $field_name);
  }
  
  public function hasImageField($field_name, $options = array()) {
    $this->imageFields[$field_name] = $options;
  }
  
  /**
   * 重新加载Content.
   * 这个方法一般在重新设置内容字段等字段后，需要重新加载内容让对应的字段加载进来
   */
  public function reload() {
    $this->afterFind();
  }
  
  public function beforeSave() {
    if ($this->cid <= 0) {
      $cid = NULL;
    }
    if ($this->isNewRecord) {
      $this->cdate = date("Y-m-d H:i:s");
    }
    $this->mdate = date("Y-m-d H:i:s");
    
    global $language;
    if ($this->isNewRecord) {
      $this->language = $language;
    }
    
    return TRUE;
  }
  
  /**
   * 数据添加后添加Field 数据
   * @return type
   */
  public function afterSave() {
    $cid = $this->cid;
    
    // 添加 Field 数据
    foreach ($this->getFields() as $field) {
      $model = new FieldAR();
      $model->afterContentSave($this, $field);
    }

    // 添加图片
    foreach ($this->getImageFields() as $fieldName) {
      $media = new MediaAR();
      $media->saveMediaToObject($this, $fieldName);
    }

    // TODO:: 添加视频
    
    return parent::afterSave();
  }
  

  public function __get($name) {
    $fields = $this->getFields();
    if ($fields && array_search($name, $fields) !== FALSE) {
      if ($this->cid) {
        $fieldAr = new FieldAR();
        $field = $fieldAr->getFieldInstance($this, $name);
        if ($field) {
          return $field->field_content;
        }
        else {
          return "";
        }
      }
      else {
        return "";
      }
    }
    
    return parent::__get($name);
  }
  
  /**
   * 设置字段
   */
  public function __set($name, $value) {
    $fields = $this->getFields();
    if (array_search($name, $fields) !== FALSE) {
      $this->{$name} = $value;
    }
    else if (array_search($name, $this->getImageFields()) !== FALSE) {
      $this->{$name} = $value;
    }
    else {
      parent::__set($name, $value);
    }
  }
  
  /**
   * 在加载Content 之后 把对应的Field 实例加载进来
   * @author jackey
   * 
   */
  public function afterFind() {
    // 1. field
    $fields = $this->getFields();
    if ($fields) {
        foreach ($fields as $field_name) {
          $fieldAr = new FieldAR();
          $field_instance = $fieldAr->getFieldInstance($this, $field_name);
          if ($field_instance) {
            $this->{$field_name} = $field_instance->field_content;
          }
        }
    }
    
    // 2. image
    
    return parent::afterFind();
  }
  
  public function getList($limit = FALSE, $offset = FALSE) {
    $query = new CDbCriteria();
    
    if ($limit) {
      $query->limit = $limit;
    }
    if ($offset) {
      $query->offset = $offset;
    }
    
    $type = $this->type;
    
    if ($type) {
      $query->addCondition("type=:type", $type);
      $query->params[":type"] = $type;
    }
    
    global $language;
    $query->addCondition("language=:language");
    $query->params[":language"] = $language;
    
    $query->order = "weight DESC, cdate DESC";
    
    $query->addCondition("status=:status");
    $query->params[":status"] = self::STATUS_ENABLE;
    
    $rows = $this->findAll($query);
    
    return $rows;
  }
  
  /**
   * 覆盖这个方法，可以非常方便返回 JSON 数据
   */
  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $fields = $this->getFields();
    if ($fields) {
      foreach ($fields as $field_name) {
        $fieldAr = new FieldAR();
        $field_instance = $fieldAr->getFieldInstance($this, $field_name);
        if ($field_instance) {
          $attributes[$field_name] = $field_instance->field_content;
        }
        else {
          $attributes[$field_name] = "";
        }
      }
    }
    
    // 图片
    $imageFields = $this->getImageFields();
    if($imageFields) {
      foreach ($imageFields as $fieldName) {
        $media = new MediaAR();
        $media->attachMediaToObject($this, $fieldName);
        $attributes[$fieldName] = $this->{$fieldName};
      }
    }
    return $attributes;
  }
  
  /**
   * 用Key 找到一个对应的内容
   * @param type $key
   * @return ContentAR 
   */
  public function loadByKey($key) {
    $query = new CDbCriteria();
    $query->addCondition("key_id = :key_id");
    $query->params[":key_id"] = $key;
    
    $row = $this->find($query);
    // 在初始化之前是没有内容的，加一个来作为默认的内容
    global $language;
    if (!$row) {
      $data = array(
          "title" => "title",
          "body" => "body",
          "summary" => "summary",
          "uid" => 0,
          "status" => 1,
          "type" => "content",
          "weight" => 0,
          "key_id" => $key
      );
      $content = new ContentAR();
      $content->attributes = $data;
      $content->save();
      $row = $content;
    }
    
    return $row;
  }
}

