<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_core.php');
$core=& new Core();

$breakfile='edv-system-admi-welcome.php'.URL_APPEND.'&target=currency_admin';
$thisfile='edv_system_format_currency_add.php';
if($from=='set') $returnfile='edv_system_format_currency_set.php'.URL_APPEND.'&from=add';
 else $returnfile=$breakfile;

$dbtable='care_currency';
//$db->debug=1;

if(($mode=='save') && $short_name&&$long_name&&$info){

    if($item_no){
	   $sql="UPDATE $dbtable SET short_name='$short_name',
	                                               long_name='$long_name',
							info='$info',
							modify_id='".$_SESSION['sess_user_name']."',
							modify_time='".date('YmdHis')."'
							WHERE item_no='$item_no'";
	   if($ergebnis=$core->Transact($sql))
       {
		 if($db->Affected_Rows())
		 {
	  	   /* $sql="UPDATE ".$dbtable." SET
									  modify_id='".$_COOKIE['ck_cafenews_user'.$sid]."',
									 modify_time='".date('YmdHis')."'
									 WHERE item_no=".$item_no;
		   $db->Execute($sql);*/
		   $new_currency_ok=1;
		   $saved_msg=$LDCurrencyUpdated;
		 }
		   else
		   {
		     $new_currency_ok=0;
		   }
		}
		else echo "<p> $sql <p>$LDDbNoSave";
	}
	else
	{
		$info_exist=0;
		
	   // Check first if the info already exists
	   
	   $sql="SELECT item_no FROM $dbtable WHERE short_name='$short_name' AND long_name $sql_LIKE '$long_name'";
	   
	   if($ergebnis=$db->Execute($sql))
       {
		  if(!$ergebnis->RecordCount())
		  {   
	
		 	$sql="INSERT INTO $dbtable 
			                          (short_name,
						long_name,
						info,
						create_id,
						create_time)
			              VALUES (
						              '$short_name',
									  '$long_name',
									  '$info',
									  '".$_SESSION['sess_user_name']."',
									  '".date('YmdHis')."')";
			if($ergebnis=$core->Transact($sql))
       		{
				if($db->Affected_Rows())
				{
					$new_currency_ok=1;
				 	$saved_msg=$LDAddedNewCurrency;

					if($db_type=='mysql'){
						$item_no=$db->Insert_ID();
					}else{
						$item_no=$core->postgre_Insert_ID($dbtable,'item_no',$db->Insert_ID());
					}
					// $item_no=$db->Insert_ID();
				}
				else $new_currency_ok=0;
			}
			  else echo "<p>".$sql."<p>$LDDbNoSave";
		  }
		  else
		  {
		      $info_exist=1;
		  }
		}
		 else echo "<p>".$sql."<p>$LDDbNoRead"; 
	  }

}

if(($mode=='edit') && $item_no)
{

    $sql="SELECT short_name,long_name,info FROM care_currency WHERE item_no='$item_no'";
	if($ergebnis=$db->Execute($sql))
	{
	  if($ergebnis->RecordCount())
	  {
	     $c_result=$ergebnis->FetchRow();
		 $short_name=$c_result['short_name'];
		 $long_name=$c_result['long_name'];
		 $info=$c_result['info'];
      }else{
	  	$item_no='';
	  }
	}else{
	   $item_no='';
	   echo "<p>$sql<p>$LDDbNoRead";
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDCurrencyAdmin);

# href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('currency_add.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDCurrencyAdmin);
 
 # Body OnLoad Javascript
 if(!$item_no) $smarty->assign('sOnLoadJs','onLoad="document.c_form.short_name.focus()"');
 
 # Buffer page output
 ob_start();

if($info_exist)
{
?>
<font color="#990000" size=4 face="verdana,arial">
<?php
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>'.$LDCurrencyExisting;
?>
</font>
<?php
}
?>

<br>
<ul>

<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2>
<?php if($item_no) echo $LDUpdateCurrencyInfo; else echo $LDAddCurrency ?> </FONT><FONT class="prompt"><p>
<?php
if(($mode=='save') && $new_currency_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'> '.$saved_msg.'<p>';
if($item_no) echo $LDPlsEnterUpdate; else echo $LDPlsAddCurrency;
?>
</font>
<p>

<form action="<?php echo $thisfile ?>" method="post" name="c_form">
<table border=0 cellspacing=1 cellpadding=5>  
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc"><b><?php echo $LDCurrencyShortName ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="short_name" size=10 maxlength=40 value="<?php echo $short_name ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc"><b><?php echo $LDCurrencyLongName ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="long_name" size=40 maxlength=10 value="<?php echo $long_name ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9" align="right"><FONT  color="#0000cc"><b><?php echo $LDCurrencyInfo ?></b> </FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="info" size=40 maxlength=60 value="<?php echo $info ?>">
      </td>  
	</tr>
</table>
<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="item_no" value="<?php echo $item_no; ?>">
<input type="hidden" name="from" value="<?php echo $from; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>
<p><br><p>
<hr>
<a href="edv_system_format_currency_set.php?<?php echo 'sid='.$sid.'&lang='.$lang; ?>">
<img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0') ?>> <?php echo $LDClk2SetCurrency; ?></a>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
