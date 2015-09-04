<?php

class TTTSocial_facebook_widget extends WP_Widget {

    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Facebook Widget','description=Facebook feed reader');
    }

    public function form( $instance ) {

        $name = esc_attr($instance['name']);
        $id = esc_attr($instance['id']);
        $limit = esc_attr($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Page name:', 'ttt-social' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" />
            <small><?php printf( __('Go to <a href="%s" target="_blank">Facebook Help</a>', 'ttt-social' ), 'https://www.facebook.com/help/121237621291199'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Page ID:', 'ttt-social'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $id; ?>" />
            <small><?php printf( __('Go to <a href="%s" target="_blank">FindmyFBid</a>', 'ttt-social'), 'http://findmyfbid.com/'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Feed Limit:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
			<small><?php _e('Amount of entries', 'ttt-social'); ?></small>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['id'] = strip_tags($new_instance['id']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['name'] = strip_tags($new_instance['name']);
        return $instance;
    }

    public function widget( $args, $instance ) {
        $template = 'facebook';
        $TTTSocial = new TTTSocial_Front();

        $netsocial = $TTTSocial->facebook_load( (array) $instance );

        $theme = get_stylesheet_directory().'/ttt-social/'.$template.'/template.php';
        $parent = get_template_directory().'/ttt-social/'.$template.'/template.php';
        $local = TTTINC_SOCIAL . '/template/front/'.$template.'/template.php';

        echo $args['before_widget'];

        if ( file_exists( $theme ) )
            require( $theme );
        elseif ( file_exists( $parent ) )
            require( $parent );
        elseif ( file_exists( $local ) )
            require( $local );
        echo $args['after_widget'];
    }

}

register_widget( 'TTTSocial_facebook_widget' );
