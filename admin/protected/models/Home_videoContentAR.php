<?php

class Home_videoContentAR extends ContentAR {
  public $type = "home_video";
  public function getFields() {
    return parent::getFields();
  }
  
  public function getVideoFields() {
    $this->hasVideoField("video_mp4", array("mp4"));
    $this->hasVideoField("video_webm", array("webm"));
    return parent::getVideoFields();
  }
}
