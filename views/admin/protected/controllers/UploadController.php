<?php

class UploadController extends Controller {
  public function missingAction($actionID) {
    $parts = explode("_",$actionID);
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
