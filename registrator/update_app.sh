#!/bin/sh

workdir=$(dirname $0)
cd $workdir

rm -rf app_tmp/*.txt
php get_email_data_for_app.php
./create_csv_for_app.sh
./remove_dup.sh  app_tmp/participant-raw.csv app_tmp/participant_a.csv 
./extract_new.sh app_tmp/participant.csv app_tmp/participant_a.csv app_tmp/participant_delta.csv

if [ -f app_tmp/participant_delta.csv  ]; then

    if [ ! -f app_tmp/participant_delta.csv ]; then
	touch app_tmp/participant_delta.csv 
    fi
    
    echo "New data."
    mv app_tmp/participant_a.csv app_tmp/participant.csv 
    php put_data_for_app.php app_tmp/participant_delta.csv app_tmp/non-participant_delta.csv 

else
    echo "No new data"
fi
