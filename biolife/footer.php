<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Biolife
 * @since 1.0
 * @version 1.0
 */
?>
<?php
$ovic_enable_go_to_top_button = Biolife_Functions::get_option('enable_back_to_top',0);
?>
<?php if ( $ovic_enable_go_to_top_button == 1 ): ?>
    <a href="#" class="backtotop"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<?php endif; ?>
<?php do_action( 'biolife_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
