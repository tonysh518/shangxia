<?php

class PageController extends Controller {
  
  public function beforeAction($action) {
    if (!UserAR::isLogin() && $action->id != "login" && $action->id != "error") {
      return $this->redirect(Yii::app()->getBaseUrl()."/index/login");
    }
    return parent::beforeAction($action);
  }

  public function actionLogout () {
    UserAR::logout();
    
    $this->redirect(Yii::app()->createUrl("index/index"));
  }

  public function actionTest() {
    header("Content-Type: text/html;charset=utf-8");
    $key_id = "home_brand_story_summary";
    // 用Key 来加载一个对应的内容
    $content = ContentAR::model()->loadByKey($key_id);
    
    // 文字例子
//    // 它是一个有额外字段的内容 - 系列名称
    $content->hasContentField("collection_name");
//    
//    // 设置好后 重新加载
//    $content->reload();
//    
//    // 保存
//    $content->collection_name = "hello world, 你好";
//    $content->save();
//    
//    // 打印
//    print_r($content->attributes);
    
    // 图文例子
    $_POST["image"] = array("/uploads/xxsdl1.png", "/uploads/xxsdl2.png", "/uploads/xxsdl3.png");
    
    $content->hasImageField("image", array("multi" => TRUE));
    $content->reload();
    
    //$content->save();
    
    print_r($content->attributes);
  }
  
  public function actionAddcontent() {
    $request = Yii::app()->getRequest();
    $type = $request->getParam("type");
    
    $class = ucfirst($type).'ContentAR';
    $model = new $class();
    
    // Edit
    $id = $request->getParam("id", FALSE);
    if ($id) {
      $instance = $model->findByPk($id);
      return $this->render("editcontent", array("model" => $model, "type" => $type, "instance" => $instance));
    }
    else {
      return $this->render("addcontent", array("model" => $model, "type" => $type));
    }
  }
  
  public function actionContent() {
    $request = Yii::app()->getRequest();
    $type = $request->getParam("type");
    
    $class = ucfirst($type).'ContentAR';
    if (!class_exists($class)) {
      return $this->redirect(Yii::app()->getBaseUrl()."/index");
    }
    
    if (class_exists($class)){
      $model = new $class();
    }
    else {
      return $this->redirect("/index/index");
    }
    
    $list = $model->getList();
    
    $this->render("content", array("model" => $model, "type" => $type, "list" => $list));
  }
  
  public function actionContact() {
    $list = ContactContentAR::model()->getList();
    $this->render("contact", array("model" => ContactContentAR::model(), "type" => "contact", "list" => $list));
    
  }
  
  public function actionNewsletter() {
    $list = NewsletterContentAR::model()->getList();
    $this->render("newsletter", array("model" => NewsletterContentAR::model(), "type" => "newsletter", "list" => $list));
  }
  
  public function actionWantobuy() {
    $list = BuyContentAR::model()->getList();
    
    $this->render("wantobuy", array("model" => NewsletterContentAR::model(), "type" => "buy", "list" => $list));
  }
  
  public function actionBlocks() {
    $block_keys = array(
        'home_block_1', 'home_block_2', 'home_block_3'
    );
    $blocks = array();
    foreach ($block_keys as $block_key) {
      $model = ContentAR::model();
      $block = $model->loadByKey($block_key);
      $block->hasImageField("thumbnail");
      $blocks[] = array("instance" => $block, "model" => $model, "type" => "content");
    }
    
    $this->render("blocks", array("blocks" => $blocks));
  }
}

