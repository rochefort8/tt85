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


for ($count=0;$count<=34;$count++) {
    $obj = ParseObject::create("Tochikuji");

   try {
     $file_image       = ParseFile::createFromFile( "2/$count.jpg" ,"$count.jpg") ;
     $obj->set( "image" , $file_image ) ;
     $obj->save() ;
   } catch (\Parse\ParseException $e) {
      print $e ;
   }
}


?>
