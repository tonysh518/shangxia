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
   // $productGroupes = require("/Users/jackeychen/Workspace/shangxia/docs/sound_of_tea+translation/convert.php");
    
    // 把collection 转换到ID
    foreach ($productGroupes as $products) {
      foreach ($products as $index => $product) {
        $collection = trim($product["collection_name"]);
        $craft = trim($product["craft"]);
        
        if ($product["language"] != "fr") {
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
        $product["weight"] = $index;
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
  
  public function actionOrder() {
    // Step1, 先加载所有的英文，用英文的顺序做为参照
    global $language;
    $language = "en";
    
    $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
    // 修改原始的产品
//    $en_products = ProductContentAR::model()->getList();
//    $total = count($en_products);
//    
//    foreach ($en_products as $index => $en_product) {
//      if ($en_product->weight) {
//        $sub = $total + $en_product->weight;
//      }
//      else {
//        $sub = $total - $index;
//        print $sub."\r\n";
//      }
//      $en_product->weight = $sub;
//      $en_product->save();
//    }
//    return;
    
    $en_products = ProductContentAR::model()->getList();
    
    // 更新顺序
//    foreach ($en_products as $index => $en_product) {
//      // Step2, 然后再加载对应的中文
//      $language = "cn";
//      $cn_product = ContentAR::loadContentWithUrlKey($en_product->url_key, "product");
//      if ($cn_product) {
//        //print "{$cn_product->weight} : {$cn_product->cdate} \t";
//        $cn_product->weight = $en_product->weight;
//        $cn_product->save();
//        //print "{$cn_product->weight} : {$cn_product->cdate}\r\n";
//        print ".\r\n";
//        //print "saved: ".$en_product->title." ".$en_product->cid." \r\n";
//      }
//      else {
//        print "not found: ".$en_product->title." ".$en_product->cid." \r\n";
//      }
//      
//      // Step3, 最后更新对应的法文
//      $language = "fr";
//      $cn_product = ContentAR::loadContentWithUrlKey($en_product->url_key, "product");
//      if ($cn_product) {
//        //print "{$cn_product->weight} : {$cn_product->cdate} \t";
//        $cn_product->weight = $en_product->weight;
//        $cn_product->save();
//        //print "{$cn_product->weight} : {$cn_product->cdate}\r\n";
//        print ".\r\n";
//        //print "saved: ".$en_product->title." ".$en_product->cid." \r\n";
//      }
//      else {
//        print "not found: ".$en_product->title." ".$en_product->cid." \r\n";
//      }
//    }
    
//    foreach ($en_products as $en_product) {
//      $language = "cn";
//      $cn_product = ContentAR::loadContentWithUrlKey($en_product->url_key, "product");
//      if ($cn_product) {
//        //TODO::
//        //print $en_product->url_key." {$en_product->cid} \r\n";
//      }
//      else {
//        print "not found: ".$en_product->title." ".$en_product->cid." \r\n";
//      }
//    }
    
//    $file = fopen("products_en.csv", "w+");
//    $language = "en";
//    foreach ($en_products as $index => $en_product) {
//      $attributes = ($en_product->attributes);
//      if (is_array($attributes)) {
//        unset($attributes["product_slide_image"]);
//        if ($index == 0) {
//          fputcsv($file, array_keys($attributes));
//        }
//        fputcsv($file, $attributes);
//      }
//    }
//    
//    $language = "cn";
//    $cn_products = ProductContentAR::model()->getList();
//    
//    $file = fopen("products_cn.csv", "w+");
//    foreach ($cn_products as $index => $cn_product) {
//      $attributes = ($cn_product->attributes);
//      if (is_array($attributes)) {
//        unset($attributes["product_slide_image"]);
//        if ($index == 0) {
//          fputcsv($file, array_keys($attributes));
//        }
//        fputcsv($file, $attributes);
//      }
//    }
//    fclose($file);
//    
//    $language = "fr";
//    $cn_products = ProductContentAR::model()->getList();
//    
//    $file = fopen("products_fr.csv", "w+");
//    foreach ($cn_products as $index => $cn_product) {
//      $attributes = ($cn_product->attributes);
//      if (is_array($attributes)) {
//        unset($attributes["product_slide_image"]);
//        if ($index == 0) {
//          fputcsv($file, array_keys($attributes));
//        }
//        fputcsv($file, $attributes);
//      }
//    }
//    fclose($file);
    
//    $file = fopen("products_en.csv", "r");
//    $language = "fr";
//    $fields = fgetcsv($file);
//    
//    global $language;
//    $language = "cn";
//    while ($attributes = fgetcsv($file)) {
//      $product = ProductContentAR::model()->findByPk($attributes[0]);
//      $product->weight = $attributes[9];
//      $_POST["thumbnail"] = $attributes[17];
//      $product->save();
//      print ".";
//    }
//    $file = fopen("products_en.csv", "r");
//    
//    $en_products = array();
//    while ($row = fgetcsv($file)) {
//      $en_products[] = $row;
//    }
//    
//    print_r(count($en_products));
//    
//    fclose($file);
//    
//    $file = fopen("products_cn.csv", "r");
//    $cn_products = array();
//    while ($row = fgetcsv($file)) {
//      $cn_products[] = $row;
//    }
//    
//    print "\r\n".count($cn_products);
    
  }
}

