<?php
add_action( 'wp_enqueue_scripts', 'biolife_child_theme_enqueue_styles' );
function biolife_child_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_theme_file_uri( '/style.css' ) );
}


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (current_user_can('test_user')) {
  show_admin_bar(false);
}
}

add_filter('user_contactmethods', 'custom_user_contactmethods');
function custom_user_contactmethods($user_contact){ 
  $user_contact['text_phone'] = 'Phone number';
  
  return $user_contact;
}