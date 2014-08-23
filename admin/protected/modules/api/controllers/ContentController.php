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
    
    $key_id = $request->getPost("key_id");
    $content = ContentAR::model()->loadByKey($key_id);
    
    if (!$content) {
      return $this->responseError("unknow error", ErrorAR::ERROR_UNKNOWN);
    }
    
    //1. Field
    $field = $request->getPost("field", FALSE);
    if ($field) {
      // 传入的字段用 ',' 分隔
      $fields = explode(",", $field);
    }
    $attributes = $content->attributes;
    $content->attributes = $_POST;
    foreach ($fields as $field) {
      // 确保Field 不是默认的属性
      if (array_search($field, $attributes) !== FALSE) {
        continue;
      }
      $value = $request->getPost($field);
      $content->hasContentField($field);
      $content->reload();
      
      $content->{$field} = $value;
    }
    
    //2. Image
    //TODO::
    
    $content->save();
    
    $this->responseJSON($content->attributes, "success");
  }
  
}

