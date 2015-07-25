<?php
add_action( 'customize_register', 'wp_ct_blog_setting' );
function wp_ct_blog_setting( $wp_customize ){
    
    $wp_customize->add_panel( 'panel_blog', array(
        'priority' => 80,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Blog', TEXTDOMAIN ),
        'description' =>__( 'Make default setting for page, general', TEXTDOMAIN ),
    ) );


    /**
     * Layout Setting
     */
    $wp_customize->add_section( 'blog_layout_settings', array(
        'priority' => 1,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Layout Setting', TEXTDOMAIN ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

     ///  Archive layout setting
    $wp_customize->add_setting( 'wpo_theme_options[blog-archive-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize, 'wpo_theme_options[blog-archive-layout]', array(
        'settings'  => 'wpo_theme_options[blog-archive-layout]',
        'label'     => __('Archive Layout', TEXTDOMAIN),
        'section'   => 'blog_layout_settings',
        'priority' => 1

    ) ) );

   

   
    $wp_customize->add_setting( 'wpo_theme_options[blog-archive-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    
    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize, 'wpo_theme_options[blog-archive-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[blog-archive-left-sidebar]',
        'label'     => __('Archive Left Sidebar', TEXTDOMAIN),
        'section'   => 'blog_layout_settings' ,
         'priority' => 2
    ) ) );

     /// 
    $wp_customize->add_setting( 'wpo_theme_options[blog-archive-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize, 'wpo_theme_options[blog-archive-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[blog-archive-right-sidebar]',
        'label'     => __('Archive Right Sidebar', TEXTDOMAIN),
        'section'   => 'blog_layout_settings',
         'priority' => 2 
    ) ) );

     ///  single layout setting
    $wp_customize->add_setting( 'wpo_theme_options[blog-single-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize,  'wpo_theme_options[blog-single-layout]', array(
        'settings'  => 'wpo_theme_options[blog-single-layout]',
        'label'     => __('Single Blog Layout', TEXTDOMAIN),
        'section'   => 'blog_layout_settings' 
    ) ) );

   
    $wp_customize->add_setting( 'wpo_theme_options[blog-single-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[blog-single-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[blog-single-left-sidebar]',
        'label'     => __('Single blog Left Sidebar', TEXTDOMAIN),
        'section'   => 'blog_layout_settings' 
    ) ) );

     $wp_customize->add_setting( 'wpo_theme_options[blog-single-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'blog-sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[blog-single-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[blog-single-right-sidebar]',
        'label'     => __('Single blog Right Sidebar', TEXTDOMAIN),
        'section'   => 'blog_layout_settings' 
    ) ) );


    /**
     * General Setting
     */
    $wp_customize->add_section( 'blog_general_settings', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'General Setting', TEXTDOMAIN ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    $wp_customize->add_setting('wpo_theme_options[blog_show-title]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[blog_show-title]', array(
        'settings'  => 'wpo_theme_options[blog_show-title]',
        'label'     => __('Show title', TEXTDOMAIN),
        'section'   => 'blog_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('wpo_theme_options[blog_show-breadcrumb]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[blog_show-breadcrumb]', array(
        'settings'  => 'wpo_theme_options[blog_show-breadcrumb]',
        'label'     => __('Show breadcrumb', TEXTDOMAIN),
        'section'   => 'blog_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    /**
     * Archive Setting
     */
    $wp_customize->add_section( 'archive_general_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Archive Setting', TEXTDOMAIN ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    $wp_customize->add_setting('wpo_theme_options[archive-style]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $path = WPO_THEME_DIR.'/templates/blog/blog-*.php';
    $file_name = 'blog-';

    $wp_customize->add_control( 'wpo_theme_options[archive-style]', array(
        'label'      => __( 'Archive style', TEXTDOMAIN ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => wpo_get_styles($path, $file_name)
    ) );

     $wp_customize->add_setting('wpo_theme_options[archive-column]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '4',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[archive-column]', array(
        'label'      => __( 'Select column', TEXTDOMAIN ),
        'section'    => 'archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => __('2 column', TEXTDOMAIN ),
            '3' => __('3 column', TEXTDOMAIN ),
            '4' => __('4 column', TEXTDOMAIN ),
            '6' => __('6 column', TEXTDOMAIN ),
        )
    ) );


    /**
     * Single post Setting
     */
    $wp_customize->add_section( 'blog_single_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Single post Setting', TEXTDOMAIN ),
        'description' => '',
        'panel' => 'panel_blog',
    ) );

    
    $wp_customize->add_setting('wpo_theme_options[show-share-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[show-share-post]', array(
        'settings'  => 'wpo_theme_options[show-share-post]',
        'label'     => __('Show share post', TEXTDOMAIN),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('wpo_theme_options[show-related-post]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[show-related-post]', array(
        'settings'  => 'wpo_theme_options[show-related-post]',
        'label'     => __('Show related post', TEXTDOMAIN),
        'section'   => 'blog_single_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
    

    $wp_customize->add_setting( 'wpo_theme_options[blog-items-show]', array(
        'type'       => 'option',
        'default'    => 4,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[blog-items-show]', array(
        'label'      => __( 'Number Of post to show', TEXTDOMAIN ),
        'section'    => 'blog_single_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => __('2 posts', TEXTDOMAIN ),
            '3' => __('3 posts', TEXTDOMAIN ),
            '4' => __('4 posts', TEXTDOMAIN ),
            '6' => __('6 posts', TEXTDOMAIN ),
        )
    ) );    
}
