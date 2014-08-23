<?php

class PageController extends Controller {
  
  public function beforeAction($action) {
    if (!UserAR::isLogin() && $action->id != "login" && $action->id != "error") {
      return $this->redirect(Yii::app()->getBaseUrl()."/index/login");
    }
    return parent::beforeAction($action);
  }
  
  public function actionLookbook() {
    $request = Yii::app()->getRequest();
    $brand = strtolower($request->getParam("brand"));
    if (!$brand) {
      return $this->redirect("/index/index");
    }
    $lookbookes = LookbookAR::model()->loadLookbookWithBrand($brand);
    $this->render("lookbook", array("lookbookes" => $lookbookes));
  }
  
  public function actionArrival() {
    $request = Yii::app()->getRequest();
    $brand = strtolower($request->getParam("brand"));
    if (!$brand) {
      return $this->redirect("/index/index");
    }
    $lookbookes = LookbookAR::model()->loadLookbookWithBrand($brand);
    $this->render("arrival", array("lookbookes" => $lookbookes));
  }
  
  public function actionNews() {
    $category = Yii::app()->getRequest()->getParam("category", FALSE);
    $list = NewsAR::model()->getNewsInCategory($category);
    $this->render("news", array("news_list" => $list));
  }
  
  public function actionAddnews() {
    $request = Yii::app()->getRequest();
    $id = $request->getParam("id", FALSE);
    $news = NewsAR::model()->findByPk($id);
    if ($id && !$news) {
      $this->redirect(array("news"));
    }
    $this->render("addnews", array("news" => $news));
  }
  
  public function actionNavigation() {
    $request = Yii::app()->getRequest();
    
    // 添加/修改数据
    if ($request->isPostRequest) {
      $post = $request->getPort();
      $this->responseJSON($post, "success");
    }
    else {
      return $this->render("navigation");
    }
  }
  
  // corporate information
  public function actionCorporate() {
    $this->render("corporate");
  }
  
  public function actionBrand() {
    $this->render("brand");
  }
  
  public function actionVideo() {
    $videcontentAr = new VideoContentAR();
    $this->render("video", array("videocontentes" => $videcontentAr->getList()));
  }
  
  public function actionAddVideo() {
    $request = Yii::app()->getRequest();
    $id = $request->getParam("id");
    $contentvideo = VideoContentAR::model()->findByPk($id);
    
    $this->render("addvideo", array("contentvideo" => $contentvideo));
  }
  
  public function actionQrcode() {
    $qrcodes = QacodeAR::model()->getList();
    $this->render("qrcode", array("qrcodes" => $qrcodes));
  }
  
  public function actionAddqacode() {
    $this->render("addqrcode");
  }
  
  public function actionContact() {
    $this->render("contact");
  }
  
  public function actionCareers() {
    $jobes = JobAR::model()->getList();
    $this->render("careers", array("careeres" => $jobes));
  }
  
  public function actionAddcareer() {
    $cid = Yii::app()->getRequest()->getParam("id", false);
    $career = FALSE;
    if ($cid) {
      $career = JobAR::model()->findByPk($cid);
    }
    $this->render("addcareer", array("career" => $career));
  }
  
  public function actionBrandInfo() {
    $this->render("brandinfo");
  }
  
  public function actionLogout () {
    UserAR::logout();
    
    $this->redirect(Yii::app()->createUrl("index/index"));
  }
}

