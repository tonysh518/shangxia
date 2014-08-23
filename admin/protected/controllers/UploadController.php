<?php

class UploadController extends Controller {
  public function missingAction($actionID) {
    $parts = explode("_",$actionID);
    if (count($parts) == 4) {
      $name = $parts[0];
      $width = $parts[1];
      $height = $parts[2];
      $ext = $parts[3];
      $uri = "/upload/".$name."_".$width."_".$height.".".$ext;
      $sourceUri = "/upload/". $name.".".$ext;
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
}
