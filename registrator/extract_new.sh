#!/bin/bash

old=$1
new=$2
delta=$3

rm -rf $delta

while read new_line
do
    found=
    while read old_line
    do
        if [ "$new_line" == "$old_line" ]; then
	    found="y"
	    break;
	fi
    done < $old
    if [ -z "$found" ]; then
	echo "$new_line" >> $delta
    fi
done < $new
