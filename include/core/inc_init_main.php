<?php
# This is the database name
$dbname='care2x';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='root';

# Database user password, default is empty char
$dbpassword='omu2tbdf';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='9.1416706867656E+27';

# Second key used for accessing modules
$key_2level='1.8072936914435E+28';

# 3rd key for encrypting cookie information
$key_login='2.0810631007321E+25';

# Main host address or domain
$main_domain='localhost/care2x/';

# Host address for images
$photoserver_ip='localhost/care2x/';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='https';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysqli';

# Set this to your timezone.
$timezone = 'Africa/Abidjan';
date_default_timezone_set($timezone);

//For production server
$ErrorLevel = E_ERROR | E_WARNING | E_PARSE | E_NOTICE;

//For development
//$ErrorLevel = -1;

?>
