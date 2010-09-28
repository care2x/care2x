<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],"inc_init_crypt.php")) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/**
* This initializes the hcemd5 crypt function
*/

function makeRand()
{
    srand((double)microtime()*32767);
    $rand = rand(1, 32767);
    return pack('i*', $rand);
}

/**
* NOTE!!!  The variable declarations for the chaining keys were moved 
* to the inc_init_main.php   script since beta 1.0.04. 
* If you want to manually change the
* keys please open the inc_init_main.php script.
*/

/*if(defined('FROM_ROOT')&&FROM_ROOT==1)
{
   include_once($root_path.'classes/pear/crypt/hcemd5.php');
   include_once($root_path.'include/core/inc_init_main.php');   // This loads the chaining keys
}
 else*/
{
   include_once($root_path.'classes/pear/crypt/hcemd5.php');
   include_once('inc_init_main.php');   // This loads the chaining keys
}


/**
* The INIT_DECODE  must be defined at the calling script before including this script
* INIT_DECODE=1  // will not start creation of random key and create decoder object
* INIT_DECODE= undefined or not 1 // will start creation of random key and create encoder object
*/
if(defined('INIT_DECODE')&&INIT_DECODE==1)
{
    $dec_hcemd5 = new Crypt_HCEMD5($key, '');
}
else
{  
    $enc_hcemd5 = new Crypt_HCEMD5($key, makeRand());
}
?>
