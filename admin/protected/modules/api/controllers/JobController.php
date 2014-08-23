<?php

class JobController extends Controller {
  
  // 添加职位
  public function actionAdd() {
    $request = Yii::app()->getRequest();
    $job = new JobAR();
    
    if ($request->isPostRequest) {
      $cid = isset($_POST["cid"]) ? $_POST["cid"]: 0;
      if ($cid > 0) {
        $job = JobAR::model()->findByPk($cid);
        $job->setAttributes($_POST);
        $job->update();
      }
      else {
        $job->setAttributes($_POST);
        $job->save();
      }
      return $this->responseJSON($job, 'success');
    }
    else {
      $this->responseError("http verb error", ErrorAR::ERROR_HTTP_VERB_ERROR);
    }
  }
  
  public function actionIndex() {
    $request = Yii::app()->getRequest();
    $id = $request->getParam("cid", FALSE);
    if ($id !== FALSE) {
      $job = JobAR::model()->findByPk($id);
      $this->responseJSON($job, "success");
    }
    else {
      $job = new JobAR();
      $jobs = $job->getList();

      $this->responseJSON($jobs, "success");
    }
  }
  
  // 申请工作
  public function actionApply() {
    $request = Yii::app()->getRequest();
    
    $id = $request->getParam("id", FALSE);
    if (!$id) {
      return $this->responseError("param error", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    
    $job = JobAR::model()->findByPk($id);
    if (!$job) {
      return $this->responseError("param error", ErrorAR::ERROR_MISSED_REQUIRED_PARAMS);
    }
    
    if (Yii::app()->session["job_apply_". $job->cid]) {
      return $this->responseJSON("success", $job);
    }
    Yii::app()->session["job_apply_". $job->cid] = TRUE;
    $mailto = Yii::app()->params["job_mail"];
    if ($mailto) {
      // TODO:: send mail to admin
    }
  }
}

