<div class="table-bar">
  <i class="fa fa-plus-square"></i><a href="<?php echo Yii::app()->createUrl("page/addnews")?>"><?php echo Yii::t("strings", "Add News")?></a>
</div>

<div class="table-content" ng-controller="NewsTable" ng-init="init()">
  <header>
    <div class="icons">
      <i class="fa fa-table"></i>
    </div>
    <h5><?php echo Yii::t("strings", "News Table")?></h5>
  </header>
  
  <div class="tabbable tabs-below">
    <div class="nav nav-tabs">
      <li class="<?php if (!isset($_GET["category"])) echo "active"?>"><a href="<?php echo Yii::app()->createUrl("page/news")?>"><?php echo Yii::t("strings", "All")?></a></li>
      <?php foreach (Yii::app()->params["brands"] as $brand): ?>
      <li class="<?php if (isset($_GET["category"]) && $_GET["category"] == strtolower($brand)) echo "active"?>"><a href="<?php echo Yii::app()->createUrl("page/news", array("category" => strtolower($brand)))?>"><?php echo ucfirst($brand)?></a></li>
      <?php endforeach;?>
    </div>
    <div class="tab-content">
    <table class="table table-striped">
      <thead>
        <td><?php echo Yii::t("strings", "Title")?></td>
        <td><?php echo Yii::t("strings", "Category")?></td>
        <td><?php echo Yii::t("strings", "Date")?></td>
        <td><?php echo Yii::t("strings", "Actions")?></td>
      </thead>
      <tbody>
        <?php foreach($news_list as $news) :?>
        <tr>
          <td><?php echo $news->title?></td>
          <td><?php echo $news->category?></td>
          <td><?php echo $news->cdate?></td>
          <td>
            <a href="<?php echo Yii::app()->baseUrl."/page/addnews?id=". $news->cid?>"><?php echo Yii::t("strings", "Edit")?></a>
            &nbsp;|&nbsp;
            <a href="javascript:void(0)" data-cid="<?php echo $news->cid?>" ng-click="deleteContent()"><?php echo Yii::t("strings", "Delete")?></a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    </div>
  </div>

</div>