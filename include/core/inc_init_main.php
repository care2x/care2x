<?php
# This is the database name
$dbname='siis';

# Database user name, default is root or httpd for mysql, or postgres for postgresql
$dbusername='root';

# Database user password, default is empty char
$dbpassword='root';

# Database host name, default = localhost
$dbhost='localhost';

# First key used for simple chaining protection of scripts
$key='5.38621570795E+013';

# Second key used for accessing modules
$key_2level='5.49291213674E+012';

# 3rd key for encrypting cookie information
$key_login='4.12565406494E+012';

# Main host address or domain
$main_domain='localhost';

# Host address for images
$fotoserver_ip='localhost';

# Transfer protocol. Use https if this runs on SSL server
$httprotocol='http';

# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
$dbtype='mysql';

date_default_timezone_set("Europe/Rome");
?>
