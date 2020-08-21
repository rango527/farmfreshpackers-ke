<?php

class Mo_Firebase_Authentication_Admin_Support {
	
	public static function mo_firebase_authentication_support(){
	?>
		<div class="col-md-12">
				<div class="mo_firebase_auth_card" style="width:90%" >
					<h4 style="margin-bottom:10px">Contact us</h4>
					<p class="mo_firebase_auth_contact_us_p"><b>Need any help?<br>Just send us a query so we can help you.</b></p>
					<form action="" method="POST">
						<?php wp_nonce_field('mo_firebase_auth_contact_us_form','mo_firebase_auth_contact_us_field'); ?>
						<input type="hidden" name="option" value="mo_firebase_auth_contact_us">
						<div class="form-group">
							<input style="width:90%;" type="email" placeholder="Enter email here" class="form-control" name="mo_firebase_auth_contact_us_email" id="mo_firebase_auth_contact_us_email" required>
						</div>	
						<div class="form-group">
							<input style="width:90%;" type="tel" id="mo_firebase_auth_contact_us_phone" pattern="[\+]\d{11,14}|[\+]\d{1,4}[\s]\d{9,10}" placeholder="Enter phone here" class="form-control" name="mo_firebase_auth_contact_us_phone">
						</div>
						<div class="form-group">
							<textarea class="form-control" onkeypress="mo_firebase_auth_contact_us_valid_query(this)" onkeyup="mo_firebase_auth_contact_us_valid_query(this)" onblur="mo_firebase_auth_contact_us_valid_query(this)"  name="mo_firebase_auth_contact_us_query" placeholder="Enter query here" rows="5" id="mo_firebase_auth_contact_us_query" required></textarea>
						</div>
						<input type="submit" class="btn btn-primary" style="width:130px;height:40px" value="Submit">								
					</form>
					<br>
					<p class="mo_firebase_auth_contact_us_p"><b>If you want custom features in the plugin, just drop an email at<br><a href="mailto:info@xecurify.com">info@xecurify.com</a></b></p>
				</div>
			</div>
			</div>
		</div>

		<script>
			jQuery("#mo_firebase_auth_contact_us_phone").intlTelInput();
			function mo_firebase_auth_contact_us_valid_query(f) {
			    !(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
			        /[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
			}

		</script>
	<?php
	}


}