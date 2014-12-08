<?php
class MailmanSoapClient{

	private $SOAPClient = null;

	function __construct($wsdl, $username, $password, array $ClientOptions = array()){
		// Create the SoapClient instance
		$ClientOptions['trace'] = 1;
		$ClientOptions['exception'] = 0;
		$ClientOptions['authentication'] = SOAP_AUTHENTICATION_BASIC;
		$ClientOptions['login'] = $username;
		$ClientOptions['password'] = $password;
		$this->SOAPClient = new SoapClient($wsdl, $ClientOptions);
	}

	private static $cache;

	function __call($name, $arguments){
		$k = md5($name . serialize($arguments));
		if (!isset(self::$cache[$k])){
			try{
				self::$cache[$k] = $this->SOAPClient->__soapCall($name, $arguments, null);
			}
			catch (Exception $e){
				throw $e;
			}
		}

		return self::$cache[$k];
	}
}

function formatXML($xml){
	if (strpos($xml, '<?xml') === 0){
		$doc = new DOMDocument();
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
		$doc->loadXML($xml);
		return $doc->saveXML();
	}
	return $xml;
}

/**
 * Class Expediere
 */
class Expediere{
	/**
	 * nume destinatar
	 *
	 * @var string
	 */
	public $destinatar_nume;
	/**
	 * departament/persoana contact
	 *
	 * @var string
	 */
	public $destinatar_departament;
	/**
	 * adresa
	 *
	 * @var string
	 */
	public $detalii_destinatar_adresa;
	/**
	 * localitate
	 *
	 * @var string
	 */
	public $detalii_destinatar_localitate;
	/**
	 * judet
	 *
	 * @var string
	 */
	public $detalii_destinatar_judet;
	/**
	 * telefon
	 *
	 * @var string
	 */
	public $detalii_destinatar_telefon;
	/**
	 * descriere expeditie: plic, colet, documente, RCA ...
	 *
	 * @var string
	 */
	public $descriere_expeditie;
	/**
	 * numar plicuri in expeditie
	 *
	 * @var integer
	 */
	public $plic;
	/**
	 * numar colete in expeditie
	 *
	 * @var integer
	 */
	public $colet;
	/**
	 * greutate colete (kg)
	 *
	 * @var integer
	 */
	public $greutate;
	/**
	 * valoare declarata (RON)
	 *
	 * @var float
	 */
	public $valoare_declarata;
	/**
	 * valoare ramburs (RON)
	 *
	 * @var float
	 */
	public $ramburs;
	/**
	 * note
	 *
	 * @var string
	 */
	public $note;
}
