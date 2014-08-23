<div class="form-con qrcode-form" ng-controller="ShopController" ng-init="init()">
  <div class="">
    <form name="shopform" class="form-horizontal" action="<?php echo Yii::app()->baseUrl ?>/shop/add" method="POST" enctype="multipart/form-data">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Add New Shop")?></h4>
      <div class="toolbar">
        <nav style="padding: 8px;">
          <a href="javascript:;" class="btn btn-default btn-xs full-box">
            <i class="fa fa-expand"></i>
          </a> 
          <a href="javascript:;" class="btn btn-danger btn-xs close-box">
            <i class="fa fa-times"></i>
          </a> 
        </nav>
      </div>
    </div>
      <fieldset>
        <legend><?php echo ($shop) ? Yii::t("strings", "Edit Shop").' <span class="divider"> - </span> '.$shop->title : Yii::t("strings", "Shop") ?></legend>
        
        <div class="control-group">
          <label class="control-label" for=""><?php echo Yii::t("strings", "Location") ?></label>
          <div class="controls">
            <select name="city" id="" ng-change="cityChange()" ng-model="shop.city"  ng-options="value for (key, value) in country_city">
              <option value="">--<?php echo Yii::t("strings", "Choose Province")?>--</option>
            </select>
            <select name="distinct" id="" ng-model="shop.distinct" ng-change="distinctChange()" ng-options="c for c in city_distinct">
              <option value="">--<?php echo Yii::t("strings", "Choose City")?>--</option>
            </select>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for=""><?php echo Yii::t("strings", "Title") ?></label>
          <div class="controls">
            <input type="text" name="title" ng-model="shop.title"/>
          </div>
        </div>
        
        <div class="control-group">
          <div class="control-label">
            <label for=""><?php echo Yii::t("strings", "Category")?></label>
          </div>
          <div class="controls">
            <select ng-model="shop.category">
              <?php foreach (Yii::app()->params["brands"] as $brand): ?>
              <option value="<?php echo strtolower($brand)?>"><?php echo ucfirst($brand)?></option>
              <?php endforeach;?>
            </select>
          </div>
        </div>
        
        <div class="control-group">
        <label class="control-label" for=""><?php echo Yii::t("strings", "Address") ?></label>
        <div class="controls">
          <input type="text" name="address" ng-change="addressChanged()" ng-model="shop.address" />
        </div>
        </div>
        
        <div class="control-group">
          <label for="" class="control-label"><?php echo Yii::t("strings", "Lat/ Lng")?></label>
          <div class="controls">
            <input type="text" name="lat" ng-model="shop.lat"/>
            <input type="text" name="lng" ng-model="shop.lng"/>
          </div>
        </div>
          
      </fieldset>
      
      <fieldset class="fieldset-section form-inline">
        <div class="control-group">
          <div id="shop-map"></div>
        </div>
      </fieldset>
      
      <input type="hidden" name="shop_id" value="<?php echo $shop ? $shop->shop_id : ""?>"/>

      <div class="form-actions">
        <input type="button" class="btn btn-primary" ng-click="submitForm()" value="<?php echo Yii::t("strings", "Submit") ?>"/> 
      </div>
    </form>
  </div></div>

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZuVRDtLTr1PXxz7g028BUPYL"></script> 
