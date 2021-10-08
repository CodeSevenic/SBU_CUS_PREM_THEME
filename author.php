<?php get_header();?>

<?php
 $author = get_query_var('author');
 $author_posts = count_user_posts($author);
 $author_display = get_the_author_meta('display_name', $author);
 $author_description = get_the_author_meta('user_description', $author);
 $author_website = get_the_author_meta('user_url', $author);
?>

<div class="o-container u-margin-bottom-40">
  <div class="o-row">

    <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
      <header>
        <?php echo get_avatar($author, 128); ?>
        <h1 class="u-margin-top-20"><b><?php echo esc_html($author_display); ?></b></h1>
        <?php
         /* translators: %s is the number of posts */
         printf(esc_html(_n('%s post', '%s posts', $author_posts, '_themename')), number_format_i18n($author_posts));

        if ($author_website) {?>
      <a href="<?php echo esc_url($author_website); ?>" target="_blank">
        <?php }?>
      </header>
    </div>

    <div
      class="o-row__column o-row__column--span-12 o-row__column--span-8@medium">
      <main role="main">
        <?php get_template_part('loop', 'author');?>
      </main>
    </div>



  </div>
</div>

<?php get_footer();?>