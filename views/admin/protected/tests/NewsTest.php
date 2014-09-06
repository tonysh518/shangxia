<?php

class NewsTest extends FuelTest {
  public function testAddNews() {
    $ret = $this->post("news/add", array("title" => "News title", "body" => "News body"));
    
    print $ret;
  }
}

