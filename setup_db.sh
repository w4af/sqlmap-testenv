#!/bin/bash

echo "Starting mysql server..."
/usr/bin/mysqld_safe > /dev/null 2>&1 &

RET=1
while [[ RET -ne 0 ]]; do
    echo "=> Waiting for confirmation of MySQL service startup"
    sleep 5
    mysql -uroot -e "status" > /dev/null 2>&1
    RET=$?
done
echo "mysql server running"

echo "Importing mysql schema..."
mysql -uroot < /var/www/html/sqlmap/schema/mysql.sql
echo "Imported schema"

echo "Stopping mysql server..."
mysqladmin -uroot shutdown
echo "Mysql server shutdown"

