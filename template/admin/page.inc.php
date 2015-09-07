<?php


// Default credentials for Twitter
if ( ! $this->get('twitter_customer_key') ) $this->set('twitter_customer_key','SxILR9KHzg8jCTJnIosHQ');
if ( ! $this->get('twitter_customer_secret') ) $this->set('twitter_customer_secret','RB3u3gq7Q43GSVCxQ6klDPyba9iearl3DwCXkpozlM');

if ( isset($_POST['twitter_application_keys']) && check_admin_referer('twitter_application_keys') ) {
    $this->set('twitter_customer_key',$_POST['twitter_customer_key']);
    $this->set('twitter_customer_secret',$_POST['twitter_customer_secret']);
}

if ( !$_twitter_credentials = $this->get('twitter_credentials') ) {
    $redirect_url_twitter = $this->twitter_auth();
}

if ( isset($_REQUEST['unlink'] ) && wp_verify_nonce( $_REQUEST['_nonce'], 'twitter_credentials' ) ) {
    $this->del('twitter_first_auth');
    $this->del('twitter_credentials');
    echo 'Redirect......';
    echo '<script> window.location = "'.get_admin_url().'options-general.php?page=ttt-social-menu"; </script>';
    die();
}

// Default credentials for instagram
if ( ! $this->get('instagram_customer_key') ) $this->set('instagram_customer_key','b35b187c363541b393e5ae542854ce44');
if ( ! $this->get('instagram_customer_secret') ) $this->set('instagram_customer_secret','f5379cb9e5214a18a50562e09afb6d0b');

if ( isset($_POST['instagram_application_keys']) && check_admin_referer('instagram_application_keys') ) {
    $this->set('instagram_customer_key',$_POST['instagram_customer_key']);
    $this->set('instagram_customer_secret',$_POST['instagram_customer_secret']);
}

if ( !$_instagram_credentials = $this->get('instagram_credentials') ) {
    $redirect_url_instagram = $this->instagram_auth();
}

if ( isset($_REQUEST['unlink'] ) && wp_verify_nonce( $_REQUEST['_nonce'], 'instagram_credentials' ) ) {
    $this->del('instagram_first_auth');
    $this->del('instagram_credentials');
    echo 'Redirect......';
    echo '<script> window.location = "'.get_admin_url().'options-general.php?page=ttt-social-menu"; </script>';
    die();
}

// Default credentials for facebook
if ( ! $this->get('facebook_app_id') ) $this->set('facebook_app_id','158115770920449');
if ( ! $this->get('facebook_app_key') ) $this->set('facebook_app_key','4bf10c26ac3b369d6bbb4b536f628480');

if ( isset($_POST['facebook_application_keys']) && check_admin_referer('facebook_application_keys') ) {
    $this->set('facebook_app_id',$_POST['facebook_app_id']);
    $this->set('facebook_app_key',$_POST['facebook_app_key']);
}

?>

