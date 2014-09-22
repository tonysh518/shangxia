/*
 * page base action
 */
LP.use(['jquery' ,'easing' , '../api'] , function( $ , easing , api ){
    'use strict'

    // LP.use('smoothscroll' , function(){
    //     $('html,body').smoothScroll();
    // });

    // page components here
    // ============================================================================ 
    $.easing.easeLightOutBack = function (x, t, b, c, d, s) {
        if (s == undefined) s = 0.70158;
        return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    }

    var loadPressData = function( year , page , cb ){
        var tpl = '<a href="#" data-a="show-pop" data-d="press=1" class="prolistitem newsitem intoview-effect" data-effect="fadeup">\
                <img src="#[press_image]" width="100%" />\
                <p>#[title]<br /><span class="date">#[date]</span></p>\
              </a>\
              <textarea style="display:none;">\
                <div class="picoperate cs-clear">\
                    <a href="#" class="picopsized" data-a="picopsized"></a>\
                    <a href="#" class="picopsizeup" data-a="picopsizeup"></a>\
                    <a href="#[master_image]" class="picopdown" target="_blank"></a>\
                </div>\
                <div class="pic-press">\
                    <img src="#[master_image]" width="100%" style="margin:0 auto;">\
                </div>\
              </textarea>';
        $.get('/admin/api/content/press?year=' + year + '&page=' + page , function( e ){
            var list = e.data;
            var aHtml = [];
            $.each( list , function( i , press ){
                press.date = press.publish_date;
                aHtml.push( LP.format( tpl , press ) );
            });

            var $dom = $('.press-list[data-year="' + year + '"]');
            $dom.data('page' , page);
            $dom.append( aHtml.join('') );
            if( list.length >= 15 ){
                $dom.data('more-press' , true);
                $('[data-a="loadmore-press"]').show();
            } else {
                $dom.data('more-press' , false);
                $('[data-a="loadmore-press"]').hide();
            }

            cb && cb();
        } , 'json');
    }
    
    var pageManager = (function(){
        var $header = $('.head');
        var pageInits = {
            'home-page' : function( cb ){
                var $slider = $('#home-slider');
                var slideHeight = $slider.children().height();
                var $header = $('.head');
                $(window).scroll(function(){
                    var stTop = $(window).scrollTop();
                    var winHeight = $(window).height();

                    // fix home slider
                    // var mtop = Math.min( stTop , slideHeight / 2 );
                    // $slider
                    //     .css({
                    //         height: slideHeight - 2 * mtop,
                    //         overflow: 'hidden'
                    //     })
                    //     .find('img')
                    //     .css({marginTop: - mtop , marginBottom: - mtop * 2 / 3});
                    // // header fixed effect
                    if( stTop >= $header.offset().top ){
                        $header.find('.head-fixed').css('position' , 'fixed');
                    } else {
                        $header.find('.head-fixed').css('position' , 'static');
                    }
                });


                // init home page slider mouse move event
                var isMoving = false;
                var moveTimer = null;
                $('#homepage-video-slide').mousemove(function(){
                    // judge is ithe video is playing
                    var $item = $(this).find('.slideitem').eq( $(this).find('.slidetab li.on').index() );
                    var $tip = $('#homepage-video-slide').find('.slidetip');
                    var videoObject = $item.data('video-object');
                    clearTimeout( moveTimer );
                    if( !videoObject || videoObject.paused() )  {
                        $tip.stop(true , true).fadeIn();
                        return false;
                    }

                    if( isMoving == false ){
                        $tip.stop(true , true).fadeIn();
                        isMoving = true;
                    }
                    moveTimer = setTimeout(function(){
                        isMoving = false;
                        $tip.stop(true , true).fadeOut();
                    } , 2000);
                });

                cb && cb();
            },
            'craft-page': function( cb ){
                cb && cb();
            },
            "about-page": function( cb ){
                cb && cb();
            },
            "boutique-page":function( cb ){
                $('.footer .store-wrap').hide();
                cb && cb();
            },
            "product-detail": function( cb ){
                var headHeight = $('.head').height();
                var $slider = $('.slide');
                var top = $slider.offset().top;
                $(window).scroll(function(){
                    var st = $(window).scrollTop();

                    if( top - st < headHeight ){
                        $slider.find('.slidebox')
                            .css({
                                marginTop: ( st + headHeight - top ) * 2 / 3,
                                marginBottom: - ( st + headHeight - top ) * 2 / 3
                            });
                    } else {
                        $slider.find('.slidebox')
                            .css({
                                marginTop: 0,
                                marginBottom: 0
                            });
                    }
                });

                cb && cb();
            },
            "news-press": function( cb ){
                var $years = $('.newsoldertime').find('li');
                var lastYear = $years.last().trigger('click').html();
                loadPressData( lastYear , 1 , cb );
                // bind event
                $('.newsoldertime li').click(function(){
                    var year = $.trim( $(this).html() );
                    var $dom = $('.press-list[data-year="' + year + '"]');
                    if( !$dom.children().length ){
                        loadPressData( year , 1 );
                    }
                });
            },
            "contact-page": function( cb ){
                $('input[type="file"]').change(function(){
                    var fileName = this.value.replace(/.*?([^\/\\]+)$/,'$1');
                    $(this).parent().siblings('span').remove();
                    $('<span></span>').appendTo( this.parentNode.parentNode )
                        .html( fileName )
                        .css({
                            position: 'absolute',
                            whiteSpace: 'nowrap',
                            right: 30,
                            bottom: 3,
                            color: '#4b3700'
                        });
                });

                $('input[name="name"],input[name="email"],textarea[name="message"]').keyup(function(){
                    $(this).prev().find('.error').html('');
                });

                $('textarea[name="message"]').keyup(function(){
                    var len = $(this).data('max-length');
                    var tip = $(this).data('max-length-tip');
                    if( this.value.length > len ){
                        $(this).prev().find('.error').html(tip);
                    } else {
                        $(this).prev().find('.error').html('');
                    }
                });

                cb && cb();
            }
        }


        var effects = {
            'fadeup': function( $dom , index , cb ){
                var delay = $dom.data('effect-delay') || 0;
                var tarMarginTop = parseInt( $dom.css('marginTop') ) || 0;
                var marginBottom = parseInt( $dom.css('marginBottom') ) || 0;
                $dom
                    .css({
                        marginTop: tarMarginTop + 150 ,
                        marginBottom: marginBottom - 150,
                    })
                    .delay( 150 * index + delay )
                    .animate({
                        opacity: 1,
                        marginTop: tarMarginTop,
                        marginBottom: marginBottom
                    } , 500 )
                    .promise()
                    .then(function(){
                        cb && cb();
                    });
            }
            // 'number-rock': function( $dom , index , cb , du ){
            //     // init humbers
            //     var num = $dom.text();
            //     var $span = $('<span>' + num + '</span>').appendTo( $dom.html('').data('num' , num) );
            //     var width = $span.width();
            //     var height = $span.height();
            //     $span.css({
            //         height: height,
            //         width: width,
            //         display: 'inline-block',
            //         lineHeight: height + 'px',
            //         position: 'relative',
            //         margin: '0 auto',
            //         overflow: 'hidden',
            //         verticalAlign: 'middle'
            //     }).html('');
            //     $.each( num.split('') , function( i ){
            //         $('<div>' + "1234567890".split('').join('<br/>') + '</div>').appendTo( $span )
            //             .css({
            //                 position: 'absolute',
            //                 left: i * width / num.length,
            //                 top: -~~( Math.random() * 10 ) * height
            //             });
            //     });

            //     // run the animate
            //     var spanHeight = height;//$dom.find('span').height();

            //     var st = new Date();
            //     var duration = du || 1200;
            //     var $divs = $span.find('div');
            //     var interval = setInterval(function(){

            //         if( new Date - st >= duration ){
            //             var num = $dom.data('num');
            //             var nums = num.split('');
            //             $divs.each(function( i ){
            //                 var top = - ( nums[i] - 1 ) * spanHeight ;
            //                 if( nums[i] == 0 ){
            //                     top = - 9 * spanHeight
            //                 }
            //                 $(this).animate({
            //                     'top': top 
            //                 } , 800 , 'easeOutQuart' , function(){
            //                     if( i == nums.length - 1 ){
            //                         //$dom.html( num );
            //                         cb && cb();
            //                     }
            //                 });
            //             });
            //             clearInterval( interval );
            //             return false;
            //         }
            //         $divs.each(function(){
            //             $(this).css('top' , -( Math.random() * 10 ) * spanHeight );
            //         });
            //     } , 1000 / 15);
            // }
        }

        var normalPageLoading = function( $allImgs ){
            var startAnimate = false;
            loadImages( $allImgs , function(){
                loadingMgr.hide( function(){
                    $(window).trigger('resize')
                        .scrollTop(0);
                    window.LOADING = false;
                } );
            } , function( index , total ){
                loadingMgr.process( index , total , function( percent ){
                    if( !startAnimate && percent > 0.7 ){
                        startAnimate = true;
                        $('.nav li ,.hd_oter')
                            .each(function( i ){
                                $(this).css({
                                    opacity: 0,
                                    marginTop: 30
                                }).delay( i * 80 )
                                .animate({
                                    opacity: 1,
                                    marginTop: 0
                                } , 300 , 'easeLightOutBack');
                            });
                    }
                });
            });
        }

        var homePageLoading = function( $allImgs ){
            // disable scroll event
            var startAnimate = false;
            loadImages( $allImgs , function(){

                loadingMgr.hide( function(){

                    var $cloneHeader = $('.loading-wrap .head-inner-wrap')
                    .animate({
                        top: 0,
                        marginTop: -headHeight
                    } , 800);


                    var sliderHeight = $(window).height() - headHeight;

                    // set slider css
                    var $homeSilder = $('#home-slider')
                        .css({
                            height: sliderHeight,
                            overflow: 'hidden'
                        })
                        .find('.slide')
                        .css({
                            height: '100%',
                            marginTop: -sliderHeight
                        })
                        .find('.slidetip,.slidetab')
                        .css({
                            opacity: 0,
                            bottom: 0
                        })
                        .end();

                    var $loadingWrap = $('.loading-wrap');
                    $loadingWrap.stop(true)
                        .animate({
                            top: '100%'
                        } , 800)
                        .promise()
                        .then(function(){
                            // run the animate
                            $homeSilder
                                .animate({
                                    marginTop: 0
                                } , 500)
                                .promise()
                                .then(function(){
                                    $(this).find('.slidetip')
                                        .animate({
                                            opacity: 1,
                                            bottom: 120
                                        } , 300)
                                        .end()
                                        .find('.slidetab')
                                        .animate({
                                            opacity: 1,
                                            bottom: 50
                                        } , 300);
                                });

                            $loadingWrap.fadeOut( function(){
                                $loadingWrap.removeAttr('style')
                                    .find('.loading')
                                    .appendTo( $loadingWrap )
                                    .removeAttr('style')
                                    .prev()
                                    .remove();
                            } );
                        });
                    


                    $(window).trigger('resize')
                        .scrollTop(0);

                    window.LOADING = false;
                } );
            } , function( index , total ){

                loadingMgr.process( index , total , function( percent ){
                    if( !startAnimate && percent > 0.7 ){
                        startAnimate = true;
                        var $cloneHeader = $('.head-inner-wrap').clone()
                            .appendTo( $('.loading-wrap') )
                            .css({
                                marginTop: -63,
                                top: '66%'
                            })
                            // hide logo
                            .find('.logo a')
                            .css('background' , 'none')
                            .end()
                            // animate other menus
                            .find('.nav li ,.hd_oter')
                            .each(function( i ){
                                $(this).css({
                                    opacity: 0,
                                    marginTop: 30
                                }).delay( i * 80 )
                                .animate({
                                    opacity: 1,
                                    marginTop: 0
                                } , 300 , 'easeLightOutBack');
                            })
                            .end();

                        $('.loading-wrap .loading')
                            .appendTo( $cloneHeader.find('.logo a') )
                            .css({
                                top: 23,
                                left: '50%'
                            });
                    }
                } );
            });
        }


        return {
            gotoPage: function( url , type ){
                var urls = url.split('#');
                History.pushState({
                    prev: location.href,
                    hash: urls[1],
                    type: type
                },  undefined , urls[0] );
            },
            init: function(){
                window.LOADING = true;
                loadingMgr.start();
                $('.footer .store-wrap').show();
                var page = $('.head').data('page');
                var fn = pageInits[ page ];

                var $allImgs = $('img');
                var $noPreLoadImgs = $('.slide .slideitem img').filter(function( index ){
                    return index > 0;
                }).add( $('.js-horizontal-slide .slide-con img').filter(function( index ){
                    return index > 2;
                }));

                var noPreLoadImgs = $noPreLoadImgs.toArray();
                $allImgs = $allImgs.filter(function( i ){
                    return $.inArray( this , noPreLoadImgs ) == -1;
                });

                if( fn ){
                    fn( function(){
                        if( page == 'home-page' ){
                            homePageLoading( $allImgs );
                        } else {
                            normalPageLoading( $allImgs );
                        }
                    });
                } else {
                    normalPageLoading( $allImgs );
                }

                // fix common page init
                // for  banpho-img
                var $footer = $('.footer');
                $(window).scroll(function(){
                    var stTop = $(window).scrollTop();
                    var headHeight = $('.head').height();
                    var winHeight = $(window).height();

                    // fix up-fadein
                    if( $('.intoview-effect').length ){
                        var index = 0;
                        $('.intoview-effect').each(function(){
                            var $dom = $(this);
                            var offTop = $dom.offset().top;
                            var domHeight = $dom.height();
                            if( !$dom.data('init') && ( offTop - winHeight < stTop && offTop + domHeight > stTop ) ){
                                $dom.data('init' , 1);

                                if( effects[ $dom.data('effect') ] ){
                                    effects[ $dom.data('effect') ]( $dom , index++ , function(){
                                        $dom.removeClass('intoview-effect');
                                    } );
                                }
                            }
                        });
                    }

                    // fix $('.scroll-lowheight')
                    if( $('.scroll-lowheight') ){
                        $('.scroll-lowheight').css('overflow','hidden').each(function(){
                            var off = $(this).offset();
                            var $item = $(this).find('.scroll-lowheight-item');
                            if( stTop > off.top - headHeight ){
                                $item.css({
                                    //marginTop: ( stTop + headHeight - off.top ) / 2,
                                    marginBottom: -( stTop + headHeight - off.top ) / 2
                                });
                            } else {
                                $item.css({
                                    //marginTop: 0,
                                    marginBottom: 0
                                });
                            }
                        });
                    }
                })
                .trigger('scroll');

                // init slide
                $('.slide').each(function(){
                    initSlider( $(this) );
                });

                // =====================================================================================

                var navPopHoverTimer = null;
                var navPopHoverShowTimer = null;
                // init nav hover effect
                $('.nav1 li').hover(function(){
                    if( window.LOADING ) return;
                    var $li = $(this);
                    clearTimeout( navPopHoverShowTimer );
                    navPopHoverShowTimer = setTimeout(function(){
                        var text = $li.data('type');
                        var $inner = $li.closest('.head-inner');
                        $inner.attr('class' , 'head-inner cs-clear active-' + text );
                        $li.addClass('active');

                        $('.nav-pop-' + text ).stop(true).show()
                            .css('zIndex',99)
                            .animate({
                                top: 110
                            } , 500 , '' , function(){
                                $(this).css('zIndex' , 101);
                            });
                    } , 150);
                } , function(){
                    var $li = $(this);
                    clearTimeout( navPopHoverShowTimer );
                    navPopHoverTimer = setTimeout(function(){
                        $li.removeClass('active');
                        var text = $li.data('type');
                        var $inner = $('.head-inner').attr('class' , 'head-inner cs-clear');

                        $('.nav-pop-' + text ).stop(true)
                            .css('zIndex' , 98)
                            .animate({
                                top: -200
                            } , 500);
                    } , 100);
                });

                $('.nav-pop').hover(function(){
                    clearTimeout( navPopHoverTimer );

                } , function(){
                    clearTimeout( navPopHoverShowTimer );
                    $('.nav1 li.active').trigger('mouseout');
                });



                // =====================================================================================
                // init horizontal slide
                $('.js-horizontal-slide').each(function(){
                    var $dom = $(this);

                    // split content first
                    if( $dom.data('split') ){
                        var $li = $dom.find('.slide-con-inner li');
                        var height = $li.height();
                        var lineHeight = parseInt( $li.css('lineHeight') );
                        var len = Math.ceil( height / ( 5 * lineHeight ) );
                        $li.html( $('<div></div>').html( $li.html() ).height( 5 * lineHeight ).css('overflow' , 'hidden') );
                        for( var i = 1 ; i < len ; i++ ){
                            $li.clone()
                                .appendTo( $li.parent() )
                                .children('div')
                                .append( i == len - 1 ? '<br/><br/><br/><br/><br/>' : '' )
                                .scrollTop( i * 5 * lineHeight );
                        }
                    }


                    var wrapWidth = $dom.width();
                    var num = $(this).data('num') || 3;
                    var $items = $dom.find('.slide-con-inner').children();

                    // 计算每一个item的宽度 
                    var $imgs = $items.find('img');
                    var totalItems = 0;
                    if( $imgs.length ){
                        $imgs.each(function(){
                            totalItems += Math.round( $(this).data('width') / $(this).data('height') ) || 1;
                        });
                    } else {
                        totalItems = $items.length;
                    }
                    

                    var $inner = $dom.find('.slide-con-inner').width( totalItems / num * 100 + '%' );
                    var marginRight = 0.8 /( totalItems / num  );//parseInt( $items.css('margin-right') );
                    var halfMR = marginRight / 2 + '%';
                    var counted = 0;
                    var prev = 0;
                    $items
                        .css('marginRight' , marginRight + '%' )
                        .each(function(){
                        var $this = $(this);
                        var $img = $this.find('img');
                        var indent = Math.round( $img.data('width') / $img.data('height') ) || 1;
                        counted += indent;
                        if( counted % 3 == 0 ){
                            if( indent == 1 && prev == 1 ){ // 111
                                // 第一个margin-left: 0.4%
                                // 最后一个margin-right: 0.4 %
                                $this
                                .css('marginRight' , halfMR)
                                .prev()
                                .prev()
                                .css({
                                    marginLeft: halfMR ,
                                    marginRight: marginRight + '%'
                                });
                            } else if( indent == 3 ) { // 3
                                $this.css({
                                    marginLeft: halfMR,
                                    marginRight: halfMR
                                });
                            } else { // 21 || 12
                                $this.css('marginRight' , halfMR)
                                    .prev()
                                    .css({
                                        'marginLeft': halfMR,
                                        'marginRight': marginRight + '%'
                                    });
                            }
                        } else if( ( counted - indent ) % 3 == 0 ){
                            $this.css({
                                marginLeft: halfMR ,
                                marginRight: halfMR
                            });
                        }

                        $this.width( indent /  totalItems * 100 - marginRight + '%' );
                        prev = indent;
                    });

                    var total = $items.length;
                    $dom.find('.collarrowsprev')
                        .fadeOut()
                        .click(function(){
                            var ml = parseInt( $inner.css('marginLeft') ) || 0;
                            if( ml == 0 ) return false;

                            var mleft = -Math.round( Math.abs( ml ) / $inner.parent().width() - 1 );
                            $inner.animate({
                                marginLeft: mleft * 100 + '%'
                            } , 500);

                            if( mleft == 0 ){
                                // hide current btn
                                $(this).fadeOut();
                            }

                            // show next btn
                            $dom.find('.collarrowsnext').fadeIn();

                            $(window).trigger('scroll');
                    })
                    .end()
                    .find('.collarrowsnext')
                    [ totalItems > num ? 'show' : 'hide' ]()
                    .click(function(){
                        var ml = parseInt( $inner.css('marginLeft') ) || 0;
                        var outerWidth = $inner.parent().width();
                        var innerWidth = $inner.width();
                        if( Math.abs( ml ) >= innerWidth - outerWidth - 100 ) return false;
                        var mleft = -Math.round( Math.abs( ml ) / outerWidth + 1 );
                        $inner.animate({
                            marginLeft: mleft * 100 + '%'
                        } , 500 );

                        if( Math.abs( parseInt( $inner.css('marginLeft') ) ) + outerWidth >= innerWidth - outerWidth - 100 ){
                            // hide current btn
                            $(this).fadeOut();
                        }

                        // show pre btn
                        $dom.find('.collarrowsprev').fadeIn();

                        $(window).trigger('scroll');
                    });
                });

                // render map
                $('[data-map]').each(function(){
                    mapHelper.render( $(this) );
                });

                // render video
                $('[data-video-render]').each(function(){
                    // fix video image
                    var $dom = $(this).css({
                        position: 'relative',
                        overflow: 'hidden'
                    });

                    fixImageToWrap( $dom , $dom.find('img') );

                    var poster = $dom.find('img').attr('src');
                    renderVideo( $dom , $dom.data('mp4') , $dom.data('webm') , poster , {pause_button: true} );
                });

                // render initHoverMoveEffect
                $('.inout-effect').each(function(){
                    initHoverMoveEffect( $(this) );
                });

                 // nav-pop-item inout-effect
                $('.nav-pop-item.inout-effect').hover(function(){
                    $(this).find('span:not(.inout-bg)').stop(true , true).fadeOut(700);
                } , function(){
                    $(this).find('span:not(.inout-bg)').stop(true , true ).fadeIn(700);
                });


                
                var isRunning = false;
                // init nav pop mouse move event
                $('.nav-pop-collections .nav-pop-wrap').mousemove(function( ev ){
                    if( $(this).children().length < 4 ) return;
                    var winWidth = $(window).width();
                    var off = $(this).offset();
                    var $item = $(this).children().first();
                    if( ev.pageX / winWidth < 0.7 && ( ev.pageX - off.left ) / winWidth > 0.3 ){
                        isRunning = false;
                        $item.stop( true );
                    } else {
                        if( isRunning ) return;
                        if( ev.pageX / winWidth > 0.7 ){
                            isRunning = true;
                            $item.stop( true )
                                .animate({
                                    marginLeft: '-16%'
                                } , 500);
                            } else {
                                isRunning = true;
                                $item.stop( true )
                                    .animate({
                                        marginLeft: '0.6%'
                                    } , 500);
                            }
                    }
                    // if( ev.pageX / winWidth > 0.7 && !isRunning ){
                    //     console.log( 'right' );
                    //     isRunning = true;
                    //     $item.stop( true )
                    //         .animate({
                    //             marginLeft: '-16%'
                    //         } , 500);
                    // } else if( ( ev.pageX - off.left ) / winWidth < 0.3 && !isRunning ){
                    //     console.log( 'left' );
                    //     isRunning = true;
                    //     $item.stop( true )
                    //         .animate({
                    //             marginLeft: 0
                    //         } , 500);
                    // } else {
                    //     console.log( 'stop' );
                    //     isRunning = false;
                    //     $item.stop( true );
                    // }
                });

                return false;
            },
            destroy: function(){
                $(window).unbind('scroll');
                $(document.body).unbind('mousemove');
            }
        }
    })();


    var loadingMgr = (function(){
        var $loading = $('.loading-wrap');
        // if( !$loading.length )
        //     $loading = $('<div class="loading-wrap"><div class="loading loading_small"></div></div>')
        //         .appendTo(document.body);

        var $loadingInner = $loading.find('.loading');
        // var positions = [-44,-142,-240,-338,-436,-534];
        // var interval = null;

        // var colors = {
        //     'black': 'rgba(0,0,0,.85)'
        // }
        var MAX_STEPS = 59;
        // var IMG_WIDTH = 57.9;
        // var IMG_HEIGHT = 56.2;
        var IMG_WIDTH = 103;
        var IMG_HEIGHT = 100;
        var current = 0;
        var target = 10;
        var interval;
        var stepCallBack = null;

        var isHomePage = false;
        var isToStart = false;
        return {
            process: function( index , total , cb ){
                stepCallBack = cb;
                target = Math.max( target , Math.round( index / total * MAX_STEPS ) );
            },
            start: function( ){
                current = 0;
                clearInterval( interval );
                var page = $('.head').data('page');
                interval = setInterval( function(){
                    if( current >= target ) return;
                    current++;


                    stepCallBack && stepCallBack( current / MAX_STEPS );

                    if( page == 'home-page' && current < 10 ){
                        $loadingInner.css('top' , 30 + current * 4 + '%' );
                    }

                    var x = ( ( current % 10 - 10 ) % 10 ) *  IMG_WIDTH;
                    var y = -~~( ( current - 1 ) / 10 ) * IMG_HEIGHT;
                    $loadingInner
                        .css('background-position' , x + 'px ' + y + 'px'  );
                } , 50 );
            },
            show: function( isNormal ){
                $(document.body).css('overflow' , 'hidden');

                if( !$loading.is(':visible') ){
                    $loading
                        .removeAttr('style')
                        .fadeIn();    
                }

                $loadingInner
                    .removeAttr('style');

                isHomePage = !isNormal;
                if( isNormal ){
                    $loadingInner.appendTo( $('.logo a').css('background' , 'none') )
                        .css('top' , 23 );
                    $loading.css('zIndex' , 90);
                    // fade out other navs
                    $('.nav li,.hd_oter').each(function( i ){
                        $(this).delay(i * 100)
                            .animate({
                                marginTop: 30,
                                opacity: 0
                            } , 200);
                    });
                }

            },
            hide: function( cb ){
                var timer = setInterval(function(){
                    if( current == MAX_STEPS ){
                        clearInterval( timer );
                        clearInterval( interval );
                        $(document.body).css('overflow' , 'auto');

                        if( !isHomePage ){
                            $loadingInner.appendTo( $loading.fadeOut() );
                            $('.logo a').removeAttr('style');
                        }
                        cb && cb();
                    }
                } , 200);
            }
        }
    })();

    function initSlider( $wrap , config ){
        var $slidebox = $wrap.find('.slidebox');
        var $slidetabs = $wrap.find('.slidetab li');
        // if( $slidetabs.length == 1 ){
        //     $slidetabs.hide();
        // }
        var currentIndex = 0;
        var length = $slidebox.children().length;
        var isAbs = $wrap.data('slide') == 'absolute';
        if( isAbs ){
            $slidebox.children().find('img')
                .eq(0)
                .load(function(){
                    $wrap.height( this.height );
                });
            $(window).resize(function(){
                $wrap.height( 
                    $slidebox.children().find('img')
                        .eq(0).height() );
            });

            $slidebox.children().css({
                position: 'absolute',
                width: '100%',
                left:0,
                top: 0,
                zIndex: 0
            })
            .eq(0)
            .css('zIndex' , 1);


            $slidetabs.click(function(){

                if( $(this).hasClass('on') ) return false;
                if( $slidebox.find('.video-wrap').length ){
                    disposeVideo();
                    // change btn text
                    var $btn = $('a[data-a="homepage-watch-video"]');
                    $btn.find('i').html( $btn.data('play-text') + '<br/><br/>' + $btn.data('pause-text') );
                }

                var lastIndex = $slidetabs.filter('.on').index();
                $(this).addClass('on')
                    .siblings()
                    .removeClass('on');

                var index = $(this).index();

                $slidebox.children().eq( index )
                    .css({'zIndex': 2 , left: lastIndex > index ? '-100%' : '100%'})
                    .stop(true)
                    .animate({
                        left: 0
                    } , 400 , function(){
                        $(this).css('zIndex' , 1)
                            .siblings()
                            .css('zIndex' , 0);
                    } );

                return false;
            });
        } else {
            $slidebox.css( 'width' , length * 100 + '%' )
                .children()
                .css('width' , 1 / length * 100 + '%' );

            $slidetabs.click(function(){
                $(this).addClass('on')
                    .siblings()
                    .removeClass('on');


                start_time = +new Date();

                var index = $(this).index();
                $slidebox.stop(true).animate({
                    marginLeft: - index * 100 + '%'
                } , 400 );

                return false;
            });
        }
        var start_time = 0;

        if( $wrap.data('auto') !== false ){
            $wrap.data('interval' , setInterval(function(){
                if( new Date() - start_time < 4000 ) return;
                var $next = $slidetabs.filter('.on').next();
                if( $next.length ){
                    $next.trigger('click');
                } else {
                    $slidetabs.eq(0).trigger('click');
                }
            } , 5000) );
        }
    }


    function disposeVideo(){
        $(document.body).find('.video-wrap').parent()
            .each(function(){
                var video = $(this).data('video-object');
                try{video && video.dispose();}catch(e){}
                $(this).removeData('video-object').find('.video-wrap').remove();
            });
    }

    function loadImages( $img , cb , step ){
        var index = 0 ;
        var length = $img.length;
        if( length == 0 ){
            step && step( 1 , 1 );
            cb && cb();
        }
        $img.each(function(){
            $('<img/>').load(function(){
                index ++;
                step && step( index , length );
                if( index == length ){
                    cb && cb();
                }
            })
            .error(function(){
                index ++;
                step && step( index , length );
                if( index == length ){
                    cb && cb();
                }
            })
            .attr('src' , this.getAttribute('src'));
        });
    }


    function fixImageToWrap( $wrap , $img ){
        if( !$img.width() ){
            $img.load(function(){
                fixImageToWrap( $wrap , $img );
            });
            return ;
        }
        var ratio = $img.height() / $img.width();
        var w = $wrap.width()  ;
        var h = $wrap.height() ;
        var vh = 0 ;
        var vw = 0 ;
        var exp = 0;
        if( h / w > ratio ){
            vh = h + exp;
            vw = vh / ratio;
        } else {
            vw = w + exp;
            vh = vw * ratio;
        }

        $img.css({
            width: vw,
            height: vh,
            marginTop: ( h - vh ) / 2,
            marginLeft: ( w - vw ) / 2
        });
    }

    function renderVideo ( $wrap , mp4 , webm , poster , config , cb ){
        var id = 'video-js-' + ( $.guid++ );
        $wrap.append( LP.format( '<div class="video-wrap" ><video id="#[id]" style="width: 100%;height: 100%;" class="video-js vjs-default-skin"\
            preload="auto"\
              poster="#[poster]">\
             <source src="#[mp4]" type="video/mp4" />\
             <source src="#[webm]" type="video/webm" />\
        </video></div>' , {id: id  , mp4: mp4 , webm: webm , poster: poster}));

        config = $.extend( { "controls": false, "muted": false, "autoplay": false, "preload": "auto","loop": true, "children": {"loadingSpinner": false} } , config || {} );
        var ratio = config.ratio || 9/16;

        var getSize = function(){
            var w = $wrap.width()  ;
            var h = $wrap.height() ;
            var vh = 0 ;
            var vw = 0 ;
            var exp = 0;
            if( h / w > ratio ){
                vh = h + exp;
                vw = vh / ratio;
            } else {
                vw = w + exp;
                vh = vw * ratio;
            }

            return {
                h: h,
                w: w,
                width: vw,
                height: vh
            }
        }
        var size = getSize();

        config.width = size.width;
        config.height = size.height;
        if( window.navigator.userAgent.indexOf('Firefox') >= 0 ){
            config['techOrder'] = ['flash'];
        }
        
        LP.use('video-js' , function(){
            var is_playing = false;
            videojs.options.flash.swf = "/js/video-js/video-js.swf";
            var myVideo = videojs( id , config , function(){
                var v = this;
                if( config.resize !== false ){
                    var resizeFn = function(){
                        var size = getSize();
                        console.log( size );
                        try{v.dimensions( size.width , size.height );}catch(e){}

                        // var w = $wrap.width()  ;
                        // var h = $wrap.height() ;
                        // var vh = 0 ;
                        // var vw = 0 ;
                        // var exp = 0;
                        // if( h / w > ratio ){
                        //     vh = h + exp;
                        //     vw = vh / ratio;
                        // } else {
                        //     vw = w + exp;
                        //     vh = vw * ratio;
                        // }

                        // try{v.dimensions( vw , vh );}catch(e){}
                        console.log( v.Q );
                        $('#' + v.Q).css({
                            "margin-top": ( size.h -  size.height ) / 2,
                            "margin-left": ( size.w - size.width ) / 2
                        });
                        return false;
                    }
                    $(window).bind( 'resize.video-' + id , resizeFn )
                        .trigger('resize.video-' + id);

                    $wrap.bind('resize.video-' + id , resizeFn);
                }
                setTimeout(function(){
                    $wrap.find('.video-wrap').show();
                    if( config.autoplay ){
                        try{myVideo.play();}catch(e){}
                    } else if( config.pause_button ){
                        $wrap.find('.vjs-big-play-button').fadeIn();
                    }
                } , 20);

                // if need to add pause button
                if( config.pause_button ){
                    $('<div></div>').insertBefore($wrap.find('.vjs-poster').fadeIn() )
                        .css({
                            position: 'absolute',
                            top: 0,
                            left:0,
                            width: '100%',
                            height: '100%'
                        });
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

    /* init hover effect */
    function initHoverMoveEffect( $dom , hoverin , hoverout ){
        if( $dom.data('initHoverMoveEffect') ) return;
        $dom.data('initHoverMoveEffect' , 1);
        var $bg = $dom.find('.inout-bg');
        $dom.css('position','relative');

        $dom.hover(function( ev ){
            var width = $dom.width();
            var height = $dom.height();

            var off = $dom.offset();
            var topOff = ev.pageY - off.top;
            var leftOff = ev.pageX - off.left;
            var bottomOff = height + off.top - ev.pageY;
            var rightOff = width + off.left - ev.pageX;

            var min = Math.min( topOff , leftOff , bottomOff , rightOff );
            var ori = null;
            var tar = null;
            if( min == topOff ){ // from top 
                ori = { left: 0,top: '-100%'};
                tar = { top: 0 };
            } else if( min == leftOff ){
                ori = { left: '-100%',top: 0};
                tar = { left: 0 };
            } else if( min == bottomOff ){
                ori = { left: 0,top: '100%'};
                tar = { top: 0 };
            } else {
                ori = { left: '100%',top: 0};
                tar = { left: 0 };
            }
            $bg.css( ori ).stop( true )
                .animate( tar , 500 );

            hoverin && hoverin();
        } , function( ev ){
            var width = $dom.width();
            var height = $dom.height();

            var off = $dom.offset();
            var topOff = ev.pageY - off.top;
            var leftOff = ev.pageX - off.left;
            var bottomOff = height + off.top - ev.pageY;
            var rightOff = width + off.left - ev.pageX;

            var min = Math.min( topOff , leftOff , bottomOff , rightOff );
            var ori = null;
            var tar = null;
            if( min == topOff ){ // from top 
                ori = { left: 0,top: '-100%'};
                tar = { top: 0 };
            } else if( min == leftOff ){
                ori = { left: '-100%',top: 0};
                tar = { left: 0 };
            } else if( min == bottomOff ){
                ori = { left: 0,top: '100%'};
                tar = { top: 0 };
            } else {
                ori = { left: '100%',top: 0};
                tar = { left: 0 };
            }
            $bg.stop( true )
                .animate( ori , 500 );

            hoverout && hoverout();
        });
    }

    var mapHelper = (function(){
        return {
            render: function( $dom ){
                var point = $dom.data('map').split(',');
                if( $dom.data('map-type') == 'google' ){ // use baidu
                    this.renderGoogle( $dom , point );
                } else {
                    this.renderBaidu( $dom , point );
                }
                $dom.removeAttr('data-map');
            },
            renderBaidu: function( $dom , point ){
                point[0] = point[0] || 0;
                point[1] = point[1] || 0;
                // var html = '<img class="map-marker" src="#[markerPath]" />\
                //     <img src="http://api.map.baidu.com/staticimage?center=#[pointer]&width=#[width]&height=#[height]&zoom=11" />';
                // $dom.html( LP.format( html , {
                //     markerPath: SOURCE_PATH + '/images/map-marker.png',
                //     pointer: point.join(','),
                //     width: $dom.width(),
                //     height: $dom.height()
                // } ) );

                var id = $dom.attr('id') || 'baidu-map-' + ( + new Date() );
                $dom.attr( 'id' , id ) ;
                if( !window.BMap ){
                    var _LP = window.LP;
                    LP.use('http://api0.map.bdimg.com/getscript?v=2.0&ak=AwxxvHue9bTdFietVWM4PLtk&services=&t=20140725172530' , function(){
                        window.LP = _LP;
                    });
                }
                var interval = setInterval(function(){
                    if( window.BMap ){
                        clearInterval( interval );
                        var oMap = new BMap.Map( id );
                        oMap.addControl(new BMap.NavigationControl());
                        point = new BMap.Point( point[0] , point[1] );
                        oMap.centerAndZoom(point, 15);
                        oMap.setMapStyle({
                          styleJson:[
          {
                    "featureType": "all",
                    "elementType": "geometry.fill",
                    "stylers": {
                              "lightness": 13,
                              "saturation": -100
                    }
          },
          {
                    "featureType": "road",
                    "elementType": "geometry.stroke",
                    "stylers": {
                              "color": "#cac4b5"
                    }
          },
          {
                    "featureType": "building",
                    "elementType": "all",
                    "stylers": {
                              "color": "#9e927a"
                    }
          },
          {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": {
                              "color": "#9e927a"
                    }
          },
          {
                    "featureType": "administrative",
                    "elementType": "labels.text.stroke",
                    "stylers": {
                              "color": "#ffffff",
                              "saturation": 100
                    }
          },
          {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": {
                              "color": "#9e927a"
                    }
          },
          {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": {
                              "color": "#ffffff"
                    }
          }
]
                        });

                        var myIcon = new BMap.Icon("/images/marker.png", new BMap.Size(34,40));
                        var marker2 = new BMap.Marker(point,{icon:myIcon});  // 创建标注
                        oMap.addOverlay(marker2);              // 将标注添加到地图中
                    }
                } , 100 );
            },
            renderGoogle: function( $dom , point ){
                if( !window.google ) return;
                point[0] = point[0] || 0;
                point[1] = point[1] || 0;


                var map = new google.maps.Map($dom[0],{
                    center: new google.maps.LatLng(point[0],point[1]),
                    zoom:17,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                });


                var styleArray = [
                  {
                    featureType: "all",
                    stylers: [
                      { saturation: -80 }
                    ]
                  },{
                    featureType: "road.arterial",
                    elementType: "geometry",
                    stylers: [
                      { hue: "#4b3700" },
                      { saturation: 50 }
                    ]
                  },{
                    featureType: "all",
                    elementType: "labels.text.stroke",
                    stylers: [
                      { hue: "#4b3700" },
                      { saturation: 50 }
                    ]                
                  }
                ];
                map.setOptions({styles: styleArray});

                new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(point[0],point[1]),
                    icon: "/images/marker.png"
                });

                // var map = new google.maps.Map($dom[0],{
                //     center: new google.maps.LatLng(point[0],point[1]),
                //     zoom:5,
                //     mapTypeId:google.maps.MapTypeId.ROADMAP
                // });

                // new google.maps.Marker({
                //     map: map,
                //     position: new google.maps.LatLng(point[0],point[1])
                //   });
            }
        }
    })();


    var popHelper = (function(){
        var tpl ='<div class="popshade"></div>\
            <div class="pop">\
                <div class="popclose" data-a="popclose"></div>\
                <div class="popcon transition">#[con]</div>\
            </div>';
        return {
            show: function( con , data ){
                data = data || {};
                var html = LP.format( tpl , { con: con } );
                var $pop = $( html )
                    .appendTo( document.body )
                    .hide()
                    .fadeIn( function(){
                        $(this).find('.popcon')
                            .addClass( 'popcon-show' );
                    } );
                if( data.press ){
                    $pop.find('.popcon')
                        .css({
                            width: '100%',
                            padding: 0,
                            textAlign: 'center'
                        });
                }

                $('html,body').css('overflow' , 'hidden');
            },
            hide: function(){
                var $pop = $('.pop').fadeOut( function(){
                    $(this).remove();
                } );
                $('.popshade').fadeOut( function(){
                    $(this).remove();
                } );

                $('html,body').css('overflow' , 'auto');
            }
        }
    })();

    // page init here
    // ==============================================================================

    // init map
    // var _LP = window.LP;
    // LP.use('http://api0.map.bdimg.com/getscript?v=2.0&ak=AwxxvHue9bTdFietVWM4PLtk&services=&t=20140725172530' , function(){
    //     window.LP = _LP;
    // });
    // var interval = setInterval(function(){
    //     if( window.BMap ){
    //         clearInterval( interval );
    //         var oMap = new BMap.Map("map");
    //         oMap.addControl(new BMap.NavigationControl());
    //         var point = new BMap.Point(121.478988,31.227919);
    //         oMap.centerAndZoom(point, 15);
    //         //oMap.setMapStyle({style: 'grayscale'});
    //         // oMap.setMapStyle({
    //         //   styleJson:[{
    //         //     "featureType": "all",
    //         //     "elementType": "all",
    //         //     "stylers": {
    //         //       "lightness": 13,
    //         //       "saturation": -100
    //         //     }
    //         //   }]
    //         // });
    //     }
    // } , 100 );

    // var map=new google.maps.Map(document.getElementById( 'google-map' ),{
    //     center:new google.maps.LatLng(51.508742,-0.120850),
    //     zoom:5,
    //     mapTypeId:google.maps.MapTypeId.ROADMAP
    // });
    $(document).click(function( ev ){
        if ( $(ev.target).closest('.searchform').length || $(ev.target).hasClass('hd_search') ){
            return;
        }
        if( $('.searchform').is(':visible') )
            $('.searchform').fadeOut();

    });

    var headHeight = $('.head').height();

    $(window).resize(function(){
        var winWidth = $(window).width();
        var winHeight = $(window).height();

        // fix home slider
        $('#home-slider').height( winHeight - headHeight )
            .find('.slideitem')
            .each(function(){
                // fix image size
                fixImageToWrap( $(this) , $(this).find('img') );
            });
        

        // fix slidetab marginleft
        $('.slidetab').each(function(){
            $(this).css('marginLeft' , - $(this).width() / 2);
        });

        // fix height
        // $('.knowhowintro').each(function(){
        //     var h = $(this).parent('.knowhowitem').children('.knowhowpic').height()
        //     $(this).css('padding-top' , (h - $(this).height())/2)
        // })
        $('.knowhowintro').each(function(){
            var h = $(this).parent('.knowhowitem').children('.knowhowpic').height()
            $(this).css('height' , h);
            var $wrap = $(this).children('.cwrap');
            $wrap.css('padding-top' , (h - $wrap.height())/2);
        });
        $('.proinfortxt').each(function(){
            var h = $(this).next('.proinforpic').height();
            $(this).height( h );
            $(this).find('.proinfortxt-inner')
                .css({
                    marginBottom: 30,
                    overflow: 'hidden',
                    height: h - 220
                });
        });

        $('.picinfortxt').each(function(){
            var $this = $(this);
            var $picWrap = $(this).next('.picinforpic');
            loadImages( $picWrap.find('img') , function(){
                var h = $picWrap.height();
                $this.height( h - 50 ).css({
                    overflow: 'hidden',
                    paddingBottom: 50
                })
                .find('.picinfortxt-inner').height( h - 100 )
                    .css('overflow' , 'hidden');
            } )
            // var h = $(this).next('.picinforpic').height();
            // $(this).height( h - 50 ).css({
            //     overflow: 'hidden',
            //     paddingBottom: 50
            // });
            // $(this).find('.picinfortxt-inner').height( h - 100 )
            //     .css('overflow' , 'hidden');
        });

        $('.aboutinfortxt').each(function(){
            var h = $(this).next('.proinforpic').height();
            $(this).height( h - 80 )
                .find('.picinfortxt-inner')
                .css({
                    height: h - 280,
                    marginBottom: 40
                });
        });


        var prevHeight = $('.storemap').prev().outerHeight();
        $('.storemap').css( 'height' , prevHeight );
        // $('.storemap').css({
        //     height: 0.70 * prevHeight,
        //     marginTop: 0.15 * prevHeight
        // });

        // fix resize:
        $('[data-resize]').each(function(){
            var val = $(this).data('resize');
            val = val.split(':');
            var height = winWidth / val[0] * val[1];
            $(this).css({
                height: height
            });
            fixImageToWrap( $(this) , $(this).find('img') );
        });
    })
    .keyup(function( ev ){
        switch( ev.which ){
            case 27:
                var dom = $('.pop .popclose').get(0);
                dom && dom.click();
                break;
        }
    });
    // change history
    LP.use('../plugin/history.js' , function(){
        History.replaceState( { prev: '' } , undefined , location.href  );

        var isHomePage = ( location.pathname == '' || location.pathname == '/' || location.pathname == '/index.php' );
        loadingMgr.show( !isHomePage );
        pageManager.init( );

        $(document).ajaxError(function(){
            loadingMgr.hide();
        });
        // Bind to StateChange Event
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate

            var State = History.getState(); // Note: We are using History.getState() instead of event.state
            var prev = State.data.prev;
            var type = State.data.type;
            var hash = State.data.hash;
            // if only change hash
            if( State.url.indexOf('##') >= 0 ){
                return false;
            }
            // hid head pop
            $('.nav1 li.active').trigger('mouseout');

            // show loading
            var isHomePage = ( location.pathname == '' || location.pathname == '/' || location.pathname == '/index.php' );
            loadingMgr.show( !isHomePage );


            switch( type ){
                default: 
                    $.get( location.href , '' , function( html ){
                        var $newPage = $('<div>' + html + '</div>');

                        var bodyClass = $newPage.find('body').attr('class');
                        var page = $newPage.find('.head').data('page');
                        $('.head').data('page' , page || '');
                        $(document.body).attr('class' , bodyClass || '');

                        html = $newPage.find('.wrap')
                            .find( isHomePage ? '.footer' : '.footer,.head' )
                            .remove()
                            .end()
                            .html();
                        $( '.wrap' ).children(isHomePage ? ':not(.footer)' : ':not(.footer,.head)').animate({
                            opacity: 0
                        } , 500);

                        setTimeout(function(){
                            $('#home-slider').remove();
                            $( '.wrap' ).children( isHomePage ? ':not(.footer)' : ':not(.footer,.head)' )
                                .remove();
                            $(html).insertBefore( $('.footer') );
                            $( '.wrap' )
                                .children( isHomePage? '' : ':not(.head)')
                                .fadeIn();
                            //pagetitarrbottom

                            var sttop = 0;
                            if( hash ){
                                location.hash = hash;
                                var $a = $('a[name="' + hash + '"]'); 
                                sttop = $a.length && $a.offset().top - headHeight;
                            }
                            $('html,body').animate({
                                scrollTop: sttop || 0
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
    // LP.action('nav-pop' , function( data ){
        
    //     var text = data.type;
    //     var $inner = $(this).closest('.head-inner');
    //     $inner.attr('class' , 'head-inner cs-clear active-' + text );
        
    //     if( $('.nav-pop-' + text ).is(':visible') ){
    //         LP.triggerAction('nav-mask');
    //         return false;
    //     }
    //     $('.head .nav li').removeClass('active');
    //     $(this).closest('li').addClass('active');

    //     $('.nav-pop').fadeOut();
    //     $('.nav-pop-' + text ).stop(true , true).fadeIn();
    //     $('.nav-mask').fadeIn();
    //     return false;
    // });

    // LP.action('nav-mask' , function(){
    //     var $inner = $('.head-inner').attr('class' , 'head-inner cs-clear');
    //     $('.head-inner').find('li.active').removeClass('active');
    //     $('.nav-pop').fadeOut();
    //     $('.nav-mask').fadeOut();

    //     return false;
    // });

    LP.action('nav-link' , function(){
        if( $('html').hasClass('no-history') ) return;
        disposeVideo();
        // load next page
        var lhref = location.href;
        var href = $(this).attr('href');

        if( href.indexOf('#') >= 0 ){
            var hrefs = href.split('#');
            if( lhref.indexOf( hrefs[0] ) >= 0 ){
                $('html,body').animate({
                    scrollTop: $('a[name="' + hrefs[1] + '"]').offset().top - 130
                } , 300 );
                return false;
            }
        } else if( lhref.match( new RegExp( href + '$' ) ) ){ // 如果是同一个页面
            History.Adapter.trigger( window , 'statechange');
            return false;
        }

        if( $('#home-slider').length ){
            $('html,body').animate({
                scrollTop: $('#home-slider').height()
            } , 400)
            .promise()
            .then(function(){
                $(this).scrollTop(0);
                $('#home-slider').remove();
                $('.head-fixed').removeAttr('style');

                pageManager.gotoPage( href );
            });
        } else {
            pageManager.gotoPage( href );
        }

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


    LP.action('render-foot-map' , function( data ){
        switch( data.type ){
            case 'beijing':
                $('#map').css('z-index' , 2);
                $('#google-map').css('z-index' , 1);
                break;
            case 'paris':
                $('#map').css('z-index' , 1);
                $('#google-map').css('z-index' , 2);
                break;
        }

        return false;
    });
    

    LP.action('homepage-watch-video' , function(){
        var $dom = $(this);
        var playText = $dom.data('play-text');
        var pauseText = $dom.data('pause-text');
        var $tip = $dom.closest('.slidetip-wrap');
        
        var index = $tip.next().find('.on').index();
        var $li = $tip.prev().children().eq( index );
        var stopHtml = playText + '<br><br>' + playText;
        var playHtml = pauseText + '<br><br>' + pauseText;

        if( $li.find('.video-wrap').length ){
            var obj = $li.data('video-object');
            var isPaused = obj.paused();
            obj[ isPaused ? 'play' : 'pause' ]();

            $dom.find('i').html( isPaused ? playHtml : stopHtml );
        } else {
            disposeVideo();
            renderVideo( $li , $li.data('mp4') , $li.data('webm') , $li.find('img').attr('src') , {autoplay: true} );
            $dom.find('i').html( playHtml );
        }

        return false;
    });


    LP.action('page-prev' , function(){
        var href = location.href;
        var $links = $('.sitelinkitem a');
        $links.each(function( i ){
            var h = $(this).attr('href');
            h = h.replace(/.\/|..\//g , '');
            if( href.indexOf( h ) >= 0 ){
                var $link = $links.eq( i - 1 );
                $link[0] && $link[0].click();
                return false;
            }
        });
    });

    LP.action('page-next' , function(){
        var href = location.href;
        var $links = $('.sitelinkitem a');
        $links.each(function( i ){
            var h = $(this).attr('href');
            h = h.replace(/.\/|..\//g , '');
            if( href.indexOf( h ) >= 0 ){
                var $link = $links.eq( i + 1 );
                $link[0] && $link[0].click();
                return false;
            }
        });
    });


    LP.action('show-pop' , function( data ){
        if ($(this).siblings('textarea').size() > 0) {
          popHelper.show( $(this).siblings('textarea').val() , data );
        }
        else {
          popHelper.show($(this).parent().siblings().find("textarea").val(), data );
        }
        return false;
    });

    LP.action('popclose' , function(){
        popHelper.hide();
        return false;
    });

    LP.action('home-collarrowsprev' , function(){
        var $slider = $(this).parent();
        var $li = $slider.find('.slidetab li.on');
        var $prev = $li.prev();
        $prev.length ? $prev.trigger('click') : $slider.find('.slidetab li').last().trigger('click');
        // change the tit
        var index = $li.index() - 1;
        if( !$prev.length ){
            index = $slider.find('.slidebox li').length - 1;
        }
        var $item = $slider.find('.slidebox li').eq( index );

        $slider.find('.slidetip2-tit').html( $item.data('tit') )
            .end()
            .find('.slidetip2-index')
            .html( ( index + 1 ) + '/' + $slider.find(".slidebox").children().length );

        return false;
    });

    LP.action('home-collarrowsnext' , function(){
        var $slider = $(this).parent();
        var $li = $slider.find('.slidetab li.on');
        var $next = $(this).parent().find('.slidetab li.on').next();
        $next.length ? $next.trigger('click') : $(this).parent().find('.slidetab li').first().trigger('click');

        // change the tit
        var index = $li.index() + 1;
        if( !$next.length ){
            index = 0;
        }
        var $item = $slider.find('.slidebox li').eq( index );

        $slider.find('.slidetip2-tit').html( $item.data('tit') )
            .end()
            .find('.slidetip2-index')
            .html( ( index + 1 ) + '/' + $slider.find(".slidebox").children().length );
        return false;
    });

    // LP.action('pop-press-item' , function(){
    //     var tpl = '<div class="popshade"></div>\
    //             <div class="pop">\
    //                 <div class="popclose" data-a="popclose"></div>\
    //                 <div class="poppiccon">\
    //                     <div class="picoperate cs-clear">\
    //                         <a href="#" class="picopsized"></a>\
    //                         <a href="#" class="picopsizeup"></a>\
    //                         <a href="#" class="picopdown"></a>\
    //                     </div>\
    //                     <img src="#[img]" alt="">\
    //                 </div>\
    //             </div>';
    //     var html = LP.format( tpl , {img: $(this).data('press')} );
    //     $(html).appendTo( document.body ).hide().fadeIn();

    //     return false;
    // });

    LP.action('newsletter' , function(){
        popHelper.show( $('#newsletter').html() );
        return false;
    });

    LP.action('i-want-to-buy' , function( data ){
        popHelper.show( LP.format( $('#i_want_to_buy').html() , data ) );
        LP.use('form' , function(){
            $('.pop form').ajaxSubmit({
                type: 'post',
                dataType: 'json',
                success: function( data ){
                    console.log( data );
                }
            });
        });
        return false;
    });

    LP.action('newsletter-send' , function(){
        var $pop = $(this).closest('.pop');
        $pop.find('#name-tip,#email-tip,#phone-tip').html('');
        var $form = $(this).closest('form');
        var data = LP.query2json( $form.serialize() );
        var error = false;
        if( !data.name ){
            $pop.find('#name-tip').html( $pop.find('input[name="name"]').data('required') );
            error = true;
        }
        if( !data.email || !data.email.match( /[a-zA-Z0-9\-\._]+@(\w+\.)+\w+/ ) ){
            $pop.find('#email-tip').html( $pop.find('input[name="email"]').data('required') );
            error = true;
        }

        if( !data.phone ){
            $pop.find('#phone-tip').html( $pop.find('input[name="phone"]').data('required') );
            error = true;
        }
        if( error ){
            return false;
        }
        LP.use('form' , function(){
            $form.ajaxSubmit({
                type: 'post',
                dataType: 'json',
                success: function( data ){
                    if( data.status == 0 ){
                        alert('submit success');
                        $pop.find('.popclose')[0].click();
                    } else {
                        alert( data.message );
                    }
                }
            });
        });
        return false;
    })

    LP.action('contact-submit' , function(){
        var $form = $(this).closest('form');
        $form.find('#name-tip,#email-tip,#message-tip').html('');
        var data = LP.query2json( $form.serialize() );
        $('#other-error').html('');
        if( !data.poliry ){
            $('#other-error').html( $form.find('input[name="poliry"]').data('required') );
            return false;
        }
        var error = false;
        if( !data.name ){
            $form.find('#name-tip').html( $form.find('input[name="name"]').data('required') );
            error = true;
        }
        if( !data.email || !data.email.match( /[a-zA-Z0-9\-\._]+@(\w+\.)+\w+/ ) ){
            $form.find('#email-tip').html( $form.find('input[name="email"]').data('required') );
            error = true;
        }

        if( !data.message ){
            $form.find('#message-tip').html( $form.find('textarea[name="message"]').data('required') );
            error = true;
        } else if( data.message.length > $form.find('textarea[name="message"]').data('max-length') ){
            $form.find('#message-tip').html( $form.find('textarea[name="message"]').data('max-length-tip') );
            error = true;
        }


        if( error ){
            return false;
        }

        $('.loading-gif').fadeIn();
        LP.use('form' , function(){
            $form.ajaxSubmit({
                type: 'post',
                dataType: 'json',
                success: function( data ){
                    $('.loading-gif').fadeOut();
                    if( data.status == 0 ){
                        $form.fadeOut(function(){
                            $('<div class="success-tip"></div>').insertAfter( $form )
                                .html( data.message );

                            $('html,body').animate({
                                scrollTop: $('.success-tip').offset().top - 200
                            } , 500);
                        });
                    } else {
                        $('#other-error').html( data.message );
                    }
                }
            });
        });
        return false;
    });


    LP.action('contact-me-back' , function(){
        var $form = $(this).closest('form');
        $form.find('#name-tip,#email-tip,#phone-tip').html('');
        
        var data = LP.query2json( $form.serialize() );
        var error = false;
        if( !data.name ){
            $form.find('#name-tip').html( $form.find('input[name="name"]').data('required') );
            error = true;
        }
        if( !data.email || !data.email.match( /[a-zA-Z0-9\-\._]+@(\w+\.)+\w+/ ) ){
            $form.find('#email-tip').html( $form.find('input[name="email"]').data('required') );
            error = true;
        }

        if( !data.phone ){
            $form.find('#phone-tip').html( $form.find('input[name="phone"]').data('required') );
            error = true;
        }
        if( error ){
            return false;
        }
        LP.use('form' , function(){
            $form.ajaxSubmit({
                type: 'post',
                dataType: 'json',
                success: function( data ){
                    if( data.status == 0 ){
                        alert('submit success');
                        $form.closest('.pop').find('.popclose')[0].click();
                    } else {
                        alert( data.message );
                    }
                }
            });
        });

        return false;
    });

    LP.action('picopsizeup' , function(){
        var $img = $(this).closest('.pop')
            .find('img');

        $img.width( ( $img.width() / $(window).width() * 1.1 ) * 100 + '%' );

        return false;
    });

    LP.action('picopsized' , function(){
        var $img = $(this).closest('.pop')
            .find('img');

        $img.width( ( $img.width() / $(window).width() * 0.9 ) * 100 + '%' );

        return false;
    });




    LP.action('show-news' , function(){
        // scroll to top 
        $('html,body').animate({
            scrollTop: 0
        } , 500);

        var $html = $( $(this).find('script').html() )
            .appendTo( $('.picinfor').html('') )
            .hide()
            .fadeIn( 500 );

        // init slider
        initSlider( $html.find('.slide') );
        $(window).trigger('resize');

        return false;
    });

    LP.action('page-next' , function(){
        var href = location.href;//.replace(/#.*/ , '');
        var $links = $('.footer a[data-a="nav-link"]');
        $links.each(function( i ){
            if( href.indexOf( $(this).attr('href') ) >= 0 ){
                if( $links.eq(i + 1).get(0) )
                    $links.eq(i + 1).get(0).click();
                return false;
            }
        });

        return false;
    });

    LP.action('page-prev' , function(){
        var href = location.href;//.replace(/#.*/ , '');
        var $links = $('.footer a[data-a="nav-link"]');
        $links.each(function( i ){
            if( href.indexOf( $(this).attr('href') ) >= 0 ){
                if( $links.eq(i - 1).get(0) )
                    $links.eq(i - 1).get(0).click();
                return false;
            }
        });

        return false;
    });

    
    // 多语言切换
    LP.action('chang-lang' , function(){
        LP.setCookie( "lang", $(this).data("lang"), 0, "/");
        LP.reload();
        return false;
    });

    LP.action('search-type' , function( data ){
        switch( data.type ){
            case 'collection':
            case 'craft':
                $('#search-result').children()
                    .filter('[data-type="' + data.type + '"]')
                    .fadeIn()
                    .end()
                    .filter('[data-type!="' + data.type + '"]')
                    .fadeOut();
                break;
            default:
                $('#search-result').children()
                    .fadeIn();
        }

        $(this).addClass('on')
            .siblings()
            .removeClass('on');

        return false;
    });


    LP.action('loadmore-press' , function(){
        var year = $.trim( $('.newsoldertime li.on').html() );
        var $dom = $('.press-list[data-year="' + year + '"]');
        var page = $dom.data('page') || 1;
        loadPressData( year , page );
        return false;
    });
});
