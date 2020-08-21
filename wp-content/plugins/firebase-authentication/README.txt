=== Firebase Authentication ===
Contributors: cyberlord92
Donate link: https://miniorange.com
Tags: firebase, authentication, login, sso, jwt
Requires at least: 3.0.1
Tested up to: 5.5
Stable tag: 1.3.6
License: MIT/Expat
License URI: https://docs.miniorange.com/mit-license

This plugin allows login into WordPress using Firebase user credentials and keeps data in sync between WordPress and Firebase.

== Description ==

This plugin allows you to login or Single Sign-On into WordPress using your Firebase user credentials.
Firebase authentication works using both default WordPress login page and also we support custom login pages.

= Features =
*	**Firebase Authentication** : WordPress login / SSO using Firebase user credentials
*	**Auto Create Users** : After login, new user automatically gets created in WordPress 
*	**Configurable login options** :
	Provide option to login with,
	a) Only Firebase credentials
	b) Only WordPress credentials
	c) Both Firebase and WordPress credentials
*	**Auto Sync Users** : New users will be created in Firebase when trying to register through a WordPress site.
*	**Login/Registration Form Integration** : Integration with any Third Party and Custom Login/Registration Form to allow Firebase Login/Registration 
*	**Support for Phone Authentication method** : Users will be asked to enter OTP provided via Firebase to login into WordPress
*	**Support for different Providers Authentication Methods** : Users will be logged in to WordPress using selected provider's credentials
	Providers supported are
	1. Google
	2. Facebook
	3. Github
	4. Twitter
	5. Apple
	6. Yahoo
	7. Microsoft
*	**Support for Shortcode** : Use a shortcode to place Firebase login button anywhere in your Theme or Plugin
*	**Attribute Mapping** : User attributes received from Firebase are mapped to WordPress user profile
*	**Custom Redirect Login and Logout URL** : Automatically Redirect users after successful login/logout.
*	**WP Hooks for Different Events** : Provides support for different hooks for user defined functions

== Installation ==

1. Visit `Plugins > Add New`
2. Search for `firebase authentication`. Find and Install `firebase authentication` plugin by miniOrange
3. Activate the plugin

== Frequently Asked Questions ==
= I need help to configure the plugin? =
Please email us at <a href="mailto:info@xecurify.com" target="_blank">info@xecurify.com</a> or <a href="http://miniorange.com/contact" target="_blank">Contact us</a>. You can also submit your query from plugin's configuration page.

= I am locked out of my account and can't login with either my WordPress credentials or Firebase credentials. What should I do? =
Firstly, please check if the `user you are trying to login with` exists in your WordPress. To unlock yourself, rename the firebase-authentication plugin name. You will be able to login with your WordPress credentials. After logging in, rename the plugin back to firebase-authentication. If the problem persists, `activate, deactivate, and again activate` the plugin.

= For support or troubleshooting help =
Please email us at info@xecurify.com or <a href="https://miniorange.com/contact" target="_blank">Contact us</a>.

== Screenshots ==

1. Configure Firebase Authentication plugin
2. Option to allow WP Administrators to login
3. The result after successful Test Authentication

== Changelog ==

= 1.3.6 =
* Added compatibility with WP 5.5

= 1.3.5 =
* Some bug fixes

= 1.3.4 =
* Some bug fixes

= 1.3.3 =
* Readme changes

= 1.3.2 =
* UI changes
* Pricing Plan updates

= 1.3.1 =
* Bug Fixes

= 1.3.0 =
* Added Licensing plans
* Added registration

= 1.2.0 =
* Advertised features on UI
* Added Bug Fixes

= 1.1.4 =
* Added compatibility with WordPress 5.4

= 1.1.3 =
* Added step by step guide link

= 1.1.2 =
* Plugin deactivation form

= 1.1.1 =
* Configurable option to allow WP login only to Administrators

= 1.0.0 =
* Initial release

== Upgrade Notice ==
