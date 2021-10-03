<article <?php post_class('c-post u-margin-bottom-20'); ?>>
  <div class="c-post__inner">

    <?php if (get_the_post_thumbnail() !== '') { ?>
    <div class="c-post__thumbnail">
      <?php the_post_thumbnail('large'); ?>
    </div>
    <?php } ?>

    <header class="c-post_header">
      <?php if (is_single()) { ?>
      <h1 class="c-post__single-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h1>
      <?php } else { ?>
      <h2 class="c-post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h2>
      <?php } ?>
      <div class="c-post__meta">
        <?php echo _themename_post_meta(); ?>
      </div>
    </header>

    <div class="c-post__excerpt">
      <?php the_excerpt(); ?>
    </div>
    <?php echo _themename_readmore_link() ?>
    <?php echo _themename_delete_post(); ?>
    <?php var_dump(get_post_meta(get_the_ID(), 'Price')); ?>
  </div>
</article>