<?php if (have_posts()) { ?>
<?php while (have_posts()) { ?>
<?php the_post(); ?>
<article <?php post_class('c-post u-margin-bottom-20'); ?>>
  <?php get_template_part('template-parts/post/content'); ?>
  <?php } ?>
  <?php the_posts_pagination(); ?>
  <?php do_action('_themename_after_pagination'); ?>
  <?php } else { ?>
  <?php get_template_part('template-parts/post/content', 'none'); ?>
  <?php } ?>