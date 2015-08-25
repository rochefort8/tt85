#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php

rm -rf tmp/tmp.csv
for f in $(ls tmp/*.txt)
do
    dos2unix $f
    subject=$(cat $f | grep "Subject" | grep "[懇親会申し込み]") ;
    if [ "$subject" = "" ]; then
	continue
    fi

#    graduate=$(cat $f | grep "[期]" | cut -d] -f2) ;
    graduate=$(cat $f | grep "\[期\]"| cut -d] -f2 | sed 's/^[ \t]*//')
    name=$(cat $f | grep "\[名前\]"  | cut -d] -f2 | sed 's/^[ \t]*//')
    email=$(cat $f | grep "\[Email\]" | cut -d] -f2| sed 's/^[ \t]*//')
    message=$(cat $f | grep "\[一言\]" | cut -d] -f2| sed 's/^[ \t]*//')

    echo  "$graduate,$name,$email,$message" >> tmp/tmp.csv

done

php put_data.php
