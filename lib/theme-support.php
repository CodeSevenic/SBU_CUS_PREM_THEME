<?php


function _themename_theme_support()
{
  add_theme_support('title-tag');
  add_theme_support('post_thumbnails');
  add_theme_support('html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption'));
  add_theme_support('customize-selective-refresh-widgets');
  add_theme_support('custom-logo', array(
    'height' => 200,
    'width' => 600,
    'flex-height' => true,
    'flex-width' => true
  ));
  add_theme_support('editor-styles');
  add_editor_style('dist/assets/css/editor.css');
}

add_action('after_setup_theme', '_themename_theme_support');