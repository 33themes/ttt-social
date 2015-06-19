<?php

if (!class_exists('OAuthConsumer'))
	require_once TTTINC_SOCIAL . '/inc/OAuth.php';

if (!class_exists('TwitterOAuth'))
	require_once TTTINC_SOCIAL . '/inc/twitteroauth.php';

class TTTSocial_Common {
	const sname = 'tttsocial';
	const expire = 900;
	const group  = 'tttsocial';

	public function init() {
		global $wpdb;
	}

	public function ckey( $fn, $a = false, $b = false, $c = false ) {
		return md5(NONCE_KEY.$fn.serialize($a).serialize($b).serialize($b));
	}

	public function twitter_connection( $func = 'statuses/user_timeline', $params = false ) {
		if ( !$_twitter_credentials = $this->get('twitter_credentials') ) return false;

		$ckey = $this->ckey( __function__, $func, $_twitter_credentials, $params );
		if ( $timeline = wp_cache_get( $ckey, self::group ) ) return $timeline;

		$connection = new TwitterOAuth( $this->get('twitter_customer_key'), $this->get('twitter_customer_secret'), $_twitter_credentials['oauth_token'], $_twitter_credentials['oauth_token_secret']);

		$timeline = $connection->get( $func, $params );

		wp_cache_set( $ckey, $timeline, self::group, self::expire );

		return $timeline;
	}


	public function twitter_auth() {

		if ( $_twitter_credentials = $this->get('twitter_credentials') ) return true;

		if ( !isset($_REQUEST['oauth_token']) && !isset($_REQUEST['oauth_verifier']) ) {
			$connection = new TwitterOAuth( $this->get('twitter_customer_key'), $this->get('twitter_customer_secret') );
			$temporary_credentials = $connection->getRequestToken( get_admin_url().'options-general.php?page=ttt-social-menu' );
			$redirect_url = $connection->getAuthorizeURL($temporary_credentials, FALSE);
			$_tttsocial['oauth_token_secret'] = $temporary_credentials['oauth_token_secret'];


			$this->set('twitter_first_auth', $_tttsocial );
			return $connection->getAuthorizeURL( $temporary_credentials, false );
		}
		else {
			$_tttsocial = $this->get('twitter_first_auth');
			$_tttsocial['oauth_token'] = $_REQUEST['oauth_token'];
			$_tttsocial['oauth_verifier'] = $_REQUEST['oauth_verifier'];
			$connection = new TwitterOAuth( TTTSOCIAL_CONSUMER_KEY, TTTSOCIAL_CONSUMER_SECRET , $_tttsocial['oauth_token'], $_tttsocial['oauth_token_secret']);
			$token_credentials = $connection->getAccessToken($_tttsocial['oauth_verifier']);

			$this->set('twitter_credentials', $token_credentials);
			$this->del('twitter_first_auth');
			
			echo 'Redirect....';
			echo '<script>window.location = "'.get_admin_url().'options-general.php?page=ttt-social-menu";</script>';
			exit();

		}
		
	}

	public function twitter_load( $fn = 'statuses/user_timeline', $params = false ) {

		if (!$fn || $fn == '') $fn = 'statuses/user_timeline';

		$netsocial = (object) array();

		if ( $fn == 'search/tweets' ) {
			$feed = $this->twitter_connection( $fn, $params );
			$netsocial->feed = $feed->statuses;
			unset($feed);
		}
		else {
			$netsocial->feed = $this->twitter_connection( $fn, $params );
		}

		return $netsocial;

	}

	public function facebook() {
		return (object) $this->get('facebook');
	}

	public function facebook_load( $params = false ) {

		$netsocial = $this->facebook();

		if ( isset($params['id']) ) $netsocial->id = $params['id'];
		if ( isset($params['limit']) ) $netsocial->limit = $params['limit'];
		if ( isset($params['name']) ) $netsocial->name = $params['name'];

		include_once(ABSPATH.WPINC.'/feed.php');               
		$feed = fetch_feed('http://www.facebook.com/feeds/page.php?format=atom10&id=' . $netsocial->id);
		if ($feed->errors > 0 ) return false;

		$limit = $feed->get_item_quantity( $netsocial->limit ); // specify number of items
		$netsocial->feed = $feed->get_items(0, $limit);
		unset( $feed );

		return $netsocial;
	}
	

	public function vimeo_load( $params = false ) {
	/*function curl_get($url) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		$return = curl_exec($curl);
		curl_close($curl);
		return $return;
	}*/			
		$netsocial = (object) $this->get('vimeo');
		$limite=1;
			
		if ( isset($params['user']) ) $netsocial->user = $params['user'];
		if ( isset($params['limit'])) {
			$netsocial->limit = $params['limit'];
			$limite = (int)$params['limit'];
			
		}
	$vimeo_user_name = $netsocial->user; //($_GET['user']) ? $_GET['user'] : 'brad';
	//$vimeo_user_name="brad";
	// API endpoint
		$api_endpoint = 'http://vimeo.com/api/v2/' . $vimeo_user_name;
	// Load the user info and clips
		$curl=curl_init($api_endpoint . '/info.xml');	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		$userlist = simplexml_load_string(curl_exec($curl));
		curl_close($curl);
		$curl=curl_init($api_endpoint . '/videos.xml');	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		$videos = simplexml_load_string(curl_exec($curl));
		curl_close($curl);
		if ($videos->errors > 0 ) return false;

		/*$limit = $videos->get_item_quantity( $netsocial->limit ); // specify number of items
		$netsocial->videos = $videos->get_items(0, $limit);*/
		//$i=1;
		
		/*for( $i=0; $i<$limite; $i++)
		{
			$userlistlimit[]=$userlist[$i];
			$videoslimit[]=$videos[$i];
		}*/
		$netsocial->userlist=$userlist;
		$netsocial->videos=$videos;
		
		return $netsocial;
	
	}
	
public function pinterest() {
		return (object) $this->get('pinterest');
	}
	public function pinterest_load( $params = false ){
		

			$netsocial = $this->pinterest();

		if ( isset($params['userpint']) ) $netsocial->userpint = $params['userpint'];
		if ( isset($params['limit']) ) $netsocial->limit = $params['limit'];
		if ( isset($params['board']) ) $netsocial->board = $params['board'];

		
		$feed = fetch_feed('https://pinterest.com/'.$netsocial->userpint.'/feed.rss');
		
		/*Visualización de los pins de un board –
		 http://pinterest.com/PON AQUÍ EL USUARIO/PON AQUÍ EL NOMBRE DEL BOARD/rss 
		 ejemplo Si el board tiene varias palabras, cambiar los espacios por el símbolo “-“*/

		  
		if ($feed->errors > 0 ) return false;

		$limit = $feed->get_item_quantity( $netsocial->limit ); // specify number of items
		$netsocial->feed = $feed->get_items(0, $limit);
		
		
		unset( $feed );

		return $netsocial;
	}

	public function instagram_load($params=false){

	}


	public function _s( $s = false ) {
		if ( $s === false) return self::name;
		return self::sname.'_'.$s;
	}
	
	public function del( $name ) {
		return delete_option( self::sname . '_' . $name );
	}
	
	public function get( $name ) {
		return get_option( self::sname . '_' . $name );
	}
	
	public function set( $name, $value ) {
		if (!get_option( self::sname . '_' . $name ))
			add_option( self::sname . '_' . $name, $value);
		
		update_option( self::sname . '_' . $name , $value);
	}
	
}

?>
