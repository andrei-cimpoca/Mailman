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

            $this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');

		$data['text_authentication'] = $this->language->get('text_authentication');
		$data['text_awb_options'] = $this->language->get('text_awb_options');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
        $data['text_none'] = $this->language->get('text_none');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_wsdl_url'] = $this->language->get('entry_wsdl_url');
        $data['entry_username'] = $this->language->get('entry_username');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['entry_parcel'] = $this->language->get('entry_parcel');
        $data['help_parcel'] = $this->language->get('help_parcel');
        $data['entry_labels'] = $this->language->get('entry_labels');
        $data['help_labels'] = $this->language->get('help_labels');
        $data['entry_plata_ramburs'] = $this->language->get('entry_plata_ramburs');
        $data['help_plata_ramburs'] = $this->language->get('help_plata_ramburs');
        $data['entry_asigurare_expeditie'] = $this->language->get('entry_asigurare_expeditie');
        $data['entry_min_gratuit'] = $this->language->get('entry_min_gratuit');
        $data['entry_tax_class'] = $this->language->get('entry_tax_class');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['wsdl_url'])) {
			$data['error_wsdl_url'] = $this->error['wsdl_url'];
		} else {
			$data['error_wsdl_url'] = '';
		}

		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['labels'])) {
			$data['error_labels'] = $this->error['labels'];
		} else {
			$data['error_labels'] = '';
		}

		if (isset($this->error['min_gratuit'])) {
			$data['error_min_gratuit'] = $this->error['min_gratuit'];
		} else {
			$data['error_min_gratuit'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/mailman', 'token=' . $this->session->data['token'], 'SSL'),
   		);
		
		$data['action'] = $this->url->link('shipping/mailman', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['mailman_status'])) {
			$data['mailman_status'] = $this->request->post['mailman_status'];
		} else {
			$data['mailman_status'] = $this->config->get('mailman_status');
		}

		if (isset($this->request->post['mailman_sort_order'])) {
			$data['mailman_sort_order'] = (int)$this->request->post['mailman_sort_order'];
		} else {
			$data['mailman_sort_order'] = $this->config->get('mailman_sort_order');
		}

		if (isset($this->request->post['mailman_wsdl_url'])) {
			$data['mailman_wsdl_url'] = $this->request->post['mailman_wsdl_url'];
		} else {
			$data['mailman_wsdl_url'] = $this->config->get('mailman_wsdl_url');
		}

		if (isset($this->request->post['mailman_username'])) {
			$data['mailman_username'] = $this->request->post['mailman_username'];
		} else {
			$data['mailman_username'] = $this->config->get('mailman_username');
		}
		
		if (isset($this->request->post['mailman_password'])) {
			$data['mailman_password'] = $this->request->post['mailman_password'];
		} else {
			$data['mailman_password'] = $this->config->get('mailman_password');
		}

		if (isset($this->request->post['mailman_parcel'])) {
			$data['mailman_parcel'] = $this->request->post['mailman_parcel'];
		} else {
			$data['mailman_parcel'] = $this->config->get('mailman_parcel');
		}

		if (isset($this->request->post['mailman_labels'])) {
			$data['mailman_labels'] = $this->request->post['mailman_labels'];
		} else {
			$data['mailman_labels'] = $this->config->get('mailman_labels');
		}

		if (isset($this->request->post['mailman_plata_ramburs'])) {
			$data['mailman_plata_ramburs'] = $this->request->post['mailman_plata_ramburs'];
		} else {
			$data['mailman_plata_ramburs'] = $this->config->get('mailman_plata_ramburs');
		}

		if (isset($this->request->post['mailman_asigurare_expeditie'])) {
			$data['mailman_asigurare_expeditie'] = $this->request->post['mailman_asigurare_expeditie'];
		} else {
			$data['mailman_asigurare_expeditie'] = $this->config->get('mailman_asigurare_expeditie');
		}

		if (isset($this->request->post['mailman_min_gratuit'])) {
			$data['mailman_min_gratuit'] = $this->request->post['mailman_min_gratuit'];
		} else {
			$data['mailman_min_gratuit'] = $this->config->get('mailman_min_gratuit');
		}

		if (isset($this->request->post['mailman_paymentrbdest'])) {
			$data['mailman_paymentrbdest'] = $this->request->post['mailman_paymentrbdest'];
		} else {
			$data['mailman_paymentrbdest'] = $this->config->get('mailman_paymentrbdest');
		}

        if (isset($this->request->post['mailman_tax_class_id'])) {
            $data['mailman_tax_class_id'] = $this->request->post['mailman_tax_class_id'];
        } else {
            $data['mailman_tax_class_id'] = $this->config->get('mailman_tax_class_id');
        }

        $this->load->model('localisation/tax_class');
        $data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('shipping/mailman.tpl', $data));
	}
	
	private function validate()
    {

		if (!$this->user->hasPermission('modify', 'shipping/mailman')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['mailman_wsdl_url']) {
			$this->error['wsdl_url'] = $this->language->get('error_wsdl_url');
		}

		if (!$this->request->post['mailman_username']) {
			$this->error['username'] = $this->language->get('error_username');
		}

		if (!$this->request->post['mailman_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}

        require_once(DIR_SYSTEM . 'library/MailmanSoapClient.php');

        $wsdl_url = $this->request->post['mailman_wsdl_url'];
        $username = $this->request->post['mailman_username'];
        $password = $this->request->post['mailman_password'];
        $soap = new MailmanSoapClient($wsdl_url, $username, $password);
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

    public function install() {
        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "order_mailman` (
				`order_id` int(11) NOT NULL,
				`awb` varchar(255) NOT NULL,
				PRIMARY KEY `order_id` (`order_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
    }

}
