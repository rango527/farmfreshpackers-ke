<?php

if(!function_exists('wcfmapi_woocommerce_inactive_notice')) {
	function wcfmapi_woocommerce_inactive_notice() {
		?>
		<div id="message" class="error">
		<p><?php printf( __( '%sWCfM Rest API is inactive.%s The %sWooCommerce Multivendor Marketplace%s must be active for the WCfM Rest API to work. Please %sinstall & activate WooCommerce Multivendor Marketplace%s', 'wcfm-marketplace-rest-api' ), '<strong>', '</strong>', '<a target="_blank" href="http://wordpress.org/extend/plugins/woocommerce/dc-woocommerce-multi-vendor/">', '</a>', '<a href="' . admin_url( 'plugin-install.php?tab=search&s=wc+multivendor+marketplace' ) . '">', '&nbsp;&raquo;</a>' ); ?></p>
		</div>
		<?php
	}
}
