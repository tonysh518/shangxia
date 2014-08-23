<div class="form-con news-form" ng-controller="NewsForm" ng-init="init()">
  <form name="newsform" class="form-horizontal" action="<?php echo Yii::app()->baseUrl ."/addform"?>" method="post">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Add News")?></h4>
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
        <input type="text" name="title" ng-model="news.title"  required />
        <p class="text-error" ng-show="news.title.$error.required">This field is required</p>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Body")?></label>
      </div>
      <div class="controls">
        <textarea  name="body" ng-ckeditor ng-model="news.body"  cols="80" rows="10"></textarea>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Category")?></label>
      </div>
      <div class="controls">
        <select ng-model="news.category">
          <?php foreach (Yii::app()->params["brands"] as $brand): ?>
          <option value="<?php echo strtolower($brand)?>"><?php echo ucfirst($brand)?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Weight")?></label>
      </div>
      <div class="controls">
        <select ng-model="news.weight">
          <?php foreach (range(0, 10) as $weight): ?>
          <option value="<?php echo ($weight)?>"><?php echo ($weight)?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="control-group imagepreview">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Master Image")?></label>
      </div>
      <div class="controls clearfix">
        <div class="preview">
          <img ng-src="{{news.master_image}}" alt="" />
        </div>
        <input type="file" onchange="angular.element(this).scope().filechange(this)" upload="<?php echo Yii::t("strings", "Upload Image")?>" name="master_image" accept="image/*"/>
        <input type="hidden" value="{{news.master_image}}" ng-model="news.master_image"/>
      </div>
    </div>
    <div class="control-group imagepreview">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Slide Image")?></label>
      </div>
      <div class="controls clearfix">
        <div class="preview" ng-repeat="media in news.thumbnail">
          <img ng-src="{{media}}" alt="" />
        </div>
        <input type="file" onchange="angular.element(this).scope().filechange(this)" multiple upload="<?php echo Yii::t("strings", "Add More Image")?>" name="thumbnail" accept="image/*"/>
        <input type="hidden" value="{{news.thumbnail}}" ng-model="news.thumbnail"/>
      </div>
    </div>
    
    <input type="hidden"  name="cid" value="<?php echo Yii::app()->getRequest()->getParam("id", 0)?>"/>
    
    
    <div class="form-actions">
      <div class="controls">
        <input type="button" ng-click="submitNews($event)" class="btn-primary btn" value="<?php echo Yii::t("strings", "Save")?>"/>
      </div>
      </div>
  </form>
</div>