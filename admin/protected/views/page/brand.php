<div class="tabbable form-con">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", isset($contentvideo) ? "Edit Media" : "Update Brand")?></h4>
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
  <div class="nav nav-tabs">
    <li ><a href="<?php echo Yii::app()->createUrl("page/lookbook", array("brand" => Yii::app()->getRequest()->getParam("brand")))?>"><?php echo Yii::t("strings", "Lookbook")?></a></li>
    <li><a href="<?php echo Yii::app()->createUrl("page/arrival", array("brand" => Yii::app()->getRequest()->getParam("brand")))?>"><?php echo Yii::t("strings", "New Arrival")?></a></li>
    <li class="active"><a href="<?php echo Yii::app()->createUrl("page/brand", array("brand" => Yii::app()->getRequest()->getParam("brand")))?>"><?php echo Yii::t("strings", "Brand Story")?></a></li>  
  </div>
  <div class="tab-content">
    <div class="brand-info-form" ng-controller="BrandController" ng-init="init()">
      <form name="brandform" class="form-horizontal">
        <div class="control-group">
          <div class="control-label">
            <label><?php echo Yii::t("strings", "Title")?></label>
          </div>
          <div class="controls">
            <input type="text" ng-model="formdata.title" />
          </div>
        </div>
        <div class="control-group">
          <div class="control-label">
            <label><?php echo Yii::t("strings", "Body")?></label>
          </div>
          <div class="controls">
            <textarea type="text" ng-ckeditor rows="10" cols="80" ng-model="formdata.body"></textarea>
          </div>
        </div>
        <div class="control-group imagepreview">
          <div class="control-label">
            <?php echo Yii::t("strings", "Master Image")?>
          </div>
          <div class="controls">
            <div class="preview">
              <img ng-src="{{formdata.brand_master_image}}" alt="" />
            </div>
            <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>"  accept="image/*" onchange="angular.element(this).scope().filechange(this)" />
            <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 605x1050"?></div>
            <input type="hidden" ng-model="formdata.brand_master_image" />
          </div>
          
          <div class="control-label">
            <?php echo Yii::t("strings", "Media Navigation Image")?>
          </div>
          <div class="controls">
            <div class="preview">
              <img ng-src="{{formdata.brand_thumbnail_image}}" alt="" />
            </div>
            <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>"  accept="image/*" onchange="angular.element(this).scope().filechange(this)" />
            <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 573x393"?></div>
            <input type="hidden" ng-model="formdata.brand_thumbnail_image" />
          </div>
          
          <div class="control-label">
            <?php echo Yii::t("strings", "Navigation Image")?>
          </div>
          <div class="controls">
            <div class="preview">
              <img ng-src="{{formdata.brand_navigation_image}}" alt="" />
            </div>
            <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>"  accept="image/*"  onchange="angular.element(this).scope().filechange(this)" />
            <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 1249x1077"?></div>
            <input type="hidden" ng-model="formdata.brand_navigation_image" />
          </div>
          
          <div class="control-label">
            <?php echo Yii::t("strings", "Navigation Full Image")?>
          </div>
          <div class="controls">
            <div class="preview">
              <img ng-src="{{formdata.brand_navigation_full_image}}" alt="" />
            </div>
            <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>"  accept="image/*"  onchange="angular.element(this).scope().filechange(this)" />
            <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 1290x1080"?></div>
            <input type="hidden" ng-model="formdata.brand_navigation_full_image" />
          </div>
        </div>
        
        <input type="hidden" name="brand" value="<?php echo Yii::app()->getRequest()->getParam("brand")?>"/>
        
        <div class="form-actions">
          <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings" ,"Save")?></button>
        </div>
      </form>
    </div>
  </div>
</div>

