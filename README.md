webvantage-blue-api
===================

An API using scraping techniques to get and submit job/time entries for a specific user.


Classes
-------
- Webvantage (Main class for performing Webvantage methods on)
- WebvantageInitOptions (Available initialize options for passing into constructor)
- WebvantageLanguage (List of available language options to be set on WebvantageInitOptions:LANGUAGE)
- WebvantageJobEntry (A job entry as entered by a user containing the entered job # and other specific entry data)


Webvantage Methods
------------------
- __construct(url:string, db:string, options:mixed)
- copyJobs(jobNumbers:mixed, dateSpan:mixed) - Copies an array of job numbers to a specified date span
- getTimeEntries(dateSpan:mixed) - Returns array of date-sorted time/job entries from a specified date span
- getJobEntries(dateSpan:mixed) - Returns array of job entries from a specifed date span
- submitTimeEntry(job:string, date:date, hours:int) - Submits a time entry for a specified job number on a specified date
- submitForApproval(dateSpan:mixed) - Submits entries from a specified date span for approval

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
