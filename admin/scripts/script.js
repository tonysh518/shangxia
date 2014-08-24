(function ($) {
  var AdminModule = angular.module("adminModule", []);
  
  AdminModule.directive("ngCkeditor", function () {
    return {
      restrict: "A",
      require: ["ngModel"],
      scope: false,
      link: function (scope, element, attrs, ctrls) {
        var ngModel = ctrls[0];
        var ckeditor = CKEDITOR.replace(element[0], {customConfig: window.baseurl + "/scripts/config.js"});
        setInterval(function () {
          if(ckeditor.checkDirty()) {
            var data = ckeditor.getData();
            if (ngModel.$viewValue != data) {
              ngModel.$setViewValue(data);
            }
          }
        }, 200);
        
        ckeditor.on("instanceReady", function() {
          var data = ngModel.$viewValue;
          ckeditor.setData(data);
        });
      }
    };
  });
  
  // 初始化Model
  AdminModule.directive("ngInitial", function () {
    return {
      restrict: "A",
      require: ["ngModel"],
      scope: false,
      link: function (scope, element, attrs, ctrls) {
        var ngModel = ctrls[0];
        ngModel.$setViewValue(element.val()); 
      }
    };
  });
  
  // 文件上传Service
  AdminModule.factory("UploadMediaService", ["$http" ,function ($http) {
    function upload(file, index) {
      if (typeof index == "undefined") {
        index = 0;
      }
      file = file.files[index];
      // 上传
      var formdata = new FormData();
      formdata.append("media", file);
      return $.ajax({
        url: window.baseurl + "/api/media/temp",
        type: "post",
        data: formdata,
        processData: false,
        contentType: false
      });
    };
    
    function uploadVideo(file) {
      file = file.files[0];
      // 上传
      var formdata = new FormData();
      formdata.append("media", file);
      return $.ajax({
        url: window.baseurl + "/api/media/videotemp",
        type: "post",
        data: formdata,
        processData: false,
        contentType: false
      });
    }
    
    return {
      upload: upload,
      uploadVideo: uploadVideo
    };
  }]);

  AdminModule.factory("ContentService", ["$http", function ($http) { 
        return {
          update: function (data) {
            return $.ajax({
              url: window.baseurl + "/api/content/update",
              data: $.param(data),
              type: "post"
            });
          }
        };
  }]);

  AdminModule.directive("ngPreviewmedia", function () {
    return {
      restrict: "A",
      require: ["ngModel"],
      
    };
  });

  AdminModule.controller("ContentForm",  function ($scope, UploadMediaService, ContentService) {
    $scope.submitContent = function () {
      if ($scope.contentform.$valid) {
        ContentService.update($scope.content).success(function (res){
          if (res["status"]!= 0) {
            alert(res["message"]);
          }
          else {
            
          }
        });
      }
      else {
        // 把鼠标焦点定向到第一个有错误的元素上去
        var form = angular.element("form[name='"+$scope.contentform["$name"]+"']");
        var firstInvalid = form.find(".ng-invalid:first");
        firstInvalid.focus();
      }
    };
  });
  
  
  // 多语言切换
  angular.element("a[lang]").click(function () {
    jQuery.cookie('lang' , $(this).attr('lang') , { expires: 7, path: '/' });
    window.location.reload();
  });
  
  angular.element(document).ready(function () {
//    angular.element("textarea").ckeditor({
//      customConfig: window.baseurl + "/scripts/config.js"
//    });
    
    angular.element("#sidebar > .icons").click(function () {
      console.log("CLICKED ");
      var icon = $(this);
      var sideBar = $(this).parent();
      if (icon.hasClass("fadeout")) {
        icon.removeClass("fadeout");
        sideBar.animate({
          left: 0,
          "margin-left": 0
        }, 1000, "easeInQuad", function () {
          icon.fadeIn("slow");
        });
      }
      else {
        var width = sideBar.width();
        sideBar.animate({
          left: -width,
          "margin-left": - ( parseInt(width) /2 )
        }, 1000, "easeInQuad", function () {
          icon.hide().addClass("fadeout").fadeIn("slow");
        });
      }
    });
    
    angular.element(".full-box").click(function () {
      var content = angular.element("#content");
      if (content.hasClass("full-screen")) {
        content.removeAttr('style').removeClass("full-screen");
      }
      else {
        content.animate({
          width: "99.1%",
          margin: "0px 0px"
        }, 1000, function () {
          content.addClass("full-screen");
        });
      }
    });
    
    var time;
    $(".thumbnail").live("mousemove", function () {
      var self = angular.element(this);
      if (!self.hasClass("checked")) {
        if (time) {
          clearTimeout(time);
        }
        time = setTimeout(function () {
        }, 200);
        
        angular.element(" > span", self).css("display", "block");
      }
    }).live("mouseleave" ,function (event) {
      var self = angular.element(this);
      if (!self.hasClass("checked")) {
        if (time) {
          clearTimeout(time);
        }
        time = setTimeout(function () {
        }, 200);
        
        angular.element(" > span", self).css("display", "none");
      }
    });

    $(".thumbnail > span .trash").live("click", function () {
      var thumbnail = $(this).parent().parent();
      if (thumbnail.hasClass("checked")) {
        $(this).removeAttr("style").parent().removeAttr("style");
        thumbnail.removeClass("checked");
        $(this).removeClass("fa-check-square");
      }
      else {
        $(this).css({color: "#cb223a"}).parent().css({"display": "block"});
        thumbnail.addClass("checked");
        $(this).addClass("fa-check-square");
      }
    });

    $(".thumbnail > span .fa-eye").live("click" ,function () {
      var src = $(this).parent().siblings("img").attr("src");
      var preview = $("body .preview-image");
      $("img", preview).attr("src", src);
      preview.fadeIn("slow");
    });

    $(".preview-image .close-icon").live("click", function () {
      $(this).parent().fadeOut("slow");
    });

    $(".preview-image .left").live("click", function () {
      var currentImage = $("body .preview-image img");
      var imageObj = $(".media-list img[src='"+currentImage.attr("src")+"']");
      currentImage.attr("src", $("img" ,imageObj.parents("li").prev()).attr("src"));
    });
    $(".preview-image .right").live("click", function () {
      var currentImage = $("body .preview-image img");
      var imageObj = $(".media-list img[src='"+currentImage.attr("src")+"']");
      currentImage.attr("src", $("img" ,imageObj.parents("li").next()).attr("src"));
    });

  });
  
  jQuery.easing.def = "easing";
  
})(jQuery);

// 删除内容
(function () {
  window.deleteContent = function (cid) {
    if (confirm(language.confirmdelete)) {
      $.ajax({
        url: window.baseurl + "/api/content/delete",
        data: {cid: cid},
        type: "POST"
      })
      .done(function () {
        alert("删除成功");
      })
      .always(function () {
        window.location.reload();
      });
    }
  }
})();

// Table pager 
(function ($) {
  $(document).ready(function () {
    $("table.tablepager").DataTable();
  });
})(jQuery);




