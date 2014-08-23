<?php

/**
 * 品牌 - Model
 */
class BrandAR extends ContentAR {
  public function getFields() {
    return array("brand_name");
  }
  
  public function getMedia() {
    return array("brand_master_image", "brand_thumbnail_image", "brand_navigation_image", "brand_navigation_full_image");
  }
  
  
}

