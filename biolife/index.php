<?php get_header(); ?>
<?php
/* Get Blog Settings */
$biolife_blog_layout     = Biolife_Functions::get_option( 'ovic_sidebar_blog_layout', 'left' );
$biolife_blog_list_style = Biolife_Functions::get_option( 'ovic_blog_list_style', 'standard' );
if ( is_single() ) {
	/*Single post layout*/
	$biolife_blog_layout = Biolife_Functions::get_option( 'ovic_sidebar_single_layout', 'left' );
}

$biolife_blog_used_sidebar = Biolife_Functions::get_option( 'ovic_blog_used_sidebar', 'widget-area' );

if( is_single()){
	$biolife_blog_used_sidebar = Biolife_Functions::get_option( 'ovic_single_used_sidebar', 'widget-area' );
}
if ( !is_active_sidebar($biolife_blog_used_sidebar) ){
    $biolife_blog_layout = 'full';
}
/*Main container class*/
$biolife_main_container_class   = array();
$biolife_main_container_class[] = 'main-container';
if ( $biolife_blog_layout == 'full' ) {
	$biolife_main_container_class[] = 'no-sidebar';
} else {
	$biolife_main_container_class[] = $biolife_blog_layout . '-sidebar';
}
$biolife_main_content_class   = array();
$biolife_main_content_class[] = 'main-content';
if ( $biolife_blog_layout == 'full' ) {
	$biolife_main_content_class[] = 'col-sm-12';
} else {
	$biolife_main_content_class[] = 'col-lg-9 col-md-8';
}
$biolife_slidebar_class   = array();
$biolife_slidebar_class[] = 'sidebar';
if ( $biolife_blog_layout != 'full' ) {
	$biolife_slidebar_class[] = 'col-lg-3 col-md-4';
}
$no_toolkit = false;
if ( !class_exists( 'Ovic_Toolkit' ) ){
	$no_toolkit = true;
}
?>
<?php do_action( 'biolife_before_content_wappper' ); ?>
    <div class="<?php echo esc_attr( implode( ' ', $biolife_main_container_class ) ); ?>">
		<?php if ( !class_exists( 'Ovic_Toolkit' ) ): ?>
            <div class="container">
				<?php if ( !is_single() ) : ?>
					<?php if ( is_home() ) : ?>
						<?php if ( is_front_page() ): ?>
                            <h1 class="page-title blog-title"><?php esc_html_e( 'Latest Posts', 'biolife' ); ?></h1>
						<?php else: ?>
                            <h1 class="page-title blog-title"><?php single_post_title(); ?></h1>
						<?php endif; ?>
					<?php elseif ( is_page() ): ?>
                        <h1 class="page-title blog-title"><?php single_post_title(); ?></h1>
					<?php elseif ( is_search() ): ?>
                        <h1 class="page-title blog-title"><?php printf( esc_html__( 'Search Results for: %s', 'biolife' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php else: ?>
                        <h1 class="page-title blog-title"><?php the_archive_title( '', '' );; ?></h1>
						<?php
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					<?php endif; ?>
				<?php elseif (is_search()): ?>
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'biolife' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php endif; ?>
            </div>
		<?php else: ?>
			<?php if ( is_search() ) : ?>
                <div class="container">
					<?php if ( have_posts() ) : ?>
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'biolife' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php endif; ?>
                </div>
			<?php endif; ?>
		<?php endif; ?>

        <div class="container">
			<?php do_action( 'biolife_before_content_inner' ); ?>
            <!-- <?php do_action( 'ovic_breadcrumb' ); ?> -->
            <div class="row">
                <div class="<?php echo esc_attr( implode( ' ', $biolife_main_content_class ) ); ?>">
                    <!-- Main content -->
					<?php
					if ( is_single() ) {
						while ( have_posts() ): the_post();
						    get_template_part( 'templates/blog/blog', 'single' );
							/*If comments are open or we have at least one comment, load up the comment template.*/
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile;
						wp_reset_postdata();
					} else {
						get_template_part( 'templates/blog/blog', $biolife_blog_list_style );
					} ?>
                </div>
				<?php if ( $biolife_blog_layout != "full" ): ?>
                    <div class="<?php echo esc_attr( implode( ' ', $biolife_slidebar_class ) ); ?>">
                        <?php
                        get_sidebar();
                        ?>
                    </div>
				<?php endif; ?>
            </div>
			<?php do_action( 'biolife_after_content_inner' ); ?>
        </div>
    </div>
<?php do_action( 'biolife_after_content_wappper' ); ?>
<?php get_footer(); ?>