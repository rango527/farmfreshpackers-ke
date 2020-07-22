;(function ($) {
    "use strict"; // Start of use strict

    /* ovic_init_dropdown */
    $(document).on('click', function (event) {
        var _target = $(event.target).closest('.ovic-dropdown'),
            _parent = $('.ovic-dropdown');

        if ( _target.length > 0 ) {
            _parent.not(_target).removeClass('open');
            if (
                $(event.target).is('[data-ovic="ovic-dropdown"]') ||
                $(event.target).closest('[data-ovic="ovic-dropdown"]').length > 0
            ) {
                _target.toggleClass('open');
                event.preventDefault();
            }
        } else {
            $('.ovic-dropdown').removeClass('open');
        }
    });
    /* ---------------------------------------------
     MOBILE MENU
     --------------------------------------------- */
    function ovic_menuadd_string_prefix(str, prefix) {
        return prefix + str;
    }
    $.fn.ovic_menuclone_all_menus = function () {
        var _this = $(this);
        _this.on('ovic_menuclone_all_menus', function () {
            if ( !$('.ovic-menu-clone-wrap').length && $('.clone-main-menu').length > 0 ) {
                $('body').prepend('<div class="ovic-menu-clone-wrap">' +
                    '<div class="ovic-menu-panels-actions-wrap">' +
                    '<span class="ovic-menu-current-panel-title">MAIN MENU</span>' +
                    '<a class="ovic-menu-close-btn ovic-menu-close-panels" href="#">x</a></div>' +
                    '<div class="ovic-menu-panels"></div>' +
                    '</div>');
            }
            var i                = 0,
                panels_html_args = Array();
            if ( !$('.ovic-menu-clone-wrap .ovic-menu-panels #ovic-menu-panel-main').length ) {
                $('.ovic-menu-clone-wrap .ovic-menu-panels').append('<div id="ovic-menu-panel-main" class="ovic-menu-panel ovic-menu-panel-main"><ul class="depth-01"></ul></div>');
            }
            $(this).each(function () {
                var $this              = $(this),
                    thisMenu           = $this,
                    this_menu_id       = thisMenu.attr('id'),
                    this_menu_clone_id = 'ovic-menu-clone-' + this_menu_id;

                if ( !$('#' + this_menu_clone_id).length ) {
                    var thisClone = $this.clone(true); // Clone Wrap
                    thisClone.find('.menu-item').addClass('clone-menu-item');

                    thisClone.find('[id]').each(function () {
                        // Change all tab links with href = this id
                        thisClone.find('.vc_tta-panel-heading a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + ovic_menuadd_string_prefix($(this).attr('id'), 'ovic-menu-clone-'));
                        thisClone.find('.ovic-menu-tabs .tabs-link a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + ovic_menuadd_string_prefix($(this).attr('id'), 'ovic-menu-clone-'));
                        $(this).attr('id', ovic_menuadd_string_prefix($(this).attr('id'), 'ovic-menu-clone-'));
                    });

                    thisClone.find('.ovic-menu-menu').addClass('ovic-menu-menu-clone');

                    // Create main panel if not exists

                    var thisMainPanel = $('.ovic-menu-clone-wrap .ovic-menu-panels #ovic-menu-panel-main ul');
                    thisMainPanel.append(thisClone.html());

                    ovic_menu_insert_children_panels_html_by_elem(thisMainPanel, i);
                }
            });
        }).trigger('ovic_menuclone_all_menus');
    }

    // i: For next nav target
    function ovic_menu_insert_children_panels_html_by_elem($elem, i) {
        if ( $elem.find('.menu-item-has-children').length ) {
            $elem.find('.menu-item-has-children').each(function () {
                var thisChildItem = $(this);
                ovic_menu_insert_children_panels_html_by_elem(thisChildItem, i);
                var next_nav_target = 'ovic-menu-panel-' + i;

                // Make sure there is no duplicate panel id
                while ( $('#' + next_nav_target).length ) {
                    i++;
                    next_nav_target = 'ovic-menu-panel-' + i;
                }
                // Insert Next Nav
                thisChildItem.prepend('<a class="ovic-menu-next-panel" href="#' + next_nav_target + '" data-target="#' + next_nav_target + '"></a>');

                // Get sub menu html
                var sub_menu_html = $('<div>').append(thisChildItem.find('> .sub-menu').clone()).html();
                thisChildItem.find('> .sub-menu').remove();

                $('.ovic-menu-clone-wrap .ovic-menu-panels').append('<div id="' + next_nav_target + '" class="ovic-menu-panel ovic-menu-sub-panel ovic-menu-hidden">' + sub_menu_html + '</div>');
            });
        }
    }

    // BOX MOBILE MENU
    $(document).on('click', '.menu-toggle', function (e) {
        $('.ovic-menu-clone-wrap').addClass('open');
        e.preventDefault();
    });
    // Close box menu
    $(document).on('click', '.ovic-menu-clone-wrap .ovic-menu-close-panels', function (e) {
        $('.ovic-menu-clone-wrap').removeClass('open');
        e.preventDefault();
    });
    $(document).on('click', function (event) {
        if ( $('body').hasClass('rtl') ) {
            if ( event.offsetX < 0 )
                $('.ovic-menu-clone-wrap').removeClass('open');
        } else {
            if ( event.offsetX > $('.ovic-menu-clone-wrap').width() )
                $('.ovic-menu-clone-wrap').removeClass('open');
        }
    });

    // Open next panel
    $(document).on('click', '.ovic-menu-next-panel', function (e) {
        var $this     = $(this),
            thisItem  = $this.closest('.menu-item'),
            thisPanel = $this.closest('.ovic-menu-panel'),
            target_id = $this.attr('href');

        if ( $(target_id).length ) {
            thisPanel.addClass('ovic-menu-sub-opened');
            $(target_id).addClass('ovic-menu-panel-opened').removeClass('ovic-menu-hidden').attr('data-parent-panel', thisPanel.attr('id'));
            // Insert current panel title
            var item_title     = thisItem.children('a').text(),
                firstItemTitle = '';

            if ( $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').length > 0 ) {
                firstItemTitle = $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').html();
            }

            if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                if ( !$('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').length ) {
                    $('.ovic-menu-panels-actions-wrap').prepend('<span class="ovic-menu-current-panel-title"></span>');
                }
                $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').html(item_title);
            }
            else {
                $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').remove();
            }

            // Back to previous panel
            $('.ovic-menu-panels-actions-wrap .ovic-menu-prev-panel').remove();
            $('.ovic-menu-panels-actions-wrap').prepend('<a data-prenttitle="' + firstItemTitle + '" class="ovic-menu-prev-panel" href="#' + thisPanel.attr('id') + '" data-cur-panel="' + target_id + '" data-target="#' + thisPanel.attr('id') + '"></a>');
        }

        e.preventDefault();
    });

    // Go to previous panel
    $(document).on('click', '.ovic-menu-prev-panel', function (e) {
        var $this        = $(this),
            cur_panel_id = $this.attr('data-cur-panel'),
            target_id    = $this.attr('href');

        $(cur_panel_id).removeClass('ovic-menu-panel-opened').addClass('ovic-menu-hidden');
        $(target_id).addClass('ovic-menu-panel-opened').removeClass('ovic-menu-sub-opened');

        // Set new back button
        var new_parent_panel_id = $(target_id).attr('data-parent-panel');
        if ( typeof new_parent_panel_id == 'undefined' || typeof new_parent_panel_id == false ) {
            $('.ovic-menu-panels-actions-wrap .ovic-menu-prev-panel').remove();
            $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').html('MAIN MENU');
        }
        else {
            $('.ovic-menu-panels-actions-wrap .ovic-menu-prev-panel').attr('href', '#' + new_parent_panel_id).attr('data-cur-panel', target_id).attr('data-target', '#' + new_parent_panel_id);
            // Insert new panel title
            var item_title = $('#' + new_parent_panel_id).find('.ovic-menu-next-panel[data-target="' + target_id + '"]').closest('.menu-item').find('.ovic-menu-item-title').attr('data-title');
            item_title     = $(this).data('prenttitle');
            if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                if ( !$('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').length ) {
                    $('.ovic-menu-panels-actions-wrap').prepend('<span class="ovic-menu-current-panel-title"></span>');
                }
                $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').html(item_title);
            }
            else {
                $('.ovic-menu-panels-actions-wrap .ovic-menu-current-panel-title').remove();
            }
        }

        e.preventDefault();
    });
    /* ---------------------------------------------
     Scripts load
     --------------------------------------------- */
    window.addEventListener('load',
        function (ev) {
            $('.clone-main-menu').ovic_menuclone_all_menus();
        }, false);

})(jQuery); // End of use strict