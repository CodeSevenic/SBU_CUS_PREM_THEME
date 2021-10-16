<?php

class _themename_Most_recent_widget extends WP_Widget
{
  public function __construct()
  {
    parent::__construct(
      '_themename_mst_recent_widget',
      esc_html__('Recent Posts', '_themename'),
      array(
        'description' => esc_html__('some description', '_themename')
      )
    );
  }

  public function form($instance)
  {
    var_dump($instance);
    if (isset($instance['title'])) {
      $title = $instance['title'];
    } else {
      $title = "";
    } ?>

    <p>
      <label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title: ', '_themename'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('post_count') ?>"><?php esc_html_e('Number of Posts: ', '_themename'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('post_count') ?>" name="<?php echo $this->get_field_name('post_count') ?>" type="number" min="1" />
    </p>

    <p>
      <input id="<?php echo $this->get_field_id('include_date') ?>" name="<?php echo $this->get_field_name('include_date') ?>" type="checkbox" />
      <label for="<?php echo $this->get_field_id('include_date') ?>"><?php esc_html_e('Include Date?: ', '_themename'); ?></label>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('sort_by') ?>"><?php esc_html_e('Sort By: ', '_themename'); ?></label>
      <select class="widefat" name="" id="<?php echo $this->get_field_id('sort_by') ?>">
        <option value="date"><?php esc_html_e('Most Recent', '_themename'); ?></option>
        <option value="rand"><?php esc_html_e('Random', '_themename'); ?></option>
        <option value="comment_count"><?php esc_html_e('Number Of Comments', '_themename'); ?></option>
      </select>
    </p>

<?php }

  public function widget($args, $instance)
  {
    echo 'Looking at me Now';
  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['post_count'] = intval($new_instance['post_count']);
    $instance['include_date'] = boolval($new_instance['include_date']);
    return $instance;
  }
}

function _themename_register_most_recent_widget()
{
  register_widget('_themename_Most_recent_widget');
}

add_action('widgets_init', '_themename_register_most_recent_widget');
