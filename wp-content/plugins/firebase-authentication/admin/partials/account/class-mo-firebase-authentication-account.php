<?php

require( 'login/register.php' );
require( 'login/verify-password.php' );

class Mo_Firebase_Authentication_Admin_Account {

	public static function verify_password() { 
		mo_firebase_auth_verify_password_ui(); 	
	}

	public static function register() {
		if(!mo_firebase_authentication_is_customer_registered()){
			mo_firebase_auth_register_ui();
		} else {
			mo_firenase_auth_show_customer_info();
		}
	}
}