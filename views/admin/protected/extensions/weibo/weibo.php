<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'config.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'saetv2.ex.class.php';

class Weibo extends CApplicationComponent{
  public $app_key;
  public $app_secret;
  
  public function init() {
    //TODO::
  }
  
  public function getAuth() {
    return new SaeTOAuthV2(WB_AKEY, WB_SKEY);
  }
  
  /**
   * 
   * @return \SaeTClientV2|boolean
   */
  public function getApi() {
    $token = Yii::app()->cache->get("weibo_token");
    if (!$token) {
      return FALSE;
    }
    return new SaeTClientV2(WB_AKEY, WB_SKEY, $token["access_token"]);
  }
}

?>