<?php
class ModelShippingMailman extends Model {
	function getQuote($address) {
		$this->load->language('shipping/mailman');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country where country_id = '" . (int)$address['country_id'] . "' and name='Romania'");
	
		if (!$query->num_rows) {
            return false;
        }

		if (!$this->cart->hasProducts()) {
            return false;
        }

        require_once(DIR_SYSTEM . 'library/MailmanSoapClient.php');

        $wsdl_url = $this->config->get('mailman_wsdl_url');
        $username = $this->config->get('mailman_username');
        $password = $this->config->get('mailman_password');
        $soap = new MailmanSoapClient($wsdl_url, $username, $password);


        $expediere = new Expediere();
        $expediere->destinatar_nume = $address['firstname'] . ' ' . $address['lastname'];
        $expediere->destinatar_departament = '';
        $postcode = '' !== $address['postcode'] ? str_pad($address['postcode'], 6, '0') : '';
        $expediere->detalii_destinatar_adresa = trim($address['address_1'] . ' ' . $address['address_2'] . ' ' . $postcode);
        $expediere->detalii_destinatar_localitate = $address['city'];
        $expediere->detalii_destinatar_judet = $address['zone'];
        $expediere->detalii_destinatar_telefon = isset($this->session->data['guest']['telephone']) ? $this->session->data['guest']['telephone'] : $this->customer->getTelephone();

        $descriere_expeditie = array();
        foreach ($this->cart->getProducts() as $product) {
            if ($product['shipping']) {
                $descriere_expeditie[] = $product["model"];
            }
        }
        $expediere->descriere_expeditie = implode(', ', $descriere_expeditie);

        $expediere->plic = $this->config->get('mailman_parcel') ? null : $this->config->get('mailman_labels');
        $expediere->colet = $this->config->get('mailman_parcel') ? $this->config->get('mailman_labels') : null;
        $expediere->greutate = round((float)$this->cart->getWeight(), 0);

        $total = round((float)$this->cart->getTotal(), 2);
        $expediere->valoare_declarata = $total;
        $expediere->ramburs = $this->config->get('mailman_plata_ramburs') ? $total : null;

        //FIXME: query de commenturi/note
        $expediere->note = '';

        $currency = 'RON';

        try {
            $awb = $soap->saveAWB($expediere);
            $error = null;
            $quote_data['mailman'] = array(
                'code'         => 'mailman',
                'title'        => 'Mailman',
                'cost'         => $this->currency->convert($awb['price'], $currency, $this->config->get('config_currency')),
                'tax_class_id' => 'mailman.tax',
                'text'         => $this->currency->format($this->tax->calculate($this->currency->convert($awb['price'], $currency, $this->currency->getCode()), $this->config->get('mailman_tax_class_id'), $this->config->get('config_tax')), $this->currency->getCode(), 1.0000000)
            );
        } catch (SoapFault $e) {
            $error = "Comanda nu a fost procesata.<br>Va rugam sa corectati datele de livrare conform mesajului de mai jos: <br><br>";
            $error .= '<br>' . $e->getMessage();
            $quote_data['mailman'] = array(
                'code'         => 'mailman',
                'title'        => 'Mailman',
                'cost'         => null,
                'tax_class_id' => 'mailman.tax',
                'text'         => null
            );
        }

        return array(
                'code'       => 'mailman',
                'title'      => 'Mailman',
                'quote'      => $quote_data,
                'sort_order' => '1',
                'error'      => $error
        );
	}
}
