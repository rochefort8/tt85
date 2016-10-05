FROM tutum/lamp:latest
MAINTAINER Fernando Mayo <fernando@tutum.co>, Feng Honglin <hfeng@tutum.co>

# Modify permissions to allow plugin upload
RUN chown -R www-data:www-data /app /var/www/html

# Add database setup script
ADD ./web_list/data/mysql.dump.sql /mysql.dump.sql

ADD ./docker/create_mysql_admin_user.sh /create_mysql_admin_user.sh
ADD ./docker/create_db.sh /create_db.sh
RUN chmod +x /*.sh

CMD ["/run.sh"]
