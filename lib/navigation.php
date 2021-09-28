<?php

function _themename_register_menus()
{
  register_nav_menus(array(
    'main-menu' => esc_html('Main Menu', '_themename'),
    'footer-menu' => esc_html('Footer Menu', '_themename')
  ));
}

add_action('init', '_themename_register_menus');

// Filters

function _themename_aria_hasdropdown($attrs, $item, $args)
{
  if ($args->theme_location == 'main-menu') {
    if (in_array('menu-item-has-children', $item->classes)) {
      $attrs['aria-haspopup'] = 'true';
      $attrs['aria-expanded'] = 'false';
    }
  }

  return $attrs;
}

add_filter('nav_menu_link_attributes', '_themename_aria_hasdropdown', 10, 3);

function _themename_submenu_button($dir = 'down', $title)
{
  $button = '<button class="menu-button">';
  $button .= '<span class="u-screen-reader-text menu-button-show">' . sprintf(esc_html__('Show %s submenu', '_themename'), $title) . '</span>';
  $button .= '<span aria-hidden="true" class="u-screen-reader-text menu-button-show">' . sprintf(esc_html__('Hide %s submenu', '_themename'), $title) . '</span>';
  $button .= '<i class="fa fa-angle-' . $dir . '" aria-hidden="true"></i>';
  $button .= '</button>';

  return $button;
}

function _themename_dropdown_icon($title, $item, $args, $depth)
{
  if ($args->theme_location == 'main-menu') {
    if (in_array('menu-item-has-children', $item->classes)) {
      if ($depth == 0) {
        $title .= _themename_submenu_button('down', $title);
      } else {
        $title .= _themename_submenu_button('right', $title);
      }
    }
  }

  return $title;
}

add_filter('nav_menu_item_title', '_themename_dropdown_icon', 10, 4);