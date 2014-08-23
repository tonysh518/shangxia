<?php

class ContentController extends Controller {
  
  /**
   * 删除数据
   */
  public function actionDelete() {
    $request = Yii::app()->getRequest();
    
    $cid = $request->getParam("cid", FALSE);
    
    if (!$cid) {
      return $this->responseError("http param error", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    
    if (is_array($cid)) {
      ContentAR::model()->deleteInPk($cid);
    }
    else {
      $content = ContentAR::model()->findByPk($cid);
      $content->status = ContentAR::STATUS_DISABLE;

      $content->save(FALSE);
    }
    
    return $this->responseJSON("success", "success");
  }
  
  public function actionUpdatecorporate() {
    $request = Yii::app()->getRequest();
    if ($request->isPostRequest) {
      $contentAr = new ContentAR();
      $contentAr->updateCorporate($_POST);
      
      $this->responseJSON($_POST, "success");
    }
    else {
      return $this->responseJSON(array(), "message");
    }
  }
  
  public function actionCorporate() {
      $contentAr = new ContentAR();
      $corporate = $contentAr->loadCorporate();
      $attributes = array();
      if ($corporate) {
        $attributes = $corporate->attributes;
        if (isset($corporate->thumbnail)) {
          $attributes["thumbnail"] = $corporate->thumbnail;
        }
        $this->responseJSON($attributes, "success");
      }
      
      $this->responseJSON("", "success");
  }
  
  public function actionUpdateqrcode() {
    $contentAr = new ContentAR();
    $request = Yii::app()->getRequest();
    if ($request->isPostRequest) {
      $qrcode = $contentAr->updateQrcode($_POST);
      
      return $this->responseJSON($qrcode->qrcodes, "success");
    }
    else {
      $this->responseError("http error");
    }
  }
  
  public function actionQrcode() {
    $contentAr = new ContentAR();
    $qrcode = $contentAr->loadQrcode();
    if ($qrcode) {
      $this->responseJSON($qrcode->qrcodes, "success");
    }
    else {
      $this->responseJSON(array(), "success");
    }
  }
  
  public function actionUpdateContact() {
    $contentAr = new ContentAR();
    $request = Yii::app()->getRequest();
    if ($request->isPostRequest) {
      $contact = $contentAr->updateContact($_POST);
      return $this->responseJSON($contact, "success");
    }
    else {
      $this->responseError("http error");
    }
  }
  
  public function actionContact() {
    $contentAr = new ContentAR();
    return $this->responseJSON($contentAr->loadContact(), "success");
  }
  
  public function actionLoadbrand() {
    $brandName = Yii::app()->getRequest()->getParam("brand");
    if (!$brandName) {
      return $this->responseError("missed param");
    }
    
    $contentAr = new ContentAR();
    $brand = $contentAr->loadBrandInfo($brandName);
    
    if (!$brand) {
      return $this->responseError('brand with '. $brandName. " is not existed");
    }
    $obj = array("title" => $brand->title, 
        "body" => $brand->body, 
        "cid" => $brand->cid,
        "language" => $brand->language,
        "brand_master_image" => $brand->brand_master_image,
        "brand_thumbnail_image" => $brand->brand_thumbnail_image,
        "brand_navigation_full_image" => $brand->brand_navigation_full_image,
        "brand_navigation_image" => $brand->brand_navigation_image);
    $this->responseJSON($obj, "success");
  }
  
  public function actionUpdatabrand() {
    $brandName = Yii::app()->getRequest()->getPost("brand");
    if (!$brandName) {
      return $this->responseError("missed param");
    }
    
    $contentAr = new ContentAR();
    $ret = $contentAr->updateBrandInfo($brandName, $_POST);
    
    if (!$ret) {
      return $this->responseError("unkonwn error happend");
    }
    
    $brand = $contentAr->loadBrandInfo($brandName);
    
    $this->responseJSON($brand, "success");
  }
  
  public function actionLoadbrandinfo() {
    $contentAr = new ContentAR();
    
    $brandInfomation = $contentAr->loadBrandInformationContent();
    if (!$brandInfomation) {
      return $this->responseError("not found");
    }
    
    $this->responseJSON(array(
        "title" => $brandInfomation->title, 
        "body" => $brandInfomation->body,
        "dazzle_thumbnail" => $brandInfomation->dazzle_thumbnail,
        "diamond_thumbnail" => $brandInfomation->diamond_thumbnail,
        "dzzit_thumbnail" => $brandInfomation->dzzit_thumbnail), "success");
  }
  
  public function actionUpdateBrandInfo() {
    $request = Yii::app()->getRequest();
    if (!$request->isPostRequest) {
      return $this->responseError("http verb error");
    }
    
    $contentAr = new ContentAR();
    $ret = $contentAr->updateBrandInformationContent($_POST);
    
    $this->responseJSON($ret, "success");
  }
  
}

