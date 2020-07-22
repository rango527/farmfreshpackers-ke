<div class="blog-single01 blog-new">
    <article <?php post_class( 'post-item' ); ?>>
        <?php
        do_action('biolife_single_post_thumbnail');
        do_action('biolife_single_post_title');
        /**
         * Functions hooked into biolife_single_post_content action
         *
         * @hooked biolife_post_thumbnail          - 10
         * @hooked biolife_post_info               - 20
         */
        do_action('biolife_single_post_date');
        ?>
        <?php
            do_action('biolife_post_single_content');
        ?>
        <div class="clearfix"></div>
        <div class="post-area">
            <?php
                do_action('biolife_post_single_category2');
                do_action('biolife_post_single_tags');
            ?>
        </div>
        <div class="post-socials">
            <?php do_action('biolife_post_author'); ?>
            <?php do_action('biolife_post_single_sharing'); ?>
        </div>
    </article>
    <?php
    if (class_exists('Ovic_Toolkit')){
        ovic_set_post_views( get_the_ID()  );
    }
    get_template_part( 'templates/blog/blog', 'related' );
    ?>
</div>