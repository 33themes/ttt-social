
# TTT Social
Contributors: 33themes, gabrielperezs, lonchbox, tomasog
Tags: facebook timeline, twitter timeline, twitter oauth, multiple twitter account, social timeline, facebook widget, twitter widget
Requires at least: 3.4
Tested up to: 3.6
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Custom design Facebook Page & Twitter timelines widgets.

# Description


# Widgets

The plugin load two custom widgets:

* TTT Social Facebook Widget
Fields:
- Page Name. Your page name is: http://facebook.com/MYPAGENAME you URL username is MYPAGENAME.
- Page ID. If you don´t know your ID go to: http://findmyfacebookid.com/
- Limit. Is the amount of entries you want to show in your widget.

* TTT Social Twitter Widget
Fields:
- Count. How many tweets you want to show.
- User. Even you had connected with your twitter account you can also show other user timeline just writeing his username.
- Query. Also you can filter the tweets by: hashtag, username or text.


You can Add as many widgets you want :)



# 33themes Template System

This plugins use our widgets template system, make easy to you to customize the plugin look&feel to create a new widget markup inside your theme folder, don´t need to change anything in the plugin, just copy two files from the plugin into new folders inside your theme.

## Create a custom template:

1. Create a `ttt-social` folder sindei your theme, next create two new folders `ttt-social/facebook` & `ttt-social/twitter`, onea folder for each social network.
1. Copy the **template.php** file from `wp-content/plugins/ttt-social/template/front/facebook/template.php` to a new folder in your theme `wp-content/themes/YOUR-THEME/ttt-social/facebook/template.php`
1. Copy the **template.php** file from `wp-content/plugins/ttt-social/template/front/twitter/template.php` to a new folder in your theme `wp-content/themes/YOUR-THEME/ttt-social/twitter/template.php`
1. Edit the files you copied from the plugin into your folder, remove all `<html>` code you want to make it look as you need.

## Templates Data

### Facebook
`
<?php if ( $netsocial->feed ): ?>
	<?php foreach ($netsocial->feed as $fb_feed_item) : ?>
		HERE HTML & FB FIELDS
	<?php endforeach; ?>
<?php endif; ?>
`
FB FIELDS:
* `<?php echo $fb_page; ?>` -> FB Page link
* `<?php echo $netsocial->name ?>` -> FB Page name
* `<?php echo $fb_feed_item->get_permalink(); ?>` -> FB Page Item link
* `<?php echo $fb_feed_item->get_date('j F Y @ g:i a'); ?>` -> FB Page Item date
* `<?php echo substr($fb_feed_item->get_description(), 0, 165); ?>` -> FB Page Item content. Text limit from 0 to 165 characters.

### Twitter
`
<?php foreach( $netsocial->feed as $twitt ): ?>
	HERE HTML & TWITTER FIELDS
<?php endforeach; ?>
`
TW FIELDS:
* `<?php echo $twitter ?>` -> TW user link
* `<?php echo $twitt->user->name; ?>` -> TW username
* `<?php echo $twitt->user->profile_image_url; ?>` -> TW user avatar
* `<?php echo $twitt->user->screen_name; ?>` -> TW user screen name. Is not the same as username
* `<?php echo $twitt->id_str; ?>` -> Tweet code
* `<?php echo $twitt->text; ?>`-> Tweet text
* `<?php echo $twitt->created_at; ?>` -> Tweet date
* `<?php echo $twitt->retweet; ?>` -> Retweet link

How to write a tweet url?
`https://twitter.com/<?php echo $twitt->user->screen_name; ?>/status/<?php echo $twitt->id_str; ?>`



## Installation

This section describes how to install the plugin and get it working.

e.g.

1. Upload `ttt-social-timelines` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


### Twitter Oauth Connection

*IMPORTANT*
By Default TTT Social have twitter connection with our Twitter Application, you can keep using our connection but we recommend to make your own Twitter Application so you have more control.
If you want to change the Twitter App:

1. Create a Twitter Application: https://dev.twitter.com/apps/new
1. After you create your twitter app just replace the **Key** & **secret** codes from Settings -> TTT Social with your own codes.

*Add a Twitter Account*
Go to Settings -> TTT Social and click in **Add Account** button, the plugin will launch a twitter login, give your account permision to connect and it´s DONE.


# Frequently Asked Questions #

## How the plugin bring the content from each social network?

*All Facebook data came form the feed*
Use your ID number & URL username to make the connection. *NOT FACEBOOK CONNECT*.
Let´s use the WordPress Facebook Page. His url is http://www.facebook.com/WordPress and ID is 6427302910.
All data you can use in your widget template came from Facebook Feed tags. This is the feed url http://www.facebook.com/feeds/page.php?format=atom10&id=6427302910
The page username it used to bring page profile image and some other things.

*All Twitter data you can use in your widget template came from twitter API 1.1*
https://dev.twitter.com/docs/api/1.1/get/lists/list 
