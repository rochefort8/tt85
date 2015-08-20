#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
./remove_dup.sh
php put_data.php
