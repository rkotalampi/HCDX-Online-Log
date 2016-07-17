#!/bin/sh

echo Set up DNS name for the server
echo Go to your DNS provider.
echo What is the name of the server?
read DNS
echo What is the admin email address for this service?
read ADMIN

export ROOT=`pwd`

yum -y install mysql-server httpd php git mariadb-server

if [ ! -d /usr/local ]; then
mkdir /usr/local
fi

cd /usr/local/; git clone https://github.com/rkotalampi/HCDX-Online-Log.git

service mariadb start

cd /usr/local/HCDX-Online-Log/; mysql HCDX -p < init_db.sql
cat /usr/local/HCDX-Online-Log/online-log.conf| sed -e s/DNS/$DNS/g | sed -e s/ADMIN/$ADMIN/g | sed -e s/ROOT/$ROOT/g > /etc/httpd/conf.d/online-log.conf
service httpd restart


