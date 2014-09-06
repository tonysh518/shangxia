<?php

class ShopTest extends FuelTest {
  public function testShopAdd() {
    $response = $this->post("shop/add", array("shop_star_image" => "/upload/aa26ab239e6af5aeb40626d5917183f1" ,"title" => "上海大宁店", "address" => "上海闸北区大宁国际", "lat" => "12.03", "lng" => "35.03"));
    
    print_r($response);
  }
}
