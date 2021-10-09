<?php

require_once 'lib/customize.php';
require_once 'lib/helpers.php';
require_once 'lib/enqueue-assets.php';
require_once 'lib/sidebars.php';
require_once 'lib/theme-support.php';
require_once 'lib/navigation.php';
require_once 'lib/include-plugins.php';
require_once 'lib/comment-callback.php';

function _themename_icon_func($atts)
{
 extract(shortcode_atts(['icon' => 'red'], $atts));

 return '<i class="background-color: ' . esc_attr($icon) . ' aria-hidden "></i>';
}

add_shortcode('_themename_icon', '_themename_icon_func');

function _themename_button_func($atts)
{
 extract(shortcode_atts(['color' => 'red', 'text' => 'Button'], $atts));

 return '<button style="background-color: ' . esc_attr($color) . ' ">' . esc_html($text) . '</button>';
}

add_shortcode('_themename_button', '_themename_button_func');

function _themename_handle_delete_post()
{
 if (isset($_GET['action']) && $_GET['action'] === '_themename_delete_post') {
  if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], '_themename_delete_post_' . $_GET['post'])) {
   return;
  }

  $post_id = isset($_GET['post']) ? $_GET['post'] : null;
  $post = get_post((int) $post_id);
  if (empty($post)) {
   return;
  }

  if (!current_user_can('delete_post', $post_id)) {
   return;
  }

  wp_trash_post($post_id);
  wp_safe_redirect(home_url());

  die;
 }
}

add_action('init', '_themename_handle_delete_post');
