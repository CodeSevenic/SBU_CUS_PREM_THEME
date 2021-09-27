<?php

function _themename_register_menus()
{
  register_nav_menus(array(
    'main-menu' => esc_html('Main Menu', '_themename'),
    'footer-menu' => esc_html('Footer Menu', '_themename')
  ));
}

add_action('init', '_themename_register_menus');