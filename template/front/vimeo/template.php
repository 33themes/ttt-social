<?php if ( ! defined( 'WPINC' ) ) { die; } ?>

<?php 
 if ( $netsocial->videos ): ?>
<aside id="ttt-social-vimeo" class="widget vimeo-widget">
	<h4 class="widget-title">Vimeo videos</h4>
	<ul class="no-bullet">
		
		<?php  $i=0;
		foreach( $netsocial->videos as $video): 
		if ($i<$netsocial->limit){?>
		
			<li class="feed-entry">
				<img id="portrait" src="<?php echo $netsocial->userlist->user->portrait_small ?>" />
				<h2><?php echo $netsocial->userlist->user->display_name ?>'s Videos</h2>
				
				<p id="bio"><?php echo $netsocial->userlist->user->bio ?></p>
				<a href="<?php echo $video->url ?>"><img src="<?php echo $video->thumbnail_medium ?>" /></a>
			</li>
			
		<?php 
		$i++;
		}
		endforeach ?>
	
	</ul>
</aside>
<?php endif; ?>
