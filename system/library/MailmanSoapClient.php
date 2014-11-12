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
		if (!self::$cache[$k]){
			if (isset($GLOBALS['debug'])){
				var_dump('try', $name, $arguments);
			}
			try{
				self::$cache[$k] = $this->SOAPClient->__soapCall($name, $arguments, null);
				if (isset($GLOBALS['debug'])){
					var_dump('response', self::$cache[$k]);
				}
			}
			catch (Exception $e){
				if (isset($GLOBALS['debug'])){
					var_dump('__getLastRequestHeaders()', $this->SOAPClient->__getLastRequestHeaders());
					var_dump('__getLastRequest()', $this->SOAPClient->__getLastRequest());
					var_dump('__getLastResponseHeaders()', $this->SOAPClient->__getLastResponseHeaders());
					if (strpos($this->SOAPClient->__getLastResponse(), '<?xml') === 0){
						var_dump('__getLastResponse', formatXML($this->SOAPClient->__getLastResponse()));
						$doc = new DOMDocument();
						$doc->loadXML($this->SOAPClient->__getLastResponse());
						$xpath = new DOMXPath($doc);
						var_dump($xpath->query('//faultstring')->item(0)->nodeValue);
						echo "<code>", $xpath->query('//detail')->item(0)->nodeValue, "</code><br>\r\n";
					}
					else{
						var_dump('__getLastResponse()', $this->SOAPClient->__getLastResponse());
					}
				}
				throw $e;
			}
			if ($GLOBALS['debug'] > 1){
				var_dump($this->SOAPClient->__getLastRequest());
				var_dump(formatXML($this->SOAPClient->__getLastResponse()));
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
