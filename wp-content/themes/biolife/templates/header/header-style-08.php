<?php
/**
 * Name:  Header style 08
 **/
?>
<header id="header" class="header style-2 style-3 style-8">
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
						do_action( 'ovic_user_link' );
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
