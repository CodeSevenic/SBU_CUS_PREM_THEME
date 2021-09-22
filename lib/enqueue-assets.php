<?php

function sbu_theme_assets()
{
  wp_enqueue_style('sbu_theme-stylesheet', get_template_directory_uri() . '/dist/assets/css/bundle.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'sbu_theme_assets');