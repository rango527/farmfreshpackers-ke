<?php
/**
 * Name:  Header style 14
 **/
?>
<header id="header" class="header style-1 style-2 style-4 style-14">
    <div class="header-middle">
        <div class="container">
            <div class="header-middle-inner header-responsive">
                <div class="box-header-nav">
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
                <div class="logo">
                    <?php biolife_get_logo(); ?>
                </div>
                <div class="box-header-info">
                    <div class="header-control">
                        <ul class="header-style-04-user-link"><?php do_action( 'ovic_user_link' ); ?></ul>
                        <a class="search-click" href="#"><i class="flaticon-magnifying-glass"></i></a>
                        <?php
                        do_action( 'biolife_wishlist' );
                        do_action( 'biolife_header_mini_cart' );
                        ?>
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
            </div>
        </div>
    </div>
</header>
