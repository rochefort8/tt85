#!/bin/bash
# Export mysql data
#docker exec -t tt-website mysqldump -u root wordpress > ./mysql.dump.sql

docker exec -t tt-website /bin/bash /export_db.sh $1
mv ../wp-content/*.sql .
