<?php
require 'vendor/autoload.php';

date_default_timezone_set('Asia/Tokyo');

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

$app_id = 'rLfiUPlbIE5orN0Al07gpotnvIpqwTUpoQlkhjO0' ;
$rest_key = 'LnIgqdYSz8krs6iKBdH5XtGqglkyjzuSEHTnNbEC' ;
$master_key = 'jtNDkVGTpaVeregAuvlTYOUCErbKnSMgE7F6x9Fo' ;

$dest_url = 'https://vivabelgianbeer-server.herokuapp.com/parse';

ParseClient::initialize( $app_id, $rest_key, $master_key );
ParseClient::setServerURL($dest_url) ;

    $obj = ParseObject::create("QuestionList");

   try {
       $obj->set( "title" , "ビール" ) ;
       $obj->set( "text" , " ベルギービールは初めてだ" ) ;
       $obj->save() ;
   } catch (\Parse\ParseException $e) {
      print $e ;
   }
?>
