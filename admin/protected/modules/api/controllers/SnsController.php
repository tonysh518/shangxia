<?php

class SnsController extends Controller {
  public function actionWeibo() {
    $api = Yii::app()->weibo->getApi();
    if (!$api) {
      $this->responseError("weibo not login", ErrorAR::ERROR_UNKNOWN);
    }
    
    $token = Yii::app()->cache->get("token");
    
    $timeline = $api->user_timeline_by_id($token["uid"]);
    
    $this->responseJSON($timeline, "success");
    
  }
}

