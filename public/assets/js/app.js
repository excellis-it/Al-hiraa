
/************************************************************************/
/******/ ({

/***/ "./src/js/preloader.js":
/*!*****************************!*\
  !*** ./src/js/preloader.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

  (function () {
    'use strict'; // PRELOADER
  
    window.addEventListener('load', function () {
      $('.preloader').fadeOut();
      domFactory.handler.upgradeAll();
    });
  })();
  
  /***/ }),
  
  /***/ "./src/js/sidebar.js":
  /*!***************************!*\
    !*** ./src/js/sidebar.js ***!
    \***************************/
  /*! no static exports found */
  /***/ (function(module, exports, __webpack_require__) {
  
  
  (function () {
    'use strict'; // Connect button(s) to drawer(s)
  
    // SIDEBAR COLLAPSE MENUS
  
    $('.sidebar .collapse').on('show.bs.collapse', function (e) {
      e.stopPropagation();
      var parent = $(this).parents('.sidebar-submenu').get(0) || $(this).parents('.sidebar-menu').get(0);
      $(parent).find('.open').find('.collapse').collapse('hide');
      $(this).closest('li').addClass('open');
    });
    $('.sidebar .collapse').on('hidden.bs.collapse', function (e) {
      e.stopPropagation();
      $(this).closest('li').removeClass('open');
    });
    $('.sidebar .collapse').on('show.bs.collapse shown.bs.collapse hide.bs.collapse hidden.bs.collapse', function (e) {
      var el = new SimpleBar($(this).closest('.sidebar').get(0));
      el.recalculate();
    });
  })();
  
  /***/ }),
  
  
  
  /******/ });
  
  
  
  
  
  $(document).ready(function(){
    $(".navbar-toggler").click(function(){
        $("body").toggleClass("nav_open");
    });
    $(".mdk-drawer__scrim").click(function(){
      $("body").toggleClass("nav_open");
  });
  });
  
  
  
  $(".food_box_slid").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    speed: 300,
    centerMode: false,
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: false,
    prevArrow:
      '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
    nextArrow:
      '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
    responsive: [
      {
        breakpoint: 1441,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ],
  });
  $(".interview-slide").slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    speed: 300,
    centerPadding: "20px",
    infinite: true,
    autoplaySpeed: 5000,
    autoplay: false,
    prevArrow:
      '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
    nextArrow:
      '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ],
  });
  
  
  // progress - js
  
  (function($) {
    $.fn.appear = function(fn, options) {
  
        var settings = $.extend({
  
            //arbitrary data to pass to fn
            data: undefined,
  
            //call fn only on the first appear?
            one: true,
  
            // X & Y accuracy
            accX: 0,
            accY: 0
  
        }, options);
  
        return this.each(function() {
  
            var t = $(this);
  
            //whether the element is currently visible
            t.appeared = false;
  
            if (!fn) {
  
                //trigger the custom event
                t.trigger('appear', settings.data);
                return;
            }
  
            var w = $(window);
  
            //fires the appear event when appropriate
            var check = function() {
  
                //is the element hidden?
                if (!t.is(':visible')) {
  
                    //it became hidden
                    t.appeared = false;
                    return;
                }
  
                //is the element inside the visible window?
                var a = w.scrollLeft();
                var b = w.scrollTop();
                var o = t.offset();
                var x = o.left;
                var y = o.top;
  
                var ax = settings.accX;
                var ay = settings.accY;
                var th = t.height();
                var wh = w.height();
                var tw = t.width();
                var ww = w.width();
  
                if (y + th + ay >= b &&
                    y <= b + wh + ay &&
                    x + tw + ax >= a &&
                    x <= a + ww + ax) {
  
                    //trigger the custom event
                    if (!t.appeared) t.trigger('appear', settings.data);
  
                } else {
  
                    //it scrolled out of view
                    t.appeared = false;
                }
            };
  
            //create a modified fn with some additional logic
            var modifiedFn = function() {
  
                //mark the element as visible
                t.appeared = true;
  
                //is this supposed to happen only once?
                if (settings.one) {
  
                    //remove the check
                    w.unbind('scroll', check);
                    var i = $.inArray(check, $.fn.appear.checks);
                    if (i >= 0) $.fn.appear.checks.splice(i, 1);
                }
  
                //trigger the original fn
                fn.apply(this, arguments);
            };
  
            //bind the modified fn to the element
            if (settings.one) t.one('appear', settings.data, modifiedFn);
            else t.bind('appear', settings.data, modifiedFn);
  
            //check whenever the window scrolls
            w.scroll(check);
  
            //check whenever the dom changes
            $.fn.appear.checks.push(check);
  
            //check now
            (check)();
        });
    };
  
    //keep a queue of appearance checks
    $.extend($.fn.appear, {
  
        checks: [],
        timeout: null,
  
        //process the queue
        checkAll: function() {
            var length = $.fn.appear.checks.length;
            if (length > 0) while (length--) ($.fn.appear.checks[length])();
        },
  
        //check the queue asynchronously
        run: function() {
            if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
            $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
        }
    });
  
    //run checks when these methods are called
    $.each(['append', 'prepend', 'after', 'before', 'attr',
        'removeAttr', 'addClass', 'removeClass', 'toggleClass',
        'remove', 'css', 'show', 'hide'], function(i, n) {
        var old = $.fn[n];
        if (old) {
            $.fn[n] = function() {
                var r = old.apply(this, arguments);
                $.fn.appear.run();
                return r;
            }
        }
    });
  
  })(jQuery);
  
  $('.progress-bar > span').each(function () {
            var $this = $(this);
            var width = $(this).data('percent');
            $this.css({
                'transition': 'width 3s'
            });
            setTimeout(function () {
                $this.appear(function () {
                    $this.css('width', width + '%');
                });
            }, 500);
        });
  
  