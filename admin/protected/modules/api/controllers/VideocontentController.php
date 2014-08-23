<?php

// video content
class VideocontentController extends Controller {
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      $videocontentAr = new VideoContentAR();
      $cid = $request->getPost("cid");
      if ($cid) {
        $videocontentAr = VideoContentAR::model()->findByPk($cid);
      }
      
      $videocontentAr->attributes = $_POST;
      if ($videocontentAr->isNewRecord) {
        if ($videocontentAr->save()) {
          $this->responseJSON($videocontentAr, "success");
        }
        else {
          $this->responseError("error", 500, $videocontentAr->getErrors());
        }
      }
      else {
        if ($videocontentAr->update()) {
          $this->responseJSON($videocontentAr, "success");
        }
        else {
          $this->responseError("error", 500, $videocontentAr->getErrors());
        }
      }
    }
  }
  
  public function actionView() {
    $request = Yii::app()->getRequest();
    
    $id = $request->getParam("id");
    if (!$id) {
      $this->responseError("missed param");
    }
    
    $videcontent = VideoContentAR::model()->findByPk($id);
    $this->responseJSON($videcontent, "success");
  }
  
  public function actionIndex () {
    $videcontentAr = new VideoContentAR();
    $this->responseJSON($videcontentAr->getList(), "success");
  }
}
