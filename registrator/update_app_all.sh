#!/bin/sh

rm -rf app_tmp/*.txt
php get_email_data_for_app.php
./create_csv_for_app.sh
./remove_dup.sh app_tmp/participant-raw.csv app_tmp/participant.csv 
php put_data_for_app.php app_tmp/participant.csv app_tmp/non-participant.csv 
