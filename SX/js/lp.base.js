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
        var pageInits = {
            'home-page' : function( cb ){
                cb && cb();
            },
            'awards-page': function( cb ){
                cb && cb();
            },
            'contact-page': function( cb ){
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
                var $page = $('.page');
                var fn = pageInits[ $page.data('page') ];

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
                    var stTop = $(window).scrollTop() + headerHeight;
                    var winHeight = $(window).height();

                    // fix up-fadein
                    if( $('.intoview-effect').length ){
                        var index = 0;
                        $('.intoview-effect').each(function(){
                            var $dom = $(this);
                            var offTop = $dom.offset().top;
                            if( !$dom.data('init') && offTop < stTop + winHeight && offTop > stTop ){
                                $dom.data('init' , 1);
                                effects[ $dom.data('effect') ] && effects[ $dom.data('effect') ]( $dom , index , function(){
                                    $dom.removeClass('intoview-effect');
                                } );
                                
                            }
                        });
                    }
                })
                .trigger('scroll');

                // init select
                initSelect( $('select') );

                return false;
            },
            destroy: function(){
                $(window).unbind('scroll');
                $(document.body).unbind('mousemove').css('overflow' , 'auto');
            }
        }
    })();

    
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
                        html = $('<div>' + html + '</div>').find('.container')
                            .html();
                        $( '.container' ).children(':not(.header)').animate({
                            opacity: 0
                        } , 500);
                        setTimeout(function(){
                            $( '.container' ).html( html ).children('.page')
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
    
});
