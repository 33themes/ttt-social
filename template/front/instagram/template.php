<?php if ( ! defined( 'WPINC' ) ) { die; } ?>


<?php if ( $netsocial->feed ): ?>
<section id="ttt-social-instagram" class="widget instagram-widget">
	<h4 class="widget-title">Instagram</h4>
	<a href="<?php echo $netsocial->userdata->link; ?>">
		<?php echo $netsocial->userdata->full_name; ?>
	</a>
	<em><?php echo $netsocial->userdata->bio; ?></em>

	<ul class="no-bullet">
		
		<?php foreach( $netsocial->feed as $item): ?>
		
			<li class="feed-entry">

				<p>Likes: <?php echo number_format($item->likes->count,0); ?></p>
				<p>Comments: <?php echo number_format($item->comments->count,0); ?></p>
				
				<a href="<?php echo $item->link; ?>">
					<img src="<?php echo $item->images->standard_resolution->url; ?>" />
				</a>

			</li>
			
		<?php endforeach ?>
	
	</ul>
</section>
<?php endif; ?>
