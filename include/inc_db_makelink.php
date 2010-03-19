<?php
# Set this to your database type. For details refer to ADODB manual or goto http://php.weblogs.com/ADODB/
#$dbtype='mysql';
#$dbtype='postgres7';

/*------begin------ 
* This protection code was suggested by Luki R. luki@karet.org 
*/
if (eregi('inc_db_makelink.php',$PHP_SELF)) die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(!isset($root_path)) $root_path='../'; // default language table root path is "../"
if(!isset($lang)) include($root_path.'chklang.php');
//if(!isset($dbtype) || empty($dbtype)) $dbtype='mysql';

/*********************************************************
*   the following lines establish connection to the database 
*    
*	 DO NOT EDIT 
*  	
***********************************************************/
/**
*   :::::NOTE:::::
*   The variable declarations for database access were moved in the
*   inc_init_main.php script.  If you are trying to set up
*   your database manually, edit the variable values in the inc_init_main.php script
*/

# This line loads those variables
require($root_path.'include/inc_init_main.php');

# Adjust some  db dependent sql peculiarities
# Set the "LIKE" comparison operator, postgre needs "ILIKE" for case-insensitive comparison
# Set the "no-date" value based on the dbtype, Values defined at include/inc_environment_global.php
switch($dbtype){
	case 'mysql':
                    $dbf_nodate=NODATE_MYSQL;
					$dbf_nodatetime=NODATE_MYSQL.' 00:00:00';
                    define('DBF_NODATE',NODATE_MYSQL);
					 define('DBF_NODATETIME',NODATE_MYSQL.' 00:00:00');
				    $sql_LIKE='LIKE';
				    break;
	case 'postgres7':
                     $dbf_nodate=NODATE_POSTGRE;
					$dbf_nodatetime=NODATE_POSTGRE.' 00:00:00';
					 define('DBF_NODATE',NODATE_POSTGRE);
					 define('DBF_NODATETIME',NODATE_POSTGRE.' 00:00:00');
					 $sql_LIKE = 'ILIKE';
				     break;
	case 'postgres':
                    $dbf_nodate=NODATE_POSTGRE;
					$dbf_nodatetime=NODATE_POSTGRE.' 00:00:00';
					define('DBF_NODATE',NODATE_POSTGRE);
					define('DBF_NODATETIME',NODATE_POSTGRE.' 00:00:00');
					$sql_LIKE='ILIKE';
	                break;

	default:        $dbf_nodate=NODATE_DEFAULT;
					$dbf_nodatetime=NODATE_DEFAULT.' 00:00:00';
					define('DBF_NODATE',NODATE_DEFAULT);
					define('DBF_NODATETIME',NODATE_DEFAULT.' 00:00:00');
					$sql_LIKE='LIKE';
}

# Load the db error messages lang table
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_db_msg.php')){
	include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_db_msg.php');
}else{
	include_once($root_path.'language/en/lang_en_db_msg.php');
}
	
# Establish a database link	

$dblink_ok=0;

// Metabase connection 
/*
$db_error='';
require_once($root_path.'classes/metabase/metabase_interface.php');
require_once($root_path.'classes/metabase/metabase_database.php');
$db_error=MetabaseSetupDatabaseObject(array(
            'Type'=>'mysql',
            'User'=>$dbusername,
            'Password'=>$dbpassword,
			'Host'=>$dbhost
      ),$db);
if($db_error!='') {
    echo "$LDDbNoLink: $error\n";
}
else $dblink_ok=1;
$db->SetDatabase($dbname);
*/

# Set dbtype to mysql if not set or empty
if(!isset($dbtype)||empty($dbtype)) $dbtype='mysql';

# ADODB connection
require_once($root_path.'classes/adodb/adodb.inc.php');
$db = &ADONewConnection($dbtype);

//if ($db) echo "ok"; else echo "no ok";


$dblink_ok = $db -> Connect($dbhost,$dbusername,$dbpassword,$dbname);

//if($dblink_ok) echo "db ok"; else echo "no link";

# Establish a link
# Native mySQL connection
# Temporary active for the transition phase from 1.0.03 to 1.0.04
# this will be deactivated or totally removed in later versions
/*
if ($link=mysql_connect($dbhost,$dbusername,$dbpassword)){
	if(mysql_select_db($dbname,$link)){
		$DBLink_OK=1;
	}else{
		$DBLink_OK=0;
	}
}
*/
# Load the database functions
require_once($root_path.'include/inc_db_fx.php');
?>
