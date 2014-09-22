<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class URLCommand extends CConsoleCommand {
  public function run($args) {
    
    return parent::run($args);
  }
  
  public function actionIndex() {
    global $language;
    $types = array(
        "collection",
        //"product",
        "craft"
    );
    $languages = array("en");
    
//    foreach ($types as $type) {
//      $class = ucfirst($type)."ContentAR";
//      foreach ($languages as $lang) {
//        $language = $lang;
//        
//        if (class_exists($class)) {
//          $contentAr = new $class();
//          $contents = $contentAr->getList();
//          foreach ($contents as $content) {
//            $title = preg_replace('/([\s-&])+/i', "-", strip_tags(strtolower($content->title)));
//            print $content->title ." " .$content->cid." ".$content->type." ".$language."\r\n";
//
//            $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
//            $_REQUEST["url_key"] = strtolower($title);
//            $content->save();
//          }
//        }
//      }
//    }
    
    // Product + English 更新 url key
//    $language = "en";
//    $productAr = ProductContentAR::model()->getList();
//    foreach ($productAr as $product) {
//      $url_key = $product->title;
//      $title = preg_replace('/([\s-&\(\)])+/i', "-", strip_tags(strtolower($url_key)));
//      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
//      $url_key = strtolower($title);
//      
//      // 更新之前要保证 URK_KEY 是唯一的
//      $exitProduct = ProductContentAR::loadContentWithUrlKey($url_key, "product");
//      if ($exitProduct) {
//        print ($exitProduct->language." ". $exitProduct->cid."\r\n");
//      }
//      $index = 1;
//      if ($exitProduct) {
//        while ($exitProduct) {
//          $tmp_url_key = $url_key. "-{$index}";
//          if ($exitProduct = ProductContentAR::loadContentWithUrlKey($tmp_url_key, "product")) {
//            $index += 1;
//          }
//        }
//        $url_key .= "-{$index}";
//      }
//      
//      $_REQUEST["url_key"] = $url_key;
//      $product->save();
//      print $url_key." ".$language."\r\n";
//    }
    
    // Product + Chinese 更新 url key
//    $language = "cn";
//    $productAr = ProductContentAR::model()->getList();
//    foreach ($productAr as $product) {
//      $url_key = $product->url_key;
//      $title = preg_replace('/([\s-&\(\)])+/i', "-", strip_tags(strtolower($url_key)));
//      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
//      $url_key = strtolower($title);
//      
//      // 更新之前要保证 URK_KEY 是唯一的
//      $exitProduct = ProductContentAR::loadContentWithUrlKey($url_key, "product");
//      if ($exitProduct) {
//        print ($exitProduct->language." ". $exitProduct->cid."\r\n");
//      }
//      $index = 1;
//      if ($exitProduct) {
//        while ($exitProduct) {
//          $tmp_url_key = $url_key. "-{$index}";
//          if ($exitProduct = ProductContentAR::loadContentWithUrlKey($tmp_url_key, "product")) {
//            $index += 1;
//          }
//        }
//        $url_key .= "-{$index}";
//      }
//      
//      $_REQUEST["url_key"] = $url_key;
//      $product->save();
//      print $url_key." ".$language."\r\n";
//    }
    
    // Sound of tea
//    $language = "en";
//    $productAr = ProductContentAR::model()->getList();
//    foreach ($productAr as $product) {
//      if ($product->collection != "20331") {
//        continue;
//      }
//      $url_key = $product->title;
//      $title = preg_replace('/([\s-&\(\)])+/i', "-", strip_tags(strtolower($url_key)));
//      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
//      $url_key = strtolower($title);
//      
//      // 更新之前要保证 URK_KEY 是唯一的
//      $exitProduct = ProductContentAR::loadContentWithUrlKey($url_key, "product");
//      if ($exitProduct) {
//        print ($exitProduct->language." ". $exitProduct->cid."\r\n");
//      }
//      $index = 1;
//      if ($exitProduct) {
//        while ($exitProduct) {
//          $tmp_url_key = $url_key. "-{$index}";
//          if ($exitProduct = ProductContentAR::loadContentWithUrlKey($tmp_url_key, "product")) {
//            $index += 1;
//          }
//        }
//        $url_key .= "-{$index}";
//      }
//      
//      $_REQUEST["url_key"] = $url_key;
//      try {
//        $product->save();
//      } catch (Exception $ex) {
//        
//      }
//      print $url_key." ".$language."\r\n";
//    }
    
    // Product + Chinese 更新 url key
//    $language = "en";
//    $productAr = ProductContentAR::model()->getList();
//    foreach ($productAr as $product) {
//      if ($product->collection != "20567") {
//        continue;
//      }
//      $url_key = $product->url_key;
//      $title = preg_replace('/([\s-&\(\)])+/i', "-", strip_tags(strtolower($url_key)));
//      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
//      $url_key = strtolower($title);
//      
//      // 更新之前要保证 URK_KEY 是唯一的
//      $exitProduct = ProductContentAR::loadContentWithUrlKey($url_key, "product");
//      if ($exitProduct) {
//        print ($exitProduct->language." ". $exitProduct->cid."\r\n");
//      }
//      $index = 1;
//      if ($exitProduct) {
//        while ($exitProduct) {
//          $tmp_url_key = $url_key. "-{$index}";
//          if ($exitProduct = ProductContentAR::loadContentWithUrlKey($tmp_url_key, "product")) {
//            $index += 1;
//          }
//        }
//        $url_key .= "-{$index}";
//      }
//      
//      $_REQUEST["url_key"] = $url_key;
//      try {
//        $product->save();
//      } catch (Exception $ex) {
//        
//      }
//      print $url_key." ".$language."\r\n";
//    }
    
     // Product + French 更新 url key
    $language = "fr";
    $productAr = ProductContentAR::model()->getList();
    foreach ($productAr as $product) {
      // sound of tea
//      if ($product->collection != "20773") {
//        continue;
//      }
      // 其他 collection
      if ($product->collection == "20773") {
        continue;
      }
      $url_key = $product->url_key;
      $title = preg_replace('/([\s-&\(\)])+/i', "-", strip_tags(strtolower($url_key)));
      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
      $url_key = strtolower($title);
      
      // 更新之前要保证 URK_KEY 是唯一的
      $exitProduct = ProductContentAR::loadContentWithUrlKey($url_key, "product");
      if ($exitProduct) {
        print ($exitProduct->language." ". $exitProduct->cid."\r\n");
      }
      $index = 1;
      if ($exitProduct) {
        while ($exitProduct) {
          $tmp_url_key = $url_key. "-{$index}";
          if ($exitProduct = ProductContentAR::loadContentWithUrlKey($tmp_url_key, "product")) {
            $index += 1;
          }
        }
        $url_key .= "-{$index}";
      }
      
      $_REQUEST["url_key"] = $url_key;
      try {
        $product->save();
      } catch (Exception $ex) {
        
      }
      print $url_key." ".$language."\r\n";
    }
  }
}
