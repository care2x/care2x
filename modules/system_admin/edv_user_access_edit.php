<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR ) ;
require ('./roots.php') ;
require ($root_path . 'include/inc_environment_global.php') ;
/**
 * CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
 * GNU General Public License
 * Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
$lang_tables [] = 'access.php' ;
define ( 'LANG_FILE', 'edp.php' ) ;
$local_user = 'ck_edv_user' ;
require_once ($root_path . 'include/inc_front_chain_lang.php') ;
///$db->debug=true;
/**
 * The following require loads the access areas that can be assigned for
 * user permissions.
 */
require ($root_path . 'include/inc_accessplan_areas_functions.php') ;

$breakfile = 'edv-system-admi-welcome.php' . URL_APPEND ;
$returnfile = $_SESSION [ 'sess_file_return' ] . URL_APPEND ;
$_SESSION [ 'sess_file_return' ] = basename ( __FILE__ ) ;

//gjergji : load the department list
require_once ($root_path . 'include/care_api_classes/class_department.php') ;
$dept_obj = new Department ( ) ;
$deptarray = $dept_obj->getAllActiveSort ( 'name_formal' ) ;

//gjergji : load the access roles
require_once($root_path.'include/care_api_classes/class_access.php');
$role_obj = & new Access();
$roles = $role_obj->loadAllRoles();

$edit = 0 ;
$error = 0 ;

if (! isset ( $mode ))
	$mode = '' ;
if (! isset ( $errorname ))
	$errorname = '' ;
if (! isset ( $erroruser ))
	$erroruser = '' ;
if (! isset ( $username ))
	$username = '' ;
if (! isset ( $userid ))
	$userid = '' ;
if (! isset ( $errorpass ))
	$errorpass = '' ;
if (! isset ( $pass ))
	$pass = '' ;
if (! isset ( $errorbereich ))
	$errorbereich = '' ;
if (! isset ( $dept_nr ))
	$dept_nr = '0' ;

if ($mode != '') {
	if ($mode != 'edit' && $mode != 'update' && $mode != 'data_saved') {
		/* Trim white spaces off */
		$username = trim ( $username ) ;
		$userid = trim ( $userid ) ;
		$pass = trim ( $pass ) ;
		
		if ($username == '') {
			$errorname = 1 ;
			$error = 1 ;
		}
		if ($userid == '') {
			$erroruser = 1 ;
			$error = 1 ;
		}
		if ($pass == '') {
			$errorpass = 1 ;
			$error = 1 ;
		}
	}
	
	if (($mode == 'save' && ! $error) || ($mode == 'update' && ! $erroruser)) {
		
		/* Prepare the permission codes */
		
/*		$p_areas = '' ;
		
		while ( list ( $x, $v ) = each ( $_POST ) ) {
			if (! ereg ( '_a_', $x ))
				continue ;
			
			if ($_POST [ $x ] != '')
				$p_areas .= $v . ' ' ;
		}*/
		/* If permission area is available, save it */
		if ($selected_role != '') {
			///$db->debug=true;
			if ($mode == 'save') {
				$sql = "INSERT INTO care_users (
						   name,
						   login_id,
						   password,
						   permission,
						   personell_nr,
						   s_date,
						   s_time,
						   dept_nr,
						   user_role,
						   status,
						   modify_id,
						   create_id,
						   create_time
						 ) VALUES (
						   '" . addslashes ( $username ) . "',
						   '" . addslashes ( $userid ) . "',
						   '" . md5 ( $pass ) . "',
						   '" . $permission . "',
						   '" . (( int ) $personell_nr) . "',
						   '" . date ( 'Y-m-d' ) . "',
						   '" . date ( 'H:i:s' ) . "',
						   '" .  serialize($dept_nr)  . "',
						   '" . $selected_role . "',
						   'normal',
						   '',
						   '" . $_SESSION [ 'sess_user_name' ] . "',
						   '" . date ( 'YmdHis' ) . "'
						 )" ;
			
			} else {
				$sql = "UPDATE care_users SET permission='$permission', dept_nr='" . serialize($dept_nr) ."', user_role ='$selected_role' ,modify_id='" . $_COOKIE [ $local_user . $sid ] . "'  WHERE login_id='$userid'" ;
			}
			
			/* Do the query */
			$db->BeginTrans () ;
			$ok = $db->Execute ( $sql ) ;
			if ($ok && $db->CommitTrans ()) {
				//echo $sql;
				header ( 'Location:edv_user_access_edit.php' . URL_REDIRECT_APPEND . '&userid=' . strtr ( $userid, ' ', '+' ) . '&mode=data_saved' ) ;
				exit () ;
			} else {
				$db->RollbackTrans () ;
				if ($mode != 'save')
					$edit = 1 ;
				$mode = 'error_double' ;
			}
		} else {
			if ($mode != 'save')
				$edit = 1 ;
			$mode = 'error_noareas' ;
		} // end if ($p_areas!="")
	} // end of if($mode=="save"
	

	if ($mode == 'edit' || $mode == 'data_saved' || $edit) {
		$sql = "SELECT name, login_id, permission, dept_nr,user_role FROM care_users WHERE login_id='$userid'" ;
		if ($ergebnis = $db->Execute ( $sql )) {
			if ($ergebnis->RecordCount ()) {
				$user = $ergebnis->FetchRow () ;
				$edit = 1 ;
			}
		}
	}
}

