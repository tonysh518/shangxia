<?php

// 渲染 面包屑 
class Breadcrumb extends CWidget {
  public $links;
  public function run() {
    $html = "<ul class='breadcrumb'>";
    foreach ($this->links as $index => $link) {
      if ($index + 1 >= count($this->links)) {
        $html .= "<li class='active'>".$link."</li>";
      }
      else {
        $html .= "<li>".$link." <span class='divider'>/</li>";
      }
    }
    
    print $html;
  }
}

