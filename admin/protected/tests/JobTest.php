<?php

class JobTest extends FuelTest {
  public function testJobAdd() {
    $response = $this->post("job/add", array("title" => "上海大宁店", "body" => "上海闸北区大宁国际"));
    
    print_r($response);
  }
}
