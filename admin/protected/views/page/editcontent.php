<div class="form-con slideshow-form" ng-controller="ContentForm" ng-init="init()">
  <form name="contentform" class="form-horizontal"  method="post" redirect="<?php echo Yii::app()->createUrl("page/content", array("type" => $type)) ?>">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", "Edit ". ucfirst($type))?></h4>
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
    
    <!-- 内容区域 / 基本的区域 -->
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Title")?></label>
      </div>
      <div class="controls">
        <input type="text" name="title" ng-model="content.title" value="<?php echo $instance->title?>" ng-initial required />
        <p class="text-error" ng-show="content.title.$error.required">This field is required</p>
      </div>
    </div>
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Body")?></label>
      </div>
      <div class="controls">
        <textarea  name="body" ng-ckeditor ng-model="content.body" ng-initial cols="80" rows="10"><?php echo $instance->body?></textarea>
      </div>
    </div>
    
    <div class="control-group">
      <div class="control-label">
        <label for=""><?php echo Yii::t("strings", "Weight")?></label>
      </div>
      <div class="controls">
        <select ng-model="content.weight"  ng-initial>
          <?php foreach (range(0, 10) as $weight): ?>
          <option value="<?php echo ($weight)?>" <?php if ($instance->weight == $weight) echo "selected"?>><?php echo ($weight)?></option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    
    <!-- 内容 Field / 扩展字段 -->
    <?php foreach ($model->getFields() as $field): ?>
      <div class="controle-group">
        <div class="control-label"><label for="<?php echo $field?>"><?php echo Yii::t("fields", ucfirst(str_replace("_", " " ,$field)))?></label></div>
        <div class="controls">
          <input type="text" value="<?php echo $instance->{$field}?>" name="<?php echo $field?>" ng-model="content.<?php echo $field?>" ng-initial/>
        </div>
      </div>
    <?php endforeach;?>
    
    <!-- 图片 Field / 图片扩展字段 -->
    <?php foreach ($model->getImageFields()  as $field): ?>
    <div class="control-group imagepreview">
      <div class="control-label"><label for="<?php echo $field?>"><?php echo Yii::t("fields", ucfirst(str_replace("_", " " ,$field)))?></label></div>
      <div class="controls clearfix">
<!--        <div class="preview">
          <img ng-src="{{content.<?php echo $field?>}}" alt="" />
        </div>
        <input type="file" onchange="angular.element(this).scope().filechange(this)" upload="<?php echo Yii::t("strings", "Upload Image")?>" name="<?php echo $field?>" accept="image/*"/>
        <input type="hidden" value="{{content.<?php echo $field?>}}" ng-model="content.<?php echo $field?>"/>-->
        <ng-uploadimage value="<?php echo $instance->{$field}?>" ng-model="content.<?php echo $field?>">
      </div>
    </div>
    <?php endforeach;?>
    
    <!-- 视频 Field / 视频扩展字段 -->
    <?php foreach ($model->getVideoFields()  as $field): ?>
    <div class="control-group imagepreview">
      <div class="control-label"><label for="<?php echo $field?>"><?php echo Yii::t("fields", ucfirst(str_replace("_", " " ,$field)))?></label></div>
      <div class="controls clearfix">
        <ng-uploadvideo  ng-model="content.<?php echo $field?>" value="<?php echo $instance->{$field}?>">
          
        </ng-uploadvideo>
      </div>
    </div>
    <?php endforeach;?>
    
    <input type="hidden" name="type" value="<?php echo $type?>" ng-model="content.type" ng-initial/>
    <input type="hidden" name="cid" value="<?php echo Yii::app()->getRequest()->getParam("id", 0)?>" ng-model="content.cid" ng-initial/>
    
    <div class="form-actions">
      <div class="controls">
        <input type="button" ng-click="submitContent($event)" class="btn-primary btn" value="<?php echo Yii::t("strings", "Save")?>"/>
      </div>
   </div>
  </form>
</div>