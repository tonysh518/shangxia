<?php

class MilestoneController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      $data = $_POST;
      if (isset($data["cid"])) {
        // 更新
        $milestoneAr = MilestoneAR::model()->findByPk($data["cid"]);
        if ($milestoneAr) {
          $milestoneAr->setAttributes($data);
          $milestoneAr->update();
           return $this->responseJSON($milestoneAr, "success");
        }
        else {
          $this->responseError("not found", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
        }
      }
      // 添加
      else {
        $milestoneAr = new MilestoneAR();
        $milestoneAr->setAttributes($data);
        
        if ($milestoneAr->save()) {
          return $this->responseJSON($milestoneAr, "success");
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
      $milestone = MilestoneAR::model()->findByPk($id);
      $this->responseJSON($milestone, "success");
    }
    else {
      $milestone = new MilestoneAR();
      $list = $milestone->getList();
      $this->responseJSON($list, "success");
    }
  }
}

