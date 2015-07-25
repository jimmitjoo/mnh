<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     Opal  Team <opalwordpressl@gmail.com >
  * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/support/forum.html
  */


function wpo_create_type_footer(){
  $labels = array(
    'name' => __( 'Footer', TEXTDOMAIN ),
    'singular_name' => __( 'Footer', TEXTDOMAIN ),
    'add_new' => __( 'Add New Footer', TEXTDOMAIN ),
    'add_new_item' => __( 'Add New Footer', TEXTDOMAIN ),
    'edit_item' => __( 'Edit Footer', TEXTDOMAIN ),
    'new_item' => __( 'New Footer', TEXTDOMAIN ),
    'view_item' => __( 'View Footer', TEXTDOMAIN ),
    'search_items' => __( 'Search Footers', TEXTDOMAIN ),
    'not_found' => __( 'No Footers found', TEXTDOMAIN ),
    'not_found_in_trash' => __( 'No Footers found in Trash', TEXTDOMAIN ),
    'parent_item_colon' => __( 'Parent Footer:', TEXTDOMAIN ),
    'menu_name' => __( 'Footers', TEXTDOMAIN ),
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'List Footer',
      'supports' => array( 'title', 'editor' ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => false,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false
  );
  register_post_type( 'footer', $args );

  if($options = get_option('wpb_js_content_types')){
    $check = true;
    foreach ($options as $key => $value) {
      if($value=='footer') $check=false;
    }
    if($check)
      $options[] = 'footer';
    update_option( 'wpb_js_content_types',$options );
  }else{
    $options = array('page','footer');
  }

}

add_action('init','wpo_create_type_footer');