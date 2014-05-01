<?php

namespace com\daleyjem\webvantage {

	use Symfony\Component\DomCrawler\Crawler;

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
		 * @param  string $row
		 */
		public function import(Crawler $row) {
			$this->clientCode 		= trim($row->filter('td:nth-child(2)')->text());
			$this->divisionCode 	= trim($row->filter('td:nth-child(3)')->text());
			$this->productCode 		= trim($row->filter('td:nth-child(4)')->text());
			$this->client 			= trim($row->filter('td:nth-child(5)')->text());
			$this->division 		= trim($row->filter('td:nth-child(6)')->text());
			$this->product 			= trim($row->filter('td:nth-child(7)')->text());
			$this->jobCode			= trim($row->filter('td:nth-child(8)')->text());
			$this->componentCode 	= trim($row->filter('td:nth-child(9)')->text());
			$this->job 				= trim($row->filter('td:nth-child(10)')->text());
			$this->component 		= trim($row->filter('td:nth-child(11)')->text());
			$this->funcCatCode 		= trim($row->filter('td:nth-child(13)')->text());
			$this->funcCat 			= trim($row->filter('td:nth-child(14)')->text());
			$this->deptCode 		= trim($row->filter('td:nth-child(15)')->text());
		}
	}

}