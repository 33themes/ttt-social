<?php

class TTTSocial_instagram_widget extends WP_Widget {

    public function __construct() {
        // widget actual processes
        parent::WP_Widget(false,'TTT Social Instagram Widget','description=Instagram feed reader');
    }

    public function form( $instance ) {
        $user_name = esc_attr($instance['user_name']);
        $user_id = esc_attr($instance['user_id']);
        $limit = esc_attr($instance['limit']);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('user_name'); ?>">
                <?php _e('User name:'); ?>
                <input class="widefat"
                    id="<?php echo $this->get_field_id('user_name'); ?>"
                    name="<?php echo $this->get_field_name('user_name'); ?>"
                    type="text" value="<?php echo $user_name; ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('user_id'); ?>">
                <?php _e('User ID:'); ?>
                <input class="widefat"
                    id="<?php echo $this->get_field_id('user_id'); ?>"
                    name="<?php echo $this->get_field_name('user_id'); ?>"
                    type="text" value="<?php echo $user_id; ?>" />
            </label>
            <em>* <?php _e("Empty if you don't know"); ?></em>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">
                <?php _e('Limit:'); ?>
                <input class="widefat"
                    id="<?php echo $this->get_field_id('limit'); ?>"
                    name="<?php echo $this->get_field_name('limit'); ?>"
                    type="text" value="<?php echo $limit; ?>" />
            </label>
        </p>

        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['user_name'] = strip_tags($new_instance['user_name']);
        $instance['user_id'] = strip_tags($new_instance['user_id']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        $base = new TTTSocial_Common();
        $instance['user_id'] = $base->instagram_user_search($instance['user_name']);

        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'instagram';
        $TTTSocial = new TTTSocial_Front();

        unset( $_from );
        if ( mb_strlen($instance['user_id']) > 3 ) {
            $netsocial = $TTTSocial->instagram_load( false, (array) $instance );
        }
        else {
            return false;
        }

        $parent = get_template_directory().'/ttt-social/'.$template.'/template.php';
        $theme = get_stylesheet_directory().'/ttt-social/'.$template.'/template.php';
        $local = TTTINC_SOCIAL . '/template/front/'.$template.'/template.php';

        echo $args['before_widget'];

        if ( file_exists( $theme ) )
            require( $theme );
        elseif ( file_exists( $parent ) )
            require( $local );
        elseif ( file_exists( $local ) )
            require( $local );

        echo $args['after_widget'];
    }

}
register_widget( 'TTTSocial_instagram_widget' );
