<?php

require_once('vendor/autoload.php');

$server = new \Fetch\Server('imap.gmail.com', 993);
$server->setAuthentication('tt85.20151107@gmail.com', 'tochikun');

$messages = $server->getMessages();
/** @var $message \Fetch\Message */

$file_id=0;

foreach ($messages as $message) {

    $subject = imap_utf8($message->getSubject());
    $str = "Subject: " . $subject . "\nBody: {$message->getMessageBody()}\n";
    echo $str ;

    $filename = "app_tmp/" . "$file_id" . ".txt" ;
    file_put_contents($filename,$str) ;
    $file_id++ ;
}

?>