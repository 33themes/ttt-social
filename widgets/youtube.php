<?php

class TTTSocial_vimeo_widget extends WP_Widget {

    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Vimeo Widget','description=Vimeo feed reader');
    }

    public function form( $instance ) {
        $vimeo_user_name = esc_attr($instance['user']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>">
                <?php _e('User:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $vimeo_user_name; ?>" />
            </label>
        </p>

        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['user'] = strip_tags($new_instance['user']);
        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'vimeo';
        $TTTSocial = new TTTSocial_Front();

        unset( $_from );
        if ( mb_strlen($instance['user']) > 3 ) {
            $_s = preg_split('/\s+/',$instance['user']);
            foreach ($_s as $_name) {
                if ( $_from ) $_from .= ' OR ';
                $_from .= 'from:'.trim($_name);
            }
        }
        else {
            $netsocial = $TTTSocial->vimeo_load( false, (array) $instance );
        }

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
