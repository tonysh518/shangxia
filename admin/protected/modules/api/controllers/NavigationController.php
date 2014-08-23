<?php

/**
 * 导航
 */
class NavigationController extends Controller {
  public function actionIndex() {
    $list = NavigationMenuAR::model()->findAll();
    
    $ret = array();
    foreach ($list as $item) {
      $ret[$item["name"]] = $item["text"];
      $ret[$item["name"]."_media_uri"] = $item["media_uri"];
      $ret[$item["name"]."_media_uri_hover"] = $item["media_uri_hover"];
    }
    
    $this->responseJSON($ret, "success");
  }
  
  public function actionAdd() {
    global $language;
    $request = Yii::app()->getRequest();
    $post = $_POST;
    $names = NavigationMenuAR::$names;
    foreach ($names as $name) {
      $data = array();
      if (isset($_POST[$name])) {
        $data["text"] = $_POST[$name];
      }
      if (isset($_POST[$name."_media_uri"])) {
        $data["media_uri"] = $_POST[$name."_media_uri"];
      }
      if (isset($_POST[$name."_media_uri_hover"])) {
        $data["media_uri_hover"] = $_POST[$name."_media_uri_hover"];
      }
      if ($data) {
        $navigation = new NavigationMenuAR();
        $navigation->updateNavMenuByName($name, $data);
      }
    }
    $this->responseJSON($post + array("language" => $language), "success");
  }
}
