(function ($) {
    "use strict";
    $.extend(CORE_TEMP.function, {
        /* Write your Page/Layout function here */
        demo: function () {
            var handleSidebarMenuActiveLink = function (mode, el, $state) {
                var url = location.hash.toLowerCase();
                var menu = $('.page-sidebar-menu');

                // begin: handle active state
                if (menu.hasClass('page-sidebar-menu-hover-submenu') === false) {
                    menu.find('li.nav-item.open').each(function () {
                        var match = false;
                        $(this).find('li').each(function () {
                            var state = $(this).attr('ui-sref');
                            if ($state && state) {
                                if ($state.is(state)) {
                                    match = true;
                                    return;
                                }
                            } else if ($(this).find(' > a').attr('href') === el.attr('href')) {
                                match = true;
                                return;
                            }
                        });

                        if (match === true) {
                            return;
                        }

                        $(this).removeClass('open');
                        $(this).find('> a > .arrow.open').removeClass('open');
                        $(this).find('> .sub-menu').slideUp();
                    });
                } else {
                    menu.find('li.open').removeClass('open');
                }

                menu.find('li.active').removeClass('active');
                menu.find('li > a > .selected').remove();
                // end: handle active state

                el.parents('li').each(function () {
                    $(this).addClass('active');
                    $(this).find('> a > span.arrow').addClass('open');

                    if ($(this).parent('ul.page-sidebar-menu').size() === 1) {
                        $(this).find('> a').append('<span class="selected"></span>');
                    }

                    if ($(this).children('ul.sub-menu').size() === 1) {
                        $(this).addClass('open');
                    }
                });

                if (mode === 'click') {
                    if (App.getViewPort().width < resBreakpointMd && $('.page-sidebar').hasClass('in')) { // close the menu on mobile view while laoding a page
                        $('.page-header .responsive-toggler').click();
                    }
                }
            };
        }
    });
    $.extend(CORE_TEMP.onReady, {
        layoutOnReady: function () {
            CORE_TEMP.function.demo();
            /* Call your function here to init on DOCUMENT READY */
        }
    });
    $.extend(CORE_TEMP.onLoad, {
        layoutOnLoad: function () {
            /* Call your function here to init on WINDOW LOAD */
        }
    });
    $.extend(CORE_TEMP.onResize, {
        /* Call your function here to init on WINDOW RESIZE */
    });
})(jQuery);