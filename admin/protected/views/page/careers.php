  <div class="table-bar">
    <i class="fa fa-plus-square"></i><a href="<?php echo Yii::app()->createUrl("page/addcareer")?>"><?php echo Yii::t("strings", "Career Add New")?></a>
  </div>

<div class="table-content" ng-controller="CareerTable" ng-init="init()">
  <header>
    <div class="icons">
      <i class="fa fa-table"></i>
    </div>
    <h5><?php echo Yii::t("strings", "Careers Table")?></h5>
  </header>
    <table class="table table-striped">
      <thead>
        <td><?php echo Yii::t("strings", "Title")?></td>
        <td><?php echo Yii::t("strings", "Date")?></td>
        <td><?php echo Yii::t("strings", "Actions")?></td>
      </thead>
      <tbody>
        <?php foreach ($careeres as $career): ?>
        <tr>
          <td><?php echo $career->title?></td>
          <td><?php echo $career->cdate?></td>
          <td><a href="<?php echo Yii::app()->createUrl("page/addcareer", array("id" => $career->cid))?>"><?php echo Yii::t("strings", "Edit")?></a>&nbsp;&nbsp;| <a href="#" onclick='deleteContent(<?php echo $career->cid?>)'><?php echo Yii::t("strings", "Delete")?></a> </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

</div>