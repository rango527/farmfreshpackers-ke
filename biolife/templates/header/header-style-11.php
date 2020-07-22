<?php
/**
 * Name:  Header style 11
 **/
?>
<header id="header" class="header style-11">
	<div class="header-top">
		<div class="container">
			<div class="header-top-inner clearfix">
				<div class="header-top-left">
					<?php
					if (class_exists('SitePress')){
		                biolife_header_language();
		            }
		            if ( has_nav_menu( 'language_menu' ) ) {
		                wp_nav_menu( array(
		                        'menu'            => 'language_menu',
		                        'theme_location'  => 'language_menu',
		                        'depth'           => 2,
		                        'container'       => '',
		                        'container_class' => '',
		                        'container_id'    => '',
		                        'menu_class'      => 'biolife-nav top-bar-menu language-menu',
		                    )
		                );
		            } 
		            ?>
		            <div class="header-message"><?php echo esc_html_e('Welcome To Organic Store!', 'biolife') ?></div>
		        </div>
		        <div class="header-top-right">
			        <?php
			        ovic_user_link();
					if ( has_nav_menu( 'top_menu_header_11' ) ) {
                            wp_nav_menu( array(
                                    'menu'            => 'top_menu_header_11',
                                    'theme_location'  => 'top_menu_header_11',
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
							$text_before_search = Biolife_Functions::get_option( 'text_before_search' ); 
							$icon_text_before   = Biolife_Functions::get_option( 'icon_text_before' );
						?>
						<div class="before-search">
							<?php if ( $icon_text_before != "" ): ?>
	                            <span class="icon <?php echo esc_attr( $icon_text_before ); ?>"></span>
	                        <?php endif; ?>
	                        <?php if ( $text_before_search != "" ): ?>
	                            <span class="text-before-search"><?php echo esc_html( $text_before_search ); ?></span>
	                        <?php endif; ?>
                        </div>
						<?php 
						biolife_search_form(); 
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
			</div>
		</div>
	</div>
</header>
