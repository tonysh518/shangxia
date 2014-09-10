<?php

class DataCommand extends CConsoleCommand {
  public function actionImportShop() {
    $collectionCids = array(
        "人与自然" => "20093",
        "传承与情感" => "20092",
        "里·外" => "20079",
        "Human & Nature" => "20332",
        "Heritage & Emotion" => "20333",
        "In & Out" => "20330",
    );
    $types = array();
    $tmp_types = ProductContentAR::getType();
    foreach ($tmp_types as $key => $value) {
      $types[$value] = $key;
    }
    
    $productGroupes = require("/Users/jackeychen/Workspace/shangxia/docs/product.csv/convert.php");
    
    // 把collection 转换到ID
    foreach ($productGroupes as $products) {
      foreach ($products as $index => $product) {
        $collection = trim($product["collection_name"]);
        if ($product["language"] == "fr") {
          continue;
        }
        else  if ($product["language"] == "cn") {
          continue;
        }
        
        $collectionId = $collectionCids[$collection];
        $product["collection"] = $collectionId;
        $product["product_type"] = $types[trim($product["category"])];
        $product["product_slide_image"] = ["/upload/". $product["thumbnail"]];
        $product["thumbnail"] = "/upload/". $product["thumbnail"];
        $product["video_title"] = $product["title"];
        $product["video_description"] = $product["title"];
        $product["craft"] = "";
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

