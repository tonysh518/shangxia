<?php

class DataCommand extends CConsoleCommand {
  public function actionImportShop() {
    $file = "lily_store_en.cvs.csv";
    $content = file_get_contents($file);
    
    $rows = explode("\r\n", $content);
    foreach ($rows as $index => $row) {
      $coles = str_getcsv($row, ",", "");
      if (!count($coles)) {
        continue;
      }
      if (!$coles[0]) {
        //print_r($coles);
        continue;
      }
      $shop = new ShopAR();
      $latlng = isset($coles[7]) ? $coles[7]: "";
      $lat = "";
      $lng = "";
      if ($latlng) {
        $parts = explode(",", $latlng);
        if (count($parts) > 1) {
          list($lat, $lng) = $parts;
        }
      }
      $attr = array(
          "country" => $coles[1],
          "city" => $coles[2],
          "distinct" => $coles[3],
          "title" => trim($coles[4]),
          "address" => trim($coles[5]),
          "phone" => trim($coles[6]),
          "lat" => str_replace('"', "", $lat),
          "lng" => str_replace('"', "", $lng),
          "star" => isset($coles[8]) ? $coles[8] : 0,
          "language" => "en",
      );
      $shop->setAttributes($attr, FALSE);
      
      $ret = $shop->save();
      
      print ".";
    }
  }
}

