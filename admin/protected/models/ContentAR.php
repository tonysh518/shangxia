<?php

class ContentAR extends CActiveRecord {
  
  const STATUS_ENABLE = 1;
  const STATUS_DISABLE = 0;
  
  const CORPORATE_CID = 10000;
  const CORPORATE_ZH_CID = 10001;
  
  const QRCODE_CID = 10002;
  const QRCODE_ZH_CID = 10003;
  
  const CONTACT_CID = 10004;
  const CONTACT_ZH_CID = 10005;
  
  const DAZZLE_BRAND_INFO_CID = 10006;
  const DAZZLE_BRAND_INFO_ZH_CID=10007;
  
  const DIAMONDDAZZLE_BRAND_INFO_CID = 10008;
  const DIAMONDDAZZLE_BRAND_INFO_ZH_CID=10009;
  
  const DZZIT_BRAND_INFO_CID = 10010;
  const DZZIT_BRAND_INFO_ZH_CID=10011;
  
  const BRAND_INFORMATION_CID = 10012;
  const BRAND_INFORMATION_ZH_CID = 10013;
  
  public $thumbnail;
  
  public $qrcodes = array();
  
  public $status = 1;
  
  public $brand_master_image;
  
  public $brand_thumbnail_image;
  
  public $brand_navigation_image;

  public $brand_navigation_full_image;
  
  public $dazzle_thumbnail;
  
  public $diamond_thumbnail;
  
  public $dzzit_thumbnail;
  
