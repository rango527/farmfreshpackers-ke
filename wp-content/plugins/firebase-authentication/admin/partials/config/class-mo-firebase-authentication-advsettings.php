<?php


class Mo_Firebase_Authentication_Admin_AdvSettings {
	
	public static function mo_firebase_authentication_advsettings() {
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="mo_firebase_auth_card" style="width:90%">
				<form name="integration_form" id="mo_firebase_auth_integration"  method="post">
					<input type="hidden" name="option" value="mo_firebase_auth_integration">
					<h6><b>Sync WordPress and Firebase users </b><small style="color: #FF0000"><a href="admin.php?page=mo_firebase_authentication&tab=licensing_plans">[PREMIUM]</a></small></h6><br>
					
					<div style="display:inline-block"><label class="mo_firebase_auth_switch">
						<input value="1" name="mo_enable_firebase_auto_register" type="checkbox" id="mo_enable_firebase_auto_register" disabled>
						<span class="mo_firebase_auth_slider round"></span>
						<input type="hidden" name="option" value="">
						</label>
					</div>
					<strong>Auto register users into Firebase</strong>
					<br>
					<h8>Enabling this option will create new user in Firebase project when a user registers in WordPress site.</h8>
			    </form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="mo_firebase_auth_card" style="width:90%">
				<form name="integration_form" id="mo_firebase_auth_integration"  method="post">
					<input type="hidden" name="option" value="mo_firebase_auth_integration">
					<h6><b>Login & Registeration Form Integration </b><small style="color: #FF0000"><a href="admin.php?page=mo_firebase_authentication&tab=licensing_plans">[PREMIUM]</a></small></h6><br>
					<h8>Select below if you want to allow users to login using firebase credentials with third party or custom login/registration page.</h8><br><br>
					<input type="checkbox" name = "mo_firebase_auth_woocommerce_intigration" id = "mo_firebase_auth_woocommerce_intigration" value= "1" onclick="mo_firebase_auth_manageWCDiv();" disabled>
						<img src="<?php echo dirname(plugin_dir_url( __FILE__ ));?>/../images/woocommerce-circle.png" width="50px">WooCommerce
						<br><br>
					<input type="checkbox" name = "mo_firebase_auth_buddypress_intigration"value="1" disabled>
						<img src="<?php echo dirname(plugin_dir_url( __FILE__ ));?>/../images/buddypress.png" width="50px"> BuddyPress
				    	<br><br>
			    	<input type="checkbox" name = "mo_firebase_auth_custom_form_intigration"value="1" disabled>Custom Login Form&emsp;<div class="mo-firebase-auth-tooltip">&#x1F6C8;<div class="mo-firebase-auth-tooltip-text mo-tt-right">Select if you have any custom login or registeration form or using any other third party plugin to create these forms.</div> </div>
					<br>
					<p style="font-size: 15px;margin-left: 10px;">You can select this option if you have any custom login or registeration form or using any other third party plugin to create these forms.</p>
			    	<br><br>
			    	<input type="submit" style="text-align:center;"class="btn btn-primary" style="width:120px;height:40px" name="integration_settings" value=" Save Settings" id = "mo_auth_integration_save_settings_button" disabled><br>
			    </form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="mo_firebase_auth_card" style="width:90%">
				<form name="integration_form" id="mo_firebase_auth_integration"  method="post">
					<input type="hidden" name="option" value="mo_firebase_auth_integration">
					<h6><b>Firebase Authentication methods </b><small style="color: #FF0000"> <a href="admin.php?page=mo_firebase_authentication&tab=licensing_plans">[ENTERPRISE]</a></small></h6><br>
					<h8>Select any one method to Login into your site using one of the Firebase Authentication method. </h8><br><br>
					<!-- <input type="radio" id="emailPassword" value="emailPassword" disabled>
					<label for="male">Email and Password</label><br> -->
					<input type="checkbox" id="google" value="google" disabled>
					<label for="female">Google</label><br>
					<input type="checkbox" id="facebook" value="facebook" disabled>
					<label for="other">Facebook</label><br>
					<input type="checkbox" id="github" value="github" disabled>
					<label for="other">GitHub</label><br>
					<input type="checkbox" id="twitter" value="twitter" disabled>
					<label for="other">Twitter</label><br>
					<input type="checkbox" id="microsoft" value="microsoft" disabled>
					<label for="other">Microsoft</label><br>
					<input type="checkbox" id="yahoo" value="yahoo" disabled>
					<label for="other">Yahoo</label><br>
					<input type="checkbox" id="phone" value="phone" disabled>
					<label for="other">Phone</label><br><br>
					<input type="submit" style="text-align:center;"class="btn btn-primary" style="width:120px;height:40px" name="authentication_settings" value=" Save Settings" id = "mo_auth_authentication_save_settings_button" disabled><br>
			    </form>
			</div>
		</div>
	</div>
	<?php
	}
}