<?php

/**
 * Implements template_js_alter().
 */
function zeus_js_alter(&$javascript) {
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/ec.js']);
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/jquery.mousewheel.min.js']);
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/scripts/ec_resp.js']);
  unset($javascript[drupal_get_path('theme', 'ec_resp') . '/bootstrap/js/bootstrap.min.js']);
}

/**
 * Implements template_css_alter().
 */
function zeus_css_alter(&$css) {
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
  global $user, $language;

  // HTML Attributes
  // Use a proper attributes array for the html attributes.
  $variables['html_attributes'] = array();
  $variables['html_attributes']['lang'][] = $language->language;
  $variables['html_attributes']['dir'][] = $language->dir;

  // Flatten the HTML attributes and RDF namespaces arrays.
  $variables['html_attributes'] = drupal_attributes($variables['html_attributes']);

  // Adds bootstrap.
  drupal_add_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array('type' => 'external'));

  // Adds FontAwesome 4.7.0
  drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array('type' => 'external'));

  $head_elements = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'http-equiv' => 'X-UA-Compatible',
      'content' => 'IE=edge',
    ),
  );
  drupal_add_html_head($head_elements, 'meta_http_equiv');
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

/**
 * Implements hook_preprocess_node().
 */
function zeus_preprocess_node(&$variables) {

  // Add $unpublished variable.
  $variables['unpublished'] = (!$variables['status']) ? TRUE : FALSE;
}