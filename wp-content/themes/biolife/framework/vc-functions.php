<?php
if ( !function_exists( 'biolife_add_result_autocomplete' ) ) {
    function biolife_add_result_autocomplete()
    {
        if ( class_exists( 'Ovic_Visual_composer' ) ) {
            //add_filter( 'vc_autocomplete_ovic_banner_ids_callback', array( 'Ovic_Visual_composer', 'productIdAutocompleteSuggester' ), 10, 1 );
            //add_filter( 'vc_autocomplete_ovic_banner_ids_render', array( 'Ovic_Visual_composer', 'productIdAutocompleteRender' ), 10, 1 );

            /* Add auto complete for Product */
            add_filter( 'vc_autocomplete_ovic_product_ids_callback', array( 'Ovic_Visual_composer', 'productIdAutocompleteSuggester' ), 10, 1 );
            add_filter( 'vc_autocomplete_ovic_product_ids_render', array( 'Ovic_Visual_composer', 'productIdAutocompleteRender' ), 10, 1 );

            add_filter( 'vc_autocomplete_ovic_special_offer_ids_callback', array( 'Ovic_Visual_composer', 'productIdAutocompleteSuggester' ), 10, 1 );
            add_filter( 'vc_autocomplete_ovic_special_offer_ids_render', array( 'Ovic_Visual_composer', 'productIdAutocompleteRender' ), 10, 1 );
        }
    }
}
add_action( 'vc_after_mapping', 'biolife_add_result_autocomplete', 10 );
if ( !function_exists( 'Biolife_VC_Functions_Param' ) ) {
    add_filter( 'ovic_add_param_visual_composer', 'Biolife_VC_Functions_Param' );
    function Biolife_VC_Functions_Param( $param )
    {
        $attributes_tax = array();
        if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
            $attributes_tax = wc_get_attribute_taxonomies();
        }
        $attributes = array();
        if ( is_array( $attributes_tax ) && count( $attributes_tax ) > 0 ) {
            foreach ( $attributes_tax as $attribute ) {
                $attributes[$attribute->attribute_label] = $attribute->attribute_name;
            }
        }
        // CUSTOM PRODUCT SIZE
        $product_size_width_list = array();
        $width                   = 300;
        $height                  = 300;
        $crop                    = 1;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size   = wc_get_image_size( 'shop_catalog' );
            $width  = isset( $size['width'] ) ? $size['width'] : $width;
            $height = isset( $size['height'] ) ? $size['height'] : $height;
            $crop   = isset( $size['crop'] ) ? $size['crop'] : $crop;
        }
        for ( $i = 100; $i < $width; $i = $i + 10 ) {
            array_push( $product_size_width_list, $i );
        }
        $product_size_list                         = array();
        $product_size_list[$width . 'x' . $height] = $width . 'x' . $height;
        foreach ( $product_size_width_list as $k => $w ) {
            $w      = intval( $w );
            $width  = intval( $width );
            $height = intval( $height );
            if ( isset( $width ) && $width > 0 ) {
                $h = round( $height * $w / $width );
            } else {
                $h = $w;
            }
            $product_size_list[$w . 'x' . $h] = $w . 'x' . $h;
        }
        $product_size_list['Custom']      = 'custom';


        $args = array(
            'taxonomy'          => 'product_cat',
            'hide_empty'        => false,
            'orderby'           => 'name',
            'order'             => 'ASC',
        );
        $categories_options = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $product_categories = get_terms( 'product_cat', $args );

            if ($product_categories){
                foreach ($product_categories as $product_category){
                    $categories_options[$product_category->name] = $product_category->term_id;
                }
            }
        }
        /*@todo: ovic_iconbox*/
        $param['ovic_iconbox']            = array(
            'base'        => 'ovic_iconbox',
            'name'        => esc_html__( 'Ovic: Icon Box', 'biolife' ),
            'icon'        => OVIC_FRAMEWORK_URI . 'assets/images/happiness.svg',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Display Icon Box', 'biolife' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'biolife' ),
                    'value'       => array(
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style01.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style02.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 03', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style03.jpg' ),
                        ),
                        'style4' => array(
                            'title'   => esc_html__( 'Style 04', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style04.jpg' ),
                        ),
                        'style5' => array(
                            'title'   => esc_html__( 'Style 05', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style05.jpg' ),
                        ),
                        'style6' => array(
                            'title'   => esc_html__( 'Style 06', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style06.jpg' ),
                        ),
                        'style7' => array(
                            'title'   => esc_html__( 'Style 07', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style07.jpg' ),
                        ),
                        'style8' => array(
                            'title'   => esc_html__( 'Style 08', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style08.jpg' ),
                        ),
                        'style9' => array(
                            'title'   => esc_html__( 'Style 09', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style09.jpg' ),
                        ),
                        'style10' => array(
                            'title'   => esc_html__( 'Style 10', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style10.jpg' ),
                        ),
                        'style11' => array(
                            'title'   => esc_html__( 'Style 11', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style11.jpg' ),
                        ),
                        'style12' => array(
                            'title'   => esc_html__( 'Style 12', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style12.jpg' ),
                        ),
                        'style13' => array(
                            'title'   => esc_html__( 'Style 13', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style13.jpg' ),
                        ),
                        'style14' => array(
                            'title'   => esc_html__( 'Style 14', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style14.jpg' ),
                        ),
                        'style15' => array(
                            'title'   => esc_html__( 'Style 15', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style15.jpg' ),
                        ),
                        'style16' => array(
                            'title'   => esc_html__( 'Style 16', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style16.jpg' ),
                        ),
                        'style17' => array(
                            'title'   => esc_html__( 'Style 17', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style17.jpg' ),
                        ),
                        'style18' => array(
                            'title'   => esc_html__( 'Style 18', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style18.jpg' ),
                        ),
                        'style19' => array(
                            'title'   => esc_html__( 'Style 19', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style19.jpg' ),
                        ),
                        'style20' => array(
                            'title'   => esc_html__( 'Style 20', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style20.jpg' ),
                        ),
                        'style21' => array(
                            'title'   => esc_html__( 'Style 21', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/iconbox/style21.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select text align', 'biolife' ),
                    'value'       => array(
                        esc_html__( 'Text Align Left', 'biolife' ) => 'text_left',
                        esc_html__( 'Text Align Right', 'biolife' )  => 'text_right',
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'text_align',
                    'dependency'  => array(
                        "element" => "style",
                        "value"   => array( 'style2', 'style11', 'style14' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Number', 'biolife' ),
                    'param_name' => 'number',
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array( 'style2', 'style5', 'style6', 'style10' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Before title', 'biolife' ),
                    'param_name'  => 'before_title',
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array('style9' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array( 'style1', 'style2', 'style8', 'style9' , 'style11' , 'style13' , 'style14' , 'style16', 'style17', 'style18', 'style19', 'style20', 'style21' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Sub Title', 'biolife' ),
                    'param_name'  => 'sub_title',
                    'admin_label' => true,
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array( 'style11', 'style13', 'style19' ),
                    ),
                ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'title_1',
                    'admin_label' => true,
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array( 'style15' ),
                    ),
                ),
                array(
                    'param_name' => 'text_content',
                    'heading'    => esc_html__( 'Content', 'biolife' ),
                    'type'       => 'textarea',
                    'dependency'  => array(
                        'element'            => 'style',
                        'value_not_equal_to' => array( 'style12', 'style13' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon library', 'biolife' ),
                    'value'       => array(
                        esc_html__( 'Font Awesome', 'biolife' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'biolife' )  => 'openiconic',
                        esc_html__( 'Typicons', 'biolife' )     => 'typicons',
                        esc_html__( 'Entypo', 'biolife' )       => 'entypo',
                        esc_html__( 'Linecons', 'biolife' )     => 'linecons',
                        esc_html__( 'Mono Social', 'biolife' )  => 'monosocial',
                        esc_html__( 'Material', 'biolife' )     => 'material',
                        esc_html__( 'Ovic Fonts', 'biolife' )   => 'oviccustomfonts',
                        esc_html__( 'Image', 'biolife' )        => 'image',
                    ),
                    'admin_label' => true,
                    'param_name'  => 'type',
                    'description' => esc_html__( 'Select icon library.', 'biolife' ),
                    'dependency'  => array(
                        'element'            => 'style',
                        'value_not_equal_to' => array( 'style13', 'style15', 'style19', 'style20' ),
                    ),
                ),
                array(
                    'param_name'  => 'icon_oviccustomfonts',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                    'type'        => 'iconpicker',
                    'settings'    => array(
                        'emptyIcon' => false,
                        'type'      => 'oviccustomfonts',
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'oviccustomfonts',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_fontawesome',
                    'value'       => 'fa fa-adjust',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_openiconic',
                    'value'       => 'vc-oi vc-oi-dial',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'openiconic',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_typicons',
                    'value'       => 'typcn typcn-adjust-brightness',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'typicons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'       => 'iconpicker',
                    'heading'    => esc_html__( 'Icon', 'biolife' ),
                    'param_name' => 'icon_entypo',
                    'value'      => 'entypo-icon entypo-icon-note',
                    'settings'   => array(
                        'emptyIcon'    => false,
                        'type'         => 'entypo',
                        'iconsPerPage' => 100,
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'entypo',
                    ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_linecons',
                    'value'       => 'vc_li vc_li-heart',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'linecons',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_monosocial',
                    'value'       => 'vc-mono vc-mono-fivehundredpx',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'monosocial',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'        => 'iconpicker',
                    'heading'     => esc_html__( 'Icon', 'biolife' ),
                    'param_name'  => 'icon_material',
                    'value'       => 'vc-material vc-material-cake',
                    'settings'    => array(
                        'emptyIcon'    => false,
                        'type'         => 'material',
                        'iconsPerPage' => 100,
                    ),
                    'dependency'  => array(
                        'element' => 'type',
                        'value'   => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'biolife' ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Image', 'biolife' ),
                    'param_name' => 'image',
                    'dependency' => array(
                        'element' => 'type',
                        'value'   => 'image',
                    ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Image Background', 'biolife' ),
                    'param_name' => 'image_iconbox_background',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => 'style12',
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select product category', 'biolife' ),
                    'value'       => $categories_options,
                    'param_name'  => 'product_category',
                    'dependency' => array(
                        "element" => "style",
                        "value"   => array( 'style6'),
                    ),
                ),
                array(
                    'type'       => 'datepicker',
                    'heading'    => esc_html__( 'Date play', 'biolife' ),
                    'param_name' => 'countdown_date',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style7', 'style8', 'style11', 'style19'),
                    ),
                    'std'        => date( 'm/d/Y H:i:s' ),
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link', 'biolife' ),
                    'param_name'  => 'link',
                    'description' => esc_html__( 'The Link to Icon', 'biolife' ),
                    'dependency'  => array(
                        'element'            => 'style',
                        'value_not_equal_to' => array( 'style13', 'style17', 'style18', 'style20', 'style21' ),
                    ),
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link 2', 'biolife' ),
                    'param_name'  => 'link_2',
                    'description' => esc_html__( 'The Link to Icon', 'biolife' ),
                    'dependency'  => array(
                        'element'            => 'style',
                        'value' => array( 'style15' ),
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_banner*/
        $param['ovic_banner']             = array(
            'base'        => 'ovic_banner',
            'name'        => esc_html__( 'Ovic: Banner', 'biolife' ),
            'icon'        => '',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Your can build banner here', 'biolife' ),
            'params'      => array(
                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'layout',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style1.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style2.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 03', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style3.jpg' ),
                        ),
                        'style4' => array(
                            'title'   => esc_html__( 'Style 04', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style4.jpg' ),
                        ),
                        'style5' => array(
                            'title'   => esc_html__( 'Style 05', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style5.jpg' ),
                        ),
                        'style6' => array(
                            'title'   => esc_html__( 'Style 06', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style6.jpg' ),
                        ),
                        'style7' => array(
                            'title'   => esc_html__( 'Style 07', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style7.jpg' ),
                        ),
                        'style8' => array(
                            'title'   => esc_html__( 'Style 08', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style8.jpg' ),
                        ),
                        'style9' => array(
                            'title'   => esc_html__( 'Style 09', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style9.jpg' ),
                        ),
                        'style10' => array(
                            'title'   => esc_html__( 'Style 10', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style10.jpg' ),
                        ),
                        'style11' => array(
                            'title'   => esc_html__( 'Style 11', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style11.jpg' ),
                        ),
                        'style12' => array(
                            'title'   => esc_html__( 'Style 12', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style12.jpg' ),
                        ),
                        'style13' => array(
                            'title'   => esc_html__( 'Style 13', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/banner-style13.jpg' ),
                        ),
                        'style14' => array(
                            'title'   => esc_html__( 'Style 14', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style14.jpg' ),
                        ),
                        'style15' => array(
                            'title'   => esc_html__( 'Style 15', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style15.jpg' ),
                        ),
                        'style16' => array(
                            'title'   => esc_html__( 'Style 16', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style16.jpg' ),
                        ),
                        'style17' => array(
                            'title'   => esc_html__( 'Style 17', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style17.jpg' ),
                        ),
                        'style18' => array(
                            'title'   => esc_html__( 'Style 18', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style18.jpg' ),
                        ),
                        'style19' => array(
                            'title'   => esc_html__( 'Style 19', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style19.jpg' ),
                        ),
                        'style20' => array(
                            'title'   => esc_html__( 'Style 20', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style-20.jpg' ),
                        ),
                        'style21' => array(
                            'title'   => esc_html__( 'Style 21', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/banner/style-21.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Style', 'biolife' ),
                    'param_name'  => 'texts_style',
                    'std'         => 'texts_default',
                    'value'       => array(
                        esc_html__( 'Default', 'biolife' )  => 'texts_default',
                        esc_html__( 'Style 1', 'biolife' )  => 'texts_style1',
                        esc_html__( 'Style 2', 'biolife' )  => 'texts_style2',
                    ),
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style5', 'style6'),
                    ),
                ),
                array(
                    "type"        => "attach_image",
                    "heading"     => esc_html__( "Image", 'biolife' ),
                    "param_name"  => "image_background",
                    'admin_label' => true,
                ),
                array(
                    "type"        => 'colorpicker',
                    'rgba'        => true,
                    "heading"     => esc_html__( "Background color", 'biolife' ),
                    "param_name"  => "background_color_banner",
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style1', 'style2', 'style4', 'style5', 'style6', 'style7', 'style8', 'style9', 'style10' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Effect Banner', 'biolife' ),
                    'description' => esc_html__( 'Select an effect for this banner', 'biolife' ),
                    'param_name'  => 'banner-effect',
                    'std'         => 'banner-effect-1',
                    'value'       => array(
                        esc_html__( 'None', 'biolife' )            => 'default',
                        esc_html__( 'Effect Zoom', 'biolife' ) => 'banner-effect-1',
                    ),
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style1', 'style2', 'style7', 'style8', 'style9', 'style10' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Text 1', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_1',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array(
                            'style1',
                            'style2',
                            'style4',
                            'style5',
                            'style6',
                            'style7',
                            'style8',
                            'style9',
                            'style10',
                            'style12',
                            'style14',
                            'style15',
                            'style16',
                            'style17',
                            'style18',
                            'style19',
                            'style20',
                            'style21',
                        ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Text 2', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_2',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array(
                            'style1',
                            'style2',
                            'style4',
                            'style5',
                            'style6',
                            'style7',
                            'style8',
                            'style9',
                            'style10',
                            'style14',
                            'style15',
                            'style16',
                            'style17',
                            'style18',
                            'style19',
                            'style21',
                        ),
                    ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Line Image', 'biolife' ),
                    'param_name' => 'underline',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style20', 'style21' ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Descriptions', 'biolife' ),
                    'param_name'  => 'subtitle',
                    'admin_label' => false,
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style20', 'style21' ),
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Text 2 color', 'biolife' ),
                    'param_name'  => 'text_2_color',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array(
                            'style18',
                        ),
                    ),
                    'group'       => esc_html__( 'Style', 'biolife' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Text 3', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_3',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array(
                            'style1',
                            'style2',
                            'style4',
                            'style5',
                            'style6',
                            'style8',
                            'style9',
                            'style10',
                            'style15',
                            'style16',
                            'style17',
                            'style18',
                            'style19',
                        ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Text 4', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_4',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style1', 'style2', 'style4', 'style5', 'style6', 'style9', 'style15', 'style19' ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Text 2', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_5',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style12' ),
                    ),
                ),
                array(
                    'type'        => 'textarea_html',
                    'heading'     => esc_html__( 'Text', 'biolife' ),
                    'description' => esc_html__( 'Enter the text on banner', 'biolife' ),
                    'param_name'  => 'text_6',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style13' ),
                    ),
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Banner link', 'biolife' ),
                    'param_name'  => 'link',
                    'dependency'  => array(
                        'element'            => 'layout',
                        'value_not_equal_to' => array(
                            'style20', 'style21',
                        ),
                    ),
                ),
                array(
                    "type"        => "attach_image",
                    "heading"     => esc_html__( "Link Background", 'biolife' ),
                    "param_name"  => "link_image_background",
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style11'),
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_button*/
        $param['ovic_button']             = array(
            'base'        => 'ovic_button',
            'name'        => esc_html__( 'Ovic: Button', 'biolife' ),
            'icon'        => '',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Your can build button here', 'biolife' ),
            'params'      => array(
                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'style',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/button/style-01.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/button/style-02.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 03', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/button/style-03.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Banner link', 'biolife' ),
                    'param_name'  => 'link',
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_category*/
        $param['ovic_category']             = array(
            'base'        => 'ovic_category',
            'name'        => esc_html__( 'Ovic: Category', 'biolife' ),
            'icon'        => '',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Your can build category here', 'biolife' ),
            'params'      => array(
                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'style',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'style1' => array(
                            'title'   => esc_html__( 'Style 01', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/category/style-01.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 02', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/category/style-02.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'taxonomy',
                    'heading'     => esc_html__( 'Product Category', 'biolife' ),
                    'param_name'  => 'taxonomy',
                    'options'     => array(
                        'multiple'   => true,
                        'hide_empty' => true,
                        'taxonomy'   => 'product_cat',
                    ),
                    'placeholder' => esc_html__( 'Choose category', 'biolife' ),
                    'description' => esc_html__( 'Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'biolife' ),
                ),
                array(
                    'type'       => 'attach_image',
                    'heading'    => esc_html__( 'Background', 'biolife' ),
                    'param_name' => 'background',
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__( 'Color', 'biolife' ),
                    'description' => esc_html__( 'Default is main color', 'biolife' ),
                    'param_name'  => 'color',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style2' ),
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Text Position', 'biolife' ),
                    'param_name'  => 'text_position',
                    'std'         => 'texts_default',
                    'value'       => array(
                        esc_html__( 'Left', 'biolife' )  => 'text-left',
                        esc_html__( 'Center', 'biolife' )  => 'text-center',
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_products*/
        $param['ovic_products']['params'] = array(
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Icon image", 'biolife' ),
                "param_name"  => "icon_images",
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'style9'),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'biolife' ),
                'param_name'  => 'title',
                'admin_label' => true,
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Sub Title', 'biolife' ),
                'param_name'  => 'sub_title',
                'admin_label' => true,
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style8', 'style9' ),
                ),
            ),
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__( 'Extent URL', 'biolife' ),
                'param_name' => 'link',
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style8', 'style9' ),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Product List style', 'biolife' ),
                'param_name'  => 'productsliststyle',
                'value'       => array(
                    esc_html__( 'Grid Bootstrap', 'biolife' ) => 'grid',
                    esc_html__( 'Owl Carousel', 'biolife' )   => 'owl',
                ),
                'description' => esc_html__( 'Select a style for list', 'biolife' ),
                'std'         => 'grid',
            ),
            array(
                'heading'    => esc_html__( 'Layout', 'biolife' ),
                'param_name' => 'layout',
                'type'       => 'select_preview',
                'value'      => array(
                    'default' => array(
                        'title'   => esc_html__( 'Default', 'biolife' ),
                        'preview' => '',
                    ),
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style1.jpg' ),
                    ),
                    'style2' => array(
                        'title'   => esc_html__( 'Style 02', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style2.jpg' ),
                    ),
                    'style3' => array(
                        'title'   => esc_html__( 'Style 03', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style3.jpg' ),
                    ),
                    'style4' => array(
                        'title'   => esc_html__( 'Style 04', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style4.jpg' ),
                    ),
                    'style5' => array(
                        'title'   => esc_html__( 'Style 05', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style5.jpg' ),
                    ),
                    'style6' => array(
                        'title'   => esc_html__( 'Style 06', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style6.jpg' ),
                    ),
                    'style7' => array(
                        'title'   => esc_html__( 'Style 07', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style7.jpg' ),
                    ),
                    'style8' => array(
                        'title'   => esc_html__( 'Style 08', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style8.jpg' ),
                    ),
                    'style9' => array(
                        'title'   => esc_html__( 'Style 09', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_products/style9.jpg' ),
                    ),
                ),
            ),
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Title background", 'biolife' ),
                "param_name"  => "title_background",
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style2'),
                ),
            ),
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Background image", 'biolife' ),
                "param_name"  => "image_background",
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'style6'),
                ),
            ),
            array(
                "type"        => 'colorpicker',
                'rgba'        => true,
                "heading"     => esc_html__( "Background color", 'biolife' ),
                "param_name"  => "background_color",
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'style6'),
                ),
            ),
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Product style', 'biolife' ),
                'value'       => apply_filters( 'ovic_product_options', 'Shortcode' ),
                'default'     => '1',
                'admin_label' => true,
                'param_name'  => 'product_style',
                'description' => esc_html__( 'Select a style for product item', 'biolife' ),
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style1', 'default', 'style3', 'style5', 'style6', 'style7', 'style8', 'style9' ),
                ),
            ),

            array(
                'type'       => 'dropdown',
                'value'      => array(
                    esc_html__( 'Yes', 'biolife' ) => 'true',
                    esc_html__( 'No', 'biolife' )  => 'false',
                ),
                'std'        => 'false',
                'heading'    => esc_html__( 'Hide review', 'biolife' ),
                'param_name' => 'hide_review',
                'dependency' => array(
                    'element' => 'product_style', 'value' => array('10'),
                ),
            ),
            array(
                'type'       => 'dropdown',
                'value'      => array(
                    esc_html__( 'Yes', 'biolife' ) => 'true',
                    esc_html__( 'No', 'biolife' )  => 'false',
                ),
                'std'        => 'false',
                'heading'    => esc_html__( 'Hide categories', 'biolife' ),
                'param_name' => 'hide_categories',
                'dependency' => array(
                    'element' => 'product_style', 'value' => array('10'),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Product Attribute', 'biolife' ),
                'param_name'  => 'attribute_options',
                'value'       => $attributes,
                'description' => esc_html__( 'Select a Attribute for product', 'biolife' ),
                'dependency'  => array(
                    'element' => 'product_style',
                    'value'   => array( '4' ),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Image size', 'biolife' ),
                'param_name'  => 'product_image_size',
                'value'       => $product_size_list,
                'description' => esc_html__( 'Select a size for product', 'biolife' ),
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style1', 'default', 'style5', 'style6' ),
                ),
            ),
            array(
                'type'       => 'number',
                'heading'    => esc_html__( 'Width', 'biolife' ),
                'param_name' => 'product_custom_thumb_width',
                'value'      => $width,
                'suffix'     => esc_html__( 'px', 'biolife' ),
                'dependency' => array(
                    'element' => 'product_image_size',
                    'value'   => array( 'custom' ),
                ),
            ),
            array(
                'type'       => 'number',
                'heading'    => esc_html__( 'Height', 'biolife' ),
                'param_name' => 'product_custom_thumb_height',
                'value'      => $height,
                'suffix'     => esc_html__( 'px', 'biolife' ),
                'dependency' => array(
                    'element' => 'product_image_size',
                    'value'   => array( 'custom' ),
                ),
            ),
            /* Products */
            array(
                'type'        => 'taxonomy',
                'heading'     => esc_html__( 'Product Category', 'biolife' ),
                'param_name'  => 'taxonomy',
                'options'     => array(
                    'multiple'   => true,
                    'hide_empty' => true,
                    'taxonomy'   => 'product_cat',
                ),
                'placeholder' => esc_html__( 'Choose category', 'biolife' ),
                'description' => esc_html__( 'Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'biolife' ),
                'group'       => esc_html__( 'Products options', 'biolife' ),
                'dependency'  => array(
                    'element'            => 'target',
                    'value_not_equal_to' => array(
                        'products',
                    ),
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Target', 'biolife' ),
                'param_name'  => 'target',
                'value'       => array(
                    esc_html__( 'Best Selling Products', 'biolife' ) => 'best-selling',
                    esc_html__( 'Top Rated Products', 'biolife' )    => 'top-rated',
                    esc_html__( 'Recent Products', 'biolife' )       => 'recent-product',
                    esc_html__( 'Product Category', 'biolife' )      => 'product-category',
                    esc_html__( 'Products', 'biolife' )              => 'products',
                    esc_html__( 'Featured Products', 'biolife' )     => 'featured_products',
                    esc_html__( 'On Sale', 'biolife' )               => 'on_sale',
                    esc_html__( 'On New', 'biolife' )                => 'on_new',
                ),
                'description' => esc_html__( 'Choose the target to filter products', 'biolife' ),
                'std'         => 'recent-product',
                'group'       => esc_html__( 'Products options', 'biolife' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Order by', 'biolife' ),
                'param_name'  => 'orderby',
                'value'       => array(
                    esc_html__( 'Date', 'biolife' )          => 'date',
                    esc_html__( 'ID', 'biolife' )            => 'ID',
                    esc_html__( 'Author', 'biolife' )        => 'author',
                    esc_html__( 'Title', 'biolife' )         => 'title',
                    esc_html__( 'Modified', 'biolife' )      => 'modified',
                    esc_html__( 'Random', 'biolife' )        => 'rand',
                    esc_html__( 'Comment count', 'biolife' ) => 'comment_count',
                    esc_html__( 'Menu order', 'biolife' )    => 'menu_order',
                    esc_html__( 'Sale price', 'biolife' )    => '_sale_price',
                ),
                'std'         => 'date',
                'description' => esc_html__( 'Select how to sort.', 'biolife' ),
                'dependency'  => array(
                    'element'            => 'target',
                    'value_not_equal_to' => array(
                        'products',
                    ),
                ),
                'group'       => esc_html__( 'Products options', 'biolife' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Order', 'biolife' ),
                'param_name'  => 'order',
                'value'       => array(
                    esc_html__( 'ASC', 'biolife' )  => 'ASC',
                    esc_html__( 'DESC', 'biolife' ) => 'DESC',
                ),
                'std'         => 'DESC',
                'description' => esc_html__( 'Designates the ascending or descending order.', 'biolife' ),
                'dependency'  => array(
                    'element'            => 'target',
                    'value_not_equal_to' => array(
                        'products',
                    ),
                ),
                'group'       => esc_html__( 'Products options', 'biolife' ),
            ),
            array(
                'type'       => 'number',
                'heading'    => esc_html__( 'Product per page', 'biolife' ),
                'param_name' => 'per_page',
                'value'      => 6,
                'dependency' => array(
                    'element'            => 'target',
                    'value_not_equal_to' => array(
                        'products',
                    ),
                ),
                'group'      => esc_html__( 'Products options', 'biolife' ),
            ),
            array(
                'type'        => 'autocomplete',
                'heading'     => esc_html__( 'Products', 'biolife' ),
                'param_name'  => 'ids',
                'settings'    => array(
                    'multiple'      => true,
                    'sortable'      => true,
                    'unique_values' => true,
                ),
                'save_always' => true,
                'description' => esc_html__( 'Enter List of Products', 'biolife' ),
                'dependency'  => array(
                    'element' => 'target',
                    'value'   => array( 'products' ),
                ),
                'group'       => esc_html__( 'Products options', 'biolife' ),
            ),
            vc_map_add_css_animation(),
        );
        /* TODO: ovic_product */
        $param['ovic_product']             = array(
            'base'        => 'ovic_product',
            'name'        => esc_html__( 'Ovic: Product', 'biolife' ),
            'icon'        => '',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'params'      => array(

                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'layout',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_product/default.jpg' ),
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style1', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_product/style1.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'autocomplete',
                    'heading'     => esc_html__( 'Product', 'biolife' ),
                    'param_name'  => 'ids',
                    'settings'    => array(
                        'multiple'      => false,
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'Select product', 'biolife' ),
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'default', 'style1'),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Sub Title', 'biolife' ),
                    'param_name'  => 'sub_title',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array(
                            'default',
                            'style1',
                        ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Intro', 'biolife' ),
                    'param_name'  => 'intro',
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'default'),
                    ),
                ),
                array(
                    'type'       => 'datepicker',
                    'heading'    => esc_html__( 'Date play', 'biolife' ),
                    'param_name' => 'countdown_date',
                    'dependency' => array(
                        'element' => 'style',
                        'value'   => array( 'style1'),
                    ),
                    'std'        => date( 'm/d/Y H:i:s' ),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Display attributes', 'biolife' ),
                    'param_name' => 'attributes',
                    'value' => $attributes,
                    'save_always' => true,
                    'dependency'  => array(
                        'element' => 'layout',
                        'value'   => array( 'default'),
                    ),
                ),
                array(
                    "type"        => "attach_image",
                    "heading"     => esc_html__( "Image", 'biolife' ),
                    "param_name"  => "image",
                    'admin_label' => true,
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array(
                            'default',
                            'style1',
                        ),
                    )
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Extent URL', 'biolife' ),
                    'param_name' => 'link',
                    'dependency' => array(
                        'element' => 'layout',
                        'value'   => array(
                            'default',
                            'style1',
                        ),
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        if ( class_exists( 'WooCommerce' ) ) {
            $param['ovic_special_offer']  = array(
                'name'     => esc_html__( 'Ovic: Special Offer', 'biolife' ),
                'base'     => 'ovic_special_offer',
                'category' => esc_html__( 'Ovic Shortcode', 'biolife' ),
                'params'   => array(
                    array(
                        'heading'    => esc_html__( 'Layout', 'biolife' ),
                        'param_name' => 'layout',
                        'type'       => 'select_preview',
                        'value'      => array(
                            'default' => array(
                                'title'   => esc_html__( 'Default', 'biolife' ),
                                'preview' => get_theme_file_uri( '/assets/images/prev/special_offer/style-1.jpg' ),
                            ),
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type'        => 'autocomplete',
                        'heading'     => esc_html__( 'Products', 'biolife' ),
                        'param_name'  => 'ids',
                        'settings'    => array(
                            'multiple'      => true,
                            'sortable'      => true,
                            'unique_values' => true,
                        ),
                        'save_always' => true,
                        'description' => esc_html__( 'Enter List of Products', 'biolife' ),
                        'dependency'  => array(
                            'element' => 'target',
                            'value'   => array( 'products' ),
                        ),
                    ),
                ),
            );
        }
        /* TODO: ovic_twitter */
        $param['ovic_twitter']             = array(
            'base'        => 'ovic_twitter',
            'name'        => esc_html__( 'Ovic: Twitter', 'biolife' ),
            'icon'        => '',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'params'      => array(
                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'layout',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_twitter/default.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Access token', 'biolife' ),
                    'param_name'  => 'access_token',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Access token secret', 'biolife' ),
                    'param_name'  => 'access_token_secret',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Consumer key', 'biolife' ),
                    'param_name'  => 'consumer_key',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Consumer secret', 'biolife' ),
                    'param_name'  => 'consumer_secret',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Screen name', 'biolife' ),
                    'param_name'  => 'screen_name',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Count', 'biolife' ),
                    'param_name'  => 'limit',
                ),
                vc_map_add_css_animation(),
            ),
        );
        $param['ovic_twitter']['params'] = array_merge(
            $param['ovic_twitter']['params'],
            biolife_vc_carousel()
        );
        /*@todo: ovic_newsletter*/
        $param['ovic_newsletter']    = array(
            'base'        => 'ovic_newsletter',
            'name'        => esc_html__( 'Ovic: Newsletter', 'biolife' ),
            'icon'        => OVIC_FRAMEWORK_URI . 'assets/images/newsletter.svg',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Display Newsletter', 'biolife' ),
            'params'      => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'biolife' ),
                    'value'       => array(
                        'style1' => array(
                            'title'   => esc_html__( 'Newsletter 01', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style01.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Newsletter Popup', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style02.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Newsletter 02', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style03.jpg' ),
                        ),
                        'style5' => array(
                            'title'   => esc_html__( 'Newsletter 03', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style05.jpg' ),
                        ),
                        'style4' => array(
                            'title'   => esc_html__( 'Newsletter 04', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style04.jpg' ),
                        ),
                        'style6' => array(
                            'title'   => esc_html__( 'Newsletter 06', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style06.jpg' ),
                        ),
                        'style7' => array(
                            'title'   => esc_html__( 'Newsletter 07', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style07.jpg' ),
                        ),
                        'style8' => array(
                            'title'   => esc_html__( 'Newsletter 08', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style08.jpg' ),
                        ),
                        'style9' => array(
                            'title'   => esc_html__( 'Newsletter 09', 'biolife' ),
                            'preview' => get_theme_file_uri( 'assets/images/prev/newsletter/style09.jpg' ),
                        ),
                    ),
                    'default'     => 'style-1',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    "type"        => "attach_image",
                    "heading"     => esc_html__( "Image Newsletter", 'biolife' ),
                    "param_name"  => "images",
                    'dependency' => array(
                        'element' => 'style',
                        "value"   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Title', 'biolife' ),
                    'param_name' => 'title',
                    'dependency' => array(
                        'element' => 'style',
                        "value"   => array( 'style1', 'style4', 'style5', 'style6', 'style7', 'style9' ),
                    ),
                ),
                array(
                    'type'       => 'textarea_html',
                    'heading'    => esc_html__( 'Title', 'biolife' ),
                    'param_name' => 'title_text',
                    'dependency' => array(
                        'element' => 'style',
                        "value"   => array( 'style8' ),
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Subtitle', 'biolife' ),
                    'param_name' => 'subtitle',
                    'dependency' => array(
                        'element' => 'style',
                        "value"   => array( 'style1', 'style5', 'style6', 'style8' ),
                    ),
                ),
                array(
                    'type'       => 'textarea',
                    'heading'    => esc_html__( 'Descriptions', 'biolife' ),
                    'param_name' => 'desc',
                    'dependency' => array(
                        'element' => 'style',
                        "value"   => array('style4', 'style7', 'style9' ),
                    ),
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Show Mailchimp List', 'biolife' ),
                    'param_name' => 'show_list',
                    'value'      => array(
                        esc_html__( 'Yes', 'biolife' ) => 'yes',
                        esc_html__( 'No', 'biolife' )  => 'no',
                    ),
                    'std'        => 'no',
                ),
                array(
                    'type'       => 'dropdown',
                    'heading'    => esc_html__( 'Show Field Name', 'biolife' ),
                    'param_name' => 'field_name',
                    'value'      => array(
                        esc_html__( 'Yes', 'biolife' ) => 'yes',
                        esc_html__( 'No', 'biolife' )  => 'no',
                    ),
                    'std'        => 'no',
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'First Name Text', 'biolife' ),
                    'param_name' => 'fname_text',
                    'std'        => esc_html__( 'First Name', 'biolife' ),
                    'dependency' => array(
                        'element' => 'field_name',
                        'value'   => 'yes',
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Last Name Text', 'biolife' ),
                    'param_name' => 'lname_text',
                    'std'        => esc_html__( 'Last Name', 'biolife' ),
                    'dependency' => array(
                        'element' => 'field_name',
                        'value'   => 'yes',
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Placeholder Text', 'biolife' ),
                    'param_name' => 'placeholder',
                    'std'        => esc_html__( 'Your email letter', 'biolife' ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => esc_html__( 'Button Text', 'biolife' ),
                    'param_name' => 'button_text',
                    'std'        => esc_html__( 'Subscribe', 'biolife' ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_tabs*/
        $param['ovic_tabs']['params'] = array(
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Select style', 'biolife' ),
                'value'       => array(
                    'default' => array(
                        'title'   => esc_html__( 'Default', 'biolife' ),
                        'preview' => '',
                    ),
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style01.jpg' ),
                    ),
                    'style2' => array(
                        'title'   => esc_html__( 'Style 02', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style02.jpg' ),
                    ),
                    'style3' => array(
                        'title'   => esc_html__( 'Style 03', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style03.jpg' ),
                    ),
                    'style4' => array(
                        'title'   => esc_html__( 'Style 04', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style04.jpg' ),
                    ),
                    'style5' => array(
                        'title'   => esc_html__( 'Style 05', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style05.jpg' ),
                    ),
                    'style6' => array(
                        'title'   => esc_html__( 'Style 06', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style06.jpg' ),
                    ),
                    'style7' => array(
                        'title'   => esc_html__( 'Style 07', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_tabs/style07.jpg' ),
                    ),
                ),
                'default'     => 'default',
                'admin_label' => true,
                'param_name'  => 'layout',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'biolife' ),
                'param_name'  => 'tab_title',
                'description' => esc_html__( 'The title of shortcode', 'biolife' ),
                'admin_label' => true,
                'dependency'  => array(
                    'element'            => 'layout',
                    'value_not_equal_to' => array( 'style5' ),
                ),
            ),
            array(
                'type'        => 'textarea_html',
                'heading'     => esc_html__( 'Title', 'biolife' ),
                'param_name'  => 'tab_title_1',
                'description' => esc_html__( 'The title of shortcode', 'biolife' ),
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'layout',
                    "value"   => array( 'style5' ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Subtitle', 'biolife' ),
                'param_name'  => 'sub_title',
                'dependency' => array(
                    'element' => 'layout',
                    "value"   => array( 'style1', 'style2', 'style4', 'style5' ),
                ),
            ),
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Icon", 'biolife' ),
                "param_name"  => "icon",
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array(
                        'style1',
                        'style3',
                    ),
                ),
            ),
            array(
                "type"        => "attach_image",
                "heading"     => esc_html__( "Banner", 'biolife' ),
                "param_name"  => "banner",
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'style3'),
                ),
            ),
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__( 'Extra link', 'biolife' ),
                'param_name' => 'link',
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'style3'),
                ),
            ),
            array(
                'param_name' => 'ajax_check',
                'heading'    => esc_html__( 'Using Ajax Tabs', 'biolife' ),
                'type'       => 'dropdown',
                'value'      => array(
                    esc_html__( 'Yes', 'biolife' ) => '1',
                    esc_html__( 'No', 'biolife' )  => '0',
                ),
                'std'        => '0',
            ),
            array(
                'type'       => 'number',
                'heading'    => esc_html__( 'Active Section', 'biolife' ),
                'param_name' => 'active_section',
                'std'        => 0,
            ),
            vc_map_add_css_animation(),
        );
        /*@todo: ovic_accordion*/
        $param['ovic_accordion']['params']  = array(
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Select style', 'biolife' ),
                'value'       => array(
                    'default' => array(
                        'title'   => 'Default',
                        'preview' => '',
                    ),
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_accordion/style01.jpg' ),
                    ),
                ),
                'default'     => 'default',
                'admin_label' => true,
                'param_name'  => 'style',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'biolife' ),
                'param_name'  => 'tab_title',
                'description' => esc_html__( 'The title of shortcode', 'biolife' ),
                'admin_label' => true,
            ),
            vc_map_add_css_animation(),
            array(
                'param_name' => 'ajax_check',
                'heading'    => esc_html__( 'Using Ajax Tabs', 'biolife' ),
                'type'       => 'dropdown',
                'value'      => array(
                    esc_html__( 'Yes', 'biolife' ) => '1',
                    esc_html__( 'No', 'biolife' )  => '0',
                ),
                'std'        => '0',
                'dependency' => array(
                    "element" => "layout",
                    "value"   => array( 'default'),
                ),
            ),
            array(
                'type'       => 'number',
                'heading'    => esc_html__( 'Active Section', 'biolife' ),
                'param_name' => 'active_section',
                'std'        => 1,
            ),
            vc_map_add_css_animation(),
        );
        /* Map New Custom menu */
        $all_menu = array();
        $menus    = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( $menus && count( $menus ) > 0 ) {
            foreach ( $menus as $m ) {
                $all_menu[$m->name] = $m->slug;
            }
        }
        /*@todo: ovic_custommenu*/
        $param['ovic_custommenu'] = array(
            'base'        => 'ovic_custommenu',
            'name'        => esc_html__( 'Ovic: Custom Menu', 'biolife' ),
            'icon'        => OVIC_FRAMEWORK_URI . 'assets/images/menu.svg',
            'category'    => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description' => esc_html__( 'Display Custom Menu', 'biolife' ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'title',
                    'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'biolife' ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select Style', 'biolife' ),
                    'value'       => array(
                        'default' => array(
                            'title' => esc_html__( 'Default', 'biolife' ),
                        ),
                        'style01' => array(
                            'title'   => esc_html__( 'Style01', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style01.jpg' ),
                        ),
                        'style02' => array(
                            'title'   => esc_html__( 'Style02', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style02.jpg' ),
                        ),
                        'style03' => array(
                            'title'   => esc_html__( 'Style03', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style03.jpg' ),
                        ),
                        'style05' => array(
                            'title'   => esc_html__( 'Style04', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style05.jpg' ),
                        ),
                        'style06' => array(
                            'title'   => esc_html__( 'Style05', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style06.jpg' ),
                        ),
                        'style07' => array(
                            'title'   => esc_html__( 'Style06', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style07.jpg' ),
                        ),
                        'style08' => array(
                            'title'   => esc_html__( 'Style08', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style08.jpg' ),
                        ),
                        'style09' => array(
                            'title'   => esc_html__( 'Style09', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style09.jpg' ),
                        ),
                        'style10' => array(
                            'title'   => esc_html__( 'Style10', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style10.jpg' ),
                        ),
                        'style11' => array(
                            'title'   => esc_html__( 'Style11', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style11.jpg' ),
                        ),
                        'style12' => array(
                            'title'   => esc_html__( 'Style12', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style12.jpg' ),
                        ),
                        'style13' => array(
                            'title'   => esc_html__( 'Style13', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style13.jpg' ),
                        ),
                        'style14' => array(
                            'title'   => esc_html__( 'Style14', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_custommenu/style14.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style_menu',
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Menu', 'biolife' ),
                    'value'       => $all_menu,
                    'admin_label' => true,
                    'param_name'  => 'nav_menu',
                    'description' => esc_html__( 'Select menu to display.', 'biolife' ),
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Link All', 'biolife' ),
                    'param_name' => 'link',
                    'dependency'  => array(
                        'element' => 'style_menu',
                        'value'   => array( 'style09' ),
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_slide*/
        $param['ovic_slide']      = array(
            'base'                    => 'ovic_slide',
            'name'                    => esc_html__( 'Ovic: Slide', 'biolife' ),
            'icon'                    => OVIC_FRAMEWORK_URI . 'assets/images/slider.svg',
            'category'                => esc_html__( 'Ovic Shortcode', 'biolife' ),
            'description'             => esc_html__( 'Display Slide', 'biolife' ),
            'as_parent'               => array(
                'only' => 'vc_single_image, vc_custom_heading, ovic_person, vc_column_text, ovic_iconbox, ovic_banner, ovic_category, ovic_socials,ovic_custommenu, vc_row',
            ),
            'content_element'         => true,
            'show_settings_on_create' => true,
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'        => 'select_preview',
                    'heading'     => esc_html__( 'Select style', 'biolife' ),
                    'value'       => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'biolife' ),
                            'preview' => '',
                        ),
                        'style1'  => array(
                            'title'   => esc_html__( 'Style1', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_slide/style1.jpg' ),
                        ),
                        'style2'  => array(
                            'title'   => esc_html__( 'Style2', 'biolife' ),
                            'preview' => '',
                        ),
                        'style3'  => array(
                            'title'   => esc_html__( 'Style3', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_slide/style3.jpg' ),
                        ),
                        'style4'  => array(
                            'title'   => esc_html__( 'Style4', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_slide/style4.jpg' ),
                        ),
                    ),
                    'default'     => 'default',
                    'admin_label' => true,
                    'param_name'  => 'style',
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Before Title', 'biolife' ),
                    'param_name'  => 'before_title',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'slider_title',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element'            => 'style',
                        'value_not_equal_to' => array( 'style4' ),
                    ),
                ),
                array(
                    'type'        => 'textarea',
                    'heading'     => esc_html__( 'Title', 'biolife' ),
                    'param_name'  => 'slider_title_1',
                    'admin_label' => true,
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style4' ),
                    ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'After Title', 'biolife' ),
                    'param_name'  => 'after_title',
                    'dependency'  => array(
                        'element' => 'style',
                        'value'   => array( 'style1' ),
                    ),
                ),
                vc_map_add_css_animation(),
            ),
        );
        /*@todo: ovic_person*/
        $param['ovic_person']['params']     = array(
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Select style', 'biolife' ),
                'value'       => array(
                    'default' => array(
                        'title'   => esc_html__( 'Default', 'biolife' ),
                        'preview' => '',
                    ),
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_person/style1.jpg' ),
                    ),
                    'style2' => array(
                        'title'   => esc_html__( 'Style 02', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_person/style2.jpg' ),
                    ),
                ),
                'default'     => 'default',
                'admin_label' => true,
                'param_name'  => 'layout',
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__( 'Avatar Person', 'biolife' ),
                'param_name' => 'avatar',
                'dependency'  => array(
                    'element'            => 'layout',
                    'value_not_equal_to' => array( 'style2' ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Name', 'biolife' ),
                'param_name'  => 'name',
                'description' => esc_html__( 'Name of Person.', 'biolife' ),
                'admin_label' => true,
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Positions', 'biolife' ),
                'param_name'  => 'positions',
                'admin_label' => true,
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__( 'Descriptions', 'biolife' ),
                'param_name' => 'desc',
                'dependency'  => array(
                    'element'            => 'layout',
                    'value_not_equal_to' => array( 'style2' ),
                ),
            ),
            array(
                'type'       => 'vc_link',
                'heading'    => esc_html__( 'Link', 'biolife' ),
                'param_name' => 'link',
            ),
            vc_map_add_css_animation(),
        );
        /*@todo: ovic_instagram*/
        $param['ovic_instagram']['params']     = array(
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Select style', 'biolife' ),
                'value'       => array(
                    'default' => array(
                        'title'   => esc_html__( 'Default', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_instagram/default.jpg' ),
                    ),
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_instagram/style1.jpg' ),
                    ),
                    'style2' => array(
                        'title'   => esc_html__( 'Style 02', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/ovic_instagram/style2.jpg' ),
                    ),
                ),
                'default'     => 'default',
                'admin_label' => true,
                'param_name'  => 'layout',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'biolife' ),
                'param_name'  => 'title',
                'description' => esc_html__( 'The title of shortcode', 'biolife' ),
                'admin_label' => true,
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Subtitle', 'biolife' ),
                'param_name'  => 'sub_title',
                'dependency'  => array(
                    'element'            => 'layout',
                    'value_not_equal_to' => array( 'style2' ),
                ),
            ),
            array(
                'type'        => 'textarea',
                'heading'     => esc_html__( 'Description', 'biolife' ),
                'param_name'  => 'desc',
                'dependency'  => array(
                    'element' => 'layout',
                    'value'   => array( 'style1' ),
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Instagram List style', 'biolife' ),
                'param_name' => 'productsliststyle',
                'value'      => array(
                    esc_html__( 'Grid Bootstrap', 'biolife' ) => 'grid',
                    esc_html__( 'Owl Carousel', 'biolife' )   => 'owl',
                ),
                'std'        => 'grid',
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Image Source', 'biolife' ),
                'param_name' => 'image_source',
                'value'      => array(
                    esc_html__( 'From Instagram', 'biolife' )   => 'instagram',
                    esc_html__( 'From Local Image', 'biolife' ) => 'gallery',
                ),
                'std'        => 'instagram',
            ),
            array(
                'type'       => 'attach_images',
                'heading'    => esc_html__( 'Image Gallery', 'biolife' ),
                'param_name' => 'image_gallery',
                'dependency' => array(
                    'element' => 'image_source',
                    'value'   => array( 'gallery' ),
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Image Resolution', 'biolife' ),
                'param_name' => 'image_resolution',
                'value'      => array(
                    esc_html__( 'Thumbnail', 'biolife' )           => 'thumbnail',
                    esc_html__( 'Low Resolution', 'biolife' )      => 'low_resolution',
                    esc_html__( 'Standard Resolution', 'biolife' ) => 'standard_resolution',
                ),
                'std'        => 'thumbnail',
                'dependency' => array(
                    'element' => 'image_source',
                    'value'   => array( 'instagram' ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'ID Instagram', 'biolife' ),
                'param_name'  => 'id_instagram',
                'admin_label' => true,
                'dependency'  => array(
                    'element' => 'image_source',
                    'value'   => array( 'instagram' ),
                ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Token Instagram', 'biolife' ),
                'param_name'  => 'token',
                'dependency'  => array(
                    'element' => 'image_source',
                    'value'   => array( 'instagram' ),
                ),
                'description' => wp_kses( sprintf( '<a href="%s" target="_blank">' . esc_html__( 'Get Token Instagram Here!', 'biolife' ) . '</a>', 'http://instagram.pixelunion.net' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
            ),
            array(
                'type'        => 'number',
                'heading'     => esc_html__( 'Items Instagram', 'biolife' ),
                'param_name'  => 'items_limit',
                'description' => esc_html__( 'the number items show', 'biolife' ),
                'std'         => '4',
                'dependency'  => array(
                    'element' => 'image_source',
                    'value'   => array( 'instagram' ),
                ),
            ),
            vc_map_add_css_animation(),
        );
        /*@todo: ovic_blog*/
        array_splice( $param['ovic_blog']['params'], 1, 0,
            array(
                array(
                    'heading'    => esc_html__( 'Layout', 'biolife' ),
                    'param_name' => 'layout',
                    'type'       => 'select_preview',
                    'value'      => array(
                        'default' => array(
                            'title'   => esc_html__( 'Default', 'biolife' ),
                            'preview' => '',
                        ),
                        'style1' => array(
                            'title'   => esc_html__( 'Style 1', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_blog/style1.jpg' ),
                        ),
                        'style2' => array(
                            'title'   => esc_html__( 'Style 2', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_blog/style2.jpg' ),
                        ),
                        'style3' => array(
                            'title'   => esc_html__( 'Style 3', 'biolife' ),
                            'preview' => get_theme_file_uri( '/assets/images/prev/ovic_blog/style3.jpg' ),
                        ),
                    ),
                    'admin_label' => true,
                )
            )
        );
        array_splice( $param['ovic_blog']['params'], 3, 0,
            array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Subtitle', 'biolife' ),
                    'param_name'  => 'sub_title',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style1' ),
                    ),
                ),
                array(
                    'type'        => 'vc_link',
                    'heading'     => esc_html__( 'Link', 'biolife' ),
                    'param_name'  => 'link',
                    'dependency' => array(
                        "element" => "layout",
                        "value"   => array( 'style2' ),
                    ),
                ),
                vc_map_add_css_animation(),
            )
        );
        $attributes                       = array(
            array(
                'type'        => 'select_preview',
                'heading'     => esc_html__( 'Select style', 'biolife' ),
                'group'       => esc_html__( 'Image Group', 'biolife' ),
                'param_name'  => 'style',
                'value'       => array(
                    'style1' => array(
                        'title'   => esc_html__( 'Style 01', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-1.jpg' ),
                    ),
                    'style2' => array(
                        'title'   => esc_html__( 'Style 02', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-2.jpg' ),
                    ),
                    'style3' => array(
                        'title'   => esc_html__( 'Style 03', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-3.jpg' ),
                    ),
                    'style4' => array(
                        'title'   => esc_html__( 'Style 04', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-4.jpg' ),
                    ),
                    'style5' => array(
                        'title'   => esc_html__( 'Style 05', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-5.jpg' ),
                    ),
                    'style6' => array(
                        'title'   => esc_html__( 'Style 06', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-6.jpg' ),
                    ),
                    'style7' => array(
                        'title'   => esc_html__( 'Style 07', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-7.jpg' ),
                    ),
                    'style8' => array(
                        'title'   => esc_html__( 'Style 08', 'biolife' ),
                        'preview' => get_theme_file_uri( '/assets/images/prev/tab/tab-style-8.jpg' ),
                    ),
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__( 'Choose rating stars', 'biolife' ),
                'group'       => esc_html__( 'Image Group', 'biolife' ),
                'param_name' => 'select_rating',
                'value'      => array(
                    esc_html__( '0 number of star', 'biolife' )  => 'star star-0',
                    esc_html__( '01 number of star', 'biolife' ) => 'star star-1',
                    esc_html__( '02 number of star', 'biolife' ) => 'star star-2',
                    esc_html__( '03 number of star', 'biolife' ) => 'star star-3',
                    esc_html__( '04 number of star', 'biolife' ) => 'star star-4',
                    esc_html__( '05 number of star', 'biolife' ) => 'star star-5',
                ),
                'dependency' => array(
                    'element' => 'style',
                    "value"   => array( 'style2' ),
                ),
            ),
            array(
                "type"        => 'colorpicker',
                'group'       => esc_html__( 'Image Group', 'biolife' ),
                "heading"     => esc_html__( "Color", 'biolife' ),
                "param_name"  => "color_default",
                'dependency' => array(
                    "element" => "style",
                    "value"   => array('style4', 'style7' ),
                ),
            ),
            array(
                "type"        => 'colorpicker',
                'group'       => esc_html__( 'Image Group', 'biolife' ),
                "heading"     => esc_html__( "Active color", 'biolife' ),
                "param_name"  => "color",
                'dependency' => array(
                    "element" => "style",
                    "value"   => array('style3', 'style4', 'style7' ),
                ),
            ),
            array(
                "type"        => 'attach_images',
                'group'       => esc_html__( 'Image Group', 'biolife' ),
                "heading"     => esc_html__( "Background image", 'biolife' ),
                "param_name"  => "background_image",
                'dependency' => array(
                    "element" => "style",
                    "value"   => array('style8' ),
                ),
            ),
            vc_map_add_css_animation(),

        );
        vc_add_params( 'vc_tta_section', $attributes );
        vc_add_params(
            'vc_single_image',
            array(
                array(
                    'param_name' => 'image_effect',
                    'heading'    => esc_html__( 'Effect', 'biolife' ),
                    'group'      => esc_html__( 'Image Effect', 'biolife' ),
                    'type'       => 'dropdown',
                    'value'      => array(
                        esc_html__( 'None', 'biolife' )                      => 'none',
                        esc_html__( 'Opacity', 'biolife' )             => 'effect effect25',
                        esc_html__( 'Zoom', 'biolife' )             => 'effect effect-zoom',
                        esc_html__( 'Effeft 16', 'biolife' )             => 'effect effect16',
                    ),
                    'sdt'        => 'none',
                ),
            )
        );
        return $param;
    }
}
function biolife_vc_carousel( $dependency = null, $value_dependency = null )
{
    $data_value      = array();
    $data_carousel   = array(
        'owl_number_row'       => array(
            'type'       => 'dropdown',
            'value'      => array(
                esc_html__( '1 Row', 'biolife' )  => '1',
                esc_html__( '2 Rows', 'biolife' ) => '2',
                esc_html__( '3 Rows', 'biolife' ) => '3',
                esc_html__( '4 Rows', 'biolife' ) => '4',
                esc_html__( '5 Rows', 'biolife' ) => '5',
                esc_html__( '6 Rows', 'biolife' ) => '6',
            ),
            'std'        => '1',
            'heading'    => esc_html__( 'The number of rows which are shown on block', 'biolife' ),
            'param_name' => 'owl_number_row',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_rows_space'       => array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Rows space', 'biolife' ),
            'param_name' => 'owl_rows_space',
            'value'      => array(
                esc_html__( 'Default', 'biolife' ) => 'rows-space-0',
                esc_html__( '10px', 'biolife' )    => 'rows-space-10',
                esc_html__( '20px', 'biolife' )    => 'rows-space-20',
                esc_html__( '30px', 'biolife' )    => 'rows-space-30',
                esc_html__( '40px', 'biolife' )    => 'rows-space-40',
                esc_html__( '50px', 'biolife' )    => 'rows-space-50',
                esc_html__( '60px', 'biolife' )    => 'rows-space-60',
                esc_html__( '70px', 'biolife' )    => 'rows-space-70',
                esc_html__( '80px', 'biolife' )    => 'rows-space-80',
                esc_html__( '90px', 'biolife' )    => 'rows-space-90',
                esc_html__( '100px', 'biolife' )   => 'rows-space-100',
            ),
            'std'        => 'rows-space-0',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => 'owl_number_row', 'value' => array( '2', '3', '4', '5', '6' ),
            ),
        ),
        'owl_center_mode'      => array(
            'type'       => 'dropdown',
            'value'      => array(
                esc_html__( 'Yes', 'biolife' ) => 'true',
                esc_html__( 'No', 'biolife' )  => 'false',
            ),
            'std'        => 'false',
            'heading'    => esc_html__( 'Center Mode', 'biolife' ),
            'param_name' => 'owl_center_mode',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_center_padding'   => array(
            'type'        => 'number',
            'heading'     => esc_html__( 'Center Padding', 'biolife' ),
            'param_name'  => 'owl_center_padding',
            'value'       => '50',
            'min'         => 0,
            'suffix'      => esc_html__( 'Pixel', 'biolife' ),
            'description' => esc_html__( 'Distance( or space) between 2 item', 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => 'owl_center_mode', 'value' => array( 'true' ),
            ),
        ),
        'owl_vertical'         => array(
            'type'       => 'dropdown',
            'value'      => array(
                esc_html__( 'Yes', 'biolife' ) => 'true',
                esc_html__( 'No', 'biolife' )  => 'false',
            ),
            'std'        => 'false',
            'heading'    => esc_html__( 'Vertical Mode', 'biolife' ),
            'param_name' => 'owl_vertical',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_verticalswiping'  => array(
            'type'       => 'dropdown',
            'value'      => array(
                esc_html__( 'Yes', 'biolife' ) => 'true',
                esc_html__( 'No', 'biolife' )  => 'false',
            ),
            'std'        => 'false',
            'heading'    => esc_html__( 'verticalSwiping', 'biolife' ),
            'param_name' => 'owl_verticalswiping',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => 'owl_vertical', 'value' => array( 'true' ),
            ),
        ),
        'owl_autoplay'         => array(
            'type'       => 'dropdown',
            'value'      => array(
                esc_html__( 'Yes', 'biolife' ) => 'true',
                esc_html__( 'No', 'biolife' )  => 'false',
            ),
            'std'        => 'false',
            'heading'    => esc_html__( 'AutoPlay', 'biolife' ),
            'param_name' => 'owl_autoplay',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_autoplayspeed'    => array(
            'type'        => 'number',
            'heading'     => esc_html__( 'Autoplay Speed', 'biolife' ),
            'param_name'  => 'owl_autoplayspeed',
            'value'       => '1000',
            'min'         => 0,
            'suffix'      => esc_html__( 'milliseconds', 'biolife' ),
            'description' => esc_html__( 'Autoplay speed in milliseconds', 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => 'owl_autoplay', 'value' => array( 'true' ),
            ),
        ),
        'owl_navigation'       => array(
            'type'        => 'dropdown',
            'value'       => array(
                esc_html__( 'No', 'biolife' )  => 'false',
                esc_html__( 'Yes', 'biolife' ) => 'true',
            ),
            'std'         => 'true',
            'heading'     => esc_html__( 'Navigation', 'biolife' ),
            'param_name'  => 'owl_navigation',
            'description' => esc_html__( "Show buton 'next' and 'prev' buttons.", 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_navigation_style' => array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Navigation style', 'biolife' ),
            'param_name' => 'owl_navigation_style',
            'value'      => array(
                esc_html__( 'Default', 'biolife' ) => '',
            ),
            'std'        => '',
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency' => array( 'element' => 'owl_navigation', 'value' => array( 'true' ) ),
        ),
        'owl_dots'             => array(
            'type'        => 'dropdown',
            'value'       => array(
                esc_html__( 'No', 'biolife' )  => 'false',
                esc_html__( 'Yes', 'biolife' ) => 'true',
            ),
            'std'         => 'false',
            'heading'     => esc_html__( 'Dots', 'biolife' ),
            'param_name'  => 'owl_dots',
            'description' => esc_html__( "Show dots buttons.", 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_loop'             => array(
            'type'        => 'dropdown',
            'value'       => array(
                esc_html__( 'Yes', 'biolife' ) => 'true',
                esc_html__( 'No', 'biolife' )  => 'false',
            ),
            'std'         => 'false',
            'heading'     => esc_html__( 'Loop', 'biolife' ),
            'param_name'  => 'owl_loop',
            'description' => esc_html__( 'Inifnity loop. Duplicate last and first items to get loop illusion.', 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_slidespeed'       => array(
            'type'        => 'number',
            'heading'     => esc_html__( 'Slide Speed', 'biolife' ),
            'param_name'  => 'owl_slidespeed',
            'value'       => '300',
            'min'         => 0,
            'suffix'      => esc_html__( 'milliseconds', 'biolife' ),
            'description' => esc_html__( 'Slide speed in milliseconds', 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_slide_margin'     => array(
            'type'        => 'number',
            'heading'     => esc_html__( 'Margin', 'biolife' ),
            'param_name'  => 'owl_slide_margin',
            'value'       => '30',
            'min'         => 0,
            'suffix'      => esc_html__( 'Pixel', 'biolife' ),
            'description' => esc_html__( 'Distance( or space) between 2 item', 'biolife' ),
            'group'       => esc_html__( 'Carousel settings', 'biolife' ),
            'dependency'  => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
        'owl_ls_items'         => array(
            'type'       => 'number',
            'heading'    => esc_html__( 'The items on desktop (Screen resolution of device >= 1500px )', 'biolife' ),
            'param_name' => 'owl_ls_items',
            'value'      => '4',
            'suffix'     => esc_html__( 'item(s)', 'biolife' ),
            'group'      => esc_html__( 'Carousel settings', 'biolife' ),
            'min'        => 1,
            'dependency' => array(
                'element' => $dependency, 'value' => array( $value_dependency ),
            ),
        ),
    );
    $data_responsive = Ovic_Framework_Options::ovic_data_responsive_carousel();
    if ( !empty( $data_responsive ) ) {
        arsort( $data_responsive );
        foreach ( $data_responsive as $key => $item ) {
            if ( $item['screen'] == 1500 ) {
                $std = '4';
            } elseif ( $item['screen'] == 1200 ) {
                $std = '3';
            } elseif ( $item['screen'] == 992 || $item['screen'] == 768 ) {
                $std = '2';
            } elseif ( $item['screen'] == 480 ) {
                $std = '1';
            }
            $data_carousel["owl_{$item['name']}"] = array(
                'type'       => 'number',
                'heading'    => $item['title'],
                'param_name' => "owl_{$item['name']}",
                'value'      => isset( $std ) ? $std : '',
                'suffix'     => esc_html__( 'item(s)', 'biolife' ),
                'group'      => esc_html__( 'Carousel settings', 'biolife' ),
                'min'        => 1,
                'dependency' => array(
                    'element' => $dependency, 'value' => array( $value_dependency ),
                ),
            );
        }
    }
    $data_carousel = apply_filters( 'ovic_vc_options_carousel', $data_carousel, $dependency, $value_dependency );
    if ( $dependency == null && $value_dependency == null ) {
        $match = array(
            'owl_navigation_style',
            'owl_autoplayspeed',
            'owl_rows_space',
            'owl_verticalswiping',
            'owl_center_padding',
        );
        foreach ( $data_carousel as $value ) {
            if ( !in_array( $value['param_name'], $match ) ) {
                unset( $value['dependency'] );
            }
            $data_value[] = $value;
        }
    } else {
        foreach ( $data_carousel as $value ) {
            $data_value[] = $value;
        }
    }
    return $data_value;
}
/**ADD-NEW-FONTS**/
if ( !function_exists( 'fafa_vc_fonts' ) ) {
    function fafa_vc_fonts( $fonts_list )
    {
        $Cairo                          = new stdClass();
        $Cairo->font_family             = 'Cairo';
        $Cairo->font_types              = '300 light :300:normal,400 regular:400:normal,600 sime-bold:600:normal,700 bold :700:normal,900 black :700:normal';
        $Cairo->font_styles             = 'regular';
        $Cairo->font_family_description = esc_html__( 'Select font family', 'biolife' );
        $Cairo->font_style_description  = esc_html__( 'Select font styling', 'biolife' );
        $fonts_list[]                   = $Cairo;
        return $fonts_list;
    }
}
add_filter( 'vc_google_fonts_get_fonts_filter', 'fafa_vc_fonts' );
