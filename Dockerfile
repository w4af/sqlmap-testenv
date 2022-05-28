FROM ci_web1804-php7:latest

# Copy sqlmap test environment to /var/www
COPY . /app/sqlmap
COPY ./setup_db.sh /init_mysql.sh
