FROM w4af/ci_web1804-php7:latest

# Copy sqlmap test environment to /var/www
COPY docker/mysql/conf.d/mysql.cnf /etc/mysql/conf.d/mysql.cnf
COPY . /app/sqlmap
COPY ./setup_db.sh /init_mysql.sh
