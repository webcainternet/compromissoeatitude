=== UnPointZero Slider ===

Contributors: UnPointZero

Tags: slider,parallax,slide,featured,home,jquery,picture,slideshow,thumbnail

Requires at least: 2.9

Tested up to: 3.5.1

Stable tag: 3.4.4

Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JMQUZKHDUR3TG

UnPointZero slider is a plugin that display a slideshow for your posts, pages or custom post type. And it's fully customizable !



== Description ==

UnPointZero slider is a plugin that display a slideshow for your news or pages !

It's fully customizable with CSS and scale automatically images to the right size.
Different sliding effects available.

You can set a basic slider with arrows navigation, number navigation, or advanced with thumbnails (see screenshots).

Please if you promote the slider, link to this page http://www.unpointzero.com/unpointzero-slider/ instead of the WordPress plugin page.

More information @ http://www.unpointzero.com/unpointzero-slider/
If you need help to install / setup, contact-us @ http://www.unpointzero.com/contact

If you appreciate our free plugins, donate or make a backlink to our website http://www.unpointzero.com on your website. Thanks !

Coming features : Responsive slider - Parallax slider

== Upgrade Notice ==

/!\ When upgrading, please go to slider options last tab named "Update to 3.4" and click the upgrade button. /!\
= 3.4.4 =
* Added an option if you use WPML plugin, see "Other options" and tick "Using WPML".

= 3.4.3 =
* Updated 3.4.x database update method to be compatible with multisites.

= 3.4.2 =
* Minor upgrades : add strip_shortcodes() function to description to delete unwanted shortcodes display.

= 3.4.1 =
* Corrected parallax bug, now when you navigate everything slides correctly.
* Added option on "Other options" to use custom meta to display title & description. With this you can have different post (title/description) & slide (title/description).

= 3.4 =
* New option saving system. This will be more clean on your database :).
* Corrected "add custom slides", you can add up to 5 custom slides now.
* Added the first parallax option. You can add slide options for title and description. More features coming.

== Changelog ==

= 3.4.1 =
* Corrected parallax bug, now when you navigate everything slides correctly.
* Added option on "Other options" to use custom meta to display title & description. With this you can have different post (title/description) & slide (title/description).

= 3.4 =
* New option saving system. This will be more clean on your database :).
* Corrected "add custom slides", you can add up to 5 custom slides now.
* Added the first parallax option. You can add slide options for title and description. More features coming.

= 3.3 =
* Corrected some path problems (thanks to ollybach)
* Now you can overwrite the css file by using your own. just add your rules on a file named "upz-style.css" on your theme folder (thanks to ollybach)
* Corrected some CSS "bugs". Added the "upzslider" class to all selector to avoid conflicts.
* Fix some resizing problems

= 3.2.1 =
* Small fix for chrome auto-resizing problems. 

= 3.2 = 
* Corrected some bugs (shortcode, custom post type...)
* Added bubbles navigation (Slider style => Advanced CSS/JS settings => Navigation type
* Advanced options for advanced users/developers only : Support custom meta for thumbs and post order

= 3.1.8.2 = 
* Display problem solved. If you're using do_shortcode() method, please add 'usingphp=true' argument on shortcode

= 3.1.8.1 = 
* Going back to 3.1.7... Correcting shortcode bugs on next version.

= 3.1.8 = 
* Corrected slider bug when using PHP integration. If you're using do_shortcode() method, please add 'usingphp=true' argument on shortcode

= 3.1.7 = 
* Corrected a bug with plugin positioning when using the shortcode. Thanks to tanner m !

= 3.1.6 = 
* Corrected a bug with .load() event on internet explorer 6+.
* corrected a bug when mouseover option checked and links on thumb checked.

= 3.1.5 = 
* Corrected bug when using thumbnails. Description box should now dislay correctly.

= 3.1.4 = 
* New fonction added : Activate links to post or page on thumbnails (only if thumbnails on of course ;)). You'll find this option on "Other options" tab !

= 3.1.3.1 =
* Corrected small bug with links. Update only if you've problems

= 3.1.3 =
* Updated role method, using now user roles & rights to manage the administrator rights (thanks to Morten)

= 3.1.2 =
* Corrected bug caused by 'disable links' options. All should works fine now =).

= 3.1.1 =
* Corrected another WP Url bug. Thanks to Denis Platonov again ;).

= 3.1 =
* Corrected internet explorer save options bug
* Added "disable links" on "Other options" to disable links to posts/pages if you want
* Corrected bug for WordPress own directory users (thanks to Denis Platonov)
* Other minor bugfix

== Installation ==

Warning : Save your custom css file saved in the css directory before updating !

Setup thumb size BEFORE uploading ! If you set the sizes after the upload, You've to re-upload all thumbs to get the right size.


1. Upload `unpointzero-slider` folder to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Configure it on your administration panel.

4. Place `<?php do_shortcode('[upzslider usingphp=true]'); ?>` in your templates or [upzslider] on your pages / posts

5. Now you can go on your pages/posts and set thumbnails !

6. That's all !


If you want to display multiple sliders on your website (warning do not support 2 slider on the same page...) use this on your templates or on your pages / posts:

On template files: `<?php do_shortcode('[upzslider usingphp=true interid='IDs or names coma separated' intertype='page OR post']'); ?>`

for example : `<?php do_shortcode('[upzslider usingphp=true interid='3,5,20' intertype='post']'); ?>` to display posts from category 3,5,20

On WP pages/posts: [upzslider interid='IDs or names coma separated' intertype='page OR post']

for example : `[upzslider interid='3,5,20' intertype='post']` to display posts from category 3,5,20


To use your own css file, just add your rules on a file named "upzslider-style.css" on your theme directory.


More information @ http://www.unpointzero.com/unpointzero-slider/

== Screenshots ==
1. Slider preview ( you can manage all the elements easily by editing the css file and some options on administration page.
2. Classic style without thumbnails.
3. Navigation with numbers

== Some websites using UnPointZero slider ==
* http://www.rzg.fr
* http://www.luxuriant.lu
* http://www.unpointzero.com
* http://www.mediatheque-jeunesse-casc.fr

== Frequently Asked Questions ==

= I've lost my option when upgrading to 3.4 =
* Please just go to slider options last tab "Update to 3.4" and click the upgrade button.

= Can I use my own CSS file ? =
* Yes, just add your rules on a file named "upzslider-style.css" on your theme directory.

= The slider does not appear when I include it with do_shortcode WordPress function on my template. =
* Please make sure you've add usingphp=true on your shortcode like this : [upzslider usingphp=true]

= The slider does not display correct image size. =
* Before sending us a bug report about thumbnails sizes PLEASE try to regenerate your thumbnails with the regenerate thumbnails plugin available @ http://wordpress.org/extend/plugins/regenerate-thumbnails/

= How to add images to the slider ? =
* First of all, this is not a simple image slider, it's a post/page/custom post type slider. To add a slide, you've to set a "featured image" on your post/page/custom post type.