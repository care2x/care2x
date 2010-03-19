<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_left_menu_url.php',$PHP_SELF)) 
	die('<meta http-equiv=\'refresh\' content=\'0; url=../\'>');
/*------end------*/

/**
* This array contains the url's of the target files of the left menu items
* each target file must correspond exactly to the menu item
* The menu items are contained in an array. These items are language
* and therefore contained in the language table file. Sample:
* language/lang_en_indexframe.php
* To integrate a new module to the main structure of the CARE insert the
* filename of the module's starting script as an additional element of the
* following array.
*/
$targetfile=array('startframe.php',
                  'patient.php',
					'aufnahme_pass.php',
					'ambulatory.php',
					'medopass.php',
					'doctors.php',
					'pflege.php',
					'op-doku.php',
					'labor.php',
					'radiolog.php',
					'apotheke.php',
					'medlager.php',
					'telesuch.php',
					'technik.php',
					'edv.php',
					'intra-email-pass.php',
					'../nocc/',
					'spediens.php',
					'login.php'
					);
?>
