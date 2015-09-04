<?php

class TTTSocial_Admin extends TTTSocial_Common {
	
	public function init() {
		parent::init();
		
		if( current_user_can('edit_posts') ) {
			add_action('admin_menu', array( &$this, 'menu' ) );
		}
		
		//$this->ttt_social_HelpPointers();
		
		//add_action('current_screen', array( &$this, 'ttt_social_HelpPointers') );  
	}
	
	
	public function menu() {
	        $s = add_submenu_page( 'options-general.php', __('TTT Social Connector App Keys',parent::sname), __('TTT Social Keys',parent::sname), 'edit_posts', 'ttt-social-menu', array( &$this, 'menu_page') );
	}
	
	public function enqueue_common() {
		// Future implementation
	}
	
	public function menu_page()  {

		$this->enqueue_common();
		
		require_once( TTTINC_SOCIAL .'/template/admin/page.inc.php' );
	
	}

	public function uninstall() {
		
		return true;
	}
	
/*
	public function ttt_social_HelpPointers() {
		//First we define our pointers 
		$pointers = array(
			array(
				'id' => 'ttt-social',   // unique id for this pointer
				'screen' => 'plugins', // this is the page hook we want our pointer to show on
				'target' => '#menu-settings', // the css selector for the pointer to be tied to, best to use ID's
				'title' => __('1º Connect your Social Profiles','ttt_social'),
				'content' => __('Go to <a href="'.admin_url( 'options-general.php?page=ttt-social-menu' ).'">Settings -> TTT Social</a>. Just need to make an OAuth connection with your Twitter account and Instagram.', 'ttt_social'),
				'position' => array( 
					'edge' => 'left', //top, bottom, left, right
					'align' => 'middle' //top, bottom, left, right, middle
				)
			),
		);
		//Now we instantiate the class and pass our pointer array to the constructor 
		$longsocialPointers = new TTTSocial_Help($pointers);
	}
*/

}