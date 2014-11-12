<?php
class ControllerShippingMailman extends Controller
{
	private $error = array(); 
	
	public function index()
    {
		$this->load->language('shipping/mailman');
			
		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mailman', $this->request->post);
					
			$this->session->data['success'] = $this->language->get('text_success');
						
//			$this->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
			$this->redirect($this->url->link('shipping/mailman', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_authentication'] = $this->language->get('text_authentication');
		$this->data['text_awb_options'] = $this->language->get('text_awb_options');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_test_mode'] = $this->language->get('entry_test_mode');
        $this->data['entry_username'] = $this->language->get('entry_username');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_parcel'] = $this->language->get('entry_parcel');
        $this->data['text_labels'] = $this->language->get('text_labels');
        $this->data['entry_plata_ramburs'] = $this->language->get('entry_plata_ramburs');
        $this->data['entry_fara_tva'] = $this->language->get('entry_fara_tva');
        $this->data['entry_payment0'] = $this->language->get('entry_payment0');
        $this->data['text_min_gratuit'] = $this->language->get('text_min_gratuit');

        $this->data['entry_paymentrbdest'] = $this->language->get('entry_paymentrbdest');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['username'])) {
			$this->data['error_username'] = $this->error['username'];
		} else {
			$this->data['error_username'] = '';
		}

		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}

		if (isset($this->error['labels'])) {
			$this->data['error_labels'] = $this->error['labels'];
		} else {
			$this->data['error_labels'] = '';
		}

		if (isset($this->error['min_gratuit'])) {
			$this->data['error_min_gratuit'] = $this->error['min_gratuit'];
		} else {
			$this->data['error_min_gratuit'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/mailman', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('shipping/mailman', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['mailman_status'])) {
			$this->data['mailman_status'] = $this->request->post['mailman_status'];
		} else {
			$this->data['mailman_status'] = $this->config->get('mailman_status');
		}

		if (isset($this->request->post['mailman_test_mode'])) {
			$this->data['mailman_test_mode'] = $this->request->post['mailman_test_mode'];
		} else {
			$this->data['mailman_test_mode'] = $this->config->get('mailman_test_mode');
		}

		if (isset($this->request->post['mailman_username'])) {
			$this->data['mailman_username'] = $this->request->post['mailman_username'];
		} else {
			$this->data['mailman_username'] = $this->config->get('mailman_username');
		}
		
		if (isset($this->request->post['mailman_password'])) {
			$this->data['mailman_password'] = $this->request->post['mailman_password'];
		} else {
			$this->data['mailman_password'] = $this->config->get('mailman_password');
		}

		if (isset($this->request->post['mailman_parcel'])) {
			$this->data['mailman_parcel'] = $this->request->post['mailman_parcel'];
		} else {
			$this->data['mailman_parcel'] = $this->config->get('mailman_parcel');
		}

		if (isset($this->request->post['mailman_labels'])) {
			$this->data['mailman_labels'] = $this->request->post['mailman_labels'];
		} else {
			$this->data['mailman_labels'] = $this->config->get('mailman_labels');
		}

		if (isset($this->request->post['mailman_plata_ramburs'])) {
			$this->data['mailman_plata_ramburs'] = $this->request->post['mailman_plata_ramburs'];
		} else {
			$this->data['mailman_plata_ramburs'] = $this->config->get('mailman_plata_ramburs');
		}

		if (isset($this->request->post['mailman_fara_tva'])) {
			$this->data['mailman_fara_tva'] = $this->request->post['mailman_fara_tva'];
		} else {
			$this->data['mailman_fara_tva'] = $this->config->get('mailman_fara_tva');
		}

		if (isset($this->request->post['mailman_payment0'])) {
			$this->data['mailman_payment0'] = $this->request->post['mailman_payment0'];
		} else {
			$this->data['mailman_payment0'] = $this->config->get('mailman_payment0');
		}

		if (isset($this->request->post['mailman_min_gratuit'])) {
			$this->data['mailman_min_gratuit'] = $this->request->post['mailman_min_gratuit'];
		} else {
			$this->data['mailman_min_gratuit'] = $this->config->get('mailman_min_gratuit');
		}

		if (isset($this->request->post['mailman_paymentrbdest'])) {
			$this->data['mailman_paymentrbdest'] = $this->request->post['mailman_paymentrbdest'];
		} else {
			$this->data['mailman_paymentrbdest'] = $this->config->get('mailman_paymentrbdest');
		}

		$this->template = 'shipping/mailman.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
 		$this->response->setOutput($this->render());
	}
	
	private function validate()
    {

		if (!$this->user->hasPermission('modify', 'shipping/mailman')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['mailman_username']) {
			$this->error['username'] = $this->language->get('error_username');
		}

		if (!$this->request->post['mailman_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}

        require_once(DIR_SYSTEM . 'library/MailmanSoapClient.php');

        $test_mode = $this->request->post['mailman_test_mode'];
        $username = $this->request->post['mailman_username'];
        $password = $this->request->post['mailman_password'];
        $wsdl = $test_mode ? MailmanSoapClient::WSDL_TEST : MailmanSoapClient::WSDL_LIVE;
        $soap = new MailmanSoapClient($wsdl, $username, $password);
        try {
            $soap->test();
        } catch (SoapFault $e) {
            $this->error['password'] = isset($this->error['password']) ? $this->error['password'] . $e->getMessage() : $e->getMessage();
        }

		if (!$this->request->post['mailman_labels']) {
			$this->error['labels'] = $this->language->get('error_labels');
		}

		if ($this->request->post['mailman_labels']) {
            if (!is_numeric($this->request->post['mailman_labels'])){
                $this->error['labels'] = $this->language->get('error_labels');
            }
		}

		if ($this->request->post['mailman_min_gratuit']) {
            if (!is_numeric($this->request->post['mailman_min_gratuit'])){
                $this->error['min_gratuit'] = $this->language->get('error_min_gratuit');
            }
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
