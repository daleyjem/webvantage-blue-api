<?php

	include_once('WebvantageLanguage.php');

	/**
	* A PHP API using scraping techniques with cURL to get and submit job/time entries for a specific user.
	*/
	class Webvantage {

		/** Public variables **/

		public $baseUrl;
		public $db;
		public $cookieFile 	= '';
		public $language 	= WebvantageLanguage::ENGLISH_US;

		/** Private variables **/

		private $curl;
		private $isSignedIn = false;

		/** Constants **/
		const PATH_SIGNIN 		= '/SignIn.aspx';
		const PATH_TIMESHEET 	= '/Timesheet.aspx?mm=1';
		const PATH_REFERRER 	= '/UI_TopMenu.aspx';

		const CURL_USERAGENT = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.X.Y.Z Safari/525.13.";


		/********************/
		/** Public methods **/
		/********************/

		/**
		 * Instantiate new Webvantage object
		 * @param string $baseUrl The base url where you would normally access Webvantage's web interface
		 * @param string $db The name of the database entered before signing into Webvantage's web interface 
		 * @param array  $options
		 */
		public function __construct ($baseUrl, $db, array $options = array()) {
			$this->cookieFile = $_SERVER['DOCUMENT_ROOT'] . '/tmp/cookie.txt';
			// Remove trailing slash if one exists
			$baseUrl = preg_replace('{/$}', '', $baseUrl);

			$this->baseUrl 	= $baseUrl;
			$this->db 		= $db;

			foreach ($options as $key => $value) {
				$this[$key] = $value;
			}

			$this->curl = curl_init();
			$this->setCurlOpts();
		}

		public function copyJobEntries(array $jobEntries, array $dateSpan) {
			$this->clearCurlOpts();
		}

		public function getTimeEntries(array $dateSpan = array()) {
			$this->clearCurlOpts();
		}

		public function getJobEntries(array $dateSpan = array()) {
			$this->clearCurlOpts();

			curl_setopt($this->curl, CURLOPT_URL, $this->baseUrl . self::PATH_TIMESHEET);

			$exec = curl_exec($this->curl);

			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/tmp/output.txt', $exec);
		}

		/**
		 * Submit 'Sign In' form from 'Database Name' field and store cookie
		 * for subsequent cURL requests.
		 */
		public function signIn() {
			curl_setopt_array($this->curl, array(
				CURLOPT_POST 		=> true,
				CURLOPT_HTTPGET		=> false,
				CURLOPT_URL 		=> $this->baseUrl . self::PATH_SIGNIN,
				CURLOPT_POSTFIELDS	=> array(
					'RadWindowSignIn$C$TextBoxDataBase' 	=> $this->db,
					'RadWindowSignIn$C$CheckBoxRememberMe' 	=> 'on',
					'RadWindowSignIn$C$RadComboBoxLanguage'	=> $this->language
				),
			));

			$exec = curl_exec($this->curl);

			//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/tmp/output.txt', $exec);

			$this->isSignedIn = true;
		}

		public function submitTimeEntry(WebvantageTimeEntry $timeEntry) {
			$this->clearCurlOpts();
		}

		public function submitForApproval(array $dateSpan) {
			$this->clearCurlOpts();
		}


		/*********************/
		/** Private methods **/
		/*********************/


		/**
		 * Sets all cURL options for transmitting to Webvantage
		 */
		private function setCurlOpts() {
			$header = array();
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
			$header[] = "Cache-Control: max-age=0"; 
			$header[] = "Connection: keep-alive"; 
			$header[] = "Keep-Alive: 300"; 
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
			$header[] = "Accept-Language: en-us,en;q=0.5"; 
			$header[] = "Pragma: "; // browsers keep this blank. 

			curl_setopt_array($this->curl, array(
				CURLOPT_RETURNTRANSFER 	=> true,
				CURLOPT_COOKIEFILE 		=> $this->cookieFile,
				CURLOPT_COOKIEJAR 		=> $this->cookieFile,
				CURLOPT_USERAGENT 		=> self::CURL_USERAGENT,
				CURLOPT_FOLLOWLOCATION 	=> true,
				CURLOPT_HTTPHEADER 		=> $header,
				CURLOPT_ENCODING 		=> 'gzip,deflate,sdch',
				CURLOPT_AUTOREFERER 	=> true,
				CURLOPT_SSL_VERIFYPEER 	=> false,
				CURLOPT_REFERER 		=> $this->baseUrl . self::PATH_REFERRER
			));
		}

		/**
		 * Clears out any post fields and options that can't be used across all Webvantage
		 * cURL requests.
		 */
		private function clearCurlOpts() {
			curl_setopt_array($this->curl, array(
				CURLOPT_POSTFIELDS 	=> array(),
				CURLOPT_POST 		=> false,
				CURLOPT_HTTPGET		=> true
			));
		}

	}

?>