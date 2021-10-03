<?php

function _themename_post_meta()
{
  get_template_part('template-parts/content', 'post_meta');
}

function _themename_readmore_link()
{
  get_template_part('template-parts/content', 'readmore_link');
}

function _themename_delete_post()
{
  $url = add_query_arg([
    'action' => '_themename_delete_post',
    'post' => get_the_ID(),
    'nonce' => wp_create_nonce('_themename_delete_post_' . get_the_ID())
  ], home_url());
  if (current_user_can('delete_post', get_the_ID())) {
    return "<a href='" . esc_url($url) . "'>" . esc_html__('Delete Post', '_themename') . "</a>";
  }
}

function _themename_meta($id, $key, $default)
{
  $value = get_post_meta($id, $key, true);
  if (!$value && $default) {
    return $default;
  }
  return $value;
}