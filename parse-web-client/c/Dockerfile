FROM tutum/lamp:latest
MAINTAINER Fernando Mayo <fernando@tutum.co>, Feng Honglin <hfeng@tutum.co>

# Add database setup script
ADD ./docker/create_mysql_admin_user.sh /create_mysql_admin_user.sh
ADD ./docker/create_db.sh /create_db.sh

# Modify permissions to allow plugin upload
RUN chown -R www-data:www-data /app /var/www/html

CMD ["/run.sh"]
