<?php

class LookbookgalleryController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    $lookbokGallery = new LookbookGalleryAR();
    
    if ($request->isPostRequest) {
      $cid = isset($_POST["cid"]) ? $_POST["cid"]: NULL;
      if ($cid > 0) {
        $lookbokGallery = LookbookGalleryAR::model()->findByPk($cid);
        $lookbokGallery->setAttributes($_POST);
        $lookbokGallery->update();
      }
      else {
        $lookbokGallery->setAttributes($_POST);
        $lookbokGallery->save();
      }
      return $this->responseJSON($lookbokGallery, 'success');
    }
    else {
      $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
  }
  
  /**
   * 读取接口
   */
  public function actionIndex() {
    $request = Yii::app()->getRequest();
    
    $cid = $request->getParam("id", FALSE);
    if ($cid !== FALSE) {
      $this->responseJSON(LookbookGalleryAR::model()->findByPk($cid), "success");
    }
    else {
      $lookbookGallery = LookbookGalleryAR::model()->findAll();
      $this->responseJSON($lookbookGallery, "success");
    }
  }
}

