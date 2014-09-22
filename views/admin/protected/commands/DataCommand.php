<?php

class DataCommand extends CConsoleCommand {
  public function actionImportShop() {
    $collectionCids = array(
        "人与自然" => "20089",
        "传承与情感" => "20090",
        "里·外" => "20079",
        "茶歌" => "20567",
        "Human & Nature" => "20332",
        "Heritage & Emotion" => "20333",
        "In & Out" => "20330",
        "Sound of Tea" => "20331",
        "Interieur et exterieur" => "20774",
        "Heritage et Emotion" => "20776",
        "LHomme et la Nature" => "20775",
        "LE CHANT DU THE" => "20773",
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
        "Le Zitan" => "20777",
        "Le tissage de Bambou" => "20779",
        "Le feutre de cachemire" => "20778",
        'La porcelaine Coquille dOeuf' => "20780",
    );
    $types = array();
    $tmp_types = ProductContentAR::getType();
    foreach ($tmp_types as $key => $value) {
      $types[$value] = $key;
    }
    
    // 第一批 // 
    $productGroupes = require("/Users/jackeychen/Workspace/shangxia/docs/product.csv/convert.php");
    // 第二批 // sound of tea
    //$productGroupes = require("/Users/jackeychen/Workspace/shangxia/docs/sound_of_tea+translation/convert.php");
    
    // 把collection 转换到ID
    foreach ($productGroupes as $products) {
      foreach ($products as $index => $product) {
        $collection = trim($product["collection_name"]);
        $craft = trim($product["craft"]);
        
        if ($product["language"] != "cn") {
          continue;
        }
        
        $url_key = $product["title"];
        if ($product["language"] != "en") {
          $url_key = $productGroupes["en"][$index]["title"];
        }
        
        if (!isset($collectionCids[$collection])) {
          print $collection.''.  strlen($collection)."\r\n";
          print "Héritage et Émotion".strlen("Héritage et Émotion")."\r\n";
          continue;
        }
        $collectionId = $collectionCids[($collection)];
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

