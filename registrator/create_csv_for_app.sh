#!/bin/bash


dst_participant_list="app_tmp/participant-raw.csv"
dst_non_participant_list="app_tmp/non-participant-raw.csv"


rm -rf $dst_participant_list
rm -rf $dst_non_participant_list

for f in $(ls app_tmp/*.txt)
do
    dos2unix $f
    subject=$(cat $f | grep "Subject" | grep "[懇親会申し込み]") ;
    if [ "$subject" = "" ]; then
	continue
    fi

    # iOS Application
    subject=$(cat $f | grep "Subject" | grep "\[iOS\]") ;

    if [ "$subject" != "" ]; then
	graduate=$(cat $f | grep "\[期\]"| cut -d] -f2 | sed 's/^[ \t]*//')
	name=$(cat $f | grep "\[名前\]"  | cut -d] -f2 | sed 's/^[ \t]*//')
	email=$(cat $f | grep "\[Email\]" | cut -d] -f2| sed 's/^[ \t]*//')
	message=$(cat $f | grep "\[一言\]" | cut -d] -f2| sed 's/^[ \t]*//')
	if [ "$graduate" != "" -a "$name" != "" ]; then
	    echo  "$graduate,$name,$email,$message" >> $dst_participant_list
	fi
	continue
    fi

    subject=$(cat $f | grep "Subject" | grep "\[Android\]") ;
    if [ "$subject" != "" ]; then
	graduate=$(cat $f | grep "\[Graduate\]"| cut -d] -f2 | sed 's/^[ \t]*//')
	name=$(cat $f | grep "\[Name\]"  | cut -d] -f2 | sed 's/^[ \t]*//')
	email=$(cat $f | grep "\[Email\]" | cut -d] -f2| sed 's/^[ \t]*//')
	message=$(cat $f | grep "\[Message\]" | cut -d] -f2| sed 's/^[ \t]*//')
	if [ "$graduate" != "" -a "$name" != "" ]; then
	    echo  "$graduate,$name,$email,$message" >> $dst_participant_list
	fi
	continue 
    fi
done

cat $dst_participant_list

#php put_data.php
