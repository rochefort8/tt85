<?php

// Connect to gmail
$imapPath = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
$username = 'tt85.20151107@gmail.com';
$password = 'tochikun';
// try to connect
$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail:'.imap_last_error());


$msgs = imap_sort($inbox, SORTDATE, 1, SE_UID);

foreach ($msgs as $msguid) {
    $msgno = imap_msgno($inbox, $msguid);
    $headers = imap_headerinfo($inbox, $msgno);
    $structure = imap_fetchstructure($inbox, $msguid, FT_UID);

    var_dump($headers);
    var_dump($structure);
}

?>
