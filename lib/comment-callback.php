<?php
function _themename_comment_callback($comment, $args, $depth)
{
?>
  <li <?php comment_class(['c-comment', $comment->comment_parent ? 'c-comment--child' : '']) ?>>
    <article class="c-comment__body">
      <?php echo get_avatar($comment, 100, false, false, array('class' => 'c-comment__avatar')); ?>
    </article>
  <?php

}
