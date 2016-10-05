#!/bin/bash

#echo "IP=$1"
#if [ "$1" == "" ]; then
#    echo "Input IP address."
#    exit 1
#fi

mysql --host=us-cdbr-iron-east-04.cleardb.net --user=b76d4658316b72 --password=a1ab83f5 heroku_d62134a433f7447 < tt-website.sql

# ../SR/srdb.cli.php -h us-cdbr-iron-east-04.cleardb.net -n heroku_d62134a433f7447 -u b76d4658316b72 -p a1ab83f5 -s="$1:9000" -r="tt-website.herokuapp.com"
