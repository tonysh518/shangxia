<div class="table-bar">
  <i class="fa fa-plus-square"></i><a href="<?php echo Yii::app()->createUrl("shop/add")?>"><?php echo Yii::t("strings", "Add New Store")?></a>
</div>
<div class="shop-table table-content" ng-controller="ShopTable">
  <header>
    <div class="icons">
      <i class="fa fa-table"></i>
    </div>
    <h5><?php echo Yii::t("strings", "Store Table")?></h5>
  </header>
  <table class="table table-striped tablepager">
    <thead>
      <td><?php echo Yii::t("strings", "Category")?></td>
      <td><?php echo Yii::t("strings", "Province")?></td>
      <td><?php echo Yii::t("strings", "City")?></td>
      <td><?php echo Yii::t("strings", "Title")?></td>
      <td><?php echo Yii::t("strings", "Address")?></td>
      <td><?php echo Yii::t("strings", "Actions")?></td>
    </thead>
    <tbody>
      <?php foreach($shopes as $shop) :?>
      <tr>
        <td><?php echo $shop->category?></td>
        <td><?php echo ShopAR::getProvinceWithID($shop->city)?></td>
        <td><?php echo ShopAR::getCityWithID($shop->distinct)?></td>
        <td><?php echo $shop->title?></td>
        <td><?php echo $shop->address?></td>
        <td>
          <a href="<?php echo Yii::app()->baseUrl."/shop/edit?shop_id=". $shop->shop_id?>"><?php echo Yii::t("strings", "Edit")?></a>
          &nbsp;|&nbsp;
          <a href="javascript:void(0)" data-sid="<?php echo $shop->shop_id?>"><?php echo Yii::t("strings", "Close Shop")?></a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>