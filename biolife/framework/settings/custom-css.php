<?php
if ( !class_exists( 'Biolife_Custom_Css' ) ) {
    class  Biolife_Custom_Css
    {
        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ), 999 );
        }

        public function add_inline_style()
        {
            $css = '';
            $css .= $this->theme_color();
            wp_enqueue_style(
                'biolife-main',
                get_stylesheet_uri()
            );
            wp_add_inline_style( 'biolife-main', $css );
        }

        public function theme_color()
        {
            $main_color               = Biolife_Functions::get_option( 'ovic_main_color', '#e73918' );
            if (!$main_color)
                $main_color = '#e73918';
            $biolife_header_background   = Biolife_Functions::get_option( 'biolife_header_background', '' );
            $css                      = '';

            if ( is_numeric( $biolife_header_background ) && $biolife_header_background > 0 ) {
                $get_bg_url = wp_get_attachment_image_url( $biolife_header_background, "full" );
                if ( $get_bg_url != '' ) {
                    $css .= '.header-background{ background-image: url(' . esc_url( $get_bg_url ) . ');}';
                }
            }

            $css .= '
            a:hover,
            .current-menu-ancestor > a,
            .current-menu-parent > a,
            .current-menu-item > a,
            .current_page_item > a,
            .post-info .read-more,
            .slick-slider .slick-arrow:hover,
            .shiping-class,
            .yith-wcwl-add-to-wishlist a:hover::before,
            .product-item .yith-wcqv-button:hover:after,
			.product-item .compare:hover:after,
			.widgettitle .arrow:after,
			.ovic_widget_layered_nav .inline-group a:after,
			.widget_layered_nav .color-group .term-color:after,
			.grid-view-mode .modes-mode.active,
			.widget_shopping_cart .woocommerce-mini-cart li a:not(.remove):hover,
			.woocommerce-form-login .woocommerce-LostPassword,
			.product-item.style-4 .active .price,
			.ovic-products.style-4 .ovic-title,
			.mfp-content .mfp-close:hover:before,
			.post-info .ovic-share-socials .share-button:hover,
			.post-info .post-meta .post-meta-group .author:hover,
			.entry-summary .compare:hover,
			.entry-summary .compare:hover::before,
			.product-item.style-1 .add-to-cart a:hover:after,
			.product-item.list .add-to-cart a:hover,
			.product-item.style-3 .add-to-cart a:hover:after, 
			.products.product-grid .product-item .add-to-cart a:hover:after,
			.product-item.style-5 .yith-wcwl-add-to-wishlist a:hover::before,
			.tagcloud a:hover,
			.post-info .post-meta .post-meta-group .comment-count i,
			#yith-quick-view-modal .product_meta .posted_in > a:hover, 
			#yith-quick-view-modal .product_meta .tagged_as > a:hover,
			#yith-quick-view-close:hover::before,
			.entry-summary .ovic-share-socials a:hover,
			.entry-summary .shiping-class,
			.woocommerce-product-gallery__trigger::before,
			.product-item.list .yith-wcwl-add-to-wishlist a:hover::before,
			.middle-info .icon,
			.block-cart-link .group-cart-link>:first-child,
			.block-nav-category .view-all-category a:hover,
			.block-nav-category .view-all-category a:focus,
			.header-control > *,
			.product-item.style-6 .ovic-wishlist .ajax-loading:hover, 
			.product-item.style-6 .ovic-wishlist .wishlist-url:hover,
			.shop-sidebar .widget li.current-cat,
			.post-item .post-content a,
			.ovic-iconbox.style5 .icon,
			.ovic-tabs.style1 .tab-link li.style5.active a,
			.ovic-custommenu.style05 .ovic-menu-wapper > ul > li > a.ovic-menu-item-title:hover,
			.ovic-slide-style1 .title-container .before_title,
			.ovic-blog-style2 .title a:hover,
			.ovic-iconbox.style7 .link-text:hover,
			.ovic-banner.style5 .link-text:hover,
			.post-item-default .entry-content a:hover,
            .post-item-default .entry-summary a:hover,
            .post-item-default .comment-content a:hover,
            .sidebar .search-form .search-submit:hover,
            .ovic-iconbox.style8 .title,
            .ovic-banner.style3 .box-link:hover,
            .ovic-tabs.style1 .tab-link li.style6.active a,
            .ovic-tabs.style1 .tab-link li.style6 a:hover,
            .form-search-mobile.open .icon:hover,
            .post-style3 .post-info .post-content-group .post-author a:hover,
            .ovic-twitter.default .tweet-source,
            .product-item.style-6 .add-to-cart a:hover,
            .ovic-product.product-item.default .url-container .button:hover,
            .ovic-product.product-item.default .url-container .extent-url:hover,
            .product-item.style-7 .add-to-cart a:hover,
            .blog-new ~ .post-comments .comment-respond .comment-form .button:hover,
            .woocommerce-Tabs-panel .comment-respond .comment-form .form-submit input:hover,
            .growl .growl-title,
            .widget_shopping_cart .widget_shopping_cart_content .buttons > .button:not(.checkout):hover,
            .cart-collaterals button:hover,
            .cart-collaterals .button:hover,
            .woocommerce-cart-form .shop_table tr td.actions .coupon .button:hover,
            .woocommerce-checkout .place-order>button:hover,
            .comment-respond .comment-form .button:hover,
            .product-item.style-11 .price,
            .product-item.style-11 .add-to-cart a:hover,
            .ovic-products.ovic-products-style8 .extent-url:hover,
            .ovic-blog.style-7 .post-style7 .date,
            .ovic-iconbox.style11 .link-text:hover,
            .ovic-banner.style13 .texts .link-text:hover,
            .ovic-custommenu.style09 .link-text:hover,
            .product-item.style-13 .price,
            .product-item.style-14 .price,
            .ovic-tabs.style5 .title-container .title strong,
            .ovic-tabs.style5 .tab-link li.active a,
            .ovic-tabs.style5 .tab-link li a:hover,
            .widget-ovic-mailchimp.style8 .title strong,
            .ovic-banner.style19 .text-1,
            .widget-ovic-mailchimp.style8 .btn-submit:hover,
            .footer .ovic-socials .socials-list li span:hover:before,
            .product-item.style-15 .yith-wcwl-add-to-wishlist a:hover:before, 
            .product-item.style-15 a.yith-wcqv-button:hover:before,
            .product-item.style-15 .compare:hover:after,
            .header.style-13 .top-bar-menu.ovic-menu li > a:hover > .icon,
            .header.style-14 .group-cart-link .woocommerce-Price-amount,
            .product-item.style-15 .price,
            .post-style9 .post-socials-sharing a:hover
            {
                color: ' . $main_color . ';
            }
            
            
            .header.style-4 .top-bar-menu > * > a:hover,
            .header.style-4 .top-bar-menu > * a.wcml-cs-item-toggle:hover,
            .header.style-4 .top-bar-menu .socials-list a:hover,
            .header.style-4:not(.style-1) .main-menu > .menu-item > a:hover,
            .header.style-4:not(.style-1) .main-menu > .menu-item:hover > a,
            .header.style-4:not(.style-1) .header-control .block-userlink > a:hover,
            .header.style-8 .main-menu > .menu-item > a:hover,
            .header.style-8 .main-menu > .current-menu-item > a,
            .header.style-9 .top-bar-menu.ovic-menu li>a>.icon,
            .custom.tparrows:hover:before,
            .header.style-14 .main-menu>.menu-item>a:hover,
            .header.style-14 .main-menu>.current-menu-item>a,
            .header.style-14 .main-menu>.menu-item:hover>a,
            .main-color .content
            {
                color: ' . $main_color . '!important;
            }
            
            @media (min-width: 1025px){
            	
                .entry-summary .single_add_to_cart_button:hover
                {
					color: ' . $main_color . ';
				}
			}
            @media (min-width: 1200px){
            	
                .header.style-1 .header-control .block-userlink > a:hover
                {
					color: ' . $main_color . '!important;
				}
			}
            
            
            a.button:not(.compare):not(.yith-wcqv-button), 
			button:not(.modes-mode):not(.mfp-close):not(.pswp__button):not(.search-submit):not(.compare):not(.yith-wcqv-button), 
			input[type="submit"],
            .post-item .post-date,
            .onnew,
            .price_slider_wrapper .ui-slider .ui-slider-handle,
            .price_slider_wrapper .ui-slider .ui-slider-range,
            .woocommerce-pagination .page-numbers.current, 
            .navigation .page-numbers.current, 
            .pagination .page-numbers.current,
            .pagination .page-numbers:hover,
            #yith-quick-view-content .onsale,
            #ship-to-different-address label input[type="checkbox"]:checked + span::before,
            .wishlist_table tr td a.yith-wcqv-button,
            .add-to-cart a,
            .ovic-tabs .tab-link li a:after,
            .ovic-products.style-4 .tabs-variable a.active,
            .ovic-tabs .tab-link li.active .star + a,
            .ovic-tabs .tab-link li.active .star,
            .backtotop,
            .post-pagination>span:not(.title),
            .wc-tabs li a:after,
            .woocommerce-Tabs-panel .comment-respond .comment-form .form-submit input,
            .block-nav-category .block-title,
            .top-bar-menu .socials-list a:hover,
            .block-cart-link .link-dropdown .text-btn,
            .post-thumb .post-date,
            .comment-respond .comment-form .button,
            .header.style-2 .header-top,
            .header.style-2 .block-cart-link .link-dropdown .count,
            .ovic-iconbox.style5:hover .number,
            .ovic-custommenu.style05 > .widget_nav_menu > .widgettitle,
            .ovic-banner.style5 .link-text,
            .header.style-2 .block-wishlist .woo-wishlist-link .wishlist-count,
            .ovic-iconbox.style8 .link-text,
            .ovic-iconbox.style8 .link-text:hover,
            .ovic-banner.style3 .box-link:after,
            .post-style3 .post-info .post-content-group .sl-button .count,
            .ovic-iconbox.style10 .block-number,
            .ovic-product.product-item.default .url-container .wc-forward,
            .ovic-twitter.default .tweet-icon,
            .blog-new .post-info .read-more:hover,
            .blog-new .post-read-more>*:not(.read-more):hover .count,
            .blog-new.blog-single01 .post-socials-sharing a:hover,
            .blog-new ~ .post-comments .comment-respond .comment-form .button,
            .growl-notice .growl-content>a:after,
            .product-item.list .add-to-cart a,
            #header.header.style-1,
            .header-mobile,
            .search-form .search-submit:hover,
            .header.style-8 .main-menu > .menu-item > a::before,
            .main-menu>.current-menu-item>a:before,
            .header.style-1 .main-menu>.current-menu-item>a:before,
            .widget-ovic-mailchimp.style5,
            .ovic-banner.style13 .texts .link-text,
            .ovic-products.ovic-products-style8 .extent-url:hover:after,
            .ovic-blog.style-7 .post-style7 .post-info .read-more:after,
            .header.style-12 .group-cart-link .count,
            .ovic-banner.style18 .shortcode-url,
            .product-item.style-13 .group-button .inner>*:not(.add-to-cart),
            .product-item.style-13 .ovic-wishlist.added .wishlist-url,
            .ovic-iconbox.style16:hover,
            .widget-ovic-mailchimp.style8 .newsletter-form-wrap,
            .ovic-banner.style19 .banner-link,
            .ovic-live-search-form .view-all,
            .ovic-button.style1 a,
            .ovic-button.style2 a,
            .post-style9 .read-more:hover,
            .ovic-button.style3 a:hover,
            .ovic-iconbox.style19 .link-text,
            .header.style-13 .block-cart-link .link-dropdown .count,
            .ovic-instagram.style2 .box-title
            {
                background-color: ' . $main_color . ';
            }
            
            .slick-dots .slick-active button,
            #yith-quick-view-modal .entry-summary .cart .single_add_to_cart_button,
            .woocommerce-cart-form .shop_table .actions > .button:hover,
            .slick-dots .slick-active button,
            .widget_shopping_cart .widget_shopping_cart_content .buttons > .button.checkout:hover,
            .ovic-category.style1 .content a:hover,
            .product-item.style-17 .order-now:hover
            {
                background-color: ' . $main_color . '!important;
            }

            @media (max-width: 1024px){
                
                #header.header.style-8
                {
                    background-color: ' . $main_color . '!important;
                }
            }
            
			.slick-slider .slick-arrow:hover,
			.woocommerce-pagination .page-numbers.current, 
			.navigation .page-numbers.current, 
			.pagination .page-numbers.current,
			.pagination .page-numbers:hover,
			.woocommerce-pagination .page-numbers.prev:hover, 
			.woocommerce-pagination .page-numbers.next:hover,
			.navigation.pagination .page-numbers.prev:hover, 
			.navigation.pagination .page-numbers.next:hover,
			.product-item.list .yith-wcwl-add-to-wishlist>div>a,
			.product-item.list .compare,
			.product-item.list .add-to-cart a,
			#yith-quick-view-content div.images .slider-nav .slick-current,
			.main-menu > .current-menu-item > a,
			.main-menu > .menu-item > a:hover,
			.ovic-tabs .tab-link li.active .star + a,
			.ovic-tabs .tab-link li.active .star,
			.product-item.style-3 .add-to-cart a,
			.product-item.style-3 .yith-wcqv-button,
			.product-item.style-3 .compare,
			.products.product-grid .product-item .add-to-cart a,
			.products.product-grid .product-item .yith-wcqv-button,
			.products.product-grid .product-item .compare,
			.product-item.style-1 .add-to-cart a, 
			.product-item.style-1 .yith-wcqv-button, 
			.product-item.style-1 .compare,
			.post-pagination>span:not(.title),
			.flex-control-nav .slick-slide img.flex-active,
			.group-cart-link,
			.product-item.style-8:hover .product-inner,
			.ovic-iconbox.style6:hover .texts,
			.ovic-banner.style5 .link-text,
			.ovic-accordion.style1,
			.ovic-product.product-item.default .url-container .button,
			.ovic-product.product-item.default .url-container .wc-forward,
			.ovic-banner.style3:after,
			.ovic-banner.style3:before,
			.product-item.style-7 .product-inner,
			.product-item.style-6 .add-to-cart a,
			.ovic-product.product-item.default .url-container .extent-url:hover,
			.product-item.style-7 .add-to-cart a,
			.blog-new .post-info .read-more:hover,
			.blog-new.blog-single01 .post-socials-sharing a:hover,
			.woocommerce-Tabs-panel .comment-respond .comment-form .form-submit input,
			.blog-new ~ .post-comments .comment-respond .comment-form .button,
			.growl,
			.entry-summary .single_add_to_cart_button,
			.widget_shopping_cart .widget_shopping_cart_content .buttons > .button,
			.cart-collaterals button,
            .cart-collaterals .button,
            .woocommerce-cart-form .shop_table tr td.actions .coupon .button,
            .woocommerce-checkout .place-order>button,
            .comment-respond .comment-form .button,
            .search-form .search-submit:hover,
            .comment-respond .comment-form .button, 
            .post-comments .comment-respond .comment-form .button,
            .product-item.style-11 .group-button .inner > *:hover,
            .product-item.style-11 .add-to-cart a:hover, 
            .product-item.style-11 .compare:hover,
            .product-item.style-11 .ovic-wishlist,
            .ovic-iconbox.style11 .link-text,
            .ovic-banner.style13 .texts .link-text,
            .header.style-12 .block-nav-category .block-content > .ovic-menu-wapper,
            .header.style-12 .block-nav-category .view-all-category,
            .post-style9 .read-more:hover,
            .ovic-button.style3 a:hover,
            .product-item.style-17 .order-now:hover
			{
                border-color: ' . $main_color . ';
            }
            
			.widget_shopping_cart .widget_shopping_cart_content .buttons > .button.checkout:hover,
            .ovic-slider-products .product-container,
            .custom.tparrows:hover
			{
                border-color: ' . $main_color . '!important;
            }
            
            @media (max-width: 991px){
            	.product-item.style-6 .ovic-wishlist>a,
				.product-item.style-6 .ovic-wishlist .ajax-loading{
					border-color: ' . $main_color . ';
				}
			}
            
            
            .loading-lazy::after,
            .tab-container.loading::after,
            .block-minicart .widget_shopping_cart
           	{
            	border-top-color: ' . $main_color . '!important;
            }
            
            blockquote
           	{
            	border-left-color: ' . $main_color . ';
            }
            
              
            ';

            return $css;
        }
    }

    new Biolife_Custom_Css();
}