<?php

namespace com\daleyjem\webvantage {

	use com\daleyjem\webvantage\WebvantageLanguage;
	use com\daleyjem\webvantage\WebvantageJobEntry;
	use com\daleyjem\util\Trace;
	use Goutte\Client;

	/**
	* A PHP API using scraping techniques with cURL to get and submit job/time entries for a specific user.
	*/
	class Webvantage {

		/** Public variables **/

		public $url,
			   $language = WebvantageLanguage::ENGLISH_US;

		/** Private variables **/

		private $client,
				$crawler,
				$cookieJar 	= null,
				$history 	= null,
				$isSignedIn = false;

		/** Constants **/
		const PATH_SIGNIN 		= '/SignIn.aspx',
			  PATH_TIMESHEET 	= '/Timesheet.aspx?mm=1',
			  PATH_REFERRER 	= '/UI_TopMenu.aspx',
			  TEXT_SIGN_IN		= 'Sign In',
			  TEXT_ERROR_TITLE	= 'Yikes!',
			  FIELD_DATABASE	= 'RadWindowSignIn$C$TextBoxDataBase';


		/********************/
		/** Public methods **/
		/********************/

		/**
		 * Instantiate new Webvantage object
		 * @param string $baseUrl The base url where you would normally access Webvantage's web interface
		 * @param string $db The name of the database entered before signing into Webvantage's web interface 
		 * @param array  $options
		 */
		public function __construct ($url, $db, $user, $pass) {
			// Don't start a session if it's already been started
			if (session_id() == null) session_start();

			// Set the default values if a session variable exists previously
			if (isset($_SESSION['cookieJar'])) 	$this->cookieJar 	= $_SESSION['cookieJar'];
			if (isset($_SESSION['history'])) 	$this->history 		= $_SESSION['history'];

			// Remove trailing slash if one exists
			$url = preg_replace('{/$}', '', $url);
			$this->url 	= $url;

			$this->db = $db;

			// Establish Goutte client
			$this->client = new Client(array(), $this->history, $this->cookieJar);
			$this->client->setAuth($user, $pass);
		}

		/**
		 * Submit 'Sign In' form from 'Database Name' field 
		 * @param  string $db [description]
		 * @return [type]     [description]
		 */
		public function signIn() {
			$this->crawler = $this->client->request('GET', $this->url);
			$form = $this->crawler->selectButton(self::TEXT_SIGN_IN)->form();
			$this->crawler = $this->client->submit($form, array(
				self::FIELD_DATABASE => $this->db
			));

			if (!$this->checkSigninStatus())
				return false;

			$_SESSION['cookieJar'] 	= $this->client->getCookieJar();
			$_SESSION['history'] 	= $this->client->getHistory();
			
			return true;
		}

		public function signOut() {

		}

		public function copyJobEntries(array $jobEntries, array $dateSpan) {

		}

		public function getTimeEntries(array $dateSpan = array()) {

		}

		public function getJobEntries(array $dateSpan = array()) {
			$jobEntries = array();

			$uri = $this->url . self::PATH_TIMESHEET;

			$isSignedIn = null;
			while ($isSignedIn != true) {
				$this->crawler = $this->client->request('GET', $uri);
				$isSignedIn = $this->checkSigninStatus();
				if (!$isSignedIn) {
					if ($this->signIn() == false) {
						return false;
					}
				}
			}
			
			// Loop through each row of the timesheet to pull out the job entries
			$rows = $this->crawler->filter('.rgRow, .rgAltRow');
			$rows = $rows->each(function($node){
				return $node;
			});

			foreach ($rows as $row) {
				$jobEntry = new WebvantageJobEntry();
				$jobEntry->import($row);
				$jobEntries[] = $jobEntry;
			}

			return $jobEntries;
		}

		public function submitTimeEntry(WebvantageTimeEntry $timeEntry) {
			
		}

		public function submitForApproval(array $dateSpan) {
			
		}


		/*********************
		 * PRIVATE METHODS
		 *********************/

		private function checkSigninStatus() {
			$hasSigninButton = $this->crawler->selectButton(self::TEXT_SIGN_IN)->count() > 0;
			$isErrorPage = strpos($this->crawler->filter('title')->text(), self::TEXT_ERROR_TITLE) !== false;
			if ($hasSigninButton || $isErrorPage) {
				return false;
			}
			return true;
		}

	}

}