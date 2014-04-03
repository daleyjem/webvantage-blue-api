webvantage-blue-api
===================

A PHP API using scraping techniques with cURL to get and submit job/time entries for a specific user.


Classes
-------
- Webvantage (Main class for performing Webvantage methods on)
- WebvantageInitOptions (Available initialize options for passing into constructor)
- WebvantageLanguage (List of available language options to be set on WebvantageInitOptions:LANGUAGE)
- WebvantageJobEntry (A job entry as entered by a user containing the entered job # and other specific entry data)
- WebvantageTimeEntry (A time/hour entry containing the specified WebvantageJobEntry on a specified date)


Webvantage Methods
------------------
- __construct(url:string, db:string, options:mixed)
- copyJobEntries(jobEntries:array[WebvantageJobEntry], dateSpan:array[count=2]) - Copies an array of job entries to a specified date span
- getTimeEntries(dateSpan:array[count=2]) - Returns array of date-sorted time/job entries from a specified date span
- getJobEntries(dateSpan:array[count=2]) - Returns array of job entries from a specifed date span
- submitTimeEntry(timeEntry:WebvantageTimeEntry) - Submits a time entry for a specified job number on a specified date
- submitForApproval(dateSpan:array[count=2]) - Submits entries from a specified date span for approval

WebvantageInitOptions Constants
-------------------------------
- LANGUAGE <string> = 'language'
- COOKIE_FILE <string> = 'cookieFile'

WebvantageLanguage Constants
----------------------------
- ENGLISH = 'US/Eng' (or whatever)
- ...

WebvantageJobEntry Variables
----------------------------
- jobNumber <string>
- ...

WebvantageTimeEntry Variables
-----------------------------
- jobEntry <WebvantageJobEntry>
- date <date>
- hours <int>
