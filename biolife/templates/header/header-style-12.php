<?php
/**
 * Name:  Header style 12
 **/
?>
<header id="header" class="header style-12">
	<div class="header-top">
		<div class="container">
			<div class="header-top-inner clearfix">
				<div class="header-top-left">
			        <?php
					if ( has_nav_menu( 'top_left_menu_header_12' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'top_left_menu_header_12',
                                    'theme_location'  => 'top_left_menu_header_12',
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
		        <div class="header-top-right">
		        	<?php
					if ( has_nav_menu( 'top_right_menu_header_12' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'top_right_menu_header_12',
                                    'theme_location'  => 'top_right_menu_header_12',
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
		<div class="container">
			<div class="header-middle-inner">
				<div class="logo">
					<?php biolife_get_logo(); ?>
				</div>
				<div class="box-header-info">
					<div class="header-control">
						<?php 
						biolife_search_form(); 
						biolife_wishlist(); 
						biolife_header_mini_cart(); 
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
	<div class="header-bottom">
		<div class="container">
			<div class="header-bottom-inner header-responsive clearfix">
				<?php biolife_header_vertical( 'vertical_menu', true ); ?>
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
				<?php $text_menu = Biolife_Functions::get_option( 'text_menu' ); ?>
				<?php if ( $text_menu != "" ): ?>
                    <span class="text-last-menu"><?php echo esc_html( $text_menu ); ?></span>
                <?php endif; ?>
			</div>
		</div>
	</div>
</header>
