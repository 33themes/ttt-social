<?php
function ttt_social_HelpPointers() {
	//First we define our pointers 
	$pointers = array(
		array(
			'id' => 'ttt-social',   // unique id for this pointer
			'screen' => 'plugins', // this is the page hook we want our pointer to show on
			'target' => '#menu-settings', // the css selector for the pointer to be tied to, best to use ID's
			'title' => __('1º Connect your Social Profiles','ttt_social'),
			'content' => __('Go to <a href="'.admin_url( 'options-general.php?page=ttt-social-menu' ).'">Settings -> TTT Social</a>. Just need to make an OAuth connection with your Twitter account and Instagram. Also can change APP Key and Secret for Facebook, Instagram and Twittter.', 'ttt_social'),
			'position' => array( 
				'edge' => 'left', //top, bottom, left, right
				'align' => 'middle' //top, bottom, left, right, middle
			)
		),
	);
	//Now we instantiate the class and pass our pointer array to the constructor 
	$longsocialPointers = new WP_Help_Pointer($pointers);
}
add_action('admin_enqueue_scripts', 'ttt_social_HelpPointers');  