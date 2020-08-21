<?php
require( 'config/class-mo-firebase-authentication-config.php' );
require( 'config/class-mo-firebase-authentication-advsettings.php' );
require( 'config/class-mo-firebase-authentication-hooks.php' );
require( 'config/class-mo-firebase-authentication-licensing_plans.php' );
require( 'support/class-mo-firebase-authentication-support.php' );
require( 'support/class-mo-firebase-authentication-faq.php' );
require( 'account/class-mo-firebase-authentication-account.php' );

function mo_firebase_authentication_main_menu() {

	$currenttab = "";
	if( isset( $_GET['tab'] ) )
		$currenttab = $_GET['tab'];
	
	Mo_Firebase_Authentication_Admin_Menu::mo_firebase_auth_show_menu( $currenttab );
	echo '
	<div id="mo_firebase_authentication_settings">';
		echo '
		<div class="miniorange_container">';
		echo '
		<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;" class="mo_firebase_authentication_content">';
					Mo_Firebase_Authentication_Admin_Menu::mo_firebase_auth_show_tab( $currenttab );
					Mo_Firebase_Authentication_Admin_Menu::mo_firebase_auth_show_support_sidebar( $currenttab );
				echo '</tr>
		</table>
		<div class="mo_firebase_authentication_tutorial_overlay" id="mo_firebase_authentication_tutorial_overlay" hidden></div>
		</div>';
}

class Mo_Firebase_Authentication_Admin_Menu {

	public static function mo_firebase_auth_show_menu( $currenttab ) {
		?>
		 <!-- <div class="mo_firebase_auth_success_container" style="display:none;" id="mo_firebase_auth_success_container">
	        <div class="alert alert-success alert-dismissable" id="mo_firebase_auth_success_alert" data-fade="3000">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            Configurations saved successfully.
	        </div>
		</div> -->
		<!-- <div class="mo_firebase_auth_error_container" style="display:none;" id="mo_firebase_auth_error_container">
	        <div class="alert alert-danger alert-dismissable" id="mo_firebase_auth_error_alert" data-fade="3000">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	            Please enter required fields.
	        </div>
		</div> -->

		 <div style="margin-left:20px;overflow:hidden">
			<div class="wrap">
				<div class="wrap">
					<div><img style="float:left;" src="<?php echo dirname(plugin_dir_url( __FILE__ ));?>/images/logo.png"></div>
				</div>
			       	<h1>
			            miniOrange Firebase Authentication&nbsp
			           	<!-- <a class="add-new-h2" href="https://forum.miniorange.com/" target="_blank">Ask questions on our forum</a>
						<a class="add-new-h2" href="https://faq.miniorange.com/" target="_blank">FAQ</a>	 -->
			       	</h1>
	       	</div>
	       	<br>

			<div class="row">
			<div class="col-md-8">
				<ul class="row mo_firebase_authentication_nav">
					<a href="admin.php?page=mo_firebase_authentication&tab=config"><li class="mo_firebase_authentication_nav_item <?php if($currenttab === '' || $currenttab === 'config') echo 'active'; ?>">Configure</li></a>
					<a href="admin.php?page=mo_firebase_authentication&tab=advsettings"><li  class="mo_firebase_authentication_nav_item <?php if($currenttab === 'advsettings') echo 'active'; ?>">Advanced Settings</li></a>
					<a href="admin.php?page=mo_firebase_authentication&tab=hooks"><li  class="mo_firebase_authentication_nav_item <?php if($currenttab === 'hooks') echo 'active'; ?>">Hooks</li></a>
					<a href="admin.php?page=mo_firebase_authentication&tab=account"><li  class="mo_firebase_authentication_nav_item <?php if($currenttab === 'account') echo 'active'; ?>">Account Setup</li></a>
					<a href="admin.php?page=mo_firebase_authentication&tab=licensing_plans"><li  class="mo_firebase_authentication_nav_item <?php if($currenttab === 'licensing_plans') echo 'active'; ?>">Licensing Plans</li></a>
				</ul>

				<?php
				?>
			</div>
			</div>
		</div>

		<script>
			/*jQuery("#mo_firebase_auth_contact_us_phone").intlTelInput();
			function mo_firebase_auth_contact_us_valid_query(f) {
			    !(/^[a-zA-Z?,.\(\)\/@ 0-9]*$/).test(f.value) ? f.value = f.value.replace(
			        /[^a-zA-Z?,.\(\)\/@ 0-9]/, '') : null;
			}*/

			jQuery("#mo_firebase_auth_test_config_button").on("click", function(event) {
				var test_username = document.forms["test_configuration_form"]["test_username"].value;
				var test_password = document.forms["test_configuration_form"]["test_password"].value;
				if( test_username == "" || test_password == "" ){
					return;
				}
				event.preventDefault();
				let url = "<?php echo site_url(); ?>/?mo_action=firebaselogin&test=true";
				jQuery("#mo_firebasetestconfig").attr("action", url);
				let newwindow = window.open("about:blank", 'firebasetestconfig', 'location=yes,height=700,width=600,scrollbars=yes,status=yes');
				jQuery("#mo_firebasetestconfig").submit();
			});
			function mo_firebase_auth_showDiv(){
				document.getElementById("mo_firebase_auth_enable_admin_wp_login_div").style.display = "block";
			}
			function mo_firebase_auth_hideDiv(){
				document.getElementById("mo_firebase_auth_enable_admin_wp_login_div").style.display = "none";
			}

		</script>
	<?php
	}

