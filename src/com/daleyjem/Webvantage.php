<?php

namespace com\daleyjem {

	use com\daleyjem\WebvantageLanguage;
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
				$isSignedIn = false;

		/** Constants **/
		const PATH_SIGNIN 		= '/SignIn.aspx',
			  PATH_TIMESHEET 	= '/Timesheet.aspx?mm=1',
			  PATH_REFERRER 	= '/UI_TopMenu.aspx';


		/********************/
		/** Public methods **/
		/********************/

		/**
		 * Instantiate new Webvantage object
		 * @param string $baseUrl The base url where you would normally access Webvantage's web interface
		 * @param string $db The name of the database entered before signing into Webvantage's web interface 
		 * @param array  $options
		 */
		public function __construct ($url, $user, $password) {
			// Remove trailing slash if one exists
			$url = preg_replace('{/$}', '', $url);
			$this->url 	= $url;

			// Establish Goutte client
			$this->client = new Client();
			$this->client->setAuth($user, $password);

		}

		public function signIn($db) {

		}

		public function copyJobEntries(array $jobEntries, array $dateSpan) {

		}

		public function getTimeEntries(array $dateSpan = array()) {

		}

		public function getJobEntries(array $dateSpan = array()) {


			file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/tmp/output.txt', $exec);
		}

		/**
		 * Submit 'Sign In' form from 'Database Name' field 
		 */
		public function signIn() {
			

			$this->isSignedIn = true;
		}

		public function submitTimeEntry(WebvantageTimeEntry $timeEntry) {
			$this->clearCurlOpts();
		}

		public function submitForApproval(array $dateSpan) {
			$this->clearCurlOpts();
		}

	}

}