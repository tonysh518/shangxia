<?php

class NewsController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    $news = new NewsAR();
    
    if ($request->isPostRequest) {
      $cid = isset($_POST["cid"]) ? $_POST["cid"] : 0;
      if ($cid > 0) {
        $news = NewsAR::model()->findByPk($cid);
        $news->setAttributes($_POST);
        $news->update();
      }
      else {
        $news->setAttributes($_POST);
        $news->save();
      }
      return $this->responseJSON($news, 'success');
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
    
    $news_id = $request->getParam("news_id");
    if ($news_id) {
      $news = NewsAR::model()->findByPk($news_id);
      $this->responseJSON($news, "success");
    }
    else {
      $news = NewsAR::model()->getList();
      $this->responseJSON($news, "success");
    }
  }
  
  /**
   * News 搜索接口
   */
  public function actionSearch() {
    $request = Yii::app()->getRequest();
    $keyword = $request->getParam("keyword", FALSE);
    
    if (!$keyword || strlen($keyword) < 3) {
      return $this->responseError("keyword is too short", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    
    $newsAr = new NewsAR();
    $news = $newsAr->searchWithKeyword($keyword);
    
    return $this->responseJSON($news, "success");
  }
}

