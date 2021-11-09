<?php

require_once(dirname(__FILE__,2)."/directories/directories.php");

// Load the Google API PHP Client Library.
require_once __AUTOLOAD_PUBLIC__;

define("DATE_OLDEST", "2021-01-01");
define("DATE_LAST_5DAYS", "5daysAgo");
define("DATE_LAST_1MONTH", "31daysAgo");
define("DATE_LAST_1YEAR", "365daysAgo");

$option = $_GET['range'] ?? "0";

switch ($option) {
  case 1:
    $query_date_start = DATE_LAST_5DAYS;
    $query_date_end = "today";
    break;
  case 2:
    $query_date_start = DATE_LAST_1MONTH;
    $query_date_end = "today";
    break;
  case 3:
    $query_date_start = DATE_LAST_1YEAR;
    $query_date_end = "today";
    break;
  case 4:
    $query_date_start = DATE_OLDEST;
    $query_date_end = "today";
    break;
  default:
    $query_date_start = "today";
    $query_date_end = "today";
    break;
}

$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);
$results = getResults($analytics, $profile);

function initializeAnalytics()
{
  // Creates and returns the Analytics Reporting service object.

  // Use the developers console and download your service account
  // credentials in JSON format. Place them in this directory or
  // change the key file location if necessary.
  $KEY_FILE_LOCATION = __CONF_GAPI_CRDS__;

  // Create and configure a new client object.
  $client = new Google_Client();
  $client->setApplicationName("Hello Analytics Reporting");
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics($client);

  return $analytics;
}

function getFirstProfileId($analytics) {
  // Get the user's first view (profile) ID.

  // Get the list of accounts for the authorized user.
  $accounts = $analytics->management_accounts->listManagementAccounts();

  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
    $firstAccountId = $items[0]->getId();

    // Get the list of properties for the authorized user.
    $properties = $analytics->management_webproperties
        ->listManagementWebproperties($firstAccountId);

    if (count($properties->getItems()) > 0) {
      $items = $properties->getItems();
      $firstPropertyId = $items[0]->getId();

      // Get the list of views (profiles) for the authorized user.
      $profiles = $analytics->management_profiles
          ->listManagementProfiles($firstAccountId, $firstPropertyId);

      if (count($profiles->getItems()) > 0) {
        $items = $profiles->getItems();

        // Return the first view (profile) ID.
        return $items[0]->getId();

      } else {
        throw new Exception('No views (profiles) found for this user.');
      }
    } else {
      throw new Exception('No properties found for this user.');
    }
  } else {
    throw new Exception('No accounts found for this user.');
  }
}

function getResults($analytics, $profileId) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
   return $analytics->data_ga->get(
       'ga:' . $profileId,
       $GLOBALS['query_date_start'],
       'today',
       'ga:users,ga:newUsers,ga:sessions,ga:sessionDuration,ga:avgSessionDuration,ga:pageviewsPerSession,ga:percentNewSessions,ga:avgTimeOnPage,ga:bounceRate',
       array(
        'dimensions'    => 'ga:userBucket'#,
        #'filters'       => 'ga:pagePath==http://...correct url',
        #'sort'          => '-ga:pageviews',
    ));
}

function getTotalsForAllResults($result) {
  return $result->totalsForAllResults;
}

function printResults($results) {
  // Parses the ressponse from the Core Reporting API and prints
  // the profile name and total sessions.

  if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $results->getRows();
    $sessions = $rows[0][0];

    // Print the results.
    print "First view (profile) found: $profileName\n";
    print "Total sessions: $sessions\n";
  } else {
    print "No results found.\n";
  }
}
echo json_encode(getTotalsForAllResults($results),1);
die();
?>

<pre>
  <?php
    echo json_encode($results,1);
  ?>
</pre>