<div id="tttsocial-page" class="wrap">
    <div id="icon-upload" class="icon32">
        <br>
    </div>

    <h1><?php _e('TTT Social Connectors', parent::sname ) ; ?></h1>


    <h3 class="title dashicons-before dashicons-twitter"> Twitter</h3>

	<table class="form-table">
		<tbody>
			<tr>
			    <?php if ($this->get('twitter_credentials')): $connection = $this->twitter_connection('account/settings'); ?>
					<th scope="row">
						<?php _e('Is liked to twitter account', parent::sname ); ?>
					</th>
					<td>
						<strong><?php echo '@'.$connection->screen_name; ?></strong>
				        <a class="button button-small" href="<?php echo get_admin_url(); ?>options-general.php?page=ttt-social-menu&unlink=true&_nonce=<?php echo wp_create_nonce('twitter_credentials'); ?>"><?php _e('Unlink this account'); ?></a>
					</td>
			    <?php else: ?>
			    	<th scope="row">
						<?php _e('Need to link a twitter account', parent::sname ); ?>				    	
			    	</th>
			        <td>
			        	<a class="button button-primary twitter_link" href="<?php echo $redirect_url_twitter; ?>"><?php _e('Connect Twitter Account', parent::sname ); ?></a>
			        </td>
			    <?php endif; ?>
			</tr>
	    </tbody>
	</table>
	<form action="" method="post">
        <input type="hidden" name="twitter_application_keys" value="1">
        <?php wp_nonce_field('twitter_application_keys'); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<?php _e('Application keys', parent::sname ); ?>
					</th>
					<td></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="twitter_customer_key"><?php _e('Key',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="twitter_customer_key" value="<?php echo $this->get('twitter_customer_key'); ?>" placeholder="<?php _e('Application uniq key',parent::sname);?>">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="twitter_customer_secret"><?php _e('Secret',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="twitter_customer_secret" value="<?php echo $this->get('twitter_customer_secret'); ?>" placeholder="<?php _e('Application secret key',parent::sname);?>">
					</td>
				</tr>
			</tbody>
		</table>
        <input type="submit" class="button button-primary" value="<?php _e('Save', parent::sname ); ?>">
    </form>
    <p><strong><?php _e('Note:',parent::sname);?></strong> <?php _e('By default TTT Social use a 33themes.com Twitter App connect. Our App has limited twitter queries.',parent::sname);?></p>
    <p><strong><?php _e('For Developers:',parent::sname);?></strong> <a href="https://apps.twitter.com/"><?php _e('Create your own twitter App and replace this Key and Secret tokens.',parent::sname);?></a></p>

    <br><hr><br>

    <h3 class="title dashicons-before dashicons-facebook-alt"> Facebook</h3>

    <form action="" method="post">
        <input type="hidden" name="facebook_application_keys" value="1">
        <?php wp_nonce_field('facebook_application_keys'); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<?php _e('Application keys', parent::sname ); ?>
					</th>
					<td></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="facebook_app_id"><?php _e('Key',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="facebook_app_id" value="<?php echo $this->get('facebook_app_id'); ?>" placeholder="<?php _e('Application uniq ID',parent::sname);?>">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="facebook_app_key"><?php _e('Secret',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="facebook_app_key" value="<?php echo $this->get('facebook_app_key'); ?>" placeholder="<?php _e('Application key',parent::sname);?>">
					</td>
				</tr>
			</tbody>
		</table>
        <input type="submit" class="button button-primary" value="<?php _e('Save', parent::sname ); ?>">
    </form>
    <p><strong><?php _e('Note:',parent::sname);?></strong> <?php _e('By default TTT Social use a 33themes.com Facebook App connect.',parent::sname);?></p>
    <p><strong><?php _e('For Developers:',parent::sname);?></strong> <a href="https://developers.facebook.com/apps/async/create/platform-setup/dialog/"><?php _e('Create your own Facebook App and replace this Key and Secret tokens.',parent::sname);?></a></p>
    
    <br><hr><br>

    <h3 class="title dashicons-before dashicons-rss">Instagram</h3>

	<table class="form-table">
		<tbody>
			<tr>
			    <?php if ($this->get('instagram_credentials')): ?>
			
			        <?php 
			        $instagram = new Instagram(array(
			                            'apiKey'      => $this->get('instagram_customer_key'),
			                            'apiSecret'   => $this->get('instagram_customer_secret'),
			                            'apiCallback' => get_admin_url().'options-general.php?page=ttt-social-menu',
			                ));
			        $instagram->setAccessToken($this->get('instagram_credentials'));
			        // var_dump($test->searchUser('neta_alchimister'));
			        // var_dump($test->getUserMedia('29605612', 2));
			        ?>
					<th scope="row">
						<?php _e('Is liked to this Instagram account', parent::sname ); ?>
					</th>
					<td>
						<strong><?php $instagram->getUser()->data->username; ?></strong>
				        <a class="button button-small" href="<?php echo get_admin_url(); ?>options-general.php?page=ttt-social-menu&unlink=true&_nonce=<?php echo wp_create_nonce('instagram_credentials'); ?>">
				            <?php _e('Unlink this account', parent::sname ); ?> 
				        </a>
					</td>
			    <?php else: ?>
			    	<th scope="row">
						<?php _e('Need to link a Instagram account', parent::sname ); ?>				    	
			    	</th>
			        <td>
						<a class="button button-primary instagram_link" href="<?php echo $redirect_url_instagram; ?>"><?php _e('Add account', parent::sname ); ?></a>
			        </td>
			    <?php endif; ?>
			</tr>
	    </tbody>
	</table>    

    <form action="" method="post">
        <input type="hidden" name="instagram_application_keys" value="1">
        <?php wp_nonce_field('instagram_application_keys'); ?>
        <table class="form-table">
            <tbody>
	            <th scope="row">
					<?php _e('Application keys', parent::sname ); ?>
	            </th>
	            <td></td>
				<tr>
					<th scope="row">
						<label for="instagram_customer_key"><?php _e('Key',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="instagram_customer_key" value="<?php echo $this->get('instagram_customer_key'); ?>" placeholder="<?php //c_e('Application uniq key',parent::sname);?>">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="instagram_customer_secret"><?php _e('Secret',parent::sname);?></label>
					</th>
					<td>
						<input class="regular-text" type="text" name="instagram_customer_secret" value="<?php echo $this->get('instagram_customer_secret'); ?>" placeholder="<?php //_e('Application secret key',parent::sname);?>">
					</td>
				</tr>
            </tbody>
        </table>
        <input type="submit" class="button button-primary" value="<?php _e('Save', parent::sname ); ?>">
    </form>
    <p><strong><?php _e('IMPORTANT:',parent::sname);?></strong> <a href="https://instagram.com/developer/register/"><?php _e('Create your own Instagram App and replace this Key and Secret tokens.',parent::sname);?></a>
</div>