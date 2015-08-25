#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
./remove_dup.sh tmp/participant-raw.csv tmp/participant.csv 
./remove_dup.sh tmp/non-participant-raw.csv tmp/non-participant.csv 
php put_data.php tmp/participant.csv tmp/non-participant.csv 
