<?php
function _themename_comment_callback($comment, $args, $depth)
{
?>
  <li <?php comment_class(['c-comment', $comment->comment_parent ? 'c-comment--child' : '']) ?>>
    <article class="c-comment__body">
      <?php echo get_avatar($comment, 100, false, false, array('class' => 'c-comment__avatar')); ?>
      <?php edit_comment_link(esc_html('Edit Comment', '_themename'), '<span class="c-comment__edit-link">', '</span>'); ?>

      <a class="c-comment__time" href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
        <time datetime="<?php comment_time('c') ?>">
      </a>
    </article>
  <?php

}
