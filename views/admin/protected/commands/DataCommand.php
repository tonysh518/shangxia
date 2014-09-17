<?php

class DataCommand extends CConsoleCommand {
  public function actionImportShop() {
    $collectionCids = array(
        "人与自然" => "20090",
        "传承与情感" => "20089",
        "里·外" => "20079",
        "Human & Nature" => "20332",
        "Heritage & Emotion" => "20333",
        "In & Out" => "20330",
        "Sound of Tea" => "20331",
        "茶歌" => "20567",
    );
    $craftCids = array(
        "紫檀" => "20321",
        "薄胎瓷" => "20320",
        "竹编" => "20322",
        "羊绒毡" => "20319",
        "Zitan" => "20316",
        "Bamboo Weaving" => "20315",
        "Eggshell Porcelain" => "20317",
        "Cashmere Felt" => "20318",
    );
    $types = array();
    $tmp_types = ProductContentAR::getType();
    foreach ($tmp_types as $key => $value) {
      $types[$value] = $key;
    }
    
    $productGroupes = require("/Users/jackeychen/Workspace/shangxia/docs/sound_of_tea+translation/convert.php");
    // 把collection 转换到ID
    foreach ($productGroupes as $products) {
      foreach ($products as $index => $product) {
        $collection = trim($product["collection_name"]);
        $craft = trim($product["craft"]);
        if ($product["language"] == "fr") {
          continue;
        }
        else  if ($product["language"] == "en") {
          continue;
        }
        
        $url_key = $product["title"];
        if ($product["language"] != "en") {
          $url_key = $productGroupes["en"][$index]["title"];
        }
        
        $collectionId = $collectionCids[$collection];
        $product["collection"] = $collectionId;
        $product["product_type"] = $types[trim($product["category"])];
        $product["product_slide_image"] = ["/upload/". $product["thumbnail"]];
        $product["thumbnail"] = "/upload/". $product["thumbnail"];
        $product["video_title"] = $product["title"];
        $product["video_description"] = $product["title"];
        $product["craft"] = $craft ? $craftCids[$craft]: "";
        $product["url_key"] = $url_key;
        $_REQUEST = $product;
        $_POST = $product;
        $productModel = new ProductContentAR();
        $product["type"] = $productModel->type;
        $productModel->attributes = $product;
        $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
        global $language;
        $language = $product["language"];
        
        if ($cid = $productModel->save()) {
          print "Content with {$productModel->product_type}: [$productModel->cid] is inserted\r\n";
        }
        else {
          print_r($productModel->getErrors());
        }
      }
    }
  }
}

