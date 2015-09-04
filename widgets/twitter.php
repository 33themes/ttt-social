<?php

class TTTSocial_twitter_widget extends WP_Widget {
    public function __construct() {
        // widget actual processes
        parent::__construct(false,'TTT Social Twitter Widget','description=Twitter feed reader');
    }

    public function form( $instance ) {
        $count = esc_attr($instance['count']);
        $screen_name = esc_attr($instance['screen_name']);
        $q = esc_attr($instance['q']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('screen_name'); ?>"><?php _e('Username:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('screen_name'); ?>" name="<?php echo $this->get_field_name('screen_name'); ?>" type="text" value="<?php echo $screen_name; ?>" />
            <small><?php _e('i.e: http://twitter.com/33themes, use 33themes', 'ttt-social'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('q'); ?>"><?php _e('Filter tweets by or from', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('q'); ?>" name="<?php echo $this->get_field_name('q'); ?>" type="text" value="<?php echo $q; ?>" />
            <small><?php _e('i.e: a #hashtag or @username', 'ttt-social'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Limit:', 'ttt-social'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
            <small><?php _e('Amount of entries', 'ttt-social'); ?></small>           
        </p>
        <p><?php printf( __('Check if your twitter account is <a href="%s" target="_blank">Connected</a>','ttt-social'), admin_url('options-general.php?page=ttt-social-menu') ); ?></p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['count'] = strip_tags($new_instance['count']);
        $instance['screen_name'] = strip_tags($new_instance['screen_name']);
        $instance['q'] = strip_tags($new_instance['q']);
        return $instance;
    }

    public function widget( $args, $instance ) {

        $template = 'twitter';
        $TTTSocial = new TTTSocial_Front();


        unset( $_from );
        if ( mb_strlen($instance['screen_name']) > 3 ) {
            $_s = preg_split('/\s+/',$instance['screen_name']);
            foreach ($_s as $_name) {
                if ( $_from ) $_from .= ' OR ';
                $_from .= 'from:'.trim($_name);
            }
        }

        if ( mb_strlen($instance['q']) > 3 ) {
            if ( mb_strlen($instance['screen_name']) > 3 ) {
                $instance['q'] = $instance['q'].' '.$_from;
            }
            $netsocial = $TTTSocial->twitter_load( 'search/tweets', (array) $instance );
        }
        elseif ( mb_strlen($instance['screen_name']) > 3 ) {
            // $netsocial = $TTTSocial->twitter_load( 'statuses/user_timeline', (array) $instance );
            $instance['q'] = $_from;
            $netsocial = $TTTSocial->twitter_load( 'search/tweets', (array) $instance );
        }
        else {
            $netsocial = $TTTSocial->twitter_load( false, (array) $instance );
        }

        $netsocial->screen_name = $instance['screen_name'];
        $netsocial->q = $instance['q'];

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
register_widget( 'TTTSocial_twitter_widget' );
