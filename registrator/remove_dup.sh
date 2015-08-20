#!/bin/bash

line_cnt_src=0

rm -rf tmp/new.csv

while read line_src
do
    found="n"
    dup="n"

    let line_cnt_src=$line_cnt_src+1
    line_cnt_dst=0

    while read line_dst
    do
	let line_cnt_dst=$line_cnt_dst+1
	if [ $line_cnt_dst -lt $line_cnt_src ]; then
	    continue
	fi

	if [ "$line_src" = "$line_dst" ]; then
	    if [ "$found" = "n" ]; then
		found="y"
	    else
		dup="y"
		break
	    fi
	fi
    done < tmp/list.csv

    if [ "$found" = "y" -a "$dup" = "n" ]; then
	echo "$line_src" >> tmp/new.csv
    fi
done < tmp/list.csv
