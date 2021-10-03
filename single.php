<?php get_header(); ?>
<?php
$layout = get_post_meta(get_the_ID(), '_themename_post_layout', true);
var_dump($layout);
?>
<div class="o-container u-margin-bottom-40">
  <div class="o-row">
    <div
      class="o-row__column o-row__column--span-12 o-row__column--span-8@medium">
      <main role="main">
      <?php if (have_posts()) { ?>
         <?php while (have_posts()) { ?>
          <?php the_post(); ?>

              <?php get_template_part('template-parts/post/content'); ?>

          <?php } ?>
        <?php } else { ?>
         <?php get_template_part('template-parts/post/content', 'none'); ?>
      <?php } ?>
      </main>
    </div>

    <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>