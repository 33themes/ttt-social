<?php

class TTTSocial_instagram_widget extends WP_Widget {
        
    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Instagram Widget','description=Instagram feed reader');
    }

    public function form( $instance ) {
        $vimeo_user_name = esc_attr($instance['user']);
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('User:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $vimeo_user_name; ?>" /></label>
        </p>
        
        <?php 
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['user'] = strip_tags($new_instance['user']);
        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'instagram';
        $TTTSocial = new TTTSocial_Front();

        unset( $_from );
        if ( mb_strlen($instance['user']) > 3 ) {
            $netsocial = $TTTSocial->instagram_load( false, (array) $instance );
        }
        else {
            return false;
        }
        
        $theme = get_template_directory().'/ttt-social/'.$template.'/template.php';
        $local = TTTINC_SOCIAL . '/template/front/'.$template.'/template.php';

        echo $args['before_widget'];

        if ( file_exists( $theme ) )
            require( $theme );
        elseif ( file_exists( $local ) )
            require( $local );
        
        echo $args['after_widget'];
    }

}
register_widget( 'TTTSocial_instagram_widget' );