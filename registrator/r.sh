#!/bin/sh

#rm -rf tmp/*.txt
#php get_email_data.php

for f in $(ls tmp/*.txt)
do
    subject=$(cat $f | grep "Subject" | grep "[懇親会申し込み]") ;
    if [ "$subject" = "" ]; then
	continue
    fi

    graduate=$(cat $f | grep "[期]" | cut -d] -f2) ;
    name=$(cat $f | grep "[名前]"  | cut -d] -f2) ;
    email=$(cat $f | grep "[Email]" | cut -d] -f2) ;
    message=$(cat $f | grep "[一言]" | cut -d] -f2) ;

    echo $graduate $name $email $message
done