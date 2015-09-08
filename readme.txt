=== TTT Social ===
Contributors: 33themes, gabrielperezs, lonchbox, tomasog, 11bits
Tags: facebook, twitter, twitter oauth, social timeline, facebook page, vimeo feed, pinterest feed, instagram, instagram oauth
Requires at least: 3.4
Tested up to: 4.3
Stable tag: 0.8.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create your custom html layout for Facebook page, Twitter, Instagram, Pinterest and Vimeo feeds.

== Description ==

A plugin built more for Theme Developers, make it easy the importation and customization of social media timelines.


= 33themes Template System =

This plugins use our widgets template system, make easy to you to customize the plugin look&feel to create a new widget markup inside your theme folder, don´t need to change anything in the plugin, just copy two files from the plugin into new folders inside your theme.

**Create a custom template:**

1. Create a new folder with the name `ttt-social` inside your theme
1. Copy the **template.php** file from `wp-content/plugins/ttt-social/template/front/SOCIAL NETWORK/template.php` to a new folder in your theme `wp-content/themes/YOUR-THEME/ttt-social/SOCIAL NETWORK/template.php`. i.e: YOUR_THEME/ttt-social/twitter/template.php
1. The `template.php` file will replace the plugin template and is the same template used for the social network widget.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `ttt-social` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Settings -> TTT Social Keys for configuration. To make your life easier we set our App Keys, don´t need to change it at least you know how the Facebook, Twitter Apps works.
1. *Important* you have to make an OAuth connection with a Twitter. For Instagram need to create your own Instagram APP here https://instagram.com/developer/register/ and replace the Tokens Key and Secret.


== Frequently Asked Questions ==

= How the plugin bring the content from each social network? =

*How it connect with Facebook?*
It use a Facebook App, and by default we include a FB App we create, if you don´t know much about OpenGraph or Facebook App Keys just let it like it is.

*Facebook widget works with Facebook Profiles?*
No, only Facebook pages.

*Do I need to be the Facebook page administrator to connect?*
No, you can use any open to public page.

*How it connects with Twitter?*
The plugin use Twitter OAuth API connection, it´s the only way and the most simple. Also we include by default our Twitter APP Keys, you can change them by yours ONLY if you know how this works, if not, let it like it is.

*Do I need a Twitter Account to use the widget?*
Yes, is necessary to link a Twitter Account so the feed works, after link the account you can show any open twitter user in your widget or filter tweets by a #hashtag or @user, like a search.

*Can I use more than one Facebook or Twitter widget?*
Yes, you can use as many as you want, the only limitation are the queries our APP have to the Twitter or Facebook API, this will make sometimes your feed appear empty.

*Do I need an Instagram account to use the widget?*
Yes, as Twitter, Instagram need to link an account with our Instagram APP, after make the oAuth connection can show any open Instagram account you want.

*Instagram widget is limited to the connected account?*
No, after connect an Instagram account you can connect with any other you want, and use the widget any times you want where each one can have a different account.

*Connecting Instagram get this error {"code": 400, "error_type": "OAuthException", "error_message": "Redirect URI does not match registered redirect URI"} ?*
It´s because Instagram APP need the specification of the site domain, if not match with the domain in where you are installing the plugin will show this message. Go to https://instagram.com/developer/register/ and create your own Instagram APP, replace the tokens key and secret with the one ones and will work.

*Pinterest and Vimeo don´t need any API connection?*
No, :) 

*Why not Youtube?*
It´s in our roadmap for future updates.


