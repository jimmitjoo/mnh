<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- OFF-CANVAS MENU SIDEBAR -->
    <section id="wpo-off-canvas" class="wpo-off-canvas">
        <div class="wpo-off-canvas-body">
            <div class="wpo-off-canvas-header">
                <?php get_search_form(); ?>
                <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <div class="mobile-menu-header">
                    <?php _e('Menu',TEXTDOMAIN); ?>
                </div>
            </div>
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                $args = array(
                    'theme_location'  => 'mainmenu',
                    'container_class' => 'navbar-collapse',
                    'menu_class'      => 'wpo-menu-top nav navbar-nav',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu-offcanvas',
                    'walker'          => new Wpo_Megamenu_Offcanvas()
                );
                wp_nav_menu($args);
                ?>
            </nav>
        </div>
    </section>
    <!-- //OFF-CANVAS MENU SIDEBAR -->

    <?php
        $meta_template = get_post_meta(get_the_ID(),'wpo_template',true);
    ?>

    <!-- START Wrapper -->
    <section class="wpo-wrapper <?php echo isset($meta_template['el_class']) ? $meta_template['el_class'] : '' ; ?>">

        <!-- Top bar -->
        <section id="wpo-topbar" class="wpo-topbar skin-market">
            <div class="topbar-inner">
                <div class="container">
                    
                    <div class="topbar-mobile">
                        <div class="hidden-lg hidden-md pull-right">
                            <div class="active-mobile pull-left hidden-sm">
                                <div class="navbar-header-topbar">
                                    <?php wpo_renderButtonToggle(); ?>
                                </div>
                            </div>

                            <div class="active-mobile pull-left search-popup">
                                <span class="fa fa-search"></span>
                                <div class="active-content">
                                    <?php get_search_form(); ?>
                                </div>
                            </div>
                            <div class="active-mobile pull-left setting-popup">
                                <span class="fa fa-user"></span>
                                <div class="active-content">
                                    <h3 class="white title"><?php _e('Settings', TEXTDOMAIN); ?></h3>
                                    <?php if(has_nav_menu( 'topmenu' )){ ?>
                                        <div class="pull-left">
                                            <?php
                                                $args = array(
                                                    'theme_location'  => 'topmenu',
                                                    'container_class' => '',
                                                    'menu_class'      => 'menu-topbar'
                                                );
                                                wp_nav_menu($args);
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="active-mobile pull-left cart-popup">
                                <span class="fa fa-shopping-cart"></span>
                                <div class="active-content">
                                    <h3 class="white title">
                                        <?php _e('Shopping Bag',TEXTDOMAIN); ?>
                                    </h3>
                                    <div class="widget_shopping_cart_content"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user-login pull-left topbar-left hidden-xs hidden-sm">
                        <div>
                            <?php if( !is_user_logged_in() ){ ?>
                                <span class="hidden-xs"><?php echo __('Welcome visitor you can',TEXTDOMAIN); ?></span>
                                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php _e('login or create an account','woothemes'); ?>"><?php _e(' login or create an account ','woothemes'); ?></a>
                            <?php }else{ ?>
                                <?php $current_user = wp_get_current_user(); ?>
                                <span class="hidden-xs"><?php echo __('Welcome ',TEXTDOMAIN); ?><?php echo $current_user->display_name; ?> !</span>
                            <?php } ?>
                        </div>                       
                    </div>
                    <div class="topbar-right pull-right hidden-xs hidden-sm">
                        
                        <?php 
                        // WPML - Custom Languages Menu
                        if( function_exists( 'icl_get_languages' ) ){
                            $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
                            if( is_array( $languages ) ){
                                
                                foreach( $languages as $lang_k=>$lang ){
                                    if( $lang['active'] ){
                                        $active_lang = $lang;
                                        unset( $languages[$lang_k] );
                                    }
                                }
    
                                // disabled
                                if( count( $languages ) ){
                                    $lang_status = 'enabled';
                                } else {
                                    $lang_status = 'disabled';
                                }
                                
                                echo '<div class="language wpml-languages quick-button '. $lang_status .'">';
                                
                                    echo '<div class="button heading active" href="'. esc_url( $active_lang['url'] ).'" ontouchstart="this.classList.toggle(\'hover\');">';
                                        echo '<img src="'. esc_url( $active_lang['country_flag_url'] ) .'" alt="'. esc_attr( $active_lang['translated_name'] ) .'"/>';
                                        echo esc_attr( $active_lang['translated_name'] );
                                        if( count( $languages ) ) echo '<i class="icon-down-open-mini"></i>';
                                    echo '</div>';
                                    
                                    if( count( $languages ) ){
                                        echo '<ul class="wpml-lang-dropdown list">';
                                            foreach( $languages as $lang ){
                                                echo '<li><a href="'. esc_url( $lang['url'] ) .'"><img src="'. esc_url( $lang['country_flag_url'] ) .'" alt="'. esc_attr( $lang['translated_name'] ) .'"/>'. esc_attr( $lang['translated_name'] ) .'</a></li>';
                                            }
                                        echo '</ul>';
                                    }
                                    
                                echo '</div>';
                            }
                        }
                       ?>
                     
                        <div class="acount quick-button">
                            <div class="button heading">
                                <span class="title"><?php echo __('Account', TEXTDOMAIN); ?> <i class="fa fa-angle-down">&nbsp;</i></span>
                            </div>
                            <?php if(has_nav_menu( 'topmenu' )){ ?>
                                    <?php
                                        $args = array(
                                            'theme_location'  => 'topmenu',
                                            'container_class' => '',
                                            'menu_class'      => 'menu-topbar'
                                        );
                                        wp_nav_menu($args);
                                    ?>
                            <?php } ?>
                        </div> 
                    </div>
                </div>
            </div>    
        </section>
        <!-- // Topbar -->
        <!-- HEADER -->
        <header id="wpo-header" class="wpo-header skin-market">
       
            <div class="container-inner header-wrap">
                <div class="header-wrapper-inner">
                    <!-- MENU -->
                    <div class="wpo-mainmenu-header">
                        <div class="container">
                            <div class="mainmenu-content"> 
                                <div class="mainmenu-content-inner">
                                    <!-- LOGO -->
                                    <div class="logo-in-theme pull-left">
                                        <?php if( wpo_theme_options('logo') ) { ?>
                                        <div class="logo">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                <img src="<?php echo esc_url( wpo_theme_options('logo') ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                                            </a>
                                        </div>
                                        <?php } else { ?>
                                            <div class="logo logo-theme">
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                     <img src="<?php echo get_template_directory_uri() . '/images/logo-cd.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- //LOGO -->
                                    
                                    <nav id="wpo-mainnav" data-duration="<?php echo wpo_theme_options('megamenu-duration',400); ?>" class="pull-right wpo-megamenu <?php echo wpo_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
                                        <div class="navbar-header">
                                            <?php wpo_renderButtonToggle(); ?>
                                        </div><!-- //END #navbar-header -->
                                        <?php
                                            $args = array(  'theme_location' => 'mainmenu',
                                                            'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
                                                            'menu_class' => 'nav navbar-nav megamenu',
                                                            'fallback_cb' => '',
                                                            'menu_id' => 'main-menu',
                                                            'walker' => new Wpo_Megamenu());
                                            wp_nav_menu($args);
                                        ?>
                                    </nav>
                                </div>    
                            </div>  
                        </div>

                        <div class="main-search">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="main-search-inner">
                                            <div class="row">
                                                <div class="col-third col-lg-8 col-md-6">
                                                    <div class="search">
                                                        <?php categories_searchform(); ?>
                                                    </div>
                                                </div>   
                                                <div class="col-third col-lg-2 col-md-3 hidden-sm hidden-xs header-text-inner">
                                                    <div class="header-text">
                                                        <?php
                                                            $text_header =wpo_theme_options('text_header', '');
                                                         echo (!empty($text_header)?$text_header:'<span class="text-small">Call the customer services</span><span class="text-large">1800 - 1570 - 000</span>'); ?>
                                                    </div>    
                                                </div>
                                                <div class="col-third col-lg-2 col-md-3 hidden-sm hidden-xs cart-inner">
                                                    <?php if( WPO_WOOCOMMERCE_ACTIVED ) { ?>
                                                        <!-- Setting -->
                                                        <?php if( wpo_theme_options('woo-show-minicart', true) ) : ?>
                                                            <div class="top-cart hidden-sm hidden-xs">
                                                                <?php wpo_cartdropdown(); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                            </div>    
                                        </div>    
                                    </div>    
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- //MENU -->
                    <!-- SEARCH -->
                </div>

                <?php if(is_active_sidebar('header-market-right')){ ?>
                <div class="header-market-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 hidden-xs">
                                <div class="header-market-bottom-inner">
                                        <?php dynamic_sidebar('header-market-right'); ?>   
                                </div>    
                            </div>
                        </div> 
                    </div>           
                </div>
                <?php } ?>
            </div>

        </header>
        <!-- //HEADER -->