<?php

class StreehotController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      $data = $_POST;
      if (isset($data["cid"])) {
        // 更新
        $streehotAr = StreehotAR::model()->findByPk($data["cid"]);
        if ($streehotAr) {
          $streehotAr->setAttributes($data);
          $streehotAr->update();
           return $this->responseJSON($streehotAr, "success");
        }
        else {
          $this->responseError("not found", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
        }
      }
      // 添加
      else {
        $streehotAr = new StreehotAR();
        $streehotAr->setAttributes($data);
        
        if ($streehotAr->save()) {
          return $this->responseJSON($streehotAr, "success");
        }
      }
      $this->responseJSON($data, "success");
    }
    else {
      $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
  }
  
  public function actionIndex() {
    $request = Yii::app()->getRequest();
    $id = $request->getParam("id", FALSE);
    if ($id) {
      $streehot = StreehotAR::model()->findByPk($id);
      $this->responseJSON($streehot, "success");
    }
    else {
      $streehot = new StreehotAR();
      $list = $streehot->getList();
      $this->responseJSON($list, "success");
    }
  }
  
  public function actionIngroup() {
      $streehot = new StreehotAR();
      $list = $streehot->getList();
      $ret = array();
      foreach ($list as $streehot){
        foreach ($streehot->streehot_image as $image) {
          $ret[] = array(
              "title" => $streehot->title,
              "url" => $image
          );
        }
      }
      $this->responseJSON($ret, "success");
  }
}

