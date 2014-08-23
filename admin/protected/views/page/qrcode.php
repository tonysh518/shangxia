<div class="table-bar">
  <i class="fa fa-plus-square"></i><a href="<?php echo Yii::app()->createUrl("page/addqacode")?>"><?php echo Yii::t("strings", "Add QRCode")?></a>
</div>

<div class="table-content">
  <header>
    <div class="icons">
      <i class="fa fa-table"></i>
    </div>
    <h5><?php echo Yii::t("strings", "QRCode Table")?></h5>
  </header>
  
  <div class="tabbable tabs-below">
    <table class="table table-striped">
      <thead>
        <td><?php echo Yii::t("strings", "Title")?></td>
        <td><?php echo Yii::t("strings", "Category")?></td>
        <td><?php echo Yii::t("strings", "Date")?></td>
        <td><?php echo Yii::t("strings", "Actions")?></td>
      </thead>
      <tbody>
        <?php foreach($qrcodes as $qrcode) :?>
        <tr>
          <td><?php echo $qrcode->title?></td>
          <td><?php echo $qrcode->category?></td>
          <td><?php echo $qrcode->cdate?></td>
          <td>
            <a href="<?php echo Yii::app()->baseUrl."/page/addqacode?id=". $qrcode->cid?>">Edit</a>
            &nbsp;|&nbsp;
            <a href="javascript:void(0)" onclick='deleteContent(<?php echo $qrcode->cid?>)'>Delete</a>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>

</div>