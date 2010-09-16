<?php
/**
 * importGlobalVariable solves the different global variable names
 * in different versions of php
 * original idea by Chris Burkert
 */
function importGlobalVariable($variable)
{
	switch (strtolower($variable))
	{ case 'server' :
		if (isset($_SERVER))  { return $_SERVER; }
		else
		{ return $GLOBALS['$_SERVER']; }
		break;
		/*      case 'session' :
		 if (isset($_SESSION)) { return $_SESSION; }
		 else
		 { return $GLOBALS['HTTP_SESSION_VARS']; }
		 break;*/
	case 'post' :
		if (isset($_POST))    { return $_POST; }
		else
		{ return $GLOBALS['HTTP_POST_VARS']; }
		break;
	case 'get' :
		if (isset($_GET))     { return $_GET; }
		else
		{ return $GLOBALS['HTTP_GET_VARS']; }
		break;
	case 'cookie' :
		if (isset($_COOKIE))     { return $_COOKIE; }
		else
		{ return $GLOBALS['HTTP_COOKIE_VARS']; }
		break;
	default:return null;
	break;
	}
}

/**
 * This routine will check whether the register_globals of php is on or off.
 * If it is off, all GET,POST, and COOKIE variables will be explicitely 'globalized' here
 * Note: this uses the $$ variable which will not work in php3
 */
$reg_glob_ini=ini_get('register_globals');

if(empty($reg_glob_ini)||(!$reg_glob_ini)) {

	/* Process GET vars */

	//if(sizeof($_GET))
	if(sizeof($global_vars=&importGlobalVariable('get'))) {
		//while(list($x,$v)=each($_GET))
		while(list($x,$v)=each($global_vars)) {
			$$x=$v;
		}
		reset($global_vars);
	}

	/* Process POST vars */

	//if(sizeof($_POST))
	if(sizeof($global_vars=&importGlobalVariable('post'))) {
		//while(list($x,$v)=each($_POST))
		while(list($x,$v)=each($global_vars)) {
			$$x=$v;
		}
		//reset($_POST);
		reset($global_vars);
	}

	/* Process COOKIE vars */

	//if(sizeof($_COOKIE))
	if(sizeof($global_vars=&importGlobalVariable('cookie'))) {
		//while(list($x,$v)=each($_COOKIE))
		while(list($x,$v)=each($global_vars)) {
			$$x=$v;
		}
		//reset($_COOKIE);
		reset($global_vars);
	}

	/* Get cookie vars equivalent */
	$_COOKIE=&importGlobalVariable('cookie');

	/* Process SERVER vars */

	//if(sizeof($$_SERVER))
	if(sizeof($global_vars=&importGlobalVariable('server'))) {
		//while(list($x,$v)=each($$_SERVER))
		while(list($x,$v)=each($global_vars)) {
			$$x=$v;
		}
		//reset($$_SERVER);
		reset($global_vars);
	}

	/* Get server vars equivalent */
	$CARE_SERVER_VARS=&importGlobalVariable('server');

	/* Process SESSION vars */
	/*  if(sizeof($global_vars=&importGlobalVariable('session')))
	 {
	 //while(list($x,$v)=each($$_SERVER))
	 while(list($x,$v)=each($global_vars))
	 {
		$$x=$v;
		}
		//reset($$_SERVER);
		reset($global_vars);
		}

		*/


	//$_SESSION=&importGlobalVariable('session');

}

/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_vars_resolve.php',$_SERVER['SCRIPT_NAME']))
die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>