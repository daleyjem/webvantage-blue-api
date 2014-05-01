<?php

namespace com\daleyjem\webvantage\util {

	class WebvantageFormParams {

		const FIELD_DATESPAN_DATE_UNFORMATTED 	= '',
			  FIELD_DATESPAN_DATE_FORMATTED 	= '',
			  FIELD_DATESPAN_COMBINED_JSON 		= '',
			  MASK_DATESPAN_RAW

		/* EXAMPLE:

		'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate$dateInput' => '4/20/2014',
		'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate' => '2014-04-20',
		'ctl00_ContentPlaceHolderMain_RadDatePickerStartDate_dateInput_ClientState' => 
			'{
				"enabled":true,
				"emptyMessage":"Start Date",
				"validationText":"2014-04-20-00-00-00",
				"valueAsString":"2014-04-20-00-00-00",
				"minDateStr":"1950-01-01-00-00-00",
				"maxDateStr":"2050-01-01-00-00-00",
				"lastSetTextBoxValue":"4/20/2014"
			}'

		 */

		public static function buildTimesheetDates($dateSpan) {
			$params = array();

			// Create 'date' object from supplied $dateSpan

			// Convert date to unformatted
			
			// Convert date to formatted
			 
			// Get JSON string from date 

			return $params;
		}

		/**
		 * Creates the JSON string required by Webvantage for FIELD_DATESPAN_COMBINED_JSON
		 * @param  [type] $dateSpan [description]
		 * @return [type]           [description]
		 */
		private function createDatespanJSON($dateSpan) {
			$fieldsVals = array();
			$json = json_encode($fieldsVals);
			return $json;
		}
	}
}