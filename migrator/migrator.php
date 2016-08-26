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

$source_url = 'https://api.parse.com/1' ;
$dest_url = 'https://liketochiku-server.herokuapp.com/parse';

ParseClient::initialize( $app_id, $rest_key, $master_key );

$query = new ParseQuery("Ad");
//$query->AddDescending("updateAt");
$query->AddAscending("objectId");

// All results:
$results_src = $query->find();


ParseClient::setServerURL($dest_url) ;

// All results:
$results_dst = $query->find();

// Verify
if (count ($results_src) != count($results_dst)) {
   echo "Count is not equal, aborting...\n" ;
   exit (1) ;
}

for ($i=0; $i < count ($results_src); $i++) {
    $id_src=$results_src[$i]->getObjectId() ;
    $id_dst=$results_dst[$i]->getObjectId() ;
    if ($id_src != $id_dst) {
       echo "ID is not equal, aborting...\n" ;
       exit (1) ;
    }
}

$file_name_array=array() ;

ParseClient::setServerURL($source_url) ;

foreach ($results_src as $object) {
	$id = $object->getObjectId() ;
	$file = $object->get("image");
	$name = $file->getName();
	$url = $file->getURL();

	// Download the contents:
	$contents = $file->getData();

	$p = strrpos($name,"-") ;
	$short_name = substr ($name,$p + 1) ;
	$image_path = "c/" . $short_name ;
	array_push ($file_name_array,$short_name) ;

	file_put_contents ($image_path,$contents) ;
	echo $id . ":" . $short_name . "\n" ;
}


ParseClient::setServerURL($dest_url) ;

for ($i=0; $i < count($results_dst); $i++) {
    $obj =  $results_dst[$i];
    $file_name = $file_name_array[$i] ;

    $file_image  = ParseFile::createFromFile( "c/" . $file_name , "$file_name") ;	
    try {
           $obj->set( "image" , $file_image ) ;
	   $obj->save() ;
	   echo "Wrote ". $file_name .  ".\n" ;	
   } catch (\Parse\ParseException $e) {
      print $e ;
   }
}

?>
