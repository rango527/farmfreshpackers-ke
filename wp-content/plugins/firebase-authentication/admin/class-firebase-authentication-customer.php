<?php
class MO_Firebase_Customer{

	public $email;
	public $phone;

	private $defaultCustomerKey = "16555";
	private $defaultApiKey = "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";

	function create_customer(){
		$url = get_option('host_name') . '/moas/rest/customer/add';
		$this->email 		= get_option('mo_firebase_authentication_admin_email');
		$this->phone 		= get_option('mo_firebase_authentication_admin_phone');
		$password 			= get_option('password');
		$firstName    		= get_option('mo_firebase_authentication_admin_fname');
		$lastName     		= get_option('mo_firebase_authentication_admin_lname');
		$company      		= get_option('mo_firebase_authentication_admin_company');
		
		$fields = array(
			'companyName' => $company,
			'areaOfInterest' => 'WP Firebase Authentication',
			'firstname'	=> $firstName,
			'lastname'	=> $lastName,
			'email'		=> $this->email,
			'phone'		=> $this->phone,
			'password'	=> $password
		);
		$field_string = json_encode($fields);
		$headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
		$args = array(
			'method' =>'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
 
		);
		
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
		
		return wp_remote_retrieve_body($response);
	}

	function check_customer() {
		$url 	= get_option('host_name') . "/moas/rest/customer/check-if-exists";
		// $ch 	= curl_init( $url );
		$email 	= get_option("mo_firebase_authentication_admin_email");

		$fields = array(
			'email' 	=> $email,
		);
		$field_string = json_encode( $fields );
		$headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
		$args = array(
			'method' =>'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
		);
			
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
			
		return wp_remote_retrieve_body($response);
	}

	function mo_firebase_auth_get_customer_key() {
		$url 	= get_option('host_name') . "/moas/rest/customer/key";
		$email 	= get_option("mo_firebase_authentication_admin_email");
		
		$password = get_option("password");
		
		$fields = array(
			'email' 	=> $email,
			'password' 	=> $password
		);
		$field_string = json_encode( $fields );
		
		$headers = array( 'Content-Type' => 'application/json', 'charset' => 'UTF - 8', 'Authorization' => 'Basic' );
		$args = array(
			'method' =>'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
 
		);
		
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
		
		return wp_remote_retrieve_body($response);
	}

	function mo_firebase_authentication_submit_support_request() {
		
		$url = get_option ( 'host_name' ) . '/moas/api/backupcode/updatestatus';
		$customerKey = get_option('mo_firebase_authentication_admin_customer_key');
		$apiKey = get_option('mo_firebase_authentication_admin_api_key');
		$currentTimeInMillis = round(microtime(true) * 1000);
		$currentTimeInMillis = number_format ( $currentTimeInMillis, 0, '', '' );
		$stringToHash = $customerKey . $currentTimeInMillis . $apiKey;
		$hashValue = hash("sha512", $stringToHash);
		$timestampHeader = "Timestamp: " . $currentTimeInMillis;
		$authorizationHeader = "Authorization: " . $hashValue;
		$code = mo_firebase_authentication_decrypt(get_option( 'mo_firebase_authentication_lk' ));
		$fields = array ( 'code' => $code , 'customerKey' => $customerKey, 'additionalFields' => array('field1' => home_url()) );
		$field_string = json_encode($fields);
		
		$headers = array( 
			'Content-Type' => 'application/json', 
			'Customer-Key' => $customerKey,
			'Timestamp' => $currentTimeInMillis,
			'Authorization' => $hashValue,
		);
		$args = array(
			'method' =>'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers,
 
		);
		
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
		
		return wp_remote_retrieve_body($response);
	}

	function mo_firebase_auth_XfsZkodsfhHJ( $code ) {
		$url         = get_option('host_name') . '/moas/api/backupcode/verify';
		$customerKey = get_option('mo_firebase_authentication_admin_customer_key');
		$apiKey      = get_option('mo_firebase_authentication_admin_api_key');
		$username    = get_option('mo_firebase_authentication_admin_email');

		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round( microtime( true ) * 1000 );
		$currentTimeInMillis = number_format ( $currentTimeInMillis, 0, '', '' );

		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . $currentTimeInMillis . $apiKey;
		$hashValue = hash("sha512", $stringToHash);

		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " . $currentTimeInMillis;
		$authorizationHeader = "Authorization: " . $hashValue;

		$fields = array(
			'code'             => $code ,
			'customerKey'      => $customerKey,
			'additionalFields' => array(
				'field1'           => site_url()
				
			)
		);
		$field_string = json_encode($fields);

		$headers = array( 
			'Content-Type'  => 'application/json', 
			'Customer-Key'  => $customerKey,
			'Timestamp'     => $currentTimeInMillis,
			'Authorization' => $hashValue,
		);
		$args = array(
			'method'      =>'POST',
			'body'        => $field_string,
			'timeout'     => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => $headers,
	
		);
		
		$response = wp_remote_post( $url, $args );
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			exit();
		}
		
		return wp_remote_retrieve_body($response);
	}
}
?>