<?php

class LookbookController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      $data = $_POST;
      if (isset($data["cid"])) {
        // 更新
        $lookbookAr = LookbookAR::model()->findByPk($data["cid"]);
        if ($lookbookAr) {
          $lookbookAr->setAttributes($data);
          $lookbookAr->update();
           return $this->responseJSON($lookbookAr, "success");
        }
        else {
          $this->responseError("not found", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
        }
      }
      // 添加
      else {
        $lookbookAr = new LookbookAR();
        $lookbookAr->setAttributes($data);
        
        if ($lookbookAr->save()) {
          return $this->responseJSON(LookbookAR::model()->findByPk($lookbookAr->cid), "success");
        }
      }
      $this->responseJSON(LookbookAR::model()->findByPk($lookbookAr->cid), "success");
    }
    else {
      $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
  }
  
  public function actionIndex() {
    $request = Yii::app()->getRequest();
    $brand = strtolower($request->getParam("brand"));
    if (!$brand) {
      return $this->responseJSON(array(), "success");
    }
    $lookbookes = LookbookAR::model()->loadLookbookWithBrand($brand);
    
    // Thumbnail ?
    $size = $request->getParam("size", FALSE);
    if ($size) {
      list($width, $height) = explode("_", $size);
      foreach ($lookbookes as &$lookbook) {
        $lookbook->image = MediaAR::thumbnail($lookbook->image, array($width, $height));
      }
    }
    
    return $this->responseJSON($lookbookes, "success");
  }
  
  public function actionDelete() {
    $request = Yii::app()->getRequest();
    $cids = $request->getPost("cids");
    
    if ($cids && is_array($cids)) {
      LookbookAR::model()->deleteInPk($cids);
    }
    
    $this->responseJSON($cids, "success");
  }
  
  public function actionIngroup() {
  $lookbook = new LookbookGalleryAR();
  $gallery_list = $lookbook->getList();
  if (count($gallery_list)) {
    $gallery = array_shift($gallery_list);
    $lookbookItems = $gallery->loadLookbookItem();
    
    $ret = array();
    foreach ($lookbookItems as $lookbookItem) {
      foreach ($lookbookItem->look_book_image as $image) {
        $ret[] = array(
            "title" => $lookbookItem->title,
            "url" => $image
        );
      }
    }
    $this->responseJSON($ret, "success");
  }
  else {
    $this->responseJSON(array(), "success");
  }
  }
}

