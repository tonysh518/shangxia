<?php

class ShopController extends Controller {
  
  public function beforeAction($action) {
    if (!UserAR::isLogin() && $action->id != "login" && $action->id != "error") {
      return $this->redirect(Yii::app()->createUrl("index/login"));
    }
    return parent::beforeAction($action);
  }
  public function actionIndex() {
    $shopes = ShopAR::model()->getList(ShopAR::STATUS_OPEN);
    $this->render("index", array("shopes" => $shopes));
  }
  
  public function actionAdd() {
    $this->render("add",  array("shop" => FALSE));
  }
  
  public function actionEdit() {
    $request = Yii::app()->getRequest();
    $shop_id = $request->getParam("shop_id");
    $shop = ShopAR::model()->findByPk($shop_id);
    if (!$shop) {
      return $this->redirect(array("index"));
    }
    $this->render("add", array("shop" => $shop));
  }
}

