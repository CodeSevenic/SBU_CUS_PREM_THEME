<?php

require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action('tgmpa_register', '_themename_register_required_plugins');

function _themename_register_required_plugins()
{
 $plugins = array(
  array(
   'name' => '_themename metaboxes',
   'slug' => '_themename-metaboxes',
   'source' => get_template_directory() . '/lib/plugins/$sbu_theme-metaboxes.zip',
   'required' => true,
   'version' => '1.0.0',
   'force_activation' => false,
   'force_deactivation' => false,
  ),
  array(
   'name' => '_themename shortcodes',
   'slug' => '_themename-shortcodes',
   'source' => get_template_directory() . '/lib/plugins/$sbu_theme-shortcodes.zip',
   'required' => true,
   'version' => '1.0.0',
   'force_activation' => false,
   'force_deactivation' => false,
  ),
 );

 $config = array(
  'id' => '_themename',
  'default_path' => '',
  'menu' => 'tgmpa-install-plugins',
  'has_notices' => true,
  'dismissable' => true,
  'dismiss_msg' => '',
  'is_automatic' => false,
  'message' => '',
 );

 tgmpa($plugins, $config);
}
