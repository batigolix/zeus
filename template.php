<?php

/**
 * Implements template_js_alter().
 */
function zeus_js_alter(&$javascript) {
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/ec.js']);
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/jquery.mousewheel.min.js']);
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/ec_resp.js']);
}

/**
 * Implements hook_page_alter().
 */
function zeus_page_alter(&$page) {
}

/**
 * Implements hook_module_implements_alter().
 */
function zeus_module_implements_alter(&$implementations, $hook) {
}

/**
 * Implements hook_theme_registry_alter().
 */
function zeus_theme_registry_alter(&$theme_registry) {
  unset($theme_registry['page']['preprocess functions']['ec_resp_preprocess_page']);
  unset($theme_registry['menu_tree__menu_breadcrumb_menu']);
  unset($theme_registry['menu_link__menu_breadcrumb_menu']);
  unset($theme_registry['block__easy_breadcrumb__easy_breadcrumb']);
}

/**
 * Implements hook_preprocess_html().
 * @todo include bootstrap in a nice way.
 */
function zeus_preprocess_html(&$variables) {
  drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('type' => 'external'));
}

/**
 * Implements theme_breadcrumb().
 */
function zeus_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $output = '<div class="one-crumb">' . implode(' > ', $breadcrumb) . '</div>';
    return $output;
  }
}

/**
 * Implements hook_preprocess_page().
 *
 * @todo clean up.
 */
function zeus_preprocess_page(&$variables) {
  $node = &$variables['node'];
  if($variables['node']){
    $variables['date'] = format_date($variables['node']->created, 'short');
    $variables['type'] = node_type_get_name($variables['node']);
    $variables['intro'] = isset($node->field_shared_teaser) ?
      field_view_field('node', $node, 'field_shared_teaser', array('label' => 'hidden')) :
      NULL;
  }
}
