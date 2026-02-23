<?php

/* ***** ----------------------------------------------- ***** **
  ** ***** ACF
  ** ***** ----------------------------------------------- ***** */

/*==================================================================================
  ACF JSON – load/save from theme acf-json folder (for sync with version control)
==================================================================================*/

add_filter('acf/settings/save_json', function ($path) {
  return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
  unset($paths[0]);
  array_unshift($paths, get_template_directory() . '/acf-json');
  return $paths;
});

if (function_exists('acf_add_options_page')) {

  // Add Global Options tab to WP Admin
  acf_add_options_page(array(
    'menu_title'  => __('Global Fields', 'foundry'),
    'page_title'  => __('Global Fields', 'foundry'),
    'menu_slug'   => 'global-options',
    'position'    => '50',
    'capability'  => 'edit_posts',
    'icon_url'    => 'dashicons-admin-generic',
  ));

  // Add Footer Options section under the Global Options tab
  // acf_add_options_sub_page( array(
  //   'page_title'  => __( 'Footer', 'bymattlee' ),
  //   'menu_title'  => __( 'Footer', 'bymattlee' ),
  //   'parent_slug' => 'global-options',
  // ));

  // Add Code Options section under the Global Options tab
  // acf_add_options_sub_page(array(
  //   'page_title'  => __('Code Options', 'bymattlee'),
  //   'menu_title'  => __('Code', 'bymattlee'),
  //   'parent_slug' => 'global-options',
  // ));
}
