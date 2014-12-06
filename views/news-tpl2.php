<?php // tpl1 对应 二张图（ 840x470）错开的模版 ?>

<?php 
   $body1 = $news->tpl_body_one;
   $body2 = $news->tpl_body_two;
   if (count($news->news_slide_image) >= 2) {
     $image1 = $news->news_slide_image[0];
     $image2 = $news->news_slide_image[1];
   }
   else {
     $image1 = '';
     $image2 = '';
   }
?>
<div class="section">
  <div class="picinfor cs-clear">
    <div class='section1'>
      <?php echo $body1?>
      <img src="<?php echo $image1?>" />
    </div>
    <div class="section2">
      <?php echo $body2?>
      <img src="<?php echo $image2?>" />
    </div>
  </div>
</div>