<?php
# This is the database name
$dbname='';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='';

# Database user password, default is empty char
$dbpassword='';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='1.0728840012115E+28';

# Second key used for accessing modules
$key_2level='3.6785501427953E+27';

# 3rd key for encrypting cookie information
$key_login='5.3183191207469E+26';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';

# Set this to your timezone.
$timezone = 'Africa/Abidjan';
date_default_timezone_set($timezone);
?>