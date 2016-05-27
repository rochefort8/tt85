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
   '54321',
   '',
   '54321'
);
ParseClient::setServerURL('https://liketochiku-parse-server.herokuapp.com/parse');

    $obj = ParseObject::create("Ad");
    $obj->set( "title" , "Hello" ) ;
    $obj->save() ;
?>
