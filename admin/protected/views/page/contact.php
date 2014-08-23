<div class="form-con contact-form" ng-controller="ContactController" ng-init="init()">
  <form name="contactform" class="form-horizontal form">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Update Contact Information")?></h4>
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
      <div class="controls">
        <input type="hidden" ng-model="formdata.title" />
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label><?php echo Yii::t("strings", "Contact")?></label>
      </div>
      <div class="controls">
        <textarea ng-ckeditor ng-model="formdata.body" ></textarea>
      </div>
    </div>
    <div class="form-actions">
      <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings", "Save")?></button>
    </div>
  </form>
</div>