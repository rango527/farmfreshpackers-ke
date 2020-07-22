<?php
/**
 * Name:  Header style 13
 **/
?>
<?php
$text_banner_top = Biolife_Functions::get_option( 'text_banner_top' ); 
$background = Biolife_Functions::get_option( 'top_background' ); 
$header_background = Biolife_Functions::get_option( 'header_background' );
if ($background != '') {
    $bacground_url = wp_get_attachment_image_url($background, 'full');
}
if ($header_background != '') {
    $headerbacground_url = wp_get_attachment_image_url($header_background, 'full');
}
?>
<header id="header" class="header style-13">
	<?php if ($text_banner_top) : ?>
        <div class="banner-top" style="background-image: url(<?php echo esc_url($bacground_url); ?>);">
            <span><?php echo wp_specialchars_decode($text_banner_top); ?></span>
        </div>
    <?php endif; ?>
    <div class="header-innner" style="background-image: url(<?php if($header_background != ''){echo esc_url($headerbacground_url);}?>);">
		<div class="header-top">
			<div class="container">
				<div class="header-top-inner clearfix">
					<div class="header-top-left">
				        <?php
						if ( has_nav_menu( 'top_left_menu_header_13' ) ) {
	                            wp_nav_menu( array(
	                                    'menu'            => 'top_left_menu_header_13',
	                                    'theme_location'  => 'top_left_menu_header_13',
	                                    'depth'           => 2,
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
						if ( has_nav_menu( 'top_right_menu_header_13' ) ) {
	                            wp_nav_menu( array(
	                                    'menu'            => 'top_right_menu_header_13',
	                                    'theme_location'  => 'top_right_menu_header_13',
	                                    'depth'           => 1,
	                                    'container'       => '',
	                                    'container_class' => '',
	                                    'container_id'    => '',
	                                    'menu_class'      => 'biolife-nav top-bar-menu',
	                                )
	                            );
	                        }
	                    do_action( 'ovic_user_link' );
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<div class="header-bottom-inner header-responsive clearfix">
					<div class="logo">
						<?php biolife_get_logo(); ?>
						<?php biolife_header_vertical( 'vertical_menu', true ); ?>
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
    </div>
</header>
