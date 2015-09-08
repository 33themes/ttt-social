<?php
/*
Plugin Name: TTT Social
Plugin URI: http://www.33themes.com
Description: Simple and quickly social feed
Version: 0.8.1
Author: 33 Themes GmbH
Author URI: http://www.33themes.com
*/


define('TTTINC_SOCIAL', dirname(__FILE__) );
define('TTTVERSION_SOCIAL', 0.1 );

global $TTTSocial_Front, $TTTSocial;

function ttt_autoload_social( $class ) {
    if ( 0 !== strpos( $class, 'TTTSocial_' ) )
        return;
    
    $file = TTTINC_SOCIAL . '/class/' . $class . '.php';

    if (is_file($file)) {
        require_once $file;
        return true;
    }
    
    throw new Exception("Unable to load $class at ".$file);
}

if ( function_exists( 'spl_autoload_register' ) ) {
    spl_autoload_register( 'ttt_autoload_social' );
} else {
    require_once TTTINC_SOCIAL . '/class/TTTSocial_Common.php';
}

function tttsocial_init () {
    $s = load_plugin_textdomain( 'tttsocial', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    if ( !is_admin() ) {
        global $TTTSocial_Front, $TTTSocial;
        $TTTSocial_Front = new TTTSocial_Front();
        $TTTSocial_Front->init();
        $TTTSocial =& $TTTSocial_Front;
    }
    else {
        $TTTSocial_Admin = new TTTSocial_Admin();
        $TTTSocial_Admin->init();
    }
}

add_action('init', 'tttsocial_init');

function tttsocial_widgets_init() {
    require_once TTTINC_SOCIAL . '/widgets/facebook.php';
    require_once TTTINC_SOCIAL . '/widgets/twitter.php';
    require_once TTTINC_SOCIAL . '/widgets/vimeo.php';
    require_once TTTINC_SOCIAL . '/widgets/instagram.php';
    require_once TTTINC_SOCIAL . '/widgets/pinterest.php';
}
add_action('widgets_init', 'tttsocial_widgets_init');

register_deactivation_hook( __FILE__ ,'tttsocial_uninstall' );
register_uninstall_hook( __FILE__ , 'tttsocial_uninstall' );

function tttsocial_uninstall() {
    require_once TTTINC_SOCIAL . '/class/TTTSocial_Common.php';
    require_once TTTINC_SOCIAL . '/class/TTTSocial_Admin.php';

    $TTTSocial_Admin = new TTTSocial_Admin();
    $TTTSocial_Admin->uninstall();
}


require_once TTTINC_SOCIAL . '/inc/facebook-php-sdk/autoload.php';


//require_once TTTINC_SOCIAL . '/class-page-template.php';
//require_once( plugin_dir_path( __FILE__ ) . 'class-page-template.php' );
//add_action( 'plugins_loaded', array( 'Page_Template_Plugin', 'get_instance' ) );
//require_once TTTINC_SOCIAL . '/social_sidebar.php';


/* Add new social mendia profile links
 * http://wp-snippets.com/addremove-contact-info-fields/
 */
function ttt_social_contactmethods( $contactmethods ) {
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
    $contactmethods['facebook'] = 'Facebook'; // Add Facebook
    $contactmethods['vimeo'] = 'Vimeo'; // Add Vimeo
    $contactmethods['instagram'] = 'Instagram'; // Add Instagram
    $contactmethods['pinterest'] = 'Pinterest'; // Add Pinterest
    $contactmethods['youtube'] = 'Youtube'; // Add Youtube
    $contactmethods['github'] = 'Github'; // Add Github
    $contactmethods['dribble'] = 'Dribble'; // Add Dribble
    return $contactmethods;
}
add_filter('user_contactmethods','ttt_social_contactmethods',10,1); 
