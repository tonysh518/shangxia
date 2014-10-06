<?php

class UploadController extends Controller {
  
  public function makeThumbnailWithUri($uri, $prefix = "") {
    $parts = explode("_",$uri);
    
    $max = count($parts);
    $index = $max - 3;

    $extension = array_splice($parts, $index);
    if (count($extension) == 3 || count($parts) == 4) {
      if (count($parts) > 1) {
        $name = implode("_", $parts);
        $width = $extension[0];
        $height = $extension[1];
        $ext = $extension[2];
      }
      else {
        $name = $parts[0];
        $width = $extension[0];
        $height = $extension[1];
        $ext = $extension[2];
      }
      $uri = "/upload/$prefix/".$name."_".$width."_".$height.".".$ext;
      $sourceUri = "/upload/$prefix/". $name.".".$ext;
      $root = dirname(Yii::app()->basePath);
      $absPath = $root.$uri;
      $absSourceUri = $root. $sourceUri;
      if (is_file($absPath)) {
        $size = getimagesize($absPath);
        header("Content-Type: ". $size["mime"]);
        header("Content-Length: ". filesize($absPath));
        readfile($absPath);
      }
      // 生成缩略图
      else {
        $mediaAr = new MediaAR();
        $mediaAr->makeImageThumbnail($absSourceUri, $absPath, $width, $height, TRUE);
      }
     }
  }
  
  public function missingAction($actionID) {
    if (count($_GET)) {
      $uri = array_keys($_GET);
      $uri = array_shift($uri);
      $this->makeThumbnailWithUri($uri, $actionID);
    }
    else {
      $this->makeThumbnailWithUri($actionID);
    }
  }
}
