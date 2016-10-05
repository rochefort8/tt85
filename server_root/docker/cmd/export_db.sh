#!/bin/bash
# Export mysql data
docker exec -t tt-server mysqldump -u root db > ./web_list/data/mysql.dump.sql
