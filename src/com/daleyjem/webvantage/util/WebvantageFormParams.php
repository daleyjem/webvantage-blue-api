<?php

namespace com\daleyjem\webvantage\util {

	class WebvantageFormParams {

		const FIELD_DATESPAN_UNFORMATTED 		= 'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate$dateInput',
			  FIELD_DATESPAN_FORMATTED 			= 'ctl00$ContentPlaceHolderMain$RadDatePickerStartDate',
			  FIELD_DATESPAN_COMBINED_JSON 		= 'ctl00_ContentPlaceHolderMain_RadDatePickerStartDate_dateInput_ClientState',
			  MASK_DATESPAN_UNFORMATTED			= 'n/j/Y',
			  MASK_DATESPAN_FORMATTED 			= 'Y-m-d',
			  MASK_DATESPAN_FULL 				= 'Y-m-d-H-i-s',
			  DATESTR_MIN 						= '1950-01-01',
			  DATESTR_MAX						= '2050-01-01';

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

			$timestamp = strtotime($dateSpan);

			$params[self::FIELD_DATESPAN_UNFORMATTED] 	= date(self::MASK_DATESPAN_UNFORMATTED, $timestamp);
			$params[self::FIELD_DATESPAN_FORMATTED] 	= date(self::MASK_DATESPAN_FORMATTED, $timestamp);
			$params[self::FIELD_DATESPAN_COMBINED_JSON] = self::createDatespanJSON($timestamp);

			return $params;
		}

		/**
		 * Creates the JSON string required by Webvantage for FIELD_DATESPAN_COMBINED_JSON
		 * @param  [type] $dateObj A PHP 'date' object
		 * @return [type]           [description]
		 */
		private static function createDatespanJSON($dateObj) {
			$fieldsVals = array(
				"enabled" 				=> true,
				"emptyMessage" 			=> "Start Date",
				"validationText" 		=> date(self::MASK_DATESPAN_FULL, $dateObj),
				"valueAsString" 		=> date(self::MASK_DATESPAN_FULL, $dateObj),
				"minDateStr" 			=> date(self::MASK_DATESPAN_FULL, strtotime(self::DATESTR_MIN)),
				"maxDateStr" 			=> date(self::MASK_DATESPAN_FULL, strtotime(self::DATESTR_MAX)),
				"lastSetTextBoxValue" 	=> date(self::MASK_DATESPAN_UNFORMATTED, $dateObj)
			);

			$jsonStr = json_encode($fieldsVals);
			
			// Strip any brackets... they're not used 
			$jsonStr = str_replace(array('[', ']', '\/'), array('','', '/'), $jsonStr);
			
			return $jsonStr;
		}
	}
}