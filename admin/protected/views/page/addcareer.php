<div class="form-con career-form" ng-controller="CareerController" ng-init="init()">
  <form name="careerform" class="form-horizontal">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Add New Position")?></h4>
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
      <div class="control-label"><label for=""><?php echo Yii::t("strings", "Title")?></label></div>
      <div class="controls"><input type="text" ng-model="formdata.title" /></div>
    </div>
    <div class="control-group">
      <div class="control-label"><label for=""><?php echo Yii::t("strings", "Job")?></label></div>
      <div class="controls"><textarea ng-ckeditor ng-model="formdata.body" rows="8" cols="80" /></textarea></div>
    </div>
    <div class="form-actions">
      <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings", "Save")?></button>
    </div>
    <input type="hidden" name="cid" value="<?php echo ($career) ? $career->cid : 0?>" ng-model="formdata.cid" />
  </form>
</div>