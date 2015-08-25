#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
./remove_dup.sh  tmp/participant-raw.csv tmp/participant_a.csv 
./remove_dup.sh  tmp/non-participant-raw.csv tmp/non-participant_a.csv 
./extract_new.sh tmp/participant.csv tmp/participant_a.csv tmp/participant_delta.csv
./extract_new.sh tmp/non-participant.csv tmp/non-participant_a.csv tmp/non-participant_delta.csv
php put_data.php tmp/participant_delta.csv tmp/non-participant_delta.csv 
