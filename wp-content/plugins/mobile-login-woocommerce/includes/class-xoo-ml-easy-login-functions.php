<?php

class Xoo_Ml_Easy_Login_Functions{
	protected static $_instance = null;
	public static $hasPhoneReg, $hasPhoneLogin;

	public static function get_instance(){
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct(){

		if( !defined( 'XOO_EL_VERSION' ) ){
			return;
		}

		$phone_field = xoo_el()->aff->fields->get_field_data( 'xoo-ml-reg-phone' );
		self::$hasPhoneReg 		= $phone_field['settings']['active'] === "yes"  ? true : false;
		self::$hasPhoneLogin 	= xoo_ml_helper()->get_phone_option('l-enable-login-with-otp') === "yes" ? true : false;
		
		if( self::$hasPhoneReg ){
			$this->registration_hooks();
		}

		if( self::$hasPhoneLogin ){
			$this->login_hooks();
		}
		
	}

	public function add_reg_form_to_otp_valdiation( $forms ){

		if( self::$hasPhoneReg ){
			$forms[] = array(
				'key'			=> '_xoo_el_form',
				'value' 		=> 'register',
				'form' 			=> 'register_user',
				'required' 		=> xoo_ml_helper()->get_phone_option('r-phone-field') === 'required' ? 'yes' : 'no',
				'cc_required' 	=> xoo_ml_helper()->get_phone_option('r-enable-cc-field') === 'yes' ? 'yes' : 'no',
			);
		}

		return $forms;
		
	}


	public function registration_hooks(){

		add_filter( 'xoo_el_myaccount_fields', array( $this, 'remove_phone_field' ) );
		add_filter( 'xoo_aff_easy-login-woocommerce_input_html', array( $this, 'popup_phone_input_addition' ), 10, 2 );
		add_filter( 'xoo_aff_easy-login-woocommerce_field_args', array( $this, 'setting_phone_field_in_login_popup' ) );
		add_filter( 'xoo_ml_get_phone_forms', array( $this, 'add_reg_form_to_otp_valdiation' ) );

	}

	public function login_hooks(){
		add_action( 'xoo_el_login_form_end', array( $this, 'easy_login_login_with_otp_form' ), 5 );
		add_filter( 'xoo_ml_phone_input_html', array( $this, 'filter_otp_login_form_input' ), 10, 2 );
	}


	public function filter_otp_login_form_input( $input_html, $args ){

		if( $args['is_easylogin_form'] !== "yes" ) return $input_html;

		$enable_cc = xoo_ml_helper()->get_phone_option('l-enable-cc-field') === "yes";

		$fields = array();

		$col_class = 'one';

		if( $enable_cc ){

			$default_cc = xoo_ml_helper()->get_phone_option('r-default-country-code-type') === 'geolocation' ? Xoo_Ml_Geolocation::get_phone_code() : xoo_ml_helper()->get_phone_option('r-default-country-code');

			$col_class = 'onehalf';

			$fields[ 'xoo-ml-reg-phone-cc' ] = array(
				'input_type' 		=> xoo_ml_helper()->get_phone_option('m-show-country-code-as') === 'input' ? 'text' : 'phone_code' ,
				'icon' 				=> 'fas fa-phone',
				'placeholder' 		=> __( 'Country Code', 'easy-login-woocommerce' ),
				'cont_class' 		=> array( 'xoo-aff-group', $col_class ),
				'required' 			=> 'yes',
				'value' 			=> $default_cc,
				'options' 			=> xoo_el()->aff->fields->get_field_phone_codes( 'xoo-ml-reg-phone-cc' ),
				'class' 			=> 'xoo-ml-phone-cc'
			);


		}

		$fields[ 'xoo-ml-reg-phone' ] = array(
				'input_type' 		=> 'text',
				'icon' 				=> $enable_cc ? '' : 'fas fa-phone',
				'placeholder' 		=> __( 'Phone', 'easy-login-woocommerce' ),
				'cont_class' 		=> array( 'xoo-aff-group', $col_class ),
				'required' 			=> 'yes',
				'autocomplete' 		=> 'tel',
				'class' 			=> 'xoo-ml-phone-input'
		);

		$fields = apply_filters( 'xoo_ml_el_login_form_input_fields', $fields, $args );

		$input_html = '';

		foreach ( $fields as $field_id => $field_args ) {
			$input_html .= xoo_el()->aff->fields->get_input_html( $field_id, $field_args );
		}

		return $input_html;
	}


	public function setting_phone_field_in_login_popup( $args ){
		if( $args['unique_id'] === 'xoo-ml-reg-phone-cc' ){

			if( xoo_ml_helper()->get_phone_option('r-default-country-code-type') === 'geolocation' ){
				$default_cc = Xoo_Ml_Geolocation::get_phone_code();
			}else{
				$default_cc = xoo_ml_helper()->get_phone_option('r-default-country-code');
			}

			$args['value'] = $default_cc;

			if( xoo_ml_helper()->get_phone_option('m-show-country-code-as') === 'input' ){
				$args['input_type'] = 'text';
			}

			$args['class'][] = 'xoo-ml-phone-cc';
		}

		if( $args['unique_id'] === 'xoo-ml-reg-phone' ){
			$args['class'][] = 'xoo-ml-phone-input';
		}
		return $args;
	}


	public function easy_login_login_with_otp_form(){
		$args = array(
			'is_easylogin_form' => 'yes',
			'button_class' 		=> array(
				'button', 'btn', 'xoo-el-action-btn'
			),
			'label'	 			=> '',
			'otp_display' 		=> 'external_form'
		);

		$args = apply_filters( 'xoo_ml_easy_login_login_with_otp_form', $args );

		return xoo_ml_get_login_with_otp_form( $args );

	}


	public function remove_phone_field( $fields ){
		if( isset( $fields['xoo-ml-reg-phone'] ) ){
			unset( $fields['xoo-ml-reg-phone'] );
		}

		if( isset( $fields['xoo-ml-reg-phone-cc'] ) ){
			unset( $fields['xoo-ml-reg-phone-cc'] );
		}

		return $fields;
	}


	//Login/Signup popup input phone addition
	public function popup_phone_input_addition( $field_html, $args ){

		if( !isset( $args['unique_id'] ) || $args['unique_id'] !== 'xoo-ml-reg-phone' ) return $field_html;
		ob_start();

		?>

		<span class="xoo-ml-reg-phone-change"><?php _e( 'Change?', 'mobile-login-woocommerce' ); ?></span>
		<input type="hidden" name="xoo-ml-form-token" value="<?php echo mt_rand( 1000, 9999 ); ?>"/>
		<input type="hidden" name="xoo-ml-otp-form-display" value="<?php echo xoo_ml_helper()->get_phone_option('external_form'); ?>">
		<input type="hidden" name="xoo-ml-form-type" value="register_user">
		<?php

		$field_html .= ob_get_clean();
		return $field_html;

	}
}


add_action( 'init', function(){
	Xoo_Ml_Easy_Login_Functions::get_instance();
}, 0 );

