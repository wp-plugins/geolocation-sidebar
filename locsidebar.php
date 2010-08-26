<?php
/*
  Plugin Name: Geolocation Sidebar
  Plugin URI: http://eminkura.com/geosidebar
  Description: This widget shows visitor's location on map.
  Version: Version 1.0
  Author: Emin KURA
  Author URI: http://eminkura.com
  License: GPL2
 */
include('geolocate.php');

class LocSidebar extends WP_Widget {

    function LocSidebar() {
        parent::WP_Widget(false, $name = 'Geolocation Sidebar');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);

        echo $before_widget;

        if ($title)
            echo $before_title . $title . $after_title;
        $record = getGeoData();
        echo "<img src='http://maps.google.com/maps/api/staticmap?center=" . $record->latitude . "," . $record->longitude . "&zoom=10&size=" . $instance['width'] . "x" . $instance['height'] . "&sensor=true' alt='" . $record->country_name . "/" . $record->city . "'/>";
        echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);

        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr($instance['title']);

        $width = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);

        if (!isset($instance['width'])) {
            $width = '200';
        }
        if (!isset($instance['height'])) {
            $height = '200';
        }
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
            <br/>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
            </label>
            <br/>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:'); ?>
                <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
            </label>

        </p>
<?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("LocSidebar");'));
?>
