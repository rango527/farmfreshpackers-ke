<?php get_header();?>
    <div class="main-container page-404">
        <?php do_action('biolife_before_content_404');?>
        <div class="container">
            <div class="text-center content-404">
                <h1 class="heading"><?php esc_html_e('404','biolife');?></h1>
                <h2 class="title"><?php esc_html_e('Oops! That page can\'t be found.','biolife');?></h2>
                <p><?php esc_html_e('Sorry, but the page you are looking for is not found. Please, make sure you have typed the current URL.','biolife');?></p>
                <a class="button" href="<?php echo esc_url( get_home_url('/') );?>"><?php esc_html_e('Go to Home','biolife');?></a>
            </div>
        </div>
    </div>
<?php get_footer();?>