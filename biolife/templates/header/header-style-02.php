<?php
/**
 * Name:  Header style 02
 **/
?>
<header id="header" class="header style-2">
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner">
				<?php
				if ( has_nav_menu( 'top_left_menu' ) ) {
					wp_nav_menu( array(
							'menu'            => 'top_left_menu',
							'theme_location'  => 'top_left_menu',
							'depth'           => 2,
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'biolife-nav top-bar-menu',
						)
					);
				}
				if ( has_nav_menu( 'top_right_menu' ) ) {
					wp_nav_menu( array(
							'menu'            => 'top_right_menu',
							'theme_location'  => 'top_right_menu',
							'depth'           => 2,
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'biolife-nav top-bar-menu right',
						)
					);
				}
				?>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="header-middle-inner header-responsive">
                <div class="logo">
					<?php biolife_get_logo(); ?>
                </div>
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
                <div class="box-header-info">
                    <div class="header-control">
                        <div class="box-search">
							<?php biolife_search_form(); ?>
                        </div>
                        <div class="box-search-click">
                            <a class="btn-submit"><span class="flaticon-magnifying-glass"></span></a>
                        </div>
						<?php
						do_action( 'biolife_wishlist' );
						do_action( 'biolife_header_mini_cart' );
						?>
                        <div class="block-menu-bar">
                            <a class="menu-bar menu-toggle" href="#">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="container">
            <div class="header-nav-inner">
				<?php biolife_header_vertical( 'vertical_menu', true ); ?>
				<?php biolife_search_form(); ?>
                <div class="header-middle-info">
					<?php
					$ovic_header_midddle_icon   = Biolife_Functions::get_option( 'header_middle_icon' );
					$ovic_header_midddle_text_1 = Biolife_Functions::get_option( 'header_middle_text_1' );
					$ovic_header_midddle_text_2 = Biolife_Functions::get_option( 'header_middle_text_2' );
					?>
                    <div class="middle-info">
						<?php if ( $ovic_header_midddle_icon != "" ): ?>
                            <span class="icon <?php echo esc_attr( $ovic_header_midddle_icon ); ?>"></span>
						<?php endif; ?>
                        <div class="group-text">
							<?php if ( $ovic_header_midddle_text_1 != "" ): ?>
                                <span class="header-text-1"><?php echo esc_html( $ovic_header_midddle_text_1 ); ?></span>
							<?php endif; ?>
							<?php if ( $ovic_header_midddle_text_2 != "" ): ?>
                                <span class="header-text-2"><?php echo esc_html( $ovic_header_midddle_text_2 ); ?></span>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
