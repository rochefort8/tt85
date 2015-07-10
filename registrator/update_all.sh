#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
cp tmp/list.csv tmp/new.csv
php put_data.php
