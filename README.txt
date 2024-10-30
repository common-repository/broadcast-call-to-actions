=== Broadcast - WordPress Call to Actions ===
Contributors: dcooney, conReadme updatenekthq
Donate link: https://connekthq.com/donate/
Tags: cta, call to action, announcement, broadcast, action, broadcast, callout
Requires at least: 3.6
Tested up to: 4.7.3
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Broadcast is a call to action (CTA) management plugin that allows you to easy manage and display CTAs within your WordPress content.

== Description ==

Broadcast is a powerful call to action (CTA) management plugin that allows you to easy manage and display CTAs within your WordPress content. 

A simple solution for a real-world problem – Broadcast allows you to rapidly create call to actions and customize the look and feel of each CTA using layout templates.

**[Get More Information](https://connekthq.com/plugins/broadcast/)**


= **Shortcode Parameters** =

Broadcast is implemented via shortcode which lets you insert call to actions anywhere in your content and accepts the following shortcode parameters:

*   **cta** - The ID of the call to action. [REQUIRED]
*   **layout** - The ID of the layout. [REQUIRED]
*   **align** - The alignment of the CTA. (left/center/right)
*   **width** - The percentage width of the CTA.
*   **classes** - Add custom classes to the Broadcast CTA container.

**Example Shortcode**
`[broadcast cta="1726" layout="1901" width="40"]`

Don't worry, building a custom shortcode is simple with the custom shortcode builder.


= **Plugin Roadmap** =

Development of the following features is currently underway:

*   A/B Testing
*   Conversion Tracking
*   Click/Event Tracking
*   Layout template library
*   Newsletter sign-up integrations


== Frequently Asked Questions ==

= How are CTAs implemented? =

Broadcast CTAs are implements using shortcodes only. e.g. [broadcast]

= Why are layouts separate from CTAs? =
This is so Broadcast can separate content of CTAs from the display.

= How are Layouts used? =

Layouts are used to display call to action content on the front-end of your website. They typically contain a mixture of HTML, PHP and core WordPress functions such as the_title(), the_content(), the_post_thumbnail() etc.




== Installation ==

How to install Broadcast.

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'Broadcas'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `broadcast.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `broadcast.zip`
2. Extract the `broadcast` directory to your computer
3. Upload the `broadcast` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard




== Screenshots ==

1. Settings Dashboard
2. Call to Actions Dashboard
3. Layouts Dashboard
4. Post/Page Edit Screen




== Changelog ==

= 1.0 - April 7, 2017 =
* Initial Release




== Upgrade Notice ==
* None 