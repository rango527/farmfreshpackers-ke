<?php
/**
 * Name:  Header style 10
 **/
?>
<header id="header" class="header header-style-10">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 header-message"><?php echo esc_html_e('Welcome To Worldwide Organic Store', 'biolife') ?></div>
                <div class="col-sm-12 col-md-6 top-menu-part">
                    <?php
                        if ( has_nav_menu( 'top_menu' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'top_menu',
                                    'theme_location'  => 'top_menu',
                                    'depth'           => 1,
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'biolife-nav top-bar-menu',
                                )
                            );
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container header-responsive">
            <div class="row">
                <div class="col-lg-2 col-xs-4 logo-part">
                    <?php biolife_get_logo(); ?>
                </div>
                <div class="col-lg-4 col-xs-8 col-lg-push-6 header-control-part">
                    <div class="header-control">
                        <?php do_action( 'biolife_wishlist2' ); ?>
                        <ul class="user-link"><?php do_action( 'biolife_user_link2' ); ?></ul>
                        <?php if ( has_nav_menu( 'primary' ) ): ?>
                            <div class="block-menu-bar">
                                <a class="menu-bar menu-toggle" href="#">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-pull-4 header-nav-part">
                    <div class="header-nav">
                        <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'primary',
                                    'theme_location'  => 'primary',
                                    'depth'           => 3,
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'megamenu'        => true,
                                    'mobile_enable'   => true,
                                    'menu_class'      => 'biolife-nav main-menu clone-main-menu ovic-clone-mobile-menu',
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="container">
            <div class="header-nav-inner">
                <?php biolife_header_vertical( 'vertical_menu', true ); ?>
                <div class="search-part">
                    <div class="search-part-inner">
                        <?php biolife_search_form(); ?>
                        <?php
                        if ( has_nav_menu( 'search_menu' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'search_menu',
                                    'theme_location'  => 'search_menu',
                                    'depth'           => 1,
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'biolife-nav search_menu',
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
                <div class="header-middle-info">
                    <?php do_action( 'biolife_header_mini_cart' ); ?>
                </div>
            </div>
        </div>
    </div>
</header>
