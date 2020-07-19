;(function ( $ ) {
    "use strict";
    var BIOLIFE_THEME = {
        init: function () {
            this.biolife_countdown();
            this.biolife_countdown_init();
            this.biolife_backtotop();
            this.biolife_woo_quantily();
            this.biolife_hover_product_item();
            this.biolife_accordion_widget();
            this.quick_view_slide();
            this.biolife_mobile_footer();
            this.biolife_sticky_menu();
            this.biolife_products_style6_init();
            this.biolife_custommenu_05();
        },
        onResize: function () {
            this.biolife_hover_product_item();
            this.biolife_mobile_footer();
            this.biolife_products_style6_init();
            this.biolife_custommenu_05();
        },
        scroll: function () {
            this.biolife_sticky_menu();
            if ( $( window ).scrollTop() > 300 ) {
                $( '.backtotop' ).addClass( 'show' );
            } else {
                $( '.backtotop' ).removeClass( 'show' );
            }
        },
        biolife_products_style6_init: function () {
            if ( $( window ).width() >= 1200 ) {
                if ( $( ".ovic-products-style6 .box-banner" ).length > 0 ) {
                    $( ".ovic-products-style6 .box-banner" ).each( function () {
                        var _parent = $( this ).parent(),
                            _right  = $( document ).width() - (_parent.offset().left + _parent.width());
                        if ( parseInt( _right, 10 ) > 0 ) {
                            $( this ).css( 'right', -_right );
                        } else {
                            $( this ).css( 'right', 0 );
                        }

                    } );
                }
            }

        },
        biolife_custommenu_05: function () {
            if ( $( window ).width() >= 1200 ) {
                if ( $( ".ovic-custommenu.style05:not(.initialized)" ).length > 0 ) {
                    $( ".ovic-custommenu.style05" ).each( function ( index ) {
                        var count_items      = $( this ).find( '.ovic-menu-wapper > ul > li' ).length,
                            show_count_items = parseInt( $( this ).data( 'show_count_items' ) );
                        if ( show_count_items > 0 && show_count_items < count_items ) {
                            var text_more = $( this ).data( 'text_more' );
                            $( this ).find( '.ovic-menu-wapper' ).append( '<a href="javascript:void(0)" class="ovic-custommenu-load-more">' + text_more + '</a>' );
                            $( this ).find( '.ovic-menu-wapper > ul > li' ).each( function ( index ) {
                                if ( index > show_count_items - 1 ) {
                                    $( this ).addClass( 'link-other' );
                                }
                            } );
                        }
                        /* megamenu */
                        var a = $( this ).closest( '.container' ).actual( 'width' ),
                            b = $( this ).actual( 'width' ),
                            c = a - b + 2;
                        $( this ).find( '.sub-menu.megamenu' ).css( { 'width': c } );

                        $( this ).find( '.ovic-menu-wapper' ).each( function () {
                            $( this ).css( 'display', 'block' ).parent().removeClass( 'opened' );
                        } );
                        $( this ).addClass( 'initialized' );
                    } );
                }
            } else {
                $( ".ovic-custommenu.style05" ).each( function ( index ) {
                    $( this ).find( '.ovic-menu-wapper > ul > li' ).removeClass( 'link-other' );
                    $( '.ovic-custommenu.style05 .ovic-custommenu-load-more' ).remove();
                    $( this ).find( '.sub-menu.megamenu' ).css( { 'width': '100%' } );
                    $( this ).find( '.ovic-menu-wapper' ).each( function () {
                        //$(this).css('display', 'none').parent().removeClass('opened');
                    } );
                    $( this ).find( '.sub-menu' ).each( function () {
                        $( this ).css( 'display', 'none' ).parent().removeClass( 'opened' );
                        if ( !$( this ).prev().hasClass( 'ovic-custommenu-open-sub-menu' ) ) {
                            $( '<a class="ovic-custommenu-open-sub-menu"></a>' ).insertBefore( $( this ) );
                        }
                    } );
                    $( this ).removeClass( 'initialized' );
                } );
            }
        },
        biolife_countdown: function () {
            if ( $( '.ovic-countdown' ).length > 0 ) {
                $( '.ovic-countdown' ).each( function () {
                    var _this           = $( this ),
                        _text_countdown = '';

                    _this.countdown( _this.data( 'datetime' ), { defer: false } ).on( 'update.countdown', function ( event ) {
                        if ( event.elapsed ) {
                            _text_countdown = event.strftime(
                                '<span class="days"><span class="number">00</span><span class="text">' + biolife_global_frontend.day_text + '</span></span>' +
                                '<span class="hour"><span class="number">00</span><span class="text">' + biolife_global_frontend.hrs_text + '</span></span>' +
                                '<span class="mins"><span class="number">00</span><span class="text">' + biolife_global_frontend.mins_text + '</span></span>' +
                                '<span class="secs"><span class="number">00</span><span class="text">' + biolife_global_frontend.secs_text + '</span></span>'
                            );
                        } else {
                            _text_countdown = event.strftime(
                                '<span class="days"><span class="number">%D</span><span class="text">' + biolife_global_frontend.day_text + '</span></span>' +
                                '<span class="hour"><span class="number">%H</span><span class="text">' + biolife_global_frontend.hrs_text + '</span></span>' +
                                '<span class="mins"><span class="number">%M</span><span class="text">' + biolife_global_frontend.mins_text + '</span></span>' +
                                '<span class="secs"><span class="number">%S</span><span class="text">' + biolife_global_frontend.secs_text + '</span></span>'
                            );
                        }
                        _this.html( _text_countdown );
                    } );
                } );
            }
        },
        biolife_countdown_init: function () {
            if ( $( '.biolife-countdown' ).length > 0 ) {
                $( '.biolife-countdown' ).each( function () {
                    var time                                               = $( this ).data( 'datetime' ), txt_day       = $( this ).data( 'txt_day' ),
                        txt_hour                                           = $( this ).data( 'txt_hour' ), txt_min = $( this ).data( 'txt_min' ),
                        txt_sec = $( this ).data( 'txt_sec' ), value_first = $( this ).data( 'value_first' ),
                        html                                               = '';
                    if ( txt_day ) {
                        if ( value_first == '0' )
                            html += '<div class="countdown-item item-day"><span class="item-label">' + txt_day + '</span><span class="item-value">%D</span></div>';
                        else
                            html += '<div class="countdown-item item-day"><span class="item-value">%D</span><span class="item-label">' + txt_day + '</span></div>';
                    }
                    if ( txt_hour ) {
                        if ( value_first == '0' )
                            html += '<div class="countdown-item item-hour"><span class="item-label">' + txt_hour + '</span><span class="item-value">%H</span></div>';
                        else
                            html += '<div class="countdown-item item-hour"><span class="item-value">%H</span><span class="item-label">' + txt_hour + '</span></div>';
                    }
                    if ( txt_min ) {
                        if ( value_first == '0' )
                            html += '<div class="countdown-item item-min"><span class="item-label">' + txt_min + '</span><span class="item-value">%M</span></div>';
                        else
                            html += '<div class="countdown-item item-min"><span class="item-value">%M</span><span class="item-label">' + txt_min + '</span></div>';
                    }
                    if ( txt_sec ) {
                        if ( value_first == '0' )
                            html += '<div class="countdown-item item-sec"><span class="item-label">' + txt_sec + '</span><span class="item-value">%S</span></div>';
                        else
                            html += '<div class="countdown-item item-sec"><span class="item-value">%S</span><span class="item-label">' + txt_sec + '</span></div>';
                    }
                    if ( html ) {
                        $( this ).countdown( time, function ( event ) {
                            $( this ).html( event.strftime( html ) );
                        } );
                    }
                } )
            }
        },
        biolife_sticky_menu: function () {
            $( '.header-sticky' ).find( '.main-menu' ).removeClass( 'ovic-menu ovic-clone-mobile-menu' );
            if ( biolife_global_frontend.ovic_sticky_menu == 1 && $( '.header .header-nav' ).length > 0 ) {
                var _head           = $( '.header-sticky' ),
                    _verticalHeight = 0;
                if ( $( '.header .verticalmenu-content' ).length > 0 ) {
                    var _vertical       = $( '.header .verticalmenu-content' ),
                        _verticalOffset = _vertical.offset(),
                        _verticalHeight = _vertical.height() + _verticalOffset.top;
                    if ( !_vertical.parent().hasClass( 'always-open' ) ) {
                        _verticalHeight = 0;
                    }
                }
                if ( $( window ).innerWidth() > 1024 ) {
                    $( document ).on( 'scroll', function ( ev ) {
                        if ( $( window ).scrollTop() > _verticalHeight + 300 ) {
                            _head.addClass( 'is-sticky' );
                        } else {
                            _head.removeClass( 'is-sticky' );
                            _head.find( '.block-nav-category' ).removeClass( 'has-open' );
                        }
                    } );
                }
            }
        },
        biolife_mobile_footer: function () {
            if ( $( window ).innerWidth() < 768 ) {
                var lastScrollTop = 0;
                var countItem     = $( '.mobile-footer-inner>div:visible' ).length;
                $( '.mobile-footer-inner>div:visible' ).css( 'width', 100 / countItem + '%' );
                $( window ).scroll( function ( event ) {
                    var st = $( this ).scrollTop();
                    if ( st > lastScrollTop ) {
                        if ( $( window ).scrollTop() + $( window ).height() + 60 >= $( document ).height() ) {
                            $( '.mobile-footer' ).addClass( 'is-sticky' );
                        } else {
                            $( '.mobile-footer' ).removeClass( 'is-sticky' );
                        }
                    } else {
                        $( '.mobile-footer' ).addClass( 'is-sticky' );
                    }
                    lastScrollTop = st;
                } );
            }
        },
        quick_view_slide: function () {
            if ( $.fn.slick ) {
                $( '.slider-for' ).not( '.slick-initialized' ).slick( {
                    slidesToShow: 1,
                    fade: true,
                    infinite: false,
                    asNavFor: '.slider-nav',
                    slidesMargin: 0
                } );
                $( '.slider-nav' ).not( '.slick-initialized' ).slick( {
                    slidesToShow: 3,
                    asNavFor: '.slider-for',
                    focusOnSelect: true,
                    infinite: false,
                    slidesMargin: 10
                } );
            }
        },
        biolife_accordion_widget: function () {
            var _arrow_widget = $( '.widget-area .arrow' );

            _arrow_widget.on( 'click', function () {
                var _widget = $( this ).closest( '.widget' );
                _widget.children().not( '.widgettitle' ).not( '.screen-reader-text' ).slideToggle( 300 );
                _widget.toggleClass( 'active' );
                if ( biolife_global_frontend.is_toolkit == '1' ) {
                    _widget.find( '.lazy' ).ovic_init_lazy_load();
                }
            } );
        },
        biolife_hover_product_item: function () {
            var _winw = $( window ).innerWidth();
            if ( _winw > 1024 ) {
                $( '.owl-slick .product-item.style-1:not(.style-2), .owl-slick .product-item.style-3' ).hover(
                    function () {
                        $( this ).closest( '.slick-list' ).css( {
                            'padding': '10px 10px 200px',
                            'margin': '-10px -10px -200px',
                        } );
                    }, function () {
                        $( this ).closest( '.slick-list' ).css( {
                            'padding': '0',
                            'margin': '0',
                        } );
                    }
                );
                $( '.ovic-products .product-item.style-1:not(.style-2), .ovic-products .product-item.style-3' ).hover(
                    function () {
                        $( this ).closest( '.ovic-products:not(.row)' ).css( {
                            'padding': '10px 10px 200px',
                            'margin': '-10px -10px -200px',
                        } );
                    }, function () {
                        $( this ).closest( '.ovic-products:not(.row)' ).css( {
                            'padding': '0',
                            'margin': '0',
                        } );
                    }
                );
            }
        },
        biolife_woo_quantily: function () {
            $( 'body' ).on( 'click', '.quantity .quantity-plus', function ( e ) {
                var _this  = $( this ).closest( '.quantity' ).find( 'input.qty' ),
                    _value = parseInt( _this.val(), 10 ),
                    _max   = parseInt( _this.attr( 'max' ), 10 ),
                    _step  = parseInt( _this.data( 'step' ), 10 );
                if (isNaN(_value))
                    _value = 0;
                    _value = _value + _step;
                if ( _max && _value > _max ) {
                    _value = _max;
                }
                _this.val( _value );
                _this.trigger( "change" );
                e.preventDefault();
            } );
            $( document ).on( 'change', function () {
                $( '.quantity' ).each( function () {
                    var _this  = $( this ).find( 'input.qty' ),
                        _value = _this.val(),
                        _max   = parseInt( _this.attr( 'max' ) );
                    if ( _value > _max ) {
                        $( this ).find( '.quantity-plus' ).css( 'pointer-events', 'none' )
                    } else {
                        $( this ).find( '.quantity-plus' ).css( 'pointer-events', 'auto' )
                    }
                } )
            } );
            $( 'body' ).on( 'click', '.quantity .quantity-minus', function ( e ) {
                var _this  = $( this ).closest( '.quantity' ).find( 'input.qty' ),
                    _value = parseInt( _this.val(), 10 ),
                    _min   = parseInt( _this.attr( 'min' ), 10 ),
                    _step  = parseInt( _this.data( 'step' ), 10 );
                if (isNaN(_value))
                    _value = _step;
                    _value = _value - _step;
                if ( _min && _value < _min ) {
                    _value = _min;
                }
                if ( !_min && _value < 0 ) {
                    _value = 0;
                }
                _this.val( _value );
                _this.trigger( "change" );
                e.preventDefault();
            } );
        },
        biolife_backtotop: function () {
            $( document ).on( 'click', 'a.backtotop', function ( e ) {
                $( 'html, body' ).animate( { scrollTop: 0 }, 800 );
                e.preventDefault();
            } );
        }
    };

    $( document ).on( 'click', '.ovic-share-socials .share-button', function () {
        $( this ).closest( '.ovic-share-socials' ).toggleClass( 'active' );
    } );
    $( document ).on( 'click', '.box-search-click .btn-submit', function ( e ) {
        $( this ).closest( '.box-header-info' ).toggleClass( 'active' );
        e.preventDefault();
    } );
    $( document ).on( 'click', '.search-click', function () {
        $( 'body' ).addClass( 'overlay-open' );
        $( '.form-search-mobile' ).addClass( 'open' );
        $( '.form-search-mobile' ).find( '.searchfield' ).focus();
        return false;
    } );
    $( document ).on( 'click', '.form-search-mobile .close-search', function () {
        $( 'body' ).removeClass( 'overlay-open' );
        $( '.form-search-mobile' ).removeClass( 'open' );
        return false;
    } );
    $( document ).on( 'click', '.ovic-products .tabs-variable .item-attribute', function ( e ) {
        e.preventDefault();
        var _this    = $( this ),
            _content = _this.closest( '.ovic-products' ),
            _target  = _this.data( 'attribute_class' );

        _this.addClass( 'active' ).siblings().removeClass( 'active' );
        _content.find( '.' + _target ).each( function () {
            $( this ).addClass( 'active' );
        } );
        _content.find( '.item-target' ).each( function () {
            $( this ).not( '.' + _target ).removeClass( 'active' );
        } );
    } );
    $( document ).on( 'click', '.ovic-custommenu-open-sub-menu', function () {
        var p = $( this ).parent();
        if ( p.hasClass( 'opened' ) ) {
            p.removeClass( 'opened' );
            $( this ).next().slideUp( "slow" );
        } else {
            $( '.ovic-custommenu li[data-id="' + p.attr( "data-id" ) + '"] .owl-slick' ).addClass( 'slick-reinited' ).slick( 'reinit' );
            p.addClass( 'opened' );
            $( this ).next().slideDown( "slow" );
        }
    } );
    $( document ).on( 'click', '.widgettitle', function () {
        var p = $( this ).parent();
        if ( p.hasClass( 'opened' ) ) {
            p.removeClass( 'opened' ).find( '.ovic-menu-wapper' ).slideUp( "slow" );
        } else {
            p.addClass( 'opened' ).find( '.ovic-menu-wapper' ).slideDown( "slow" );
        }
    } );
    $( document ).on( 'click', '.ovic-tabs .tab-link .tab-link-item', function ( e ) {
        var p     = $( this ).parent(),
            color = $( this ).data( 'color' );
        $( this ).addClass( 'active' ).attr( 'style', 'color: ' + color ).siblings().removeClass( 'active' );
        p.find( '.tab-link-item:not(.active)' ).each( function () {
            var color = $( this ).data( 'color_default' );
            if ( color != undefined ) {
                $( this ).attr( 'style', 'color: ' + color );
            } else {
                $( this ).attr( 'style', '' );
            }
        } );
    } );
    $( ".tab-link-item.style4" ).mouseover( function () {
        if ( !$( this ).hasClass( 'active' ) ) {
            var color = $( this ).data( 'color' );
            if ( color != undefined ) {
                $( this ).attr( 'style', 'color:' + color );
            }
        }
    } ).mouseout( function () {
        if ( !$( this ).hasClass( 'active' ) ) {
            var color = $( this ).data( 'color_default' );
            if ( color != undefined ) {
                $( this ).attr( 'style', 'color:' + color );
            }
        }
    } );
    $( ".tab-link-item.style3" ).mouseover( function () {
        var color = $( this ).data( 'color' );
        $( this ).find( 'a' ).attr( 'style', 'color:' + color );
    } ).mouseout( function () {
        $( this ).find( 'a' ).attr( 'style', '' );
    } );
    $( window ).scroll( function () {
        BIOLIFE_THEME.scroll();
    } );
    $( window ).on( 'resize', function () {
        BIOLIFE_THEME.onResize();
    } );
    $( document ).on( 'ovic_trigger_init_slide', function () {
        BIOLIFE_THEME.biolife_hover_product_item();
        BIOLIFE_THEME.biolife_countdown();
    } );

    $( document ).on( 'qv_loader_stop', function () {
        BIOLIFE_THEME.quick_view_slide();
    } );
    $( document ).on( 'added_to_wishlist removed_from_wishlist', function ( e, el, el_wrap ) {
        el.closest( '.ovic-wishlist' ).addClass( 'added' );
        el.siblings( '.ajax-loading' ).css( 'visibility', 'hidden' );
        $.ajax( {
            type: 'POST',
            url: biolife_global_frontend.ajaxurl,
            data: {
                action: 'biolife_ajax_get_all_wishlist',
            },
            success: function ( response ) {
                $( ".wishlist-count" ).html( response );
            },
        } );

    } );
    document.addEventListener( "DOMContentLoaded", function ( event ) {
        if ( $( '.right_summary_content' ).length == 0 ) {
            $( '.left_summary_content' ).css( { 'width': '100%' } );
        }
        BIOLIFE_THEME.init();
    } );
})( jQuery, window, document );
