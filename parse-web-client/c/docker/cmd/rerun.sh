# Export mysql data
cmd/export_db.sh $1

# Rebuild
rm -rf ../wp-content/plugins/siteguard/really-simple-captcha/tmp/*
docker build -t tt-website ..


# Shutdown and start
docker rm -f tt-website
docker run -d -p 9000:80 -v $(pwd)/../wp-content:/app/wp-content --name=tt-website tt-website
