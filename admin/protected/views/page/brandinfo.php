<div class="form-con form-brand" ng-controller="BrandinfoController" ng-init="init()">
  <form name="brandform" class="form-horizontal" enctype="multipart/form-data">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Update Brand Information")?></h4>
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
        <?php echo Yii::t("strings", "Title")?>
      </div>
      <div class="controls">
        <input type="text" ng-model="formdata.title" />
      </div>
    </div>
    
    <div class="control-group">
      <div class="control-label">
        <?php echo Yii::t("strings", "Body")?>
      </div>
      <div class="controls">
        <textarea cols="80" ng-ckeditor rows="8" name="body" ng-model="formdata.body" ></textarea>
      </div>
    </div>
    
    <div class="control-group imagepreview">
      <div class="control-label">
        <?php echo Yii::t("strings", "Thumbnail")?>
      </div>
      <div class="controls">
        <span class="preview">
          <img ng-src="{{formdata.dazzle_thumbnail}}" alt="" />
        </span>
        <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>" accept="image/*" onchange="angular.element(this).scope().fileChange(this)"/>
        <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 658x671"?></div>
        <input type="hidden" ng-model="formdata.dazzle_thumbnail" />
      </div>
    </div>
    
    <div class="form-actions">
      <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings", "Save")?></button>
    </div>
    
  </form>
</div>