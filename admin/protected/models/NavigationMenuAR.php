<?php

class NavigationMenuAR extends CActiveRecord {
  public static $names = array(
      "title_coporation", "title_brand", "title_career", "title_media", "title_home"
  );

  public function tableName() {
    return "navigation_menu";
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function primaryKey() {
    return "nm_id";
  }
  
  public function rules() {
    return array(
        array("nm_id, name, text, media_uri, url, media_uri_hover, language", "safe"),
    );
  }

  public function findAll($query = null) {
    global $language;
    if (!$query) {
      $query = new CDbCriteria();
    }
    if ($query instanceof CDbCriteria) {
      $query->addCondition('language = :language');
      $query->params[":language"] = $language;
    }

    return parent::findAll($query);
  }
  
  /**
   * 返回一个名字下的 Menu Nav
   * @param type $name
   * @return boolean
   */
  public function getNavMenuByName($name) {
    $names = self::$names;
    if (array_search($name, $names) === FALSE) {
      return FALSE;
    }
    global $language;
    $query = new CDbCriteria();
    $query->addCondition("name=:name");
    $query->addCondition("language=:language");
    $query->params[":name"] = $name;
    $query->params[":language"] = $language;
    
    return self::model()->find($query);
  }
  
  /**
   * 更新一个名字下的Menu Nav
   * @param type $name
   * @param type $data
   */
  public function updateNavMenuByName($name, $data) {
    $menu = $this->getNavMenuByName($name);
    global $language;
    // 如果没有数据 就添加一个
    if (!$menu) {
      $tmp_menu = array(
          "name" => $name,
          "text" => @$data["text"],
          "media_uri" => @$data["media_uri"],
          "media_uri_hover" => @$data["media_uri_hover"],
          "language" => $language,
          "url" => "",
      );
      $newNavMenu = new NavigationMenuAR();
      $newNavMenu->attributes = $tmp_menu;
      $newNavMenu->insert();
      return $newNavMenu->getPrimaryKey();
    }
    if (isset($data["text"])) {
      $menu["text"] = $data["text"];
    }
    if (isset($data["media_uri"])) {
      $menu["media_uri"] = @$data["media_uri"];
    }
    if (isset($data["media_uri_hover"])) {
      $menu["media_uri_hover"] = @$data["media_uri_hover"];
    }

    $menu->language = $language;
    
    $menu->update();
    
    return $menu;
  }
  
  public function beforeSave() {
    if ($this->isNewRecord) {
      $this->cdate = date("Y-m-d H:i:s");
    }
    $this->udate = date("Y-m-d H:i:s");
    
    return parent::beforeSave();
  }
}
