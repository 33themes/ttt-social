<?php if ( ! defined( 'WPINC' ) ) { die; } ?>

<?php echo "netsocial ".$netsocial->user;
		echo "uri ".$api_endpoint; ?>
<?php if ( $netsocial->videos ): ?>
<aside id="ttt-social-vimeo" class="widget vimeo-widget">
	<h4 class="widget-title">Vimeo videos</h4>
	<ul class="no-bullet">
		
		<?php echo "netsocial ".$netsocial->user;
		echo "uri ".$api_endpoint; 
		foreach( $netsocial->videos as $video): ?>
		
			<li class="feed-entry">
				<img id="portrait" src="<?php echo $userlist->user->portrait_small ?>" />
				<h2><?php echo $userlist->user->display_name ?>'s Videos</h2>
				
				<p id="bio"><?php echo $userlist->user->bio ?></p>
				<a href="<?php echo $video->url ?>"><img src="<?php echo $video->thumbnail_medium ?>" /></a>
			</li>
			
		<?php endforeach ?>
	
	</ul>
</aside>
<?php endif; ?>
