<?php
if ( ! defined( 'ABSPATH' ) )  exit; 
/*
Plugin Name: VC Owl Carousel
Plugin URI: viankakrisna.github.io
Description: Add-on for easily create owl carousel using Visual Composer's Drag and Drop feature
Author: Ade Viankakrisna Fadlil
Version: 0.0.1
Author URI: http://viankakrisna.com
Text Domain: vc_owlcarousel
License: GPLv2
*/

add_action( 'init', function(){
    wp_enqueue_script( 'vc_owlcarousel_js', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), false, true );
    wp_enqueue_script( 'vc_owlcarousel_init', plugins_url('assets/js/owl.carousel.init.js', __FILE__), array('jquery', 'vc_owlcarousel_js'), false, true );
    wp_enqueue_style( 'vc_owlcarousel_css', plugins_url('assets/css/owl.carousel.css', __FILE__) );
    wp_enqueue_style( 'vc_owlcarousel_theme_css', plugins_url('assets/css/owl.theme.css', __FILE__) );
    wp_enqueue_style( 'vc_owlcarousel_css', plugins_url('assets/css/owl.transition_comment_status.css', __FILE__) );
});


add_action( 'after_setup_theme', 'vc_owlcarousel_integrateWithVC' );

function vc_owlcarousel_integrateWithVC() {

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_vc_owlcarousel extends WPBakeryShortCodesContainer {
            static function set(){
                return array(
                    'items' => '5',
                    'itemsCustom' => 'false',
                    'itemsDesktop' => '1199,4',
                    'itemsDesktopSmall' => '980,3',
                    'itemsTablet' => '768,2',
                    'itemsTabletSmall' => 'false',
                    'itemsMobile' => '479,1',
                    'singleItem' => 'false',
                    'itemsScaleUp' => 'false',
                 
                    //Basic Speeds
                    'slideSpeed' => '200',
                    'paginationSpeed' => '800',
                    'rewindSpeed' => '1000',
                 
                    //Autoplay
                    'autoPlay' => 'false',
                    'stopOnHover' => 'false',
                 
                    // Navigation
                    'navigation' => 'false',
                    'navigationText' => "prev,next",
                    'rewindNav' => 'true',
                    'scrollPerPage' => 'false',
                 
                    //Pagination
                    'pagination' => 'true',
                    'paginationNumbers' => 'false',
                 
                    // Responsive 
                    'responsive' => 'true',
                    'responsiveRefreshRate' => '200',
                    'responsiveBaseWidth' => 'window',
                 
                    // CSS Styles
                    'baseClass' => 'owl-carousel',
                    'theme' => 'owl-theme',
                 
                    //Lazy load
                    'lazyLoad' => 'false',
                    'lazyFollow' => 'true',
                    'lazyEffect' => 'fade',
                 
                    //Auto height
                    'autoHeight' => 'false',
                 
                    //JSON 
                    'jsonPath' => 'false', 
                    'jsonSuccess' => 'false',
                 
                    //Mouse Events
                    'dragBeforeAnimFinish' => 'true',
                    'mouseDrag' => 'true',
                    'touchDrag' => 'true',
                 
                    //Transitions
                    'transitionStyle' => 'false',
                 
                    // Other
                    'addClassActive' => 'false',
                 
                    //Callbacks
                    'beforeUpdate' => 'false',
                    'afterUpdate' => 'false',
                    'beforeInit' => 'false', 
                    'afterInit' => 'false', 
                    'beforeMove' => 'false', 
                    'afterMove' => 'false',
                    'afterAction' => 'false',
                    'startDragging' => 'false',
                    'afterLazyLoad' => 'false',
                );
            }
        }
    } 

    vc_map( array(
        "name" => __("VC Owl Carousel", "vc_owlcarousel"),
        "base" => "vc_owlcarousel",
        "as_parent" => array('only' => 'vc_owlcarousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "is_container" => true,
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items on Desktop', 'js_composer' ),
                'param_name' => 'itemsDesktop',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsDesktop'],
                'description' => __('As above.', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items on Desktop Small', 'js_composer' ),
                'param_name' => 'itemsDesktopSmall',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsDesktopSmall'],
                'description' => __('As above.', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items', 'js_composer' ),
                'param_name' => 'items',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['items'],
                'description' => __('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'js_composer')
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items Custom ', 'js_composer' ),
                'param_name' => 'itemsCustom',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsCustom'],
                'description' => __("This allow you to add custom variations of items depending from the width If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled For better preview, order the arrays by screen size, but it's not mandatory Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available. 
Example:
[[0, 2], [400, 4], [700, 6], [1000, 8], [1200, 10], [1600, 16]]
For more information about structure of the internal arrays see itemsDesktop.", 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items on Tablet', 'js_composer' ),
                'param_name' => 'itemsTablet',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsTablet'],
                'description' => __('As above.', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items on Tablet Small', 'js_composer' ),
                'param_name' => 'itemsTabletSmall',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsTabletSmall'],
                'description' => __('As above. Default value is disabled.', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Number of Items on Mobile', 'js_composer' ),
                'param_name' => 'itemsMobile',
                'group' => __( 'Number of Items', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsMobile'],
                'description' => __('As above.', 'js_composer')
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Single Item', 'js_composer' ),
                'param_name' => 'singleItem',
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['singleItem'],
                'description' => __('Display only one item.', 'js_composer')

            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Item Scale Up', 'js_composer' ),
                'param_name' => 'itemsScaleUp',
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['itemsScaleUp'],
                'description' => __('Option to not stretch items when it is less than the supplied items.', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Slide Speed', 'js_composer' ),
                'param_name' => 'slideSpeed',
                'group' => __( 'Basic Speeds', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['slideSpeed'],
                'description' => __('Slide speed in milliseconds', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Pagination Speed', 'js_composer' ),
                'param_name' => 'paginationSpeed',
                'group' => __( 'Basic Speeds', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['paginationSpeed'],
                'description' => __('Pagination speed in milliseconds', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Rewind Speed', 'js_composer' ),
                'param_name' => 'rewindSpeed',
                'group' => __( 'Basic Speeds', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['rewindSpeed'],
                'description' => __('Rewind speed in milliseconds', 'js_composer')
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Autoplay', 'js_composer' ),
                'param_name' => 'autoPlay',
                'group' => __( 'Autoplay', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['autoPlay'],
                'description' => __('Change to any integrer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Stop on Hover', 'js_composer' ),
                'param_name' => 'stopOnHover',
                'group' => __( 'Autoplay', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['stopOnHover'],
                'description' => __('Stop autoplay on mouse hover', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Navigation', 'js_composer' ),
                'param_name' => 'navigation',
                'group' => __( 'Navigation', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['navigation'],
                'description' => __('Display "next" and "prev" buttons.', 'js_composer')
                
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Navigation Text', 'js_composer' ),
                'param_name' => 'navigationText',
                'group' => __( 'Navigation', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['navigationText'],
                'description' => __('You can customize your own text for navigation. To get empty buttons use navigationText : false. Also HTML can be used here', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'rewindNav', 'js_composer' ),
                'param_name' => 'rewindNav',
                'group' => __( 'Navigation', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['rewindNav'],
                'description' => __('Slide to first item. Use rewindSpeed to change animation speed.', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Scroll per Page', 'js_composer' ),
                'param_name' => 'scrollPerPage',
                'group' => __( 'Navigation', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['scrollPerPage'],
                'description' => __('Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Pagination', 'js_composer' ),
                'param_name' => 'pagination',
                'group' => __( 'Pagination', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['pagination'],
                'description' => __('Show pagination.', 'js_composer')
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Pagination Numbers', 'js_composer' ),
                'param_name' => 'paginationNumbers',
                'group' => __( 'Pagination', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['paginationNumbers'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Responsive', 'js_composer' ),
                'param_name' => 'responsive',
                'group' => __( 'Responsive', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['responsive'],
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Responsive Refresh Rate', 'js_composer' ),
                'param_name' => 'responsiveRefreshRate',
                'group' => __( 'Responsive', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['responsiveRefreshRate'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Responsive Base Width', 'js_composer' ),
                'param_name' => 'responsiveBaseWidth',
                'group' => __( 'Responsive', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['responsiveBaseWidth'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Base Class', 'js_composer' ),
                'param_name' => 'baseClass',
                'group' => __( 'CSS Styles', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['baseClass'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Theme', 'js_composer' ),
                'param_name' => 'theme',
                'group' => __( 'CSS Styles', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['theme'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Lazy Load', 'js_composer' ),
                'param_name' => 'lazyLoad',
                'group' => __( 'Lazy Load', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['lazyLoad'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Lazy Follow', 'js_composer' ),
                'param_name' => 'lazyFollow',
                'group' => __( 'Lazy Load', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['lazyFollow'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Lazy Effect', 'js_composer' ),
                'param_name' => 'lazyEffect',
                'group' => __( 'Lazy Load', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['lazyEffect'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Auto Height', 'js_composer' ),
                'param_name' => 'autoHeight',
                'group' => __( 'Auto Height', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['autoHeight'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'JSON Path', 'js_composer' ),
                'param_name' => 'jsonPath',
                'group' => __( 'JSON', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['jsonPath'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'JSON Success', 'js_composer' ),
                'param_name' => 'jsonSuccess',
                'group' => __( 'JSON', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['jsonSuccess'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Drag before animation finish', 'js_composer' ),
                'param_name' => 'dragBeforeAnimFinish',
                'group' => __( 'Mouse Events', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['dragBeforeAnimFinish'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Mouse Drag', 'js_composer' ),
                'param_name' => 'mouseDrag',
                'group' => __( 'Mouse Events', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['mouseDrag'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Touch Drag', 'js_composer' ),
                'param_name' => 'touchDrag',
                'group' => __( 'Mouse Events', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['touchDrag'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Transition Style', 'js_composer' ),
                'param_name' => 'transitionStyle',
                'group' => __( 'Transitions', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['transitionStyle'],
                
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Add active class', 'js_composer' ),
                'param_name' => 'addClassActive',
                'group' => __( 'Other', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['addClassActive'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'beforeUpdate', 'js_composer' ),
                'param_name' => 'beforeUpdate',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['beforeUpdate'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'afterUpdate', 'js_composer' ),
                'param_name' => 'afterUpdate',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['afterUpdate'],
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'beforeInit', 'js_composer' ),
                'param_name' => 'beforeInit',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['beforeInit'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'afterInit', 'js_composer' ),
                'param_name' => 'afterInit',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['afterInit'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'beforeMove', 'js_composer' ),
                'param_name' => 'beforeMove',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['beforeMove'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'afterMove', 'js_composer' ),
                'param_name' => 'afterMove',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['afterMove'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'afterAction', 'js_composer' ),
                'param_name' => 'afterAction',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['afterAction'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'startDragging', 'js_composer' ),
                'param_name' => 'startDragging',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['startDragging'],
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'afterLazyLoad', 'js_composer' ),
                'param_name' => 'afterLazyLoad',
                'group' => __( 'Callbacks', 'js_composer'),
                'std' => WPBakeryShortCode_vc_owlcarousel::set()['afterLazyLoad'],
            ),
        ),
        "js_view" => 'VcColumnView'
    ) );

    add_shortcode('vc_owlcarousel', function( $atts, $content = null ){

    $settings = shortcode_atts( WPBakeryShortCode_vc_owlcarousel::set(), $atts );

    $settings['id'] = 'vc_owlcarousel_'.uniqid();

    wp_localize_script( 'vc_owlcarousel_init', $settings['id'], $settings );

        return '<div class="'.$settings['id'].' vc_owlcarousels" data-settings="'.$settings['id'].'">' . do_shortcode($content) . '</div>';

    });
}

add_action( 'after_setup_theme', 'vc_owlcarousel_item_integrateWithVC' );

function vc_owlcarousel_item_integrateWithVC() {

    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_vc_owlcarousel_item extends WPBakeryShortCodesContainer {
        }
    }

    vc_map( array(
        "name" => __("VC Owl Carousel Item", "vc_owlcarousel"),
        "base" => "vc_owlcarousel_item",
        "content_element" => true,
        "as_child" => 'vc_owlcarousel',
        "show_settings_on_create" => false,
        "is_container" => true,
        "params" => array(
            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                'group' => __( 'Design Options', 'js_composer' )
            ),
        ),
        "js_view" => 'VcColumnView'
    ) );


    add_shortcode('vc_owlcarousel_item', function( $atts, $content = null ){
        
        return '<div class="vc_owlcarousel_item">' . do_shortcode($content) . '</div>';

    });
}
