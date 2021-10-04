<?php

if (post_password_required()) {
  return;
} ?>

<div id="comments" class="c-comments">

  <?php if (have_comments()) { ?>
  <h2 class="c-comments__title">
    <?php
      /* translators: 1 is number of comments and 2 is post title */
      printf(
        esc_html(_n(
          '%1$s Reply to "%2$s"',
          '%1$s Replies to "%2$s"',
          get_comments_number(),
          '_themename'
        )),
        number_format_i18n(get_comments_number()),
        get_the_title()
      );
      ?>
  </h2>
  <?php } ?>

</div>