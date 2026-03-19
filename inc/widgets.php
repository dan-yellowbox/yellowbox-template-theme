<?php

class CTA_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'cta_widget',
            __('Call To Action', 'yellowbox'),
            array('description' => __('A Call To Action widget with title, text and link.', 'yellowbox'))
        );
    }

    // Frontend
    public function widget($args, $instance) {

        $title   = !empty($instance['title']) ? $instance['title'] : '';
        $content = !empty($instance['content']) ? $instance['content'] : '';
        $link    = !empty($instance['link']) ? $instance['link'] : '';
        $link_text    = !empty($instance['link_text']) ? $instance['link_text'] : '';

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        if ($content) {
            echo '<p class="mt-n3">';
            echo wpautop(esc_html($content));
            echo '</p>';
        }

        if ($link && $link_text) {
            echo '<p><a class="btn btn-primary btn-sm" href="' . esc_url($link) . '">' . $link_text . '</a></p>';
        }

        echo $args['after_widget'];
    }

    // Admin form
    public function form($instance) {

        $title   = isset($instance['title']) ? $instance['title'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        $link    = isset($instance['link']) ? $instance['link'] : '';
        $link_text    = isset($instance['link_text']) ? $instance['link_text'] : '';
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>">Text:</label>
            <textarea class="widefat"
                      rows="5"
                      id="<?php echo esc_attr($this->get_field_id('content')); ?>"
                      name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link_text')); ?>">Link Text:</label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('link_text')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link_text')); ?>"
                   type="text"
                   value="<?php echo esc_attr($link_text); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link')); ?>">Link URL:</label>
            <input class="widefat"
                   id="<?php echo esc_attr($this->get_field_id('link')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('link')); ?>"
                   type="url"
                   value="<?php echo esc_attr($link); ?>">
        </p>

        <?php
    }

    // Save
    public function update($new_instance, $old_instance) {

        $instance = array();
        $instance['title']   = sanitize_text_field($new_instance['title']);
        $instance['content'] = wp_kses_post($new_instance['content']);
        $instance['link']    = esc_url_raw($new_instance['link']);
        $instance['link_text']    = sanitize_text_field($new_instance['link_text']);

        return $instance;
    }
}

class Social_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'social_widget',
            __('Social', 'yellowbox'),
            array('description' => __('A widget for showing social profiles.', 'yellowbox'))
        );
    }

    // Frontend
    public function widget($args, $instance) {
        $title   = !empty($instance['title']) ? $instance['title'] : '';

        $social = get_field('social_profiles', 'options');
        $facebook = $social['facebook'] ?? '';
        $x_twitter = $social['x_twitter'] ?? '';
        $pinterest = $social['pinterest'] ?? '';
        $youtube = $social['youtube'] ?? '';
        $instagram = $social['instagram'] ?? '';
        $linkedin = $social['linkedin'] ?? '';

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        if( $social ) {
          echo '<div class="d-flex gap-2 social-icons flex-wrap">';
            echo ( $facebook ? '<a href="' . $facebook . '" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>' : '' );
            echo ( $linkedin ? '<a href="' . $linkedin . '" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>' : '' );
            echo ( $youtube ? '<a href="' . $youtube . '" target="_blank"><i class="fa-brands fa-youtube"></i></a>' : '' );
            echo ( $instagram ? '<a href="' . $instagram . '" target="_blank"><i class="fa-brands fa-instagram"></i></a>' : '' );
            echo ( $x_twitter ? '<a href="' . $x_twitter . '" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>' : '' );
            echo ( $pinterest ? '<a href="' . $pinterest . '" target="_blank"><i class="fa-brands fa-pinterest"></i></a>' : '' );
          echo '</div>';

          echo $args['after_widget'];
        }
    }

    // Admin form
    public function form($instance) {
      $title   = isset($instance['title']) ? $instance['title'] : '';
        ?>


        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
          <input class="widefat"
           id="<?php echo esc_attr($this->get_field_id('title')); ?>"
           name="<?php echo esc_attr($this->get_field_name('title')); ?>"
           type="text"
           value="<?php echo esc_attr($title); ?>">
        </p>
        <p>Set social links in Site Settings > Company Settings</p>

        <?php
    }

    // Save
    public function update($new_instance, $old_instance) {

        $instance = array();
        $instance['title']   = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}

function register_widgets() {
    register_widget('CTA_Widget');
    register_widget('Social_Widget');
}
add_action('widgets_init', 'register_widgets');