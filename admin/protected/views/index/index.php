<div class="row-fluid index-panel">
  <div class="wrapper">
    <div class="header">
      <h4><?php echo Yii::t("strings", "Dashboard")?></h4>
    </div>
    <ul class="row-fluid dashboard">
      <li class="item">
        <a href="<?php echo Yii::app()->createUrl("page/news")?>"><i class="fa fa-book"></i><?php echo Yii::t("strings", "News")?></a>
      </li>
    </ul>
  </div>
</div>