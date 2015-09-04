<?php

class TTTSocial_pinterest_widget extends WP_Widget {
    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Pinterest Widget','description=Pinterest feed reader');
    }

    public function form( $instance ) {

        $userpint = esc_attr($instance['userpint']);
        $board = esc_attr($instance['board']);
        $limit = esc_attr($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('userpint'); ?>"><?php _e('Username:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('userpint'); ?>" name="<?php echo $this->get_field_name('userpint'); ?>" type="text" value="<?php echo $userpint; ?>" />
            <small><?php _e('i.e: http://pinterest.com/33themes, use 33themes', 'ttt-social'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('board'); ?>"><?php _e('Filter pins from a board', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('board'); ?>" name="<?php echo $this->get_field_name('board'); ?>" type="text" value="<?php echo $board; ?>" />
            <small><?php _e('i.e: http://pinterest.com/33themes/comics/, use comics', 'ttt-social'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
            <small><?php _e('Amount of pins', 'ttt-social'); ?></small>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['userpint'] = strip_tags($new_instance['userpint']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        $instance['board'] = strip_tags($new_instance['board']);
        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'pinterest';
        $TTTSocial = new TTTSocial_Front();

        $netsocial = $TTTSocial->pinterest_load( (array) $instance );

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

register_widget( 'TTTSocial_pinterest_widget' );
