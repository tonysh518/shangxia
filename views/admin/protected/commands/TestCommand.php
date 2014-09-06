<?php

/**
 * 
 */
class TestCommand extends CConsoleCommand {
  
  public function actionShop() {
    Yii::import("application.tests.FuelTest");
    Yii::import("application.tests.ShopTest");
    $shopTest = new ShopTest();
    
    // Shop add 测试
    $shopTest->testShopAdd();
  }
  
  public function actionJob() {
    Yii::import("application.tests.FuelTest");
    Yii::import("application.tests.JobTest");
    $jobTest = new JobTest();
    
    // Shop add 测试
    $jobTest->testJobAdd();
  }
  
  public function actionMedia() {
    Yii::import("application.tests.FuelTest");
    Yii::import("application.tests.MediaTest");
    $mediaTest = new MediaTest();
    
    // Shop add 测试
    $mediaTest->testMediaTemp();
  }
  
  public function actionNews() {
    Yii::import("application.tests.FuelTest");
    Yii::import("application.tests.NewsTest");
    $newstest = new NewsTest();
    
    // Shop add 测试
    $newstest->testAddNews();
  }
}

