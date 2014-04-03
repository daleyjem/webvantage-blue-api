<?php
	class WebvantageJobEntry {
		public $clientCode,
			   $divisionCode,
			   $productCode,
			   $client,
			   $division,
			   $product,
			   $jobCode,
			   $componentCode,
			   $job,
			   $component,
			   $funcCatCode,
			   $funcCat,
			   $deptCode;

		public function __construct() {

		}

		/**
		 * Takes an HTML <tr> source and extracts the properties for the job entry
		 * @param  string $source
		 */
		public function import($source) {

		}
	}
?>