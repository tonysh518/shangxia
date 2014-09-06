<?php

class MediaTest extends FuelTest {
  public function testMediaTemp() {
    $response = $this->post("media/temp", array("media" => "@/Users/jackeychen/Downloads/test.png"));
    
    print_r($response);
    
  }
}
