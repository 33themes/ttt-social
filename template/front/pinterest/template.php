<?php if ( ! defined( 'WPINC' ) ) { die; } ?>

<?php if ( $netsocial->feed ): ?>
<!--<aside id="ttt-social-vimeo" class="widget vimeo-widget">-->
	<h4 class="widget-title">Pinterest</h4>
	<ul class="no-bullet">

	<?php foreach ($netsocial->feed as $pt_feed_item) : ?>
	<li>
		<div class="feed-entry-container">
			<!--<a class="feed-page-avatar left" href="<?php echo $fb_page; ?>"></a>-->
			<h5 class="feed-entry-title">
				<a href="<?php echo $pt_feed_item->get_permalink(); ?>" title="<?php echo $pt_feed_item->get_date('j F Y @ g:i a'); ?>">@<?php echo substr($pt_feed_item->get_title(),0,strpos($pt_feed_item->get_title(), '.')); ?></a>
			</h5>
			<p class="feed-entry-content"><?php echo substr($pt_feed_item->get_description(), 0, 165); ?></p>
			<time aria-hidden="true" class="feed-entry-publishdate"><a href="<?php echo $pt_feed_item->get_permalink(); ?>" title="<?php echo $pt_feed_item->get_date('j F Y @ g:i a'); ?>"><?php echo $pt_feed_item->get_date('d / M / Y g:i a'); ?></a></time>
		</div>			
	</li>
	<?php endforeach; ?>
</ul>
<!--</aside>-->
<?php endif; ?>