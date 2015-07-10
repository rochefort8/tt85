#!/bin/sh

rm -rf tmp/*.txt
php get_email_data.php
./create_csv.sh
./compare.sh

if [ -e "tmp/new.csv" ]; then
    php put_new_data.php
fi

exit 0