# Start Smarty templating here
/**
 * LOAD Smarty
 */
# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme


require_once ($root_path . 'gui/smarty_template/smarty_care.class.php') ;
$smarty = new smarty_care ( 'system_admin' ) ;

# Title in toolbar
$smarty->assign ( 'sToolbarTitle', $LDManageAccess ) ;

# href for return button
$smarty->assign ( 'pbBack', $returnfile ) ;

# href for help button
$smarty->assign ( 'pbHelp', "javascript:gethelp('edp.php','access','$mode')" ) ;

# href for close button
$smarty->assign ( 'breakfile', $breakfile ) ;

# Window bar title
$smarty->assign ( 'sWindowTitle', $LDManageAccess ) ;

# Buffer page output


ob_start () ;
?>
<ul>

<?php
if (($mode != '' || $error) && $mode != 'edit') {
	
	?>
<table border=0>
		<tr>
			<td><img
				<?php
	echo createMascot ( $root_path, 'mascot1_r.gif', '0', 'bottom' ) ?>
				align="absmiddle"></td>
			<td class="warnprompt">
	<?php
	if ($error)
		echo $LDInputError ; elseif ($mode == 'data_saved')
		echo $LDUserInfoSaved ; elseif ($mode == 'error_save')
		echo $LDUserInfoNoSave ; elseif ($mode == 'error_noareas')
		echo $LDNoAreas ; elseif ($mode == 'error_double')
		echo $LDUserDouble ;
	?></td>
		</tr>
	</table>
<?php
}
?>
<FONT class="prompt">
<?php

if (($mode == "") and ($remark != 'fromlist')) {
	$gtime = date ( 'H.i' ) ;
	if ($gtime < '9.00')
		echo $LDGoodMorning ;
	if (($gtime > '9.00') and ($gtime < '18.00'))
		echo $LDGoodDay ;
	if ($gtime > '18.00')
		echo $LDGoodEvening ;
	echo ' ' . $_COOKIE [ $local_user . $sid ] ;
}
?>
</FONT>
<p>
	
	
	<FORM action="edv_user_access_list.php" name="all">
		<input type="hidden" name="sid" value="<?php echo $sid ; ?>"> 
		<input type="hidden" name="lang" value="<?php echo $lang ; ?>"> 
		<input type="submit" name=message value="<?php echo $LDListActual ?>">
	</FORM>
	<p>
	
	
	<form method="post" action="edv_user_access_edit.php" name="user">
		<input type="image" <?php echo createLDImgSrc ( $root_path, 'savedisc.gif', '0', 'absmiddle' ) ?>>

<?php
if ($mode == 'data_saved' || $edit) {
	echo '<input type="button" value="' . $LDEnterNewUser . '" onClick="javascript:window.location.href=\'edv_user_access_edit.php' . URL_REDIRECT_APPEND . '&remark=fromlist\'">' ;
}
?>
<input type="button" value="<?php
echo $LDFindEmployee ;
?>"
		onClick="javascript:window.location.href='edv_user_search_employee.php<?php
		echo URL_REDIRECT_APPEND ;
		?>&remark=fromlist'">

	<table border=0 bgcolor="#000000" cellpadding=0 cellspacing=0>
		<tr>
			<td>

			<table border="0" cellpadding="5" cellspacing="1">

				<tr bgcolor="#dddddd">
					<td colspan="3">
<?php
echo $LDNewAccess ?>:
</td>
</tr>

<tr bgcolor="#dddddd">
	<td>
	<input type=hidden name=route value=validroute>
<?php
if ($errorname) {
	echo "<font color=red > <b>$LDName</b>" ;
} else {
	echo $LDName ;
}
?>

<?php

if ($edit) {
	echo '<input type="hidden" name="username" value="' . $user [ 'name' ] . '">' . '<b>' . $user [ 'name' ] . '</b>' ;
} elseif (isset ( $is_employee ) && $is_employee) {
	?>  
    <input name="username" type="hidden"
    <?php
	if ($username != "")
    		echo ' value="' . $username . '"><br><b>' . $username . '</b>' ; 
    	else
		echo '>' ;
} else {
	?>
	<input name="username" type="text" <?php if ($username != "")  echo ' value="' . $username . '"' ; ?>>
<?php
}
?>

