<?php

$emailAddress = 'postmaster@example.com';
$password = 'someSecretPassword';
$server = 'localhost';
$folder = 'Inbox';

$dsn = sprintf('{%s}%s', $server, $folder);
$mbox = imap_open($dsn, $emailAddress, $password);

if (!$mbox) {
    die ('Unable to connect');
}

$status = imap_status($mbox, $dsn, SA_ALL);
$msgs = imap_sort($mbox, SORTDATE, 1, SE_UID);

foreach ($msgs as $msguid) {
    $msgno = imap_msgno($mbox, $msguid);
    $headers = imap_headerinfo($mbox, $msgno);
    $structure = imap_fetchstructure($mbox, $msguid, FT_UID);

    var_dump($headers);
    var_dump($structure);
}