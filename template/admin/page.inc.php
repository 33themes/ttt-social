<?php

if ( ! $this->get('twitter_customer_key') ) $this->set('twitter_customer_key','SxILR9KHzg8jCTJnIosHQ');
if ( ! $this->get('twitter_customer_secret') ) $this->set('twitter_customer_secret','RB3u3gq7Q43GSVCxQ6klDPyba9iearl3DwCXkpozlM');


if ( isset($_POST['twitter_application_keys']) && check_admin_referer('twitter_application_keys') ) {
	$this->set('twitter_customer_key',$_POST['twitter_customer_key']);
	$this->set('twitter_customer_secret',$_POST['twitter_customer_secret']);
}

if ( !$_twitter_credentials = $this->get('twitter_credentials') ) {
	$redirect_url = $this->twitter_auth();
}

if ( isset($_REQUEST['unlink'] ) && wp_verify_nonce( $_REQUEST['_nonce'], 'twitter_credentials' ) ) {
	$this->del('twitter_first_auth');
	$this->del('twitter_credentials');
	echo 'Redirect......';
	echo '<script> window.location = "'.get_admin_url().'options-general.php?page=ttt-social-menu"; </script>';
	die();
}


?>

<div id="tttsocial-page" class="wrap">
	<div id="icon-upload" class="icon32">
		<br>
	</div>
	<h2><?php _e('TTT Social', parent::sname ) ; ?></h2>

	<br/>

	<h3>Twitter</h3>

	<fieldset>
		<legend><?php _e('Twitter application keys', parent::sname ); ?></legend>
		<form action="" method="post">
			<input type="hidden" name="twitter_application_keys" value="1">
			<?php wp_nonce_field('twitter_application_keys'); ?>
			<label>Key</label> <input class="input" type="input" name="twitter_customer_key" value="<?php echo $this->get('twitter_customer_key'); ?>" placeholder="<?php _e('Application uniq key',parent::sname);?>">
			<br>
			<label>Secret</label> <input class="input" type="input" name="twitter_customer_secret" value="<?php echo $this->get('twitter_customer_secret'); ?>" placeholder="<?php _e('Application secret key',parent::sname);?>">
			<br>
			<input type="submit" class="button" value="<?php _e('Save', parent::sname ); ?>">
		</form>

	</fieldset>
	<br>

	<?php if ($this->get('twitter_credentials')): $connection = $this->twitter_connection('account/settings'); ?>
	<fieldset>
		<legend><?php _e('Is liked to twitter account', parent::sname ); ?>: <?php echo '@'.$connection->screen_name; ?></legend>
		<a class="button" href="<?php echo get_admin_url(); ?>options-general.php?page=ttt-social-menu&unlink=true&_nonce=<?php echo wp_create_nonce('twitter_credentials'); ?>"><?php _e('Unlink this account'); ?></a>
	</fieldset>
	<?php else: ?>
	<a class="button twitter_link" href="<?php echo $redirect_url; ?>"><?php _e('Add account', parent::sname ); ?></a>
	<br>
	<?php endif; ?>

	<br>
	<hr>


</div>

<style type="text/css">
#tttsocial-page fieldset {
	border: 1px solid #000;
	padding: 10px;
}
</style>
