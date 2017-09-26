/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    target,
    infos = false,
    idle,
    players,
    intro = true,
    $projectsContent,
    projectsScroll,
    lastTarget = false,
    $root = '/georgiapendlebury';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {
                app.sizeSet();
            });
            $(document).ready(function($) {
                app.sizeSet();
                $body = $('body');
                $container = $('#container');
                $header = $('header');
                app.smoothState('#main', $container);
                app.interact();
                $(document).keyup(function(e) {
                    //esc
                    if (e.keyCode === 27) app.goBack();
                    if (e.keyCode === 39 && $slider) {
                        if ($slider.flkty.slides.length > 1) $slider.flickity('next');
                    }
                    if (e.keyCode === 37 && $slider) {
                        if ($slider.flkty.slides.length > 1) $slider.flickity('previous');
                    }
                });
                // $('.project-item.print img').load(function(el) {
                //     console.log('go');
                //     $el = $(el);
                //     h = $el.height();
                //     $el.next('.item-infos.left').width(h);
                //     $el.next('.item-infos.right').width(h);
                // });
                $(window).load(function() {
                    $(".loader").hide();
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 1024 || Modernizr.touch) isMobile = true;
            if (isMobile) {
                if (width >= 1024) {
                    //location.reload();
                    isMobile = false;
                }
            }
        },
        interact: function() {
            app.loadSlider();
            showContent = function() {
                $container.removeClass('hide-images');
                $sidebarHover.empty();
                $menu.attr('style', '');
                $(this).attr('style', '');
                contentHidden = false;
            };
            if (!isMobile) {
                // index
                var $menu = $(".category-title, .project");
                var $images = $("#index-hover img");
                $('#page-content.index .category .project').hover(function() {
                    var $el = $(this);
                    var id = $el.data('id');
                    var $categoryTitle = $el.parent().find(".category-title");
                    var color = $el.data('color');
                    $el.css('color', color);
                    $categoryTitle.css('color', color);
                    $('img[data-id=' + id + ']').show();
                }, function() {
                    $menu.attr('style', '');
                    $images.hide();
                });
                // grid
                var contentHidden = false;
                $('.clone').remove();
                $thumbs = $('.project-thumb');
                $sidebarHover = $('#sidebar-hover');
                $thumbs.hover(function() {
                    var $el = $(this);
                    var id = $el.data('id');
                    var color = $el.data('color');
                    var $title = $('.category .project[data-id=' + id + ']');
                    var $categoryTitle = $title.parent().find(".category-title");
                    var currentScrollTop = $(window).scrollTop();
                    var top;
                    var h = $title.height();
                    $container.addClass('hide-images');
                    $el.css('opacity', 1);
                    if ($el.offset().top > currentScrollTop + h * 2 + 40) {
                        top = $el.offset().top - h - 40;
                    } else {
                        top = $el.offset().top + $el.height() + 20;
                    }
                    $title.clone().addClass('clone').appendTo($sidebarHover);
                    $sidebarHover.css({
                        'visibility': 'visible',
                        'color': color,
                        'top': top
                    });
                    $(".category-title").hide();
                    $categoryTitle.show().css('color', color);
                    contentHidden = true;
                }, showContent);
                $(window).scroll(function(event) {
                    if (contentHidden) {
                        showContent();
                    }
                });
                $container.removeClass('hide-images');
                $sidebarHover.empty();
                $menu.attr('style', '');
                $(this).attr('style', '');
            }
        },
        plyr: function(loop) {
            players = plyr.setup('.js-player', {
                loop: false,
                controls: ['play-large', 'controls', 'progress', 'current-time'],
                iconUrl: $root + "/assets/css/plyr/plyr.svg"
            });
        },
        loadSlider: function() {
            $slider = false;
            $slideNumber = $('#slide-number');
            $slider = $('.slider').flickity({
                cellSelector: '.slide',
                imagesLoaded: true,
                lazyLoad: 2,
                setGallerySize: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: !isMobile,
                pageDots: false,
                draggable: isMobile
            });
            if ($slider.length > 0) {
                // $slider.addClass('play');
                app.plyr();
                $slider.flkty = $slider.data('flickity');
                $slider.count = $slider.flkty.slides.length;
                //$slider.first('.slide').find('.lazyimg:not(".lazyloaded")').addClass('lazyload');
                if ($slider.flkty && players.length > 0) {
                    $slider.on('select.flickity', function() {
                        if ($('.plyr--playing').length > 0) {
                            for (var i = players.length - 1; i >= 0; i--) {
                                if (!players[i].isPaused()) {
                                    players[i].pause();
                                }
                            }
                        }
                        //$mouseNav.removeClass('back pause').addClass('play');
                        // For lazysizes
                        // var adjCellElems = $slider.flickity('getAdjacentCellElements', 2);
                        // $(adjCellElems).find('.lazyimg:not(".lazyloaded")').addClass('lazyload');
                    });
                }
                $slider.find(".content:not(.video)").click(function(event) {
                    if (!isMobile) {
                        $slider.flickity('next');
                    }
                });
                $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                    if (!cellElement) {
                        return;
                    }
                    $slider.flickity('next');
                });
                $slider.on('select.flickity', function(event, pointer, cellElement, cellIndex) {
                    $slideNumber.text(($slider.flkty.selectedIndex + 1) + ' — ' + $slider.count);
                });
                $('[event-target="overview"]').click(function(event) {
                    $(".overview-nav").toggleClass('visible');
                });
            }
        },
        goBack: function() {
            // if (window.history && history.length > 0 && !$body.hasClass('projects')) {
            //     window.history.go(-1);
            // } else {
            //     $('#site-title a').click();
            // }
            $('#site-title a').click();
        },
        smoothState: function(container, $target) {
            // if (!isMobile) {
            var options = {
                    debug: true,
                    scroll: false,
                    anchors: '[data-target]',
                    loadingClass: 'is-loading',
                    prefetch: true,
                    cacheLength: 2,
                    onAction: function($currentTarget, $container) {
                        target = $currentTarget.data('target');
                    },
                    onBefore: function(request, $container) {
                        lastTarget = $('#page-content').attr('class');
                        console.log("-1: " + lastTarget, "0: " + target);
                        if (lastTarget == "projects") {
                            projectsScroll = $(window).scrollTop();
                            console.log(projectsScroll);
                            if (!$projectsContent) {
                                $projectsContent = $('#page-content');
                            }
                        }
                        // popstate = request.url.replace(/\/$/, '').replace(window.location.origin + $root, '');
                        // console.log(popstate);
                        // if (popstate == '') {
                        //     target = 'projects';
                        // } else if (isInStr('filter:print', popstate)) {
                        //     target = 'projects print';
                        // } else if (isInStr('filter:motion', popstate)) {
                        //     target = 'projects motion';
                        // } else if (isInStr('/work/', popstate)) {
                        //     return;
                        // } else {
                        //     target = popstate.replace('/', '');
                        // }
                    },
                    onStart: {
                        duration: 0, // Duration of our animation
                        render: function($container) {
                            // Add your CSS animation reversing class
                            $('.category').removeClass('active');
                            $body.attr('class', target);
                        }
                    },
                    onReady: {
                        duration: 0,
                        render: function($container, $newContent) {
                            // Remove your CSS animation reversing class
                            // Inject the new content
                            $(window).scrollTop(0);
                            $content = $newContent.find('#page-content');
                            newTarget = $content.attr('class');
                            $body.attr('class', newTarget);
                            if (newTarget == "projects" && $projectsContent) {
                                $target.html($projectsContent);
                            } else {
                                $target.html($content);
                            }
                            if (newTarget == "projects" && projectsScroll) {
                                $(window).scrollTop(projectsScroll);
                            }
                        }
                    },
                    onAfter: function($container, $newContent) {
                        app.interact();
                    }
                },
                smoothState = $(container).smoothState(options).data('smoothState');
            // }
        }
    };
    app.init();
});