  public $meta;
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
    $safe_attrs = "cid, body, summary, language, cdate, mdate, uid, status, weight, " . implode(",", $fields);
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
    return array();
  }
  
  public function getMedia() {
    return array();
  }
  
  public function getVideo() {
    return array();
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
    
    $fields = $this->getFields();
    if (count($fields) <= 0 ) {
      return parent::afterSave();
    }
    
    // 添加 Field 数据
    foreach ($fields as $field) {
      $model = new FieldAR();
      $model->afterContentSave($this, $field);
    }
    
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
    if (isset($this->qrcodes[$name])) {
      return $this->qrcodes[$name];
    }
    
    return parent::__get($name);
  }

  public function beforeFind() {
      $fields = $this->getFields();
      if ($fields) {
        foreach ($fields as $field_name) {
          $fieldAr = new FieldAR();
          $fieldAr->getFieldInstance($this, $field_name);
        }
      }
      return parent::beforeFind();
  }
  
  /**
   * 
   */
  public function afterFind() {
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
    return $attributes;
  }
  
  public function updateCorporate($data) {
    $corporate = $this->loadCorporate();
    if (!$corporate) {
      // 添加一个content为corporate
      global $language;
      $tmp_data = array(
          "cid" => $language == "en" ? self::CORPORATE_CID: self::CORPORATE_ZH_CID,
          "title" => Yii::t("strings", "corporate information"),
          "body" => "",
          "status" => self::STATUS_ENABLE,
          "type" => "none",
          "language" => $language
      );
      $tmp_corporate = new ContentAR();
      $tmp_corporate->attributes = $tmp_data;
      $tmp_corporate->save();
      
      $corporate = $this->loadCorporate();
    }
    
    if (isset($data["title"])) {
      $corporate->title = $data["title"];
    }
    if (isset($data["body"])) {
      $corporate->body = $data["body"];
    }
    if (isset($data["thumbnail"])) {
      $mediaAr = new MediaAR();
      $corporate->thumbnail = $data["thumbnail"];
      $mediaAr->saveMediaToObject($corporate, "thumbnail");
    }
    
    $corporate->save();
    
    return $corporate;
  }
  
  public function loadCorporate() {
    global $language;
    if ($language == "en") {
      $corporate = self::model()->findByPk(self::CORPORATE_CID);
    }
    else {
      $corporate = self::model()->findByPk(self::CORPORATE_ZH_CID);
    }
    
    if (!$corporate) {
      return FALSE;
    }
    
    // Load media
    $mediaAr = new MediaAR();
    $media = $mediaAr->loadMediaWithObject($corporate, "thumbnail");
    if ($media) {
      $uri = unserialize($media->uri);
      $corporate->thumbnail = $uri;
    }
    
    return $corporate;
  }
  
  public function updateQrcode($qrcodes = array()) {
    $content = $this->loadQrcode();
    // 如果没有qrcode, 则需要创建一个
    if (!$content) {
      global $language;
      $tmp_data = array(
          "cid" => $language == "en" ? self::QRCODE_CID: self::QRCODE_ZH_CID,
          "title" => Yii::t("strings", "QRcode information"),
          "body" => "",
          "status" => self::STATUS_ENABLE,
          "type" => "qrcode",
          "language" => $language
      );
      $tmp = new ContentAR();
      $tmp->attributes = $tmp_data;
      $tmp->save();
      
      $content = $this->loadQrcode();
    }
    
    $content->qrcodes = array_merge($content->qrcodes, $qrcodes);
    
    foreach ($qrcodes as $name => $qrcode) {
      $mediaAr = new MediaAR();
      $mediaAr->saveMediaToObject($content, $name);
    }
    
    $content = $this->loadQrcode();
    
    return $content;
  }
  
  public function updateContact($data) {
    $content = $this->loadContact();
    if (!$content) {
      global $language;
      $tmp_data = array(
          "cid" => $language == "en" ? self::CONTACT_CID: self::CONTACT_ZH_CID,
          "title" => Yii::t("strings", "Contact"),
          "body" => "",
          "status" => self::STATUS_ENABLE,
          "type" => "contact",
          "language" => $language
      );
      $tmp = new ContentAR();
      $tmp->attributes = $tmp_data;
      $tmp->save();
      
      $content = $this->loadContact();
    }
    
    $content->attributes = $data;
    return $content->update();
  }
  
  public function loadContact() {
    global $language;
    if ($language == "en") {
      $cid = self::CONTACT_CID;
    }
    else {
      $cid = self::CONTACT_ZH_CID;
    }
    
    $content = self::model()->findByPk($cid);
    if (!$content) {
      return FALSE;
    }
    
    return $content;
  }
  
  public function loadQrcode() {
    global $language;
    if ($language == "en") {
      $cid = self::QRCODE_CID;
    }
    else {
      $cid = self::QRCODE_ZH_CID;
    }
    
    $content = self::model()->findByPk($cid);
    if (!$content) {
      return FALSE;
    }
    
    // 加载 QRCode
    $brands = Yii::app()->params["brands"];
    $mediaAr = new MediaAR();
    foreach ($brands as $key => $brand) {
      $name = "qrcode_". strtolower($key);
      $media = $mediaAr->loadMediaWithObject($content, $name);
      if ($media) {
        $content->qrcodes[$name] = Yii::app()->getBaseUrl(TRUE). unserialize($media->uri);
      }
      else {
        $content->qrcodes[$name] = "";
      }
    }
    
    return $content;
  }
  
  /**
   * 更新Brand
   * @param type $brand
   * @param type $data
   */
  public function updateBrandInfo($brandName, $data) {
    $brand = $this->loadBrandInfo($brandName);
    
    // 先保存内容
    if (!$brand) {
    // 先得到Brand 内容
      global $language;
      if ($language == "en") {
        $brandCid = strtoupper(str_replace(array(" ", "'", "-"), "", $brandName))."_BRAND_INFO_CID";
      }
      else {
        $brandCid = strtoupper(str_replace(array(" ", "'", "-"), "", $brandName))."_BRAND_INFO_ZH_CID";
      }


      $class = new ReflectionClass("ContentAR");
      $brandCid =  $class->getConstant($brandCid);
      
      $data['type'] = "brand";
      $data["cid"] = $brandCid;
      $contentTmp = new ContentAR();
      $contentTmp->attributes = $data;
      
      if (!$contentTmp->save()) {
        return FALSE;
      }
      $brand = $contentTmp;
    }
    else {
      $brand->body = $data["body"];
      $brand->title = $data["title"];
      $brand->save();
    }
    
    // 再保存Media
    $mediaAr = new MediaAR();
    // Master Image
    $mediaAr->saveMediaToObject($brand, "brand_master_image");
    
    // Thumbnail Image
    $mediaAr->saveMediaToObject($brand, "brand_thumbnail_image");
    
    // Navigation Image
    $mediaAr->saveMediaToObject($brand, "brand_navigation_image");
    // Navigation Full Image
    $mediaAr->saveMediaToObject($brand, "brand_navigation_full_image");
    
    // 保存好后 再重新load 然后返回


    return $this->loadBrandInfo($brandName);
  }
  
  /**
   * 加载一个Brand
   * @param type $brand
   */
  public function loadBrandInfo($brandName) {
    // 先得到Brand 内容
    global $language;
    if ($language == "en") {
      $brandCid = strtoupper(str_replace(array(" ", "'", "-"), "", $brandName))."_BRAND_INFO_CID";
    }
    else {
      $brandCid = strtoupper(str_replace(array(" ", "'", "-"), "", $brandName))."_BRAND_INFO_ZH_CID";
    }
    
    $class = new ReflectionClass("ContentAR");
    $brandCid =  $class->getConstant($brandCid);
    
    $content = self::model()->findByPk($brandCid);
    if (!$content) {
      return FALSE;
    }
    
    $mediaAr = new MediaAR();
    // 再得到brand 相关联得Media
    // Master Image
    $mediaAr->attachMediaToObject($content, "brand_master_image");
    
    // Thumbnail Image
    $mediaAr->attachMediaToObject($content, "brand_thumbnail_image");
    
    // Navigation Image
    $mediaAr->attachMediaToObject($content, "brand_navigation_image");
    // Navigation Full Image
    $mediaAr->attachMediaToObject($content, "brand_navigation_full_image");
    
    return $content;
  }
  
  public function loadBrandInformationContent() {
    global $language;
    
    if ($language == "en") {
      $cid = self::BRAND_INFORMATION_CID;
    }
    else {
      $cid = self::BRAND_INFORMATION_ZH_CID;
    }
    
    $brandInformation = self::model()->findByPk($cid);
    
    if (!$brandInformation) {
      return FALSE;
    }
    
    $mediaAr = new MediaAR();
    $mediaAr->attachMediaToObject($brandInformation, "dazzle_thumbnail");
    // $mediaAr->attachMediaToObject($brandInformation, "diamond_thumbnail");
    // $mediaAr->attachMediaToObject($brandInformation, "dzzit_thumbnail");
    
    return $brandInformation;
  }
  
  public function updateBrandInformationContent($data) {
    $brandInformation = $this->loadBrandInformationContent();
    
    if (!$brandInformation) {
      global $language;

      if ($language == "en") {
        $cid = self::BRAND_INFORMATION_CID;
      }
      else {
        $cid = self::BRAND_INFORMATION_ZH_CID;
      }
      $data["cid"] = $cid;
      $data["type"] = "brand_information";
      
      $tmpBrand = new ContentAR();
      $tmpBrand->attributes = $data;
      $tmpBrand->save();
      if ($tmpBrand->hasErrors()) {
        return FALSE;
      }
      $brandInformation = $this->loadBrandInformationContent();
    }
    else {
      $brandInformation->attributes = $data;
      $brandInformation->update();
    }
    
    $mediaAr = new MediaAR();
    $mediaAr->saveMediaToObject($brandInformation, "dazzle_thumbnail");
    // $mediaAr->saveMediaToObject($brandInformation, "diamond_thumbnail");
    // $mediaAr->saveMediaToObject($brandInformation, "dzzit_thumbnail");
    
    return $this->loadBrandInformationContent();
  }
  
  /**
   * 删除一组cid 下的 数据
   */
  public function deleteInPk($cids) {
    $query = new CDbCriteria();
    $query->addInCondition("cid", $cids);
    
    return self::model()->deleteAll($query);
  }
}

