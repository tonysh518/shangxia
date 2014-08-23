<div class="corporate-form form-con" ng-controller="Corporate" ng-init="init()">
  <form class="form-horizontal" enctype="multipart/form-data" method="post" name="corporate">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Update Corporate Information")?></h4>
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
        <textarea ng-ckeditor ng-model="formdata.body" cols="80" rows="8" /></textarea>
      </div>
    </div>
    
    <div class="control-group imagepreview">
      <div class="control-label">
        <?php echo Yii::t("strings", "Thumbnail")?>
      </div>
      <div class="controls">
          <span class="preview">
            <img ng-src="{{formdata.thumbnail}}" alt="" />
          </span>
        <input upload="<?php echo Yii::t("strings", "Upload Image")?>" type="file" name="file" onchange="angular.element(this).scope().fileChange(this)" />
        <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 739x639"?></div>
        <input type="hidden" ng-model="formdata.thumbnail" />
      </div>
    </div>
    
    <div class="form-actions">
      <button ng-click="submitForm()" class="btn btn-primary"><?php echo Yii::t("strings", "Save")?></button>
    </div>
  </form>
</div>