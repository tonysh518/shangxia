<?php // tpl1 对应 二张图（ 840x470）幻灯片的模版 ?>

<div class="section">
  <div class="picinfor cs-clear">
      <div class="picinfortxt">
        <div class="picinfortxt-inner">
          <h2><?php echo $news->title?></h2>
          <h3><?php echo date("Y M d", strtotime($news->date))?></h3>
          <?php echo $news->body?>
        </div>
          <div style="margin-right:50px;">
    <a href="#" data-a="show-pop" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "read more")?><br><br><?php echo Yii::t("strings", "read more")?></span></a>
    <textarea style="display:none;">
      <h2><?php echo $news->title?></h2>
            <h3 style="text-transform:uppercase;"><?php echo date("Y M d", strtotime($news->date))?></h3>
            <div class="body">
              <?php echo $news->body?>
            </div>
    </textarea>
  </div>
      </div>
      <div class="picinforpic">
          <div class="slide">
            <div class="slidebox cs-clear">
              <?php foreach ($news->news_slide_image as $slide_image):?>
                <img class="slideitem" src="<?php echo $slide_image?>" width="100%" />
              <?php endforeach;?>
            </div>
            <ul class="slidetab">
              <?php foreach ($news->news_slide_image as $index => $slide_image):?>
                <li class="<?php if ($index == 0) echo "on"?>"></li>
              <?php endforeach;?>
            </ul>
            <!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
          </div>
      </div>
      <!--  -->
  </div>
</div>