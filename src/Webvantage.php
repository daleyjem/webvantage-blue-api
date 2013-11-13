<?php

	/**
	* A PHP API using scraping techniques with cURL to get and submit job/time entries for a specific user.
	*/
	class Webvantage {

		/** Public variables **/

		public $url;
		public $db;
		public $options;


		/** Private variables **/

		private $curl;		


		/** Public methods **/

		public function __construct ($url, $db, array $options = array()) {}

		public function copyJobEntries(array $jobEntries, array $dateSpan) {}

		public function getTimeEntries(array $dateSpan) {}

		public function getJobEntries(array $dateSpan) {}

		public function submitTimeEntry(WebvantageJobEntry $jobEntry) {}

		public function submitForApproval(array $dateSpan) {}

	}

?>