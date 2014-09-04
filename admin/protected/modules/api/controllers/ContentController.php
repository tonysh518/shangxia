<?php

class ContentController extends Controller {
  
  
  public function actionDelete() {
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      return $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
    
    $cid = $request->getPost("cid", FALSE);
    
    if ($cid === FALSE) {
      return $this->responseError("miss arguments", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    
    $content = ContentAR::model()->findByPk($cid);
    if (!$content) {
      return $this->responseError("miss arguments", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    $content->delete();
    
    return $this->responseJSON(array(), "success");
  }
  
  
  /*
   * 更新内容接口
   */
  public function actionUpdate() {
    $request = Yii::app()->getRequest();
    
    if (!$request->isPostRequest) {
      return $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
    
    // Step1, 加载对应的Model
    $type = $request->getPost("type");
    $key_id = $request->getPost("key_id");
    if (!$type && !$key_id) {
      return $this->responseError("unkonw", ErrorAR::ERROR_UNKNOWN);
    }
    
    if ($type) {
      $class = ucfirst($type)."ContentAR";
      if (!class_exists($class)) {
        return $this->responseError("unkonw", ErrorAR::ERROR_UNKNOWN);
      }

      // Step2, 然后保存数据
      $model = new $class();
      $model->attributes = $_POST;

      // 是编辑还是添加?
      if (($id = $request->getPost("cid"))) {
        $instance = $model->findByPk($id);
        $instance->attributes = $_POST;
        if ($instance->update()) {
          $this->responseJSON($model->attributes, "success");
        }
        else {
          $this->responseError("save error", ErrorAR::ERROR_INVITE, $instance->getErrors());
        }
      }
      else {
        if ($model->save()) {
          $this->responseJSON($model->attributes, "success");
        }
        else {
          $this->responseError("save error", ErrorAR::ERROR_INVITE, $model->getErrors());
        }
      }
    }
    elseif ($key_id) {
      $content = ContentAR::model()->loadByKey($key_id);
    }
  }
  
  
  public function actionTest() {
    print "start time: ". time() . "<br />";
    $products = ProductContentAR::model()->getList(10);
//    foreach ($products as $product) {
//      print "{$product->title}<br />";
//    }
    print "end time: ". time() . "<br />";
 }
  
}

