<h2 class="c-post__title">
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</h2>
<div class="c-post__meta">
  <?php echo _themename_post_meta(); ?>
</div>
<div class="c-post__excerpt">
  <?php the_excerpt(); ?>
</div>
<?php echo _themename_readmore_link() ?>
</article>