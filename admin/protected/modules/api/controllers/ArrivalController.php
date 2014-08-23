<?php


class ArrivalController extends Controller {
  
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    
    if ($request->isPostRequest) {
      $data = $_POST;
      if (isset($data["cid"])) {
        // 更新
        $arrivalAr = ArrivalAR::model()->findByPk($data["cid"]);
        if ($arrivalAr) {
          $arrivalAr->setAttributes($data);
          $arrivalAr->update();
           return $this->responseJSON($arrivalAr, "success");
        }
        else {
          $this->responseError("not found", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
        }
      }
      // 添加
      else {
        $arrivalAr = new ArrivalAR();
        $arrivalAr->setAttributes($data);
        
        if ($arrivalAr->save()) {
          return $this->responseJSON(ArrivalAR::model()->findByPk($arrivalAr->cid), "success");
        }
        $this->responseJSON(ArrivalAR::model()->findByPk($arrivalAr->cid), "success");
      }
    }
    else {
      $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
  }
  
  public function actionIndex() {
    $request = Yii::app()->getRequest();
    $id = $request->getParam("id", FALSE);
    if ($id) {
      $arrival = ArrivalAR::model()->findByPk($id);
      $this->responseJSON($arrival, "success");
    }
    else {
      $arrival = new ArrivalAR();
      $list = $arrival->loadArrivalWithBrand($_GET["brand"]);
      $this->responseJSON($list, "success");
    }
  }

}

