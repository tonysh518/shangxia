<?php

class ContentAR extends CActiveRecord {
  
  const STATUS_ENABLE = 1;
  const STATUS_DISABLE = 0;
  
  public $meta;
  private $fields = array();
  private $imageFields = array();
  private $videoFields = array();
  
  public static $cached_list = array();
  
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
    // 增加URL 字段
    $this->hasContentField("url_key");
    
    return array_keys($this->fields);
  }
  
  public function getImageFields() {
    return array_keys($this->imageFields);
  }
  
  public function getImageFieldOption($fieldName) {
    return $this->imageFields[$fieldName];
  }
  
  public function getVideoFields() {
    return array_keys($this->videoFields);
  }
  
  public function getVideoFormat($field_name) {
    return $this->videoFields[$field_name];
  }
  
  public function hasContentField($field_name, $options = array()) {
    $this->fields[$field_name] = $options;
  }
  
  public function getContentFieldOption($filedName) {
    return $this->fields[$filedName];
  }
  
  public function hasImageField($field_name, $options = array("multi" => FALSE)) {
    $this->imageFields[$field_name] = $options;
  }
  
  public function hasVideoField($field_name, $options = array("format" => "mp4")) {
    $this->videoFields[$field_name] = $options;
  }
  
  /**
   * 重新加载Content.
   * 这个方法一般在重新设置内容字段等字段后，需要重新加载内容让对应的字段加载进来
   */
  public function reload() {
    $this->afterFind();
  }
  
  public function beforeSave() {
    if ($this->getIsNewRecord()) {
      $this->cdate = date("Y-m-d H:i:s");
    }
    $this->mdate = date("Y-m-d H:i:s");
    
    global $language;
    if ($this->getIsNewRecord()) {
      $this->language = $language;
      $this->status = self::STATUS_ENABLE;
    }
    return TRUE;
  }
  
  /**
   * 数据添加后添加Field 数据
   * @return type
   */
  public function afterSave() {
    if (!$this->cid) {
      $sql = "SELECT MAX(cid) as cid FROM ". $this->tableName(). " ORDER BY cdate LIMIT 0, 1";
      $res = Yii::app()->db->createCommand($sql);
      $query = $res->query();
      $row = $query->read();
      
      $this->cid = $row["cid"];
    }
    
    parent::afterSave();
    
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

    foreach ($this->getVideoFields() as $fieldName) {
      $videoAr = new VideoAR();
      $videoAr->saveVideoToObject($this, $fieldName);
    }
    return TRUE;
  }
  

  public function __get($name) {
    // 文本字段
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
    // 图片字段
    $imageFields = $this->getImageFields();
    if ($imageFields && array_search($name, $imageFields) !== FALSE) {
      if ($this->cid) {
        $mediaAr = new MediaAR();
        $mediaAr->attachMediaToObject($this, $name);
        
        return $this->{$name};
      }
    }
    $videoFields = $this->getVideoFields();
    if ($videoFields && array_search($name, $videoFields) !== FALSE) {
      if ($this->cid) {
        $videoAr = new VideoAR();
        $videoAr->attachVideoToObject($this, $name);
        
        return $this->{$name};
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
    else if (array_search($name, $this->getVideoFields()) !== FALSE) {
      $this->{$name} = $value;
    }
    else {
      parent::__set($name, $value);
    }
  }
  
  /**
   * 在加载Content 之后 把对应的Field 实例加载进来
   */
  public function afterFind() {
    return;
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
    foreach ($this->getImageFields() as $fieldName) {
      $mediaAr = new MediaAR();
      $mediaAr->attachMediaToObject($this, $fieldName);
    }
    
    // 3. Video
    foreach ($this->getVideoFields() as $fieldName) {
      $videoAr = new VideoAR();
      $videoAr->attachVideoToObject($this, $fieldName);
    }
    
    return parent::afterFind();
  }
  
  public function getList($limit = FALSE, $offset = FALSE) {
    global $language;
    // key: {type}_{limit}_{offset}
    $key = "{$language}_{$this->type}_{$limit}_{$offset}";
    if (isset(self::$cached_list[$key])) {
      return self::$cached_list[$key];
    }
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
    
    $query->addCondition("language=:language");
    $query->params[":language"] = $language;
    
    $query->order = "weight DESC";
    
    $query->addCondition("status=:status");
    $query->params[":status"] = self::STATUS_ENABLE;
    
    $rows = $this->findAll($query);
    
    // 缓存保存好的Get list
    // key: {type}_{limit}_{offset}
    $key = "{$this->type}_{$limit}_{$offset}";
    self::$cached_list[$key] = $rows;
    
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
    
    // 视频
    foreach ($this->getVideoFields() as $fieldName) {
        $videoAr = new VideoAR();
        $videoAr->attachVideoToObject($this, $fieldName);
        $attributes[$fieldName] = $this->{$fieldName};
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
  
  public function findAll($condition = '', $params = array(), $withType = TRUE) {
    if ($condition instanceof CDbCriteria && $withType) {
      $condition->addCondition("type=:type");
      $condition->params[":type"] = $this->type;
    }
    return parent::findAll($condition, $params);
  }
  
  public static function getContentUrl($content) {
    //return preg_replace('/([\s-&])+/i', "-", strip_tags(strtolower($content->url_key == "" ? $content->title: $content->url_key)));
    
    return $content->url_key == "" ? $content->title: $content->url_key;
  }
  
  public static function loadContentWithUrlKey($uri, $type) {
    global $language;
    
    $query = new CDbCriteria();
    $query->join = " left join field on field.cid = ".  ContentAR::model()->getTableAlias().".cid and field.field_name='url_key'";
    $query->addCondition("language=:language");
    $query->addCondition("type=:type");
    $query->addCondition("field_content=:field_content");
    
    $query->params[":language"] = $language;
    $query->params[":type"] = $type;
    $query->params[":field_content"] = $uri;
    
    $row = ContentAR::model()->find($query);
    $class = ucfirst($type). "ContentAR";
    $obj = new $class();
    if ($row) {
      return $obj->findByPk($row->cid);
    }
    else {
      return FALSE;
    }
  }
}

