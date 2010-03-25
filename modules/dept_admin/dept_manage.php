<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define ( 'LANG_FILE', 'edp.php' );
$local_user = 'ck_edv_user';
require_once ($root_path . 'include/core/inc_front_chain_lang.php');

$breakfile = $root_path . 'modules/system_admin/edv-system-admi-menu.php' . URL_APPEND;
$title = $LDDeptAdmin;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php
html_rtl ( $lang );
?>
<HEAD>
<?php
echo setCharSet ();
?>


<?php
require ($root_path . 'include/core/inc_js_gethelp.php');
require ($root_path . 'include/core/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	<?php
	if (! $cfg ['dhtml']) {
		echo 'link=' . $cfg ['body_txtcolor'] . ' alink=' . $cfg ['body_alink'] . ' vlink=' . $cfg ['body_txtcolor'];
	}
	?>>
<?php
echo $test?>
 //foreach($argv as $v) echo "$v "; <?php
?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
	<tr valign=top>
		<td bgcolor="<?php
		echo $cfg ['top_bgcolor'];
		?>" height="10"><FONT
			COLOR="<?php
			echo $cfg ['top_txtcolor'];
			?>" SIZE=+2 FACE="Arial"><STRONG> &nbsp; <?php
			echo $title?></STRONG></FONT></td>
		<td bgcolor="<?php
		echo $cfg ['top_bgcolor'];
		?>" height="10"
			align=right>
<?php
if ($cfg ['dhtml'])
	echo '<a href="javascript:window.history.back()"><img ' . createLDImgSrc ( $root_path, 'back2.gif', '0' ) . '  class="fadeOut" >';
?></a><a
			href="javascript:gethelp('dept_manage.php')"><img
			<?php
			echo createLDImgSrc ( $root_path, 'hilfe-r.gif', '0' )?>
			<?php
			if ($cfg ['dhtml'])
				echo 'class="fadeOut" >';
			?>/></a><a
			href="<?php
			echo $breakfile;
			?>"><img
			<?php
			echo createLDImgSrc ( $root_path, 'close2.gif', '0' )?>
			alt="<?php
			echo $LDCloseAlt?>"
			<?php
			if ($cfg ['dhtml'])
				echo 'class="fadeOut" >';
			?>/></a></td>
	</tr>
	<tr valign=top>
		<td bgcolor=<?php
		echo $cfg ['body_bgcolor'];
		?> valign=top colspan=2>

		<FONT face="Verdana,Helvetica,Arial" size=2>

		<p><br>
		
		
		<table border=0 cellpadding=5>
			<!--     <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?php
						echo $LDOption?></b></td>
      <td >&nbsp;</td>
    </tr> -->
			<tr>
				<td></td>
				<td valign=top><FONT face="Verdana,Helvetica,Arial" size=2><a
					href="dept_new.php?sid=<?php
					echo $sid?>&mw=1<?php
					echo "&lang=$lang&station=$ck_thispc_station&name=$ck_thispc_dept"?>"><b><?php
					echo $LDCreate?></b></a><br>
	  		&nbsp;<?php
					echo $LDNewDept?><p>
			<?php
			if ($ck_thispc_station)
				$mode = "show";
			?>
			<a
					href="dept_list.php?sid=<?php
					echo "$sid&lang=$lang&mode=$mode&dept_nr=4"?>"><b><?php
					echo $LDShowDeptInfo?></b></a><br>
			<?php
			echo $LDShowDeptInfoTxt?>
				
				
				<p><a href="dept_list_config.php<?php
				echo URL_APPEND;
				?>"><b><?php
				echo $LDConfigOptions?></b></a><br>
			<?php
			echo $LDDeptConfigOptions?>
			</td>
				<td></td>
			</tr>
		</table>

		</FONT>
		<p>
		
		
		<ul>
			<a href="<?php
			echo $breakfile?>"><img
				<?php
				echo createLDImgSrc ( $root_path, 'cancel.gif', '0' )?> border="0"></a>
		</ul>
		</td>
	</tr>
	<tr>
		<td bgcolor="<?php
		echo $cfg ['bot_bgcolor'];
		?>" colspan=2>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</td>
	</tr>
</table>
&nbsp;




</FONT>


</BODY>
</HTML>
