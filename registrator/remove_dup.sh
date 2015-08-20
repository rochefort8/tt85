#!/bin/bash

line_cnt_src=0

rm -rf tmp/new.csv

while read src_line
do
    found="n"
    dup="n"

    let line_cnt_src=$line_cnt_src+1
    line_cnt_dst=0

    src_graduate=$(echo $src_line | cut -d, -f1)
    src_name=$(echo $src_line | cut -d, -f2)
    src_email=$(echo $src_line | cut -d, -f3)
    src_message=$(echo $src_line | cut -d, -f4)

    while read dst_line
    do
	let line_cnt_dst=$line_cnt_dst+1
	if [ $line_cnt_dst -lt $line_cnt_src ]; then
	    continue
	fi
	
	dst_graduate=$(echo $dst_line | cut -d, -f1)
	dst_name=$(echo $dst_line | cut -d, -f2)
	dst_email=$(echo $dst_line | cut -d, -f3)

	if [ "$dst_email" = "$src_email" -a "$dst_name"  = "$src_name" -a "$dst_graduate" = "$src_graduate" ];then
	    if [ "$found" = "n" ]; then
		found="y"
	    else
		dup="y"
		break
	    fi
	fi
    done < tmp/list.csv

    graduate=$(echo $src_graduate | sed 's/期//')
    if [ "$found" = "y" -a "$dup" = "n" ]; then
	echo "$graduate","$src_name","$src_email","$src_message" >> tmp/new.csv
    fi
done < tmp/list.csv
