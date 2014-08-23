<?php

class QrcodeController extends Controller {
    
    /**
     * 添加QRcode
     * @return type
     */
    public function actionAdd() {
    $request = Yii::app()->getRequest();
    $qrcode = new QacodeAR();
    
    if ($request->isPostRequest) {
      $cid = $request->getPost("cid", 0);
      if ($cid > 0) {
        $qrcode = QacodeAR::model()->findByPk($cid);
        $qrcode->setAttributes($_POST);
        $qrcode->update();
      }
      else {
        $qrcode->setAttributes($_POST);
        $qrcode->save();
      }
      return $this->responseJSON($qrcode, 'success');
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
    
    $cid = $request->getParam("id", FALSE);
    if ($cid) {
      $qrcode = QacodeAR::model()->findByPk($cid);
      $this->responseJSON($qrcode, "success");
    }
    else if ($cid === FALSE){
      $qrcodes = QacodeAR::model()->getList();
      $this->responseJSON($qrcodes, "success");
    }
    else {
      $this->responseError("params error");
    }
  }
}

