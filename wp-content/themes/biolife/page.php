<?php get_header();?>

<?php
/*Default  page layout*/

$biolife_page_layout = Biolife_Functions::get_post_meta(get_the_ID(),'ovic_page_layout','full');
/*Main container class*/
$biolife_main_container_class = array();
$biolife_main_container_class[] = 'main-container';
if( $biolife_page_layout == 'full'){
    $biolife_main_container_class[] = 'no-sidebar';
}else{
    $biolife_main_container_class[] = $biolife_page_layout.'-sidebar';
}
$biolife_main_content_class = array();
$biolife_main_content_class[] = 'main-content';
if( $biolife_page_layout == 'full' ){
    $biolife_main_content_class[] ='col-sm-12';
}else{
    $biolife_main_content_class[] = 'col-lg-9 col-md-8';
}
$biolife_slidebar_class = array();
$biolife_slidebar_class[] = 'sidebar';
if( $biolife_page_layout != 'full'){
    $biolife_slidebar_class[] = 'col-lg-3 col-md-4';
}
?>
<?php do_action('biolife_before_content_wappper');?>
<main class="site-main <?php echo esc_attr( implode(' ', $biolife_main_container_class) );?>">
	
    <div class="container">
        <?php do_action('biolife_before_content_inner');?>
        <div class="row">
            <div class="<?php echo esc_attr( implode(' ', $biolife_main_content_class) );?>">
                <?php
                if( have_posts()){
                    while( have_posts()){
                        the_post();
                        ?>
						<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
                        <div class="page-main-content">
                            <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'biolife' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'biolife' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                            ) );
                            ?>
                        </div>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                        <?php
                    }
                }
                ?>
            </div>
            <?php if( $biolife_page_layout != "full" ):?>
                <div class="<?php echo esc_attr( implode(' ', $biolife_slidebar_class) );?>">
                    <?php get_sidebar('page');?>
                </div>
            <?php endif;?>
        </div>
        <?php do_action('biolife_after_content_inner');?>
    </div>
</main>
<?php do_action('biolife_after_content_wappper');?>
<?php get_footer();?>