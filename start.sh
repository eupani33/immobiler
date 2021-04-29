#! /bin/bash
/Applications/MAMP/bin/stopApache.sh
/Applications/XAMPP/xamppfiles/xampp stop
killall httpd
killall mysqld
killall mysqld_safe
symfony serve -d
/Applications/MAMP/bin/startMysql.sh
exit 0

