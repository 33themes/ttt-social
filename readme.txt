# TTT Social

* **Contributors:** 33themes, gabrielperezs, lonchbox, tomasog, 11bits
* **Tags:** facebook, twitter, twitter oauth, social timeline, facebook page, vimeo feed, pinterest feed, instagram, instagram oauth
* **Requires at least:** 3.4
* **Tested up to:** 4.3
* **Stable tag:** 0.8.1
* **License:** GPLv2
* **License URI:** http://www.gnu.org/licenses/gpl-2.0.html

Create your custom html layout for Facebook page, Twitter, Instagram, Pinterest and Vimeo feeds.

## Description

A plugin built mainly for theme developers, make it easy the importation and customization of social media timelines.

## 33themes Template System

This plugin use our widgets template system, it makes easy to customize the look & feel of the social feeds.

**Create a custom template:**

1. Create a new folder with the name `ttt-social` inside your theme
2. Copy the **template.php** file from `wp-content/plugins/ttt-social/template/front/SOCIAL NETWORK/template.php` to a new folder in your theme `wp-content/themes/YOUR-THEME/ttt-social/SOCIAL NETWORK/template.php`. i.e: YOUR_THEME/ttt-social/twitter/template.php
3. The `template.php` file will replace the plugin template and is the same template used for the social network widget.


## Installation

This section describes how to install the plugin and get it working.

1. Upload `ttt-social` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings -> TTT Social Keys for configuration. To make your life easier we set our App Keys, you don´t need to change it at least you know how the Facebook, Twitter Apps works.
4. *Important* you have to make an OAuth connection with a Twitter. For Instagram need to create your own Instagram APP here https://instagram.com/developer/register/ and replace the Tokens Key and Secret.


## Frequently Asked Questions

### How the plugin brings the content from each social network?

**How does it connect with Facebook?**

It uses a Facebook App, and by default we include a FB App we create, if you don´t know much about OpenGraph or Facebook App Keys just leave it as it is.

**Facebook widget works with Facebook Profiles?**

No, only with Facebook pages.

**Do I need to be the Facebook page administrator to connect?**

No, you can use any open to public page.

**How does it connect with Twitter?**

The plugin use Twitter OAuth API connection, it´s the only way and the most simple. Also we include by default our Twitter APP Keys, you can change them by yours ONLY if you know how this works, if not, leave it as it is.

**Do I need a Twitter Account to use the widget?**

Yes, is necessary to link a Twitter Account for the feed work, after link the account you can show any open twitter user in your widget or filter tweets by #hashtag or @user, like a search.

**Can I use more than one Facebook or Twitter widget?**

Yes, you can use as many as you want, the only limitation are the queries our APP have to the Twitter or Facebook API, this will make sometimes your feed appear empty.

**Do I need an Instagram account to use the widget?**

Yes, you have to link an account with our Instagram APP, after make the oAuth connection you can show any open Instagram account.

**Is Instagram widget limited to the connected account?**

No, after connect an Instagram account you can connect with any other, and use the widget many times you want and each one can have a different account.

**Connecting Instagram shows this error `{"code": 400, "error_type": "OAuthException", "error_message": "Redirect URI does not match registered redirect URI"}` ?**

This is because Instagram APP needs the specification of the site domain, if it doesn't match with the domain in where you are installing the plugin it will show this message. Go to https://instagram.com/developer/register/ and create your own Instagram APP, replace the tokens key and secret with the new ones and it will work.

**Pinterest and Vimeo don´t need any API connection?**

No, :) 

**Why not Youtube?**

It´s in our roadmap for future updates.


