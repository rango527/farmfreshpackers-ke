<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Biolife
 * @since 1.0
 * @version 1.0
 */
?>
    <!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
    </head>
<?php
?>
<body <?php body_class(); ?>>
<a href="javascript:void(0)" class="overlay-body"></a>
<?php
do_action('biolife_search_form_click');
do_action('biolife_header_mobile');
do_action('biolife_header_sticky');
do_action('biolife_header_content');
do_action('biolife_before_full_width_inner');
?>