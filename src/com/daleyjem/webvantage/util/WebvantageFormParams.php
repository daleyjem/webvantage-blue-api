<?php

namespace com\daleyjem\webvantage\util {

	class WebvantageFormParams {

		const FIELD_DATESPAN_DATE_UNFORMATTED 	= 'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate$dateInput',
			  FIELD_DATESPAN_DATE_FORMATTED 	= 'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate',
			  FIELD_DATESPAN_COMBINED_JSON 		= 'ctl00_ContentPlaceHolderMain_RadDatePickerStartDate_dateInput_ClientState',
			  MASK_DATESPAN_UNFORMATTED			= 'm/d/Y',
			  MASK_DATESPAN_FORMATTED 			= 'Y-mm-dd';

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

			// TODO: Create 'date' object from (possibly unformatted) supplied $dateSpan

			// TODO: Convert date to unformatted
			
			// TODO: Convert date to formatted
			 
			// TODO: Get JSON string from date 

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
			// TODO: Strip any brackets... they're not used 
			return $json;
		}
	}
}