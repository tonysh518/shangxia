<div class="form-con video-form" ng-controller='VideoFormController' ng-init="init()">
  <form name="videoform" class="form-horizontal">
    <div class="header clearfix">
      <div class="icons">
        <i class="fa fa-edit"></i>
      </div>
      <h4><?php echo Yii::t("strings", isset($contentvideo) ? "Edit Media" : "Add Media")?></h4>
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
      <div class="control-label"><?php echo Yii::t("strings", "Title")?></div>
      <div class="controls">
        <input type="text" name="title" ng-model='formdata.title'/>
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
      <div class="control-label"><?php echo Yii::t("strings", "Thumbnail")?></div>
      <div class="controls">
        <div class="preview">
          <img ng-src='{{formdata.thumbnail}}' alt="" />
        </div>
        <input type="file" accept="image/*" upload="<?php echo Yii::t("strings", "Upload Image")?>" onchange='angular.element(this).scope().filechange(this)'/>
        <input type="hidden" name="thumbnail" ng-model="formdata.thumbnail"/>
        <div class="alert alert-success"><?php echo Yii::t("strings", "Image Size: "). " 1616x911"?></div>
      </div>
    </div>
    
    <fieldset>
      <legend><?php echo Yii::t("strings", "Video")?></legend>
      <label><?php echo Yii::t("strings", "MP4 Format")?></label>
      <input type="file" accept="video/*" onchange='angular.element(this).scope().filechange(this)'/>
      <input type="hidden" ng-model="formdata.video_mp4" />
      <div class="alert"><?php echo "MP4 Video: "?>{{formdata.video_mp4}}</div>
      <label for=""><?php echo Yii::t("strings", "webm Format")?></label>
      <input type="file" upload="<?php echo Yii::t("strings", "Upload Image")?>" accept='video/*' onchange='angular.element(this).scope().filechange(this)'/>
      <input type="hidden" ng-model="formdata.video_webm" />
      <div class="alert"><?php echo "Webm Video: "?>{{formdata.video_webm}}</div>
    </fieldset>
    
    <input type="hidden" name="cid" ng-model="formdata.cid" value="<?php if (isset($contentvideo)) echo $contentvideo->cid?>" />
    
    <div class="form-actions">
      <button class="btn btn-primary" ng-click="submitForm()"><?php echo Yii::t("strings", "Save")?></button>
    </div>
    </div>
  </form>
</div>