<?php // tpl3 对应 二张图（ 840x470）错开的模版 ?>

<?php $images  = array_slice($news->news_slide_image, 0, 2); ?>

<div class="section intoview-effect" data-effect="fadeup">
  <div class="picinfor cs-clear">
        <div class="picinfortxt news-picinfortxt">
            <div class="picinfortxt-inner">
              <h2><?php echo $news->title?></h2>
              <h3 style="text-transform:uppercase;"><?php echo date("Y M d", strtotime($news->date))?></h3>
              <div class="body">
                  <?php echo $news->body?>
              </div>
            </div>
            <div style="margin-right:50px;">
            <a href="#" data-a="show-pop" class="btn transition-wrap"><span class="transition">更多讯息<br><br>更多讯息</span></a>
            <textarea style="display:none;">
              <?php echo $news->body?>
            </textarea>
      </div>
          </div>
    <div class="picinforpic">
      <img src="<?php echo @$images[0]?>" width="100%">
    </div>
              <!--  -->
  </div>
</div>

<div class="section intoview-effect" data-effect="fadeup">
  <div class="picinfor cs-clear">
        <div class="picinfortxt news-picinfortxt news-pic-tpl3" style="float:right;">
            <div class="picinfortxt-inner" >
              <h2><?php echo $news->title_two?></h2>
              <h3 style="text-transform:uppercase;"><?php echo date("Y M d", strtotime($news->date))?></h3>
              <div class="body">
                 <?php echo $news->desc_two?>
              </div>
            </div>
            <div style="margin-left:50px;">
        <a href="#" data-a="show-pop" class="btn transition-wrap"><span class="transition">更多讯息<br><br>更多讯息</span></a>
        <textarea style="display:none;">
                 <?php echo $news->desc_two?>
        </textarea>
      </div>
    </div>
    <div class="picinforpic" style="float:left;">
      <img src="<?php echo @$images[1]?>" width="100%">
    </div>
              <!--  -->
  </div>
</div>