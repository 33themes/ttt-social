<?php if ( ! defined( 'WPINC' ) ) { die; } ?>

<!--<aside id="ttt-social-twitter" class="widget twitter-widget">-->
	<h4 class="widget-title">Twitter Feed</h4>
	<ul class="no-bullet">
		<?php foreach( $netsocial->feed as $twitt ): ?>
		<li class="feed-entry">						
			<div class="feed-entry-container">
				<a class="feed-page-avatar hide" href="<?php echo $twitter ?>"><img src="<?php echo $twitt->user->profile_image_url; ?>" /></a>
				<h5 class="feed-entry-author">
					<div class="hide"><?php echo $twitt->user->name; ?></div>
					<a href="https://twitter.com/<?php echo $twitt->user->screen_name; ?>/status/<?php echo $twitt->id_str; ?>">@<?php echo $twitt->user->screen_name; ?></a>
				</h5>
				<p class="feed-entry-content"><?php echo $twitt->text; ?></p>
				<time class="hide">
					<a href="https://twitter.com/<?php echo $twitt->user->screen_name; ?>/status/<?php echo $twitt->id_str; ?>"><?php echo $twitt->created_at; ?></a>
				</time>
				<?php echo $twitt->retweet; ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
<!--</aside>-->