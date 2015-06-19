<?php if ( ! defined( 'WPINC' ) ) { die; } ?>

<?php if ( $netsocial->feed ): ?>

<ul>
	<?php foreach ($netsocial->feed as $fb_feed_item) : ?>
	<li>
		<div class="feed-entry-container">
			<a class="feed-page-avatar left" href="<?php echo $fb_page; ?>"><img class="left" src="http://graph.facebook.com/<?php echo $netsocial->name ?>/picture"/></a>
			<h5 class="feed-entry-title">
				<a href="<?php echo $fb_feed_item->get_permalink(); ?>" title="<?php echo $fb_feed_item->get_date('j F Y @ g:i a'); ?>">@<?php echo $netsocial->name ?></a>
			</h5>
			<p class="feed-entry-content"><?php echo substr($fb_feed_item->get_description(), 0, 165); ?></p>
			<time aria-hidden="true" class="feed-entry-publishdate"><a href="<?php echo $fb_feed_item->get_permalink(); ?>" title="<?php echo $fb_feed_item->get_date('j F Y @ g:i a'); ?>"><?php echo $fb_feed_item->get_date('d / M / Y g:i a'); ?></a></time>
		</div>			
	</li>
	<?php endforeach; ?>
</ul>

<?php endif; ?>
