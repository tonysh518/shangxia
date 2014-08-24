<?php

class ContentController extends Controller {
  
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
    if (!$type) {
      return $this->responseError("unkonw", ErrorAR::ERROR_UNKNOWN);
    }
    $class = ucfirst($type)."ContentAR";
    if (!class_exists($class)) {
      return $this->responseError("unkonw", ErrorAR::ERROR_UNKNOWN);
    }
    
    // Step2, 然后保存数据
    $model = new $class();
    $model->attributes = $_POST;
    
    // 是编辑还是添加?
    if (($id = $request->getPost("cid")) !== FALSE) {
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
  
}

