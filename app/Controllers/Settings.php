<?php
namespace App\Controllers;

use App\Controllers\AdminBaseController;
use App\Models\SettingModel;
use App\Models\EmailTemplateModel;

class Settings extends AdminBaseController
{

    public $title = 'Settings';
    public $menu = 'settings';

	public function index()
	{
		$this->general();
	}

	public function general()
	{
		$this->permissionCheck('general_settings');
		
		$this->updatePageData([ 'submenu' => 'general' ]);

		return view('admin/settings/general');
	}

	public function generalUpdate()
	{

		$this->permissionCheck('general_settings');

		postAllowed();

        $setting = new SettingModel();

		$setting->updateByKey('date_format', post('date_format'));
		$setting->updateByKey('datetime_format', post('datetime_format'));
		$setting->updateByKey('google_recaptcha_enabled', post('google_recaptcha_enabled') == 'ok' ? 1 : 0 );
		$setting->updateByKey('google_recaptcha_sitekey', post('google_recaptcha_sitekey'));
		$setting->updateByKey('google_recaptcha_secretkey', post('google_recaptcha_secretkey'));
		$setting->updateByKey('timezone', post('timezone'));
		$setting->updateByKey('default_lang', post('default_lang'));
		$setting->updateByKey('base_currency', post('base_currency'));
		$setting->updateByKey('server_xrp', post('server_xrp'));
		$setting->updateByKey('server_eth', post('server_eth'));
		$setting->updateByKey('server_bnb', post('server_bnb'));
		$setting->updateByKey('server_bitcoin', post('server_bitcoin'));
		$setting->updateByKey('currency_symbol', post('currency_symbol'));
		$setting->updateByKey('currency_locale', post('currency_locale'));
		$setting->updateByKey('currency_fraction', post('currency_fraction'));
		$setting->updateByKey('update_interval', post('update_interval'));
		$setting->updateByKey('update_msg_interval', post('update_msg_interval'));
		$setting->updateByKey('permit_pay_with_contract_funds', post('permit_pay_with_contract_funds'));
		$setting->updateByKey('can_use_contract_funds', post('can_use_contract_funds'));
		$setting->updateByKey('matching_algorithm', post('matching_algorithm'));

		$setting->updateByKey('pay_method_transfer', post('pay_method_transfer'));
		$setting->updateByKey('pay_method_creditcard', post('pay_method_creditcard'));
		$setting->updateByKey('pay_method_creditcard_fragmented', post('pay_method_creditcard_fragmented'));
		$setting->updateByKey('pay_method_cash_on_delivery', post('pay_method_cash_on_delivery'));
		$setting->updateByKey('pay_method_oxxo', post('pay_method_oxxo'));
		$setting->updateByKey('pay_method_paypal', post('pay_method_paypal'));

 		$setting->updateByKey('pay_method_crypto_eth', post('pay_method_crypto_eth'));
		$setting->updateByKey('pay_method_crypto_bnb', post('pay_method_crypto_bnb'));
		$setting->updateByKey('pay_method_crypto_xrp', post('pay_method_crypto_xrp'));
		$setting->updateByKey('pay_method_crypto_btc', post('pay_method_crypto_btc'));
		$setting->updateByKey('pay_method_metamask', post('pay_method_metamask'));
		$setting->updateByKey('pay_method_crypto_usdt', post('pay_method_crypto_usdt'));
		$setting->updateByKey('pay_method_crypto_sol', post('pay_method_crypto_sol'));

		 

		$setting->updateByKey('wallet_xrp', post('wallet_xrp'));
		$setting->updateByKey('wallet_btc', post('wallet_btc'));
		$setting->updateByKey('wallet_eth', post('wallet_eth'));
		$setting->updateByKey('wallet_tether', post('wallet_tether'));

		$setting->updateByKey('bank_account_for_transfers', post('bank_account_for_transfers'));

		$setting->updateByKey('sms_phone', post('sms_phone'));
		$setting->updateByKey('sms_phone_to', post('sms_phone_to'));
		$setting->updateByKey('sms_sid', post('sms_sid'));
		$setting->updateByKey('sms_token', post('sms_token'));

		$setting->updateByKey('smpt_server', post('smpt_server'));
		$setting->updateByKey('smpt_port', post('smpt_port'));
		$setting->updateByKey('smpt_username', post('smpt_username'));
		$setting->updateByKey('smpt_password', post('smpt_password'));


		model('App\Models\ActivityLogModel')->add("Company Settings Updated by User: #".logged('id'));
        
        return redirect()->to('settings/general')->with('notifySuccess', 'Settings has been Updated Successfully');
	}

	public function company()
	{
		$this->permissionCheck('company_settings');

		$this->updatePageData([ 'submenu' => 'company' ]);

		return view('admin/settings/company');
	}

	
	public function companyUpdate()
	{

		$this->permissionCheck('company_settings');

		postAllowed();

		$setting = new SettingModel();
		
		$setting->updateByKey('company_name', post('company_name'));
		$setting->updateByKey('company_email', post('company_email'));

		model('App\Models\ActivityLogModel')->add("Company Settings Updated by User: #".logged('id'));
		
		//redirect('settings/company');

        return redirect()->to('settings/company')->with('notifySuccess', ' Settings has been Updated Successfully');
	}

	public function login_theme()
	{
		$this->permissionCheck('login_theme');
		$this->updatePageData([ 'submenu' => 'login_theme' ]);
		return view('admin/settings/login_theme', $this->page_data);
	}

	public function loginthemeUpdate()
	{

		$this->permissionCheck('login_theme');

		postAllowed();
		
		(new SettingModel)->updateByKey('login_theme', post('login_theme'));

		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => 'login-bg.'.$ext
			]);
			$image = $this->uploadlib->uploadImage('image');

			if($image['status']){
				(new SettingModel)->updateByKey('bg_img_type', $ext);
			}

            model('App\Models\ActivityLogModel')->add("Login Theme Updated by User: #".logged('id'));

		}
            
        return redirect()->to('settings/company')->with('notifySuccess', 'Settings has been Updated Successfully');
	}

	public function email_templates()
	{
		$this->permissionCheck('email_templates');
		$this->updatePageData([ 'submenu' => 'email_templates' ]);
		return view('admin/settings/email_templates/list');
	}

	public function edit_email_templates($id)
	{
		$this->permissionCheck('email_templates');
		$this->updatePageData([ 'submenu' => 'email_templates' ]);
		$template = (new EmailTemplateModel)->getById($id);
		return view('admin/settings/email_templates/edit', compact('template'));
	}

	public function update_email_templates($id)
	{

		$this->permissionCheck('login_theme');

		postAllowed();
		
		(new EmailTemplateModel)->update($id, [
			// 'code'	=>	post('code'),
			'name'	=>	post('name'),
			'data'	=>	post('data'),
		]);

		model('App\Models\ActivityLogModel')->add("Email Template Updated by User: #".logged('id'));

        return redirect()->to('settings/email_templates')->with('notifySuccess', 'Email Template has been Updated Successfully');
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */