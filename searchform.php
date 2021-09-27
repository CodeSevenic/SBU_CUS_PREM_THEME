<form class="c-search-form" role="search" method="GET" action="<?php echo esc_url(home_url('/')) ?>">
  <label class="c-search-form__label">
    <span class="screen-reader-text">
      <?php echo esc_html_x('Search for:', 'label', '_themename') ?>
    </span>
  </label>
  <input class="c-search-form__field" type="search" name="s" placeholder="Search"
    value="<?php echo esc_attr(get_search_query()) ?>">
  <button class="c-search-form__button" type="submit"><span
      class="u-screen-reader-text"><?php echo esc_html_x('Search', 'submit button', '_themename') ?></span><i
      class="fas fa-search" aria-hidden="true"></i></button>
</form>