<br>
</td>
<td>
<?php
if ($erroruser) {
	echo "<font color=red > <b>$LDUserId</b>" ;
} else {
	echo $LDUserId ;
}
?>

<?php
if ($edit)
	echo '<input type="hidden" name="userid" value="' . $user [ 'login_id' ] . '">' . '<b>' . $user [ 'login_id' ] . '</b>' ; else {
	?> 
	<input type=text name="userid" <?php if ($userid != "") echo 'value="' . $userid . '"' ; 	?>>
	<?php
}
?>

<br>
</td>
<td>
<?php
if ($errorpass) {
	echo "<font color=red > <b>$LDPassword</b>" ;
} else {
	echo $LDPassword ;
}
?>

<?php
if ($edit)
	echo '<input type="hidden" name="pass" value="*">****' ; else {
	?>
	<input type="password" name="pass" <?php if ($pass != "") echo "value=" . $pass ; ?>>
	<?php
}
?>

<br>
</td>
</tr>
<tr bgcolor="#dddddd">
<td valign="top"><b> <?php echo $LDRole ?> : </b> 
   	<select name="permission"> 
		<?php
		while ( list( $x, $v ) = each( $roles ) ) {
			?>
		   	<option value="<?php echo $v['permission'] ?>" onclick="document.getElementById('selected_role').value = <?php echo $v['id'] ?>;"<?php 
		   		if ($v['id'] ==  $user['user_role'] ) echo ' selected' ?>>
		 	<?php
				echo $v['role_name'] ;
			?>
			</option>
		<?php
		}
		?>
	</select>
</td>
<td colspan="2"><b> <?php echo $LDDept ?> : </b><br>
<?php 
while(list($x,$dept)=each($deptarray)){
	$actualDept = unserialize($user['dept_nr']);
	$subDepts = $dept_obj->getAllSubDepts($dept['nr']);
?>
   	<input type="checkbox" name="dept_nr[]" id="<?php echo $dept['nr'] ?>" value="<?php echo $dept['nr']?>" <?php if( in_array($dept['nr'],$actualDept)) echo 'checked' ?>>
 <?php 
		if(isset($$dept['LD_var'])&&!empty($$dept['LD_var'])) echo $$dept['LD_var'] . '<br>';
				else echo $dept['name_formal'] . '<br>';
		if($subDepts) {
			while (list($y,$sDept) = each($subDepts)) {
    			?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>L</sup>&nbsp; 
    			<input type="checkbox" name="dept_nr[]" id="<?php echo $sDept['nr'] ?>" value="<?php echo $sDept['nr']?>" <?php if( in_array($sDept['nr'],$actualDept)) echo 'checked' ?>>
        		<?php 
        			if(isset($$sDept['LD_var'])&&!empty($$sDept['LD_var'])) echo $$sDept['LD_var'] . '<br>';
        			else echo $sDept['name_formal'] . '<br>';
			}
		}
}
?>
</td>
</tr>
<tr bgcolor="#dddddd">
<td colspan=3>
<p>
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr ; ?>">
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="sid" value="<?php echo $sid ; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ; ?>">
<?php 
	reset($roles);
	echo '<input type="hidden" name="selected_role" id="selected_role"';
    $found = false;
	while ( list( $x, $v ) = each( $roles ) ) { 
    	if ($v['id'] ==  $user['user_role'] ) {
    		echo ' value="'.$v['id'].'">';
    		$found = true;
    	}	
    }
    if($found == false) echo ' value="">';
?>

<input type="hidden" name="mode" value="<?php
if ($edit || $mode == 'data_saved' || $mode == 'edit')
	echo 'update' ; else
	echo 'save' ;
?>">
<input type="image"  <?php
echo createLDImgSrc ( $root_path, 'savedisc.gif', '0', 'absmiddle' ) ?>>
 <input type="reset"  value="<?php
echo $LDReset ?>"> 
</td>
</tr>
</table>
	
	</td>
  </tr>
</table>

</form>

<p>
<a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc ( $root_path, 'cancel.gif', '0' ) ?> alt="<?php echo $LDCancel ?>" align="middle"></a>

</ul>

<?php

$sTemp = ob_get_contents () ;
ob_end_clean () ;

# Assign page output to the mainframe template


$smarty->assign ( 'sMainFrameBlockData', $sTemp ) ;
/**
 * show Template
 */
$smarty->display ( 'common/mainframe.tpl' ) ;

?>