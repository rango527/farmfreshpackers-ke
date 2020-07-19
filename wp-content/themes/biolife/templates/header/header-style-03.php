<?php
/**
 * Name:  Header style 03
 **/
?>
<header id="header" class="header style-2 style-3">
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
            <div class="hidden">
                <?php biolife_header_vertical( 'vertical_menu', true ); ?>
            </div>
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
</header>
