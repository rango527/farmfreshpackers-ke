<?php
	
	class Mo_Firebase_Authentication_Admin_Licensing_Plans {
	
		public static function mo_firebase_authentication_licensing_plans(){
			?>
			<!-- Important JSForms -->
	        <input type="hidden" value="<?php echo mo_firebase_authentication_is_customer_registered();?>" id="mo_customer_registered">
	        <form style="display:none;" id="loginform"
	              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
	              target="_blank" method="post">
	            <input type="email" name="username" value="<?php echo get_option( 'mo_firebase_authentication_admin_email' ); ?>"/>
	            <input type="text" name="redirectUrl"
	                   value="<?php echo get_option( 'host_name' ) . '/moas/initializepayment'; ?>"/>
	            <input type="text" name="requestOrigin" id="requestOrigin"/>
	        </form>
	        <form style="display:none;" id="viewlicensekeys"
	              action="<?php echo get_option( 'host_name' ) . '/moas/login'; ?>"
	              target="_blank" method="post">
	            <input type="email" name="username" value="<?php echo get_option( 'mo_firebase_authentication_admin_email' ); ?>"/>
	            <input type="text" name="redirectUrl"
	                   value="<?php echo get_option( 'host_name' ) . '/moas/viewlicensekeys'; ?>"/>
	        </form>
	        <!-- End Important JSForms -->
			<div class="row">
				<div class="col-1 moct-align-center">
				</div>
				<div class="col-5 moct-align-center">
					<div class="moc-licensing-plan card-body">
					    <div class="moc-licensing-plan-header">
					        <div class="moc-licensing-plan-name"><h2>Premium</h2></div>
					    </div><br>
					    <div class="moc-licensing-plan-price"><sup>$</sup>149<sup>*</sup></div>
					    <!-- <a class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" href="mailto:info@xecurify.com" target="_blank">Contact Us</a> -->
					    <button class="btn btn-block btn-info text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_firebase_authentication_premium_plan')">Buy Now</button>
					    <br>
					    <div class="moc-licensing-plan-feature-list">
					        <ul>
					        	<li>&#9989; Allow login with Firebase and WordPress</li>
					        	<li>&#9989; Advanced Attribute mapping</li>
					            <li>&#9989; Auto register users in Firebase as well as WordPress</li>
					            <li>&#9989; Login & Registeration Form Integration (WooCommerce, BuddyPress)</li>
					            <li>&#9989; Custom redirect URL after Login and Logout</li>
					        </ul>
					    </div>
					</div>
				</div>
				<div class="col-5 moct-align-center">
					<div class="moc-licensing-plan card-body">
					    <div class="moc-licensing-plan-header">
					        <div class="moc-licensing-plan-name"><h2>Enterprise</h2></div>
					    </div><br>
					    <div class="moc-licensing-plan-price"><sup>$</sup>249<sup>*</sup></div>
					    <!-- <a class="btn btn-block btn-purple text-uppercase moc-lp-buy-btn" href="mailto:info@xecurify.com" target="_blank">Contact Us</a> -->
					    <button class="btn btn-block btn-purple text-uppercase moc-lp-buy-btn" onclick="upgradeform('wp_oauth_firebase_authentication_enterprise_plan')">Buy Now</button>
					    <br>
					    <div class="moc-licensing-plan-feature-list">
					        <ul>
					        	<li>&#9989; Allow login with Firebase and WordPress</li>
					        	<li>&#9989; Advanced Attribute mapping</li>
					            <li>&#9989; Auto register users in Firebase as well as WordPress</li>
					            <li>&#9989; Login & Registeration Form Integration (WooCommerce, BuddyPress)</li>
					            <li>&#9989; Custom redirect URL after Login and Logout</li>
					            <li>&#9989; Shortcode to add Firebase Login Form</li>
					            <li>&#9989; Firebase Authentication methods <br>Google, Facebook, Github, Twitter, Microsoft, Yahoo, Phone</li>
					            <li>&#9989; WP hooks to read Firebase token, login event and extend plugin functionality</li>
					        </ul>
					    </div>
					</div>
				</div>
			</div>
			<!-- End Licensing Table -->
	        <a id="mobacktoaccountsetup" style="display:none;" href="<?php echo add_query_arg( array( 'tab' => 'account' ), htmlentities( $_SERVER['REQUEST_URI'] ) ); ?>">Back</a>
	        <!-- JSForms Controllers -->
			<script>
				function upgradeform(planType) {
		                if(planType === "") {
		                    location.href = "https://wordpress.org/plugins/firebase-authentication/";
		                    return;
		                } else {
		                    jQuery('#requestOrigin').val(planType);
		                    if(jQuery('#mo_customer_registered').val()==1)
		                        jQuery('#loginform').submit();
		                    else{
		                        location.href = jQuery('#mobacktoaccountsetup').attr('href');
		                    }
		                }

		            }
			</script>
			<?php
		}
	}