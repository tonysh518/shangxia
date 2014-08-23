<?php

/**
 * Video Content Model
 */
class VideoContentAR extends ContentAR {
  // thumbnail media 字段
  public $thumbnail;
  
  public $type = "videocontent";
  
  public $category;
  
  public $video_mp4;
  public $video_webm;
  
  public static function model($class = __CLASS__) {
    return parent::model($class);
  }
  
  public function afterSave() {
    parent::afterSave();
    $mediaAr = new MediaAR();
    $mediaAr->saveMediaToObject($this, "thumbnail");
    
    
    $videoAr = new VideoAR();
    $videoAr->saveVideoToObject($this, "video_mp4");
    $videoAr->saveVideoToObject($this, "video_webm");
    
    return TRUE;
  }
  
  public function afterFind() {
    parent::afterFind();
    $mediaAr = new MediaAR();
    $mediaAr->attachMediaToObject($this, "thumbnail");
    
    $videoAr = new VideoAR();
    $videoAr->attachVideoToObject($this, "video_mp4");
    $videoAr->attachVideoToObject($this, "video_webm");
  }


  public function getAttributes($names = null) {
    $attributes = parent::getAttributes($names);
    $attributes["thumbnail"] = $this->thumbnail;
    $attributes["video_mp4"] = $this->video_mp4;
    $attributes["video_webm"] = $this->video_webm;
    
    return $attributes;
  }
  
  public function getFields() {
    return array("category");
  }
  
  public function saveVideo() {
    
  }
  
  public function loadVideo() {
    
  }
}

