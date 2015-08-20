<?php
require './parse-php-sdk/autoload.php';

date_default_timezone_set('Asia/Tokyo');

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseFile;

ParseClient::initialize(
	'rLfiUPlbIE5orN0Al07gpotnvIpqwTUpoQlkhjO0',
	'LnIgqdYSz8krs6iKBdH5XtGqglkyjzuSEHTnNbEC', 
	'jtNDkVGTpaVeregAuvlTYOUCErbKnSMgE7F6x9Fo'
	);


for ($count=102;$count<=120;$count++) {
    $obj = ParseObject::create("Countdown");


   try {
     $file_image       = ParseFile::createFromFile( "./$count.jpg" ,"$count.jpg") ;
     $obj->set( "image" , $file_image ) ;
    $obj->set( "title" , "$count" ) ;
     $obj->save() ;
   } catch (\Parse\ParseException $e) {
      print $e ;
   }
}


?>
