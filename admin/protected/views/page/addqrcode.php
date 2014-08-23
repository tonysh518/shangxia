<!--<div class="form-con qrcode-form" ng-controller='QrcodeController' ng-init="init()">
  <div class="header clearfix">
    <div class="icons">
      <i class="fa fa-edit"></i>
    </div>
    <h4><?php echo Yii::t("strings", "Update Social QRCode")?></h4>
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
  <form name="qrcodeform" class="clearfix form">
   <?php foreach(Yii::app()->params["brands"] as $key => $name): ?>
    <div class="control-group imagepreview">
      <div class="control-label"><?php echo ucfirst($name)?></div>
      <div class="controls">
        <div class="preview">
          <img ng-src="{{formdata.qrcode_<?php echo strtolower(($key))?>}}" alt="" />
        </div>
        <input type="file" accept="image/*" onchange="angular.element(this).scope().filechange(this)"/>
        <input type="hidden" ng-model="formdata.qrcode_<?php echo strtolower($key)?>" />
        <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 171x204"?></div>
      </div>
    </div>
   <?php endforeach;?>
    <div class="form-actions">
      <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings", "Save")?></button>
    </div>
  </form>
</div>-->

<div class="form-con news-form" ng-controller="QrcodeController" ng-init="init()">
  <form name="qrcodeform" class="form-horizontal" action="<?php echo Yii::app()->baseUrl ."/addform"?>" method="post">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Add QRCode")?></h4>
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
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Title")?></label>
      </div>
      <div class="controls">
        <input type="text" name="title" ng-model="formdata.title"  required />
        <p class="text-error" ng-show="formdata.title.$error.required">This field is required</p>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Category")?></label>
      </div>
      <div class="controls">
        <select ng-model="formdata.category">
          <?php foreach (Yii::app()->params["brands"] as $brand): ?>
          <option value="<?php echo strtolower($brand)?>"><?php echo ucfirst($brand)?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="control-group imagepreview">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "QRCode Image")?></label>
      </div>
      <div class="controls clearfix">
        <div class="preview" ">
          <img ng-src="{{formdata.thumbnail}}" alt="" />
        </div>
        <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>"  name="media" accept="image/*" onchange="angular.element(this).scope().filechange(this)"/>
        <input type="hidden" value="{{formdata.thumbnail}}" ng-model="formdata.thumbnail"/>
        <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 171x204"?></div>
      </div>
    </div>
    
    <input type="hidden"   ng-model="formdata.body" ></input>
    <input type="hidden" name="cid" value="<?php echo Yii::app()->getRequest()->getParam("id", 0)?>"/>
    
    
    <div class="form-actions">
      <div class="controls">
        <input type="button" ng-click="submitForm($event)" class="btn-primary btn" value="<?php echo Yii::t("strings", "Save")?>"/>
      </div>
      </div>
  </form>
</div>