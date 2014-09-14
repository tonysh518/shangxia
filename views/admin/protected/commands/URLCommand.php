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
    $language = "en";
    $products = ProductContentAR::model()->getList();
    foreach ($products as $product) {
      print $product->title ." " .$product->cid." ".$product->type."\r\n";
      
      $_SERVER["SERVER_NAME"] = "http://sxhtml.local/";
      $_REQUEST["url_key"] = $product->title;
      $product->save();
    }
  }
}
