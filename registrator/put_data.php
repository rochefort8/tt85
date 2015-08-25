<?php

$participant_list=$argv[1] ;
$non_participant_list=$argv[2] ;

require_once('s/vendor/autoload.php');

$G_CLIENT_ID = '1093409669917-r0b7k4fjs0asvjh4a1q193b6akmmb7ed.apps.googleusercontent.com';
$G_CLIENT_EMAIL = '1093409669917-r0b7k4fjs0asvjh4a1q193b6akmmb7ed@developer.gserviceaccount.com';
$G_CLIENT_KEY_PATH = 'TT85-20151107-148a6e2b5d19.p12';
$G_CLIENT_KEY_PW = 'notasecret';

$obj_client_auth = new Google_Client ();
$obj_client_auth->setApplicationName ('TestApplication');
$obj_client_auth->setClientId ($G_CLIENT_ID);
$obj_client_auth->setAssertionCredentials (new Google_Auth_AssertionCredentials(
    $G_CLIENT_EMAIL,
    array('https://spreadsheets.google.com/feeds','https://docs.google.com/feeds'),
    file_get_contents ($G_CLIENT_KEY_PATH),
    $G_CLIENT_KEY_PW
));


$obj_client_auth->getAuth()->refreshTokenWithAssertion();

$obj_token  = json_decode($obj_client_auth->getAccessToken());
$accessToken = $obj_token->access_token;

$serviceRequest = new Google\Spreadsheet\DefaultServiceRequest($accessToken);
Google\Spreadsheet\ServiceRequestFactory::setInstance($serviceRequest);

$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
$spreadsheetFeed = $spreadsheetService->getSpreadsheets();

$spreadsheet = $spreadsheetFeed->getByTitle('2015年度懇親会出席者リスト');

// array from file
setlocale(LC_ALL, 'ja_JP.UTF-8');

// ----- Paticipant -----
$worksheetFeed = $spreadsheet->getWorksheets();
$worksheet = $worksheetFeed->getByTitle('Participant');
$listFeed = $worksheet->getListFeed();

$file = $participant_list;

$data = file_get_contents($file);
// $data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
$temp = tmpfile();
$csv  = array();
 
fwrite($temp, $data);
rewind($temp);
 
$keys = array("graduate", "name", "email", "message") ;

while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
    $csv = $data;
    $row = array_combine($keys,$csv) ;
    $listFeed->insert($row);
}
fclose($temp);

// ----- Non-Paticipant -----
$worksheetFeed = $spreadsheet->getWorksheets();
$worksheet = $worksheetFeed->getByTitle('Non-Participant');
$listFeed = $worksheet->getListFeed();

$file = $non_participant_list;
$data = file_get_contents($file);
// $data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
$temp = tmpfile();
$csv  = array();
 
fwrite($temp, $data);
rewind($temp);
 
$keys = array("graduate", "name", "email", "message") ;

while (($data = fgetcsv($temp, 0, ",")) !== FALSE) {
    $csv = $data;
    $row = array_combine($keys,$csv) ;
    $listFeed->insert($row);
}
fclose($temp);

?>