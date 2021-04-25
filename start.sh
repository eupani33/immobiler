#! /bin/bash
sudo /Applications/XAMPP/xamppfiles/xampp stop
sudo killall httpd
sudo killall mysqld
sudo killall mysqld_safe
symfony serve -d
/Applications/MAMP/bin/startMysql.sh
exit 0
