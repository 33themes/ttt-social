<?php

class TTTSocial_vimeo_widget extends WP_Widget {
    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Vimeo Widget','description=Vimeo feed reader');
    }

    public function form( $instance ) {
        $user = esc_attr($instance['user']);
        $limit = esc_attr($instance['limit']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Username:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" />
            <small><?php _e('i.e: http://vimeo.com/33themes use 33themes', 'ttt-social'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
            <small><?php _e('Amount of videos', 'ttt-social'); ?></small>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['limit'] = strip_tags($new_instance['limit']);
        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'vimeo';
        $TTTSocial = new TTTSocial_Front();

        $netsocial = $TTTSocial->vimeo_load( (array) $instance );

        $theme = get_template_directory().'/ttt-social/'.$template.'/template.php';
        $local = TTTINC_SOCIAL . '/template/front/'.$template.'/template.php';

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
register_widget( 'TTTSocial_vimeo_widget' );
