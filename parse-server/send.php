<?php

require 'vendor/autoload.php';

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

ParseClient::initialize(
   '2X6FE9u8wLZ4wHqwQf7OGa80OEShe5AUgdV5dq25',
   'kU7l5Tf5lQ50hEoVbnuXrdy7bcnQ8NQmDZTyIXVf',
   '8Rfi7dgFEOdgFu2hyzP0hrQoV2mer1vfQnTa6yh5'
);
ParseClient::setServerURL('https://api.parse.com/1');

    $obj = ParseObject::create("Ad");

    $obj->set( "title" , "Hello" ) ;
    $obj->save() ;
?>
