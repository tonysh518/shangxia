<div class="row-fluid index-panel">
  <div class="wrapper">
    <div class="header">
      <h4><?php echo Yii::t("strings", "Dashboard")?></h4>
    </div>
    <ul class="row-fluid dashboard">
      <li class="item">
        <a href="<?php echo Yii::app()->createUrl("page/news")?>"><i class="fa fa-book"></i><?php echo Yii::t("strings", "News")?></a>
      </li>
      <li class="item">
        <a href="<?php echo Yii::app()->createUrl("shop/index")?>"><i class="fa fa-shopping-cart"></i><?php echo Yii::t("strings", "Store")?></a>
      </li>
      <li class="item">
        <a href="<?php echo Yii::app()->createUrl("page/careers")?>"><i class="fa fa-user"></i><?php echo Yii::t("strings", "Position")?></a>
      </li>
      <li class="item">
        <a href="<?php echo Yii::app()->createUrl("page/video")?>"><i class="fa fa-video-camera"></i><?php echo Yii::t("strings", "Video")?></a>
      </li>
    </ul>
  </div>
</div>