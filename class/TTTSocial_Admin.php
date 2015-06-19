<?php

class TTTSocial_Admin extends TTTSocial_Common {
	public function init() {
		parent::init();
		
		if( current_user_can('edit_posts') ) {
			add_action('admin_menu', array( &$this, 'menu' ) );
		}
	}
	
	
	public function menu() {
	        $s = add_submenu_page( 'options-general.php', __('TTT Social title',parent::sname), __('TTT Social',parent::sname), 'edit_posts', 'ttt-social-menu', array( &$this, 'menu_page') );
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

}

?>
