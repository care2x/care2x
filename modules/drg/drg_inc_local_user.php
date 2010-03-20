<?php
#------begin------ This protection code was suggested by Luki R. luki@karet.org 
if (eregi("inc_config_color.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../../">');

# ------end-----

switch($_SESSION['sess_user_origin'])
{
	case 'nursing':
	{
		$local_user='ck_pflege_user';
		break;
	}
	case 'admission': 
	{
		$local_user='aufnahme_user';
		break;
	}
	case 'registration': 
	{
		$local_user='aufnahme_user';
		break;
	}
	default: 
	{
		$local_user='ck_op_pflegelogbuch_user';
	}
}
?>
