<?php

Yii::import("application.models.ContentAR");
/**
 * 招聘 , 继承 ContentAR 
 */
class JobAR extends ContentAR {
  
  public $type = "job";
  
//  // 发布状态
//  public $status = 1;
//  
//  const JOB_TYPE_SOCIAL = 1;
//  const JOB_TYPE_SCHOOL = 2;
//  
//  public $job_people_number;
//  public $job_type;
  
  /**
   * 返回Job 对应的Field
   */
  public function getFields() {
    // array(招聘人数, 招聘类型),
    return array();
  }
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
}

