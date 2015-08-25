#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
./remove_dup.sh  tmp/participant-raw.csv tmp/participant_a.csv 
./remove_dup.sh  tmp/non-participant-raw.csv tmp/non-participant_a.csv 
./extract_new.sh tmp/participant.csv tmp/participant_a.csv tmp/participant_delta.csv
./extract_new.sh tmp/non-participant.csv tmp/non-participant_a.csv tmp/non-participant_delta.csv

if [ -f tmp/non-participant_delta.csv -o -f tmp/participant_delta.csv ]; then
    echo "New data."
    mv tmp/participant_a.csv tmp/participant.csv 
    mv tmp/non-participant_a.csv tmp/non-participant.csv 

    php put_data.php tmp/participant_delta.csv tmp/non-participant_delta.csv 

else
    echo "No new data"
fi