	public static function mo_firebase_auth_show_tab( $currenttab ) {
		if($currenttab == 'account') {
			if (get_option ( 'mo_firebase_authentication_verify_customer' ) == 'true') {
				Mo_Firebase_Authentication_Admin_Account::verify_password();
			} else if (trim ( get_option ( 'mo_firebase_authentication_email' ) ) != '' && trim ( get_option ( 'mo_firebase_authentication_admin_api_key' ) ) == '' && get_option ( 'mo_firebase_authentication_new_registration' ) != 'true') {
				Mo_Firebase_Authentication_Admin_Account::verify_password();
			}
			else {
				Mo_Firebase_Authentication_Admin_Account::register();
			}
		} elseif( $currenttab == '' || $currenttab == 'config')
    		Mo_Firebase_Authentication_Admin_Config::mo_firebase_authentication_config();
    	elseif( $currenttab == 'advsettings')
    		Mo_Firebase_Authentication_Admin_AdvSettings::mo_firebase_authentication_advsettings();
    	elseif( $currenttab == 'hooks')
    		Mo_Firebase_Authentication_Admin_Hooks::mo_firebase_authentication_hooks();
    	elseif( $currenttab == 'licensing_plans')
    		Mo_Firebase_Authentication_Admin_Licensing_Plans::mo_firebase_authentication_licensing_plans();
    	elseif( $currenttab == 'faq')
    		Mo_Firebase_Authentication_Admin_FAQ::mo_firebase_authentication_faq();
	}

	public static function mo_firebase_auth_show_support_sidebar( $currenttab ) { 
		//if( $currenttab != 'licensing' ) { 
			echo '<td style="vertical-align:top;padding-left:1%;" class="mo_firebase_authentication_sidebar">';
			echo Mo_Firebase_Authentication_Admin_Support::mo_firebase_authentication_support();
			echo '</td>';
		//}
	}
}

add_action( 'clear_os_cache', 'HFxGjRCbNVXhw', 10, 3 );
	function HFxGjRCbNVXhw() {
		if(mo_firebase_authentication_is_customer_registered() && get_option('mo_firebase_authentication_lk')) {
			$customer = new MO_Firebase_Customer();
			$customer->mo_firebase_authentication_submit_support_request();
		}
	}