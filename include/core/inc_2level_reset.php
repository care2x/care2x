<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_2level_reset.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
/** 
* This resets all cookies involved in the second level script lock
*/
$cookie_2level=array('ck_cafenews_user',
                                 'ck_editor_user',
								 'ck_apo_db_user',
								 'ck_apo_arch_user',
								 'phonedir_user',
								 'aufnahme_user',
								 'medocs_user',
								 'ck_doctors_diensplan_user',
								 'ck_lab_user',
								 'ck_amb_user',
								 'ck_prod_order_user',
								 'ck_prod_arch_user',
								 'ck_prod_db_user',
								 'ck_edv_user',
								 'ck_intra_email_user',
								 'ck_fotolab_user',
								 'ck_pflege_user',
								 'currentuser',
								 'ck_op_dienstplan_user',
								 'ck_radio_user',
								 'ck_supplier_db_user'
								 );
								 
for($i=0;$i<sizeof($cookie_2level); $i++)
{
	if(!empty($_COOKIE[$cookie_2level[$i].$sid])) setcookie($cookie_2level[$i].$sid,'',0,'/');
	//if(isset($_COOKIE[$cookie_2level[$i].$sid])) setcookie($cookie_2level[$i].$sid);
} 
?>
