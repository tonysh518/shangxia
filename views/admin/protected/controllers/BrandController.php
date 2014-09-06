<?php

/**
 * 品牌 - Controller
 */
class BrandController extends Controller {
  /**
   *
   * @var CHttpRequest 
   */
  public $request;
  public function init() {
    parent::init();
    $this->request = Yii::app()->getRequest();
  }
  
  public function actionEdit() {
    $brand = $this->request->getParam("brand");
    
    $this->render("brandedit", array("brand" => $brand));
  }
}

