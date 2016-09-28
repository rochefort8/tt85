# Export mysql data


mysqldump -u root wordpress > /mysql.dump.sql
cp /mysql.dump.sql /app/wp-content/mysql.dump.sql
chmod 666 /app/wp-content/mysql.dump.sql

echo "docker:IP=$1"
if [ "$1" == "" ]; then
    echo "No IP address specified, skip convert.."
    exit 0
fi

/create_db.sh tt

sleep 2
# tt-website
/app/SR/srdb.cli.php -h localhost -n tt -u root -p "" -s="$1:9000" -r="tt-website.herokuapp.com"
mysqldump -u root tt > /app/wp-content/tt-website.sql

sleep 2
# tochikukai
/app/SR/srdb.cli.php -h localhost -n tt -u root -p "" -s="tt-website.herokuapp.com" -r="tochikukai.com"
mysqldump -u root tt > /app/wp-content/tochikukai.sql

chmod 666 /app/wp-content/*.sql

