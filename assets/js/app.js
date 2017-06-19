/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    target,
    lastTarget = false,
    $root = '/';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                $(document).keyup(function(e) {
                    //esc
                    //if (e.keyCode === 27) app.goIndex();
                });
                $(window).load(function() {
                    $(".loader").fadeOut("fast");
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    //location.reload();
                    isMobile = false;
                }
            }
        },
        loadSlider: function() {
            $slider = $('.slider').flickity({
                cellSelector: '.slide',
                imagesLoaded: true,
                setGallerySize: false,
                accessibility: true,
                wrapAround: true,
                prevNextButtons: true,
                pageDots: false,
                draggable: isMobile,
                dragThreshold: 40
            });
            $slider.flkty = $slider.data('flickity');
            $slider.count = $slider.flkty.slides.length;
            //$slider.first('.slide').find('.lazyimg:not(".lazyloaded")').addClass('lazyload');
            // $slider.on('select.flickity', function() {
            //     if ($slider.flkty) {
            //         $selected = $($slider.flkty.selectedElement);
            //         $slider.idx = $slider.flkty.selectedIndex + 1;
            //         $imgN.text($slider.idx + '/' + $slider.count);
            //         // For lazysizes
            //         // var adjCellElems = $slider.flickity('getAdjacentCellElements', 2);
            //         // $(adjCellElems).find('.lazyimg:not(".lazyloaded")').addClass('lazyload');
            //     }
            // });
            // $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
            //     if (!cellElement || !isMobile) {
            //         return;
            //     }
            //     if (!isMobile) {
            //       app.goNext($slider);
            //     }
            // });
        },
        goIndex: function() {},
        smoothState: function(container, target) {
            var options = {
                    anchors: '[data-target]',
                    loadingClass: 'is-loading',
                    //prefetch: true,
                    //cacheLength: 2,
                    onBefore: function($currentTarget, $container) {
                        //$container.addClass('is-loading');
                        lastTarget = target;
                        target = $currentTarget.data('target');
                    },
                    onStart: {
                        duration: 250, // Duration of our animation
                        render: function($container) {
                            // Add your CSS animation reversing class
                            $container.addClass('is-exiting');
                        }
                    },
                    onReady: {
                        duration: 0,
                        render: function($container, $newContent) {
                            // Remove your CSS animation reversing class
                            //$container.removeClass('is-loading');
                            // Inject the new content
                            target.html($newContent);
                        }
                    },
                    onAfter: function($container, $newContent) {
                        $container.removeClass('loading');
                    }
                },
                smoothState = $(container).smoothState(options).data('smoothState');
        }
    };
    app.init();
});