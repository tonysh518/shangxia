/*
 * page base action
 */
LP.use(['jquery' ,'easing' , '../api'] , function( $ , easing , api ){
    'use strict'


    // page components here
    // ============================================================================ 
    $.easing.easeLightOutBack = function (x, t, b, c, d, s) {
        if (s == undefined) s = 0.70158;
        return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    }


    /*
     * Animate Class
     * {@param originNumArr} 需要变化的初始化数据
     * {@param targetNumArr} 数据的最终值
     * {@param speed} 动画持续时间
     * {@param easing} 动画特效
     * {@param step} 动画每一步需要执行的了函数，主要用于更新元素的样式值，其第一个参数是个数组，数组里为数据变化的当前值
     * {@param callback} 动画结束时的回调函数
     */
    var Animate = function(originNumArr,targetNumArr,speed,easing,step,callback){
        this.queue = [];
        this.duration = speed;
        this.easing = easing;
        this.step = step;
        this.callback = callback;
        for (var i = 0; i < originNumArr.length; i++){
            this.queue.push(new Animate.fx(originNumArr[i],targetNumArr[i]));
        }
        // begin animation
        this.begin();
    }

    Animate.prototype = {
        begin: function(){
            if(this._t) return ;
            var that = this;
            this.startTime = +new Date();
            // loop
            this._t = setInterval(function(){
                var dur = +new Date() - that.startTime;
                var queue = that.queue;
                if(dur > that.duration){
                    that.end();
                    // end Animate
                    return;
                }
                var easing = Animate.easing[that.easing] || Animate.easing.linear,
                    currValues = [];
                for (var i = 0,len = queue.length; i < len; i++){
                    currValues.push(queue[i].update(dur,that.duration,easing));
                }
                // run step to update
                that.step(currValues);
            },13);
        },
        // go to end of the animation
        end: function(){
            clearInterval(this._t);
            var queue = this.queue,
                currValues = [];
            for (var i = 0,len = queue.length; i < len; i++){
                currValues.push(queue[i].target);
            }
            this.step(currValues);
            // call callback function
            this.callback && this.callback();
        },
        turnTo: function( targetNumArr ){
            clearInterval(this._t);
            var that = this;
            // reset queue
            this.startTime = + new Date();
            for (var i = 0,len = that.queue.length; i < len; i++){
                that.queue[i] = new Animate.fx(that.queue[i].current,targetNumArr[i]);
            }
            // reset interval
            this._t = setInterval(function(){
                var dur = +new Date() - that.startTime;
                var queue = that.queue;
                if(dur > that.duration){
                    that.end();
                    // end Animate
                    return;
                }
                var easing = Animate.easing[that.easing] || Animate.easing.linear,
                    currValues = [];
                for (var i = 0,len = queue.length; i < len; i++){
                    currValues.push(queue[i].update(dur,that.duration,easing));
                }
                // run step to update
                that.step(currValues);
            } , 13);
        }
    }
    //
    Animate.fx = function(origin,target){
        this.origin = origin;
        this.target = target;
        this.dist = target - origin;
    }
    Animate.fx.prototype = {
        update: function(n,duration,easing){
            var pos = easing(n/duration, n , 0 ,1 , duration);
            this.current = this.origin + this.dist * pos;
            return this.current;
        }
    }
    // easing
    Animate.easing = {
        linear: function( p, n, firstNum, diff ) {
            return firstNum + diff * p;
        },
        swing: function( p, n, firstNum, diff ) {
            return ((-Math.cos(p*Math.PI)/2) + 0.5) * diff + firstNum;
        }
    }

    
    var pageManager = (function(){
        var $header = $('.head');
        var pageInits = {
            'home-page' : function( cb ){
                var $slider = $('#home-slider');
                var slideHeight = $slider.children().height();
                $(window).scroll(function(){
                    var stTop = $(window).scrollTop();
                    var winHeight = $(window).height();

                    // fix home slider
                    var mtop = Math.min( stTop , slideHeight / 2 );
                    $slider
                        .css({
                            height: slideHeight - 2 * mtop,
                            overflow: 'hidden'
                        })
                        .find('img')
                        .css({marginTop: - mtop , marginBottom: - mtop * 2 / 3});

                    // // header fixed effect
                    if( stTop >= $header.offset().top ){
                        $header.find('.head-fixed').css('position' , 'fixed');
                    } else {
                        $header.find('.head-fixed').css('position' , 'static');
                    }

                    // homeCampaign animate

                    // if($('.cam_item').eq(0).offset().top < stTop + $(window).height() ){
                    //     $homeCampaign.data('animate' , 1);
                    //     $homeCampaign.find('.cam_item')
                    //         .each(function( i ){
                    //             $(this).delay( i * 200 )
                    //                 .animate({
                    //                     marginTop: 0
                    //                 } , 400 , 'easeLightOutBack');
                    //         });
                    //     $('.home_cambtn').delay( 4 * 200 )
                    //         .animate({
                    //             bottom: 90
                    //         } , 400 , 'easeLightOutBack' );
                    // }
                });
                cb && cb();
            },
            'awards-page': function( cb ){
                cb && cb();
            },
            'contact-page': function( cb ){
                

                cb && cb();
                
            }
        }


        var effects = {
            'fadeup': function( $dom , index , cb ){
                $dom.delay( 150 * index )
                    .animate({
                        opacity: 1,
                        marginTop: 0
                    } , 500 )
                    .promise()
                    .then(function(){
                        cb && cb();
                    });
            },
            'number-rock': function( $dom , index , cb , du ){
                // init humbers
                var num = $dom.text();
                var $span = $('<span>' + num + '</span>').appendTo( $dom.html('').data('num' , num) );
                var width = $span.width();
                var height = $span.height();
                $span.css({
                    height: height,
                    width: width,
                    display: 'inline-block',
                    lineHeight: height + 'px',
                    position: 'relative',
                    margin: '0 auto',
                    overflow: 'hidden',
                    verticalAlign: 'middle'
                }).html('');
                $.each( num.split('') , function( i ){
                    $('<div>' + "1234567890".split('').join('<br/>') + '</div>').appendTo( $span )
                        .css({
                            position: 'absolute',
                            left: i * width / num.length,
                            top: -~~( Math.random() * 10 ) * height
                        });
                });

                // run the animate
                var spanHeight = height;//$dom.find('span').height();

                var st = new Date();
                var duration = du || 1200;
                var $divs = $span.find('div');
                var interval = setInterval(function(){

                    if( new Date - st >= duration ){
                        var num = $dom.data('num');
                        var nums = num.split('');
                        $divs.each(function( i ){
                            var top = - ( nums[i] - 1 ) * spanHeight ;
                            if( nums[i] == 0 ){
                                top = - 9 * spanHeight
                            }
                            $(this).animate({
                                'top': top 
                            } , 800 , 'easeOutQuart' , function(){
                                if( i == nums.length - 1 ){
                                    //$dom.html( num );
                                    cb && cb();
                                }
                            });
                        });
                        clearInterval( interval );
                        return false;
                    }
                    $divs.each(function(){
                        $(this).css('top' , -( Math.random() * 10 ) * spanHeight );
                    });
                } , 1000 / 15);
            }
        }


        return {
            go: function( url , type ){
                History.pushState({
                    prev: location.href,
                    type: type
                },  undefined , url );
            },
            init: function(){
                loadingMgr.show();
                var page = $('input[name="page-indentity"]').val();
                var fn = pageInits[ page ];

                if( fn ){
                    fn( function(){
                        $(window).trigger('scroll');
                        loadingMgr.hide();
                    });
                } else {
                    loadingMgr.hide();
                }

                // fix common page init
                // for  banpho-img
                var $footer = $('.footer');
                $(window).scroll(function(){
                    var stTop = $(window).scrollTop();
                    var winHeight = $(window).height();

                    // fix up-fadein
                    if( $('.intoview-effect').length ){
                        var index = 0;
                        $('.intoview-effect').each(function(){
                            var $dom = $(this);
                            var offTop = $dom.offset().top;
                            if( !$dom.data('init') && offTop < stTop + winHeight && offTop > stTop ){
                                $dom.data('init' , 1);

                                if( effects[ $dom.data('effect') ] ){
                                    effects[ $dom.data('effect') ]( $dom , index++ , function(){
                                        $dom.removeClass('intoview-effect');
                                    } );
                                }
                            }
                        });
                    }
                })
                .trigger('scroll');

                // init slide
                $('.slide').each(function(){
                    initSlider( $(this) );
                });


                // init horizontal slide
                $('.js-horizontal-slide').each(function(){
                    var $dom = $(this);
                    var wrapWidth = $dom.width();
                    var num = $dom.data('num') || 3;
                    var $items = $dom.find('.slide-con-inner').children();

                    $dom.find('.slide-con-inner').width( $items.length / 3 * 100 + '%' );
                    var marginRight = 0.8;//parseInt( $items.css('margin-right') );
                    console.log( marginRight );
                    $items.width( 1 / $items.length * 100 - marginRight + '%' );
                });
                return false;
            },
            destroy: function(){
                $(window).unbind('scroll');
                $(document.body).unbind('mousemove').css('overflow' , 'auto');
            }
        }
    })();

    var loadingMgr = (function(){
        var $loading = $('.loading-wrap');
        if( !$loading.length )
            $loading = $('<div class="loading-wrap"><div class="loading"></div></div>')
                .appendTo(document.body);
        var positions = [-44,-142,-240,-338,-436,-534];
        var interval = null;

        var colors = {
            'black': 'rgba(0,0,0,.85)'
        }
        
        return {
            showLoading: function( $wrap ){
                $('<div class="loading-wrap" style="position: absolute;"><div class="loading" style="position:absolute;"></div></div>').appendTo( $wrap )
                    .fadeIn();
                var $loading = $wrap.find('.loading');
                clearInterval( $wrap.data('interval') );
                var index = 0;
                $wrap.data('interval' , setInterval(function(){
                    $loading.css('background-position' , 'right ' +  positions[ ( index++ % positions.length ) ] + 'px' );
                } , 1000 / 6 ) );
            },
            hideLoading: function( $wrap ){
                clearInterval( $wrap.data('interval') );
                $wrap.find('.loading-wrap').fadeOut();
            },
            show: function( bgcolor ){
                var index = 0;
                bgcolor = colors[bgcolor] || bgcolor || 'white';
                var $inner = $loading.fadeIn().find('.loading');
                $loading.css({
                    'background-color':  bgcolor
                });
                clearInterval( interval );
                interval = setInterval(function(){
                    $inner.css('background-position' , 'right ' +  positions[ ( index++ % positions.length ) ] + 'px' );
                } , 1000 / 6 );
            },
            hide: function(){
                clearInterval( interval );
                $loading.fadeOut();
            }
        }
    })();

    function initSlider( $wrap , config ){
        var $slidebox = $wrap.find('.slidebox');
        var $slidetabs = $wrap.find('.slidetab li');
        var currentIndex = 0;
        var length = $slidebox.children().length;
        console.log( $slidebox.children() );
        $slidebox.css( 'width' , length * 100 + '%' )
            .children()
            .css('width' , 1 / length * 100 + '%' );


        $slidetabs.hover(function(){
            $(this).addClass('on')
                .siblings()
                .removeClass('on');

            var index = $(this).index();
            $slidebox.stop(true).animate({
                marginLeft: - index * 100 + '%'
            } , 400 );
        });
    }


    function disposeVideo(){
        $(document.body).find('.video-wrap').parent()
            .each(function(){
                var video = $(this).data('video-object');
                try{video && video.dispose();}catch(e){}
                $(this).removeData('video-object').find('.video-wrap').remove();
            });
    }

    function renderVideo ( $wrap , movie , poster , config , cb ){
        var id = 'video-js-' + ( $.guid++ );
        $wrap.append( LP.format( '<div class="video-wrap" style="display:none;"><video id="#[id]" style="width: 100%;height: 100%;" class="video-js vjs-default-skin"\
            preload="auto"\
              poster="#[poster]">\
             <source src="#[videoFile].mp4" type="video/mp4" />\
             <source src="#[videoFile].webm" type="video/webm" />\
             <source src="#[videoFile].ogv" type="video/ogg" />\
        </video></div>' , {id: id  , videoFile: movie , poster: poster}));

        config = $.extend( { "controls": false, "muted": false, "autoplay": false, "preload": "auto","loop": true, "children": {"loadingSpinner": false} } , config || {} );
        var ratio = config.ratio || 9/16;

        LP.use('video-js' , function(){
            var is_playing = false;
            videojs.options.flash.swf = "/js/video-js/video-js.swf";
            var myVideo = videojs( id , config , function(){
                var v = this;
                if( config.resize !== false ){
                    var resizeFn = function(){
                        var w = $wrap.width()  ;
                        var h = $wrap.height() ;
                        var vh = 0 ;
                        var vw = 0 ;
                        if( h / w > ratio ){
                            vh = h + 40;
                            vw = vh / ratio;
                        } else {
                            vw = w + 40;
                            vh = vw * ratio;
                        }

                        try{v.dimensions( vw , vh );}catch(e){}

                        $('#' + v.Q).css({
                            "margin-top": ( h - vh ) / 2,
                            "margin-left": ( w - vw ) / 2
                        });
                        return false;
                    }
                    $(window).bind( 'resize.video-' + id , resizeFn )
                        .trigger('resize.video-' + id);

                    $wrap.bind('resize.video-' + id , resizeFn);
                }
                setTimeout(function(){
                    $wrap.find('.video-wrap').fadeIn();
                    if( config.autoplay ){
                        try{myVideo.play();}catch(e){}
                    } else if( config.pause_button ){
                        $wrap.find('.vjs-big-play-button').fadeIn();
                    }
                } , 20);

                // if need to add pause button
                if( config.pause_button ){
                    if( !config.controls ){
                        $wrap.off('click.video-operation').on('click.video-operation' , function(){
                            if( is_playing ){
                                v.pause();
                            } else {
                                v.play();
                            }
                        });    
                    }
                    // add big pause btn
                    v.on('play' , function(){
                        is_playing = true;
                        $wrap.find('.vjs-big-play-button').hide();
                        var $pauseBtn = $wrap.find('.vjs-big-pause-button');
                        if( !$pauseBtn.length ){
                            $pauseBtn = $('<div class="vjs-big-pause-button"></div>').insertAfter( $wrap.find('.vjs-big-play-button') )
                                .click(function(){
                                    v.pause();
                                });
                        }
                        $pauseBtn.show()
                            .delay( 4000 )
                            .fadeOut();
                    });

                    v.on('pause' , function(){
                        is_playing = false;
                        $wrap.find('.vjs-big-pause-button').hide();
                        $wrap.find('.vjs-big-play-button').fadeIn();
                    });
                }


                $wrap.data('video-object' , v);

                cb && cb(v);
            } );
        });
    }

    // page init here
    // ==============================================================================

    // init map
    var _LP = window.LP;
    LP.use('http://api0.map.bdimg.com/getscript?v=2.0&ak=AwxxvHue9bTdFietVWM4PLtk&services=&t=20140725172530' , function(){
        window.LP = _LP;
    });
    var interval = setInterval(function(){
        if( window.BMap ){
            clearInterval( interval );
            var oMap = new BMap.Map("map");
            oMap.addControl(new BMap.NavigationControl());
            var point = new BMap.Point(121.478988,31.227919);
            oMap.centerAndZoom(point, 15);
            //oMap.setMapStyle({style: 'grayscale'});
            oMap.setMapStyle({
              styleJson:[{
                "featureType": "all",
                "elementType": "all",
                "stylers": {
                  "lightness": 13,
                  "saturation": -100
                }
              }]
            });
        }
    } , 100 );


    // change history
    LP.use('../plugin/history.js' , function(){
        History.replaceState( { prev: '' } , undefined , location.href  );
        pageManager.init( );

        $(document).ajaxError(function(){
            loadingMgr.hide();
        });
        // Bind to StateChange Event
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate

            var State = History.getState(); // Note: We are using History.getState() instead of event.state
            var prev = State.data.prev;
            var type = State.data.type;

            // if only change hash
            if( State.url.indexOf('##') >= 0 ){
                return false;
            }
            // show loading
            loadingMgr.show();
            switch( type ){
                default: 
                    $.get( location.href , '' , function( html ){
                        html = $('<div>' + html + '</div>').find('.wrap')
                            .html();
                        $( '.wrap' ).children().animate({
                            opacity: 0
                        } , 500);
                        setTimeout(function(){
                            $( '.wrap' ).html( html )
                                .fadeIn();
                            //pagetitarrbottom

                            $('html,body').animate({
                                scrollTop: 0
                            } , 300 );
                            pageManager.destroy( );
                            pageManager.init( );
                        } , 500);
                    });
            }
        });
    });



    // page actions here
    // ============================================================================
    LP.action('nav-pop' , function(){
        
        var text = $.trim( $(this).text() ).toLowerCase();
        var $inner = $(this).closest('.head-inner');
        $inner.attr('class' , 'head-inner cs-clear active-' + text );
        
        if( $('.nav-pop-' + text ).is(':visible') ){
            $('.nav-pop-' + text ).fadeOut();
            $inner.attr('class' , 'head-inner cs-clear');
            $(this).closest('li').removeClass('active');
            $('.nav-bg').fadeOut();
            return false;
        }

        $(this).closest('li').addClass('active').siblings().removeClass('active');

        $('.nav-bg').fadeIn();
        $('.nav-pop').fadeOut();
        $('.nav-pop-' + text ).stop(true , true).fadeIn();
        $('.nav-mask').fadeIn();
        return false;
    });

    LP.action('nav-mask' , function(){
        var $inner = $('.head-inner').attr('class' , 'head-inner cs-clear');

        $('.nav-bg').fadeOut();
        $('.nav-pop').fadeOut();
        $('.nav-mask').fadeOut();

        return false;
    });

    LP.action('nav-link' , function(){
        disposeVideo();
        // load next page
        var href = $(this).attr('href');
        pageManager.go( href );

        return false;
    });

    LP.action('show-search-form' , function(){
        if( $('.searchform').is(':hidden') ){
            $('.searchform').fadeIn()
                .find('input')
                .focus();
        } else {
            $('.searchform').fadeOut();
        }
        
        return false;
    });


    LP.action('collarrowsprev' , function(){
        var $com = $(this).siblings('slide-con');

        return false;
    });

    LP.action('homepage-watch-video' , function(){
        disposeVideo();
        var $dom = $(this);
        var video = $dom.data('video');
        renderVideo( $dom.closest('li') , video , $dom.find('img').attr('src') , {autoplay: true} );
        return false;
    });
});
