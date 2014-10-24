<?php
define ( 'ROW_MAX', 15 ) ; # define here the maximum number of rows for displaying the parameters


error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR ) ;
require ('./roots.php') ;
require ($root_path . 'include/core/inc_environment_global.php') ;
/**
 * CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
 * GNU General Public License
 * Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define ( 'LANG_FILE', 'lab.php' ) ;
$local_user = 'ck_lab_user' ;
require_once ($root_path . 'include/core/inc_front_chain_lang.php') ;

$thisfile = basename ( __FILE__ ) ;

///$db->debug=true;


# Create lab object
require_once ($root_path . 'include/care_api_classes/class_lab.php') ;
$lab_obj = new Lab ( ) ;

# Load the date formatter */
include_once ($root_path . 'include/core/inc_date_format_functions.php') ;

if (isset ( $mode ) && ! empty ( $mode )) {
	if ($mode == 'save') {
		# Save the nr	
		if (empty ( $_POST [ 'status' ] ))
			$_POST [ 'status' ] = ' ' ;
		$_POST [ 'modify_id' ] = $_SESSION [ 'sess_user_name' ] ;
		$_POST [ 'id' ] = strtolower ( $_POST [ 'id' ] ) ;
		$_POST [ 'history' ] = $lab_obj->ConcatHistory ( "Update " . date ( 'Y-m-d H:i:s' ) . " " . $_SESSION [ 'sess_user_name' ] . "\n" ) ;
		# Set to use the test params
		$lab_obj->useTestParams () ;
		# Point to the data array
		//print_r($_POST);
		$lab_obj->setDataArray ( $_POST ) ;
		
		if ($lab_obj->updateDataFromInternalArray ( $_POST [ 'nr' ] )) {
			?>

<script language="JavaScript">
	<!-- Script Begin
	window.opener.location.reload();
	window.close();
	//  Script End -->
	</script>

<?php
			exit () ;
		} else
			echo $lab_obj->getLastQuery () ;
		# end of if(mode==save)
	}
	# begin mode new 	
	if ($mode == 'savenew') {
		# Save the nr	
		if (empty ( $_POST [ 'status' ] ))
			$_POST [ 'status' ] = ' ' ;
		$_POST [ 'modify_id' ] = $_SESSION [ 'sess_user_name' ] ;
		$_POST [ 'group_id' ] = '-1' ;
		$_POST [ 'sort_nr' ] = rand ( 1, 99 ) ;
		$_POST [ 'id' ] = str_replace ( " ", "_", strtolower ( $_POST [ 'name' ] ) ) ;
		$_POST [ 'history' ] = $lab_obj->ConcatHistory ( "Created " . date ( 'Y-m-d H:i:s' ) . " " . $_SESSION [ 'sess_user_name' ] . "\n" ) ;
		# Set to use the test params
		$lab_obj->useTestParams () ;
		# Point to the data array
		$lab_obj->setDataArray ( $_POST ) ;
		if ($lab_obj->insertDataFromInternalArray ()) {
			
			?>

<script language="JavaScript">
	<!-- Script Begin
	window.opener.location.reload();
	window.close();
	//  Script End -->
	</script>

<?php
			exit () ;
		} else
			echo $lab_obj->getLastQuery () ;
		# end of if(mode==new)		
	}
}
//gjergji : i get the groups here...
if ($mode != 'new')
	if ($tgroups = &$lab_obj->TestGroups ( $nr ))
		$tg = $tgroups->FetchRow () ;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php
html_rtl ( $lang ) ;
?>
<HEAD>
<?php
echo setCharSet () ;
?>
 <TITLE>Konfigurimi i Grupeve</TITLE>

