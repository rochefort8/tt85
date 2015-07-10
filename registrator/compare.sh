#!/bin/sh

rm -rf tmp/new.csv

date=$(date)

if [ -f data/list.csv ]; then
    diff=$(diff data/list.csv tmp/list.csv)
    if [ "$diff" = "" ]; then
	echo "$date : No updates" ;
	exit 0 ;
    fi
else 
    touch data/list.csv
fi

diff tmp/list.csv data/list.csv | grep "< " | cut -d" " -f2-  > tmp/new.csv

cp tmp/list.csv data/list.csv
echo "$date : New data found." ;

cat tmp/new.csv

exit 0
