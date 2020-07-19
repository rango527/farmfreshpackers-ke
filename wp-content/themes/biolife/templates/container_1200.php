<?php
/**
 * Template Name: Container 1200px
 *
 * @package WordPress
 * @subpackage Biolife
 * @since Biolife 1.0
 */
get_header();
?>
    <div class="container-1200-template">
        <div class="inner-template">
            <div class="container">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    ?>
                    <?php the_content(); ?>
                    <?php
                    // End the loop.
                endwhile;
                ?>
            </div>
        </div>
    </div>
<?php
get_footer();