<script language="javascript" name="j1">
<!--        
function editGroup(nr)
{
	urlholder="labor_test_group_edit?sid=<?php
	echo "$sid&lang=$lang" ?>&nr="+nr;
	editgroup_<?php
	echo $sid ?>=window.open(urlholder,"editgroup_<?php
	echo $sid ?>","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php
require ($root_path . 'include/core/inc_js_gethelp.php') ;
require ($root_path . 'include/core/inc_css_a_hilitebu.php') ;
?>
<style type="text/css" name="1">
.va12_n {
	font-family: verdana, arial;
	font-size: 12;
	color: #000099
}

.a10_b {
	font-family: arial;
	font-size: 10;
	color: #000000
}

.a12_b {
	font-family: arial;
	font-size: 12;
	color: #000000
}

.a10_n {
	font-family: arial;
	font-size: 10;
	color: #000099
}
</style>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	<?php
	
	if (! $cfg [ 'dhtml' ]) {
		echo 'link=' . $cfg [ 'body_txtcolor' ] . ' alink=' . $cfg [ 'body_alink' ] . ' vlink=' . $cfg [ 'body_txtcolor' ] ;
	}
	?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

	<tr>
		<td bgcolor="<?php
		echo $cfg [ 'top_bgcolor' ] ;
		?>"><FONT
			COLOR="<?php
			echo $cfg [ 'top_txtcolor' ] ;
			?>" SIZE=+2 FACE="Arial"><STRONG> &nbsp;
<?php
echo $tg [ 'name' ] ;
?>
 </STRONG></FONT></td>
		<td bgcolor="<?php
		echo $cfg [ 'top_bgcolor' ] ;
		?>" height="10"
			align=right><nobr><a href="javascript:gethelp('lab_param_edit.php')"><img
			<?php
			echo createLDImgSrc ( $root_path, 'hilfe-r.gif', '0' ) ?>
			<?php
			if ($cfg [ 'dhtml' ])
				echo 'class="fadeOut" >' ;
			?></a><a
			href="javascript:window.close()"><img
			<?php
			echo createLDImgSrc ( $root_path, 'close2.gif', '0' ) ?>
			<?php
			if ($cfg [ 'dhtml' ])
				echo 'class="fadeOut" >' ;
			?></a></nobr></td>
	</tr>
	<tr align="center">
		<td bgcolor=#dde1ec colspan=2><FONT SIZE=-1 FACE="Arial">


		<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1
			width="100%">
			<tr>
				<td bgcolor=#ff0000 colspan=2><FONT SIZE=2 FACE="Verdana,Arial"
					color="#ffffff"> <b>
<?php
echo $tg [ 'name' ] ;
?>
</b></td>
			</tr>
			<tr>
				<td colspan=2>

				<form action="<?php
				echo $thisfile ;
				?>" method="post"
					name="groupedit">

<?php

$toggle = 0 ;
echo '<table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;' . $LDGroup . '</td>
			<td bgcolor="' . $bgc . '"  class="a12_b"><input type="text" name="name" size=15 maxlength=15 value="' . $tg [ 'name' ] . '">&nbsp;
			</td></tr>
			' ;
echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;' . $LDShowParam . '</td>
			<td bgcolor="' . $bgc . '"  class="a12_b">
			<select name="status">
			  <option value="">' . $LDShow . '</option>
			  <option value="hidden"' ;
if ($tg [ 'status' ] == 'hidden')
	echo "selected" ;
echo '>' . $LDHide . '</option>
			  <option value="deleted"' ;
if ($tg [ 'status' ] == 'deleted')
	echo "selected" ;
echo '>' . $LDDelete . '</option>' ;
echo '</select>
			</td></tr>' ;
echo '</td></tr></table>
			' ;
?>

<input type=hidden name="nr" value="<?php
echo $nr ;
?>"> <input
					type=hidden name="sid" value="<?php
					echo $sid ;
					?>"> <input
					type=hidden name="lang" value="<?php
					echo $lang ;
					?>">
<?php
if ($mode == 'new') {
	?>
<input type=hidden name="mode" value="savenew">
<?php
} else {
	?>
<input type=hidden name="mode" value="save">
<?php
}
?>
<input type="image"
					<?php
					echo createLDImgSrc ( $root_path, 'savedisc.gif', '0' ) ?>>
				
				</td>
			</tr>

		</table>

		</form>

		</FONT>
		<p>
		
		</td>

	</tr>
</table>

</BODY>
</HTML>
