<?php if ( ! defined( 'WPINC' ) ) { die; } ?>



<?php if (count($netsocial->feed) > 0): ?>

<ul>
    <?php foreach ($netsocial->feed as $fb_feed_item) : ?>

        <?php $_time = strtotime($fb_feed_item->updated_time); ?>
        
        <li>
            <div class="feed-entry-container">
                <a class="feed-page-avatar left" href="<?php echo $fb_feed_item->link; ?>">
                    <img class="left" src="http://graph.facebook.com/<?php echo $netsocial->id ?>/picture"/>
                </a>
                <h5 class="feed-entry-title">
                    <a href="<?php echo $fb_feed_item->link; ?>" title="<?php echo date('j F Y @ g:i a', $_time); ?>">
                        @<?php echo $netsocial->name ?>
                    </a>
                </h5>
                
                <?php if (isset($fb_feed_item->picture)): ?>
                    <a class="feed-page-avatar left" href="<?php echo $fb_feed_item->link; ?>">
                        <img class="left" src="<?php echo $fb_feed_item->picture; ?>"/>
                    </a> 
                <?php endif; ?>

                <p>Likes <?php echo count($fb_feed_item->likes->data); ?></p>
                <p>Comments <?php echo count($fb_feed_item->comments->data); ?></p>
                <p class="feed-entry-content"><?php echo substr($fb_feed_item->message, 0, 165); ?></p>
                <time aria-hidden="true" class="feed-entry-publishdate">
                    <a href="<?php echo $fb_feed_item->link; ?>" title="<?php echo date('j F Y @ g:i a', $_time); ?>">
                        <?php echo date('d / M / Y g:i a', $_time); ?>
                    </a>
                </time>
            </div>          
        </li>
    <?php endforeach; ?>
</ul>

<?php endif; ?>
