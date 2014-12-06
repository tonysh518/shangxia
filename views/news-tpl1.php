<?php // tpl1 对应 一张大图 1240x470 模版 ?>

<div class="section">
  <div class="picinfor cs-clear">

      <div class="picinforpic">
          <img src="<?php echo $news->news_slide_image_1260x470?>" />
      </div>
    
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
      <!--  -->
  </div>
</div>