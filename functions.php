<?php


require_once('lib/helpers.php');
require_once('lib/enqueue-assets.php');


function after_pagination()
{
  echo "Some Text";
}

add_action('_themename_after_pagination', 'after_pagination');

function function_to_add($query)
{
  if ($query->is_main_query()) {
    $query->set('posts_per_page', 2);
  }
}