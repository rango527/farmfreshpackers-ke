<?php

class Xoo_Ml_Aff_Fields{

	public $elFields;


	public function __construct(){
		
		if( !xoo_el()->aff->fields ) return;
		$this->elFields = xoo_el()->aff->fields;
		add_action( 'xoo_aff_easy-login-woocommerce_add_predefined_fields', array( $this, 'easy_login_field_settings' ), 15 );
	}

	public function easy_login_field_settings( ){
		
		$this->predefined_phoneCode_field();
		$this->predefined_phone_field();
	}



	public function predefined_phoneCode_field(){

		$field_type_id = $field_id = 'xoo-ml-reg-phone-cc';

		$this->elFields->add_type(
			$field_type_id,
			'phone_code', 
			'Phone Code',
			array(
				'is_selectable' => 'no',
				'can_delete'	=> 'no',
				'icon' 			=> 'fas fa-code',
			)
		);

		$setting_options = $this->elFields->settings['xoo_aff_phone_code'];
		//Removing settings as we will use from the mobile login settings page.
		unset( $setting_options['active'], $setting_options['required'], $setting_options['display_myacc'], $setting_options['country_choose'], $setting_options['for_country_id'], $setting_options['country_list'], $setting_options['default'], $setting_options['phone_code_display_type'] );

		$my_settings = array(
			'unique_id' => array(
				'disabled' => 'disabled'
			),
			'cols' 		=> array(
				'value' => 'onehalf'
			),
			'icon' 		=> array(
				'value' => 'fas fa-phone'
			),
			'placeholder' => array(
				'value' => 'Phone Code'
			)
		);
		
		$setting_options = array_merge(
			$setting_options,
			$my_settings
		);

		$this->elFields->create_field_settings(
			$field_type_id,
			$setting_options
		);

		$this->elFields->add_field(
			$field_id,
			$field_type_id,
			array(
				'unique_id' => $field_id,
				'active'	=> 'yes'
			),
			10			
		);
	}

	public function predefined_phone_field(){

		$field_type_id = $field_id = 'xoo-ml-reg-phone';

		$this->elFields->add_type(
			$field_type_id,
			'phone',
			'Phone',
			array(
				'is_selectable' => 'no',
				'can_delete'	=> 'no',
				'icon' 			=> 'fas fa-phone'
			)
		);

		$setting_options = $this->elFields->settings['xoo_aff_phone'];

		unset( $setting_options['active'], $setting_options['required'], $setting_options['display_myacc'] );

		$my_settings = array(
			'unique_id' => array(
				'disabled' => 'disabled'
			),
			'cols' 		=> array(
				'value' => 'onehalf'
			),
			'placeholder' => array(
				'value' => 'Phone'
			)
		);
		
		$setting_options = array_merge(
			$setting_options,
			$my_settings
		);

		$this->elFields->create_field_settings(
			$field_type_id,
			$setting_options
		);

		$this->elFields->add_field(
			$field_id,
			$field_type_id,
			array(
				'active' 	=> 'yes',
				'unique_id' => $field_id,
			),
			15			
		);
	}

}

new Xoo_Ml_Aff_Fields();

?>