<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','phone.php');
$local_user='phonedir_user';
require_once($root_path.'include/inc_front_chain_lang.php');

# Load the Comm class and create comm (phone) object
require_once($root_path.'include/care_api_classes/class_comm.php');
$phone = & new Comm;

//$db->debug=true;
$error=1;
//$newdata=0;
$curdate=date('Y-m-d');
$curtime=date('H:i:s');

$dbtable='care_phone';

if ($mode=='save'){
	    // start checking input data
    if (($name!="")or($vorname!="")){

                # Correctly map some indexes
                $_POST['roomnr']=$_POST['zimmerno'];
                $_POST['date'] = $curdate;
                $_POST['time'] = $curtime;
                $_POST['modify_id'] = $_SESSION['sess_user_name'];
                $_POST['modify_time'] = date('YmdHis');
                $_POST['history'] = $phone->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
                $_POST['title'] = $_POST['anrede'];

                $phone->setWhereCondition("item_nr='$itemname'");
                $phone->setDataArray($_POST);

 				if($phone->updateDataFromInternalArray($itemname))
						{
							header("Location: phone_list.php?sid=$sid&lang=$lang&batchnum=$batchnum&linecount=$linecount&pagecount=$pagecount&displaysize=$displaysize&update=1&itemname=$itemname&edit=$edit");
							exit;
						}
			 			else {echo "<p>".$sql."<p>$LDDbNoSave";};
    	 }
}else{

    if(!$zeile=$phone->getData($itemname)){
        $zeile=array();
        echo $phone->getLastQuery()."<br>$LDDbNoRead<br>";
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE></TITLE>
<STYLE TYPE="text/css">
	.va12_b {text-decoration: none; color: #0000cc;}
</style>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

	<BODY >
	<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDPhoneDir ?></b></font>

	<table width=100% border=1>
	<tr>
	<td class="wardlisttitlerow">
	<FONT SIZE=+1><STRONG>&nbsp;<?php echo $LDUpdate ?></STRONG></FONT>
	</td>
	</tr>
	<tr>
	<td ><p><br>
	<ul>
<?php if (($error==1)and($newvalues!="")) echo "<FONT  COLOR=maroon  SIZE=+1  FACE=Arial>$LDNoData<p>";
?>
<form method="post" action="phone_entry_update.php">
<table class="submenu" border="1" cellpadding="5" cellspacing="1">
<tr>
<td colspan="3">
<b><?php  echo str_replace("~nr~",$zeile[item],$LDDirData); ?> </b>
</td>
<td >
&nbsp;
</td>
</tr>
<tr>
<td class="va12_b">

<?php echo $LDEditFields[1] ?>&nbsp;
<input name=anrede type=text size="5" value="<?php echo $zeile[title] ?>" maxlength=25><br>
</td>
<td class="va12_b">

<?php echo $LDEditFields[2] ?>&nbsp;
<input name=name type=text size="15" value="<?php echo $zeile[name] ?>" maxlength=45><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[3] ?>&nbsp;

<input type=text name=vorname size="15" value="<?php echo $zeile[vorname] ?>" maxlength=45><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[4] ?>&nbsp;
<input type=text name=beruf size="10" value="<?php echo $zeile[beruf] ?>" maxlength=25><br>
</td>
</tr>
<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[5] ?><br>

<input type=text name=bereich1 size="10" value="<?php echo $zeile[bereich1] ?>" maxlength=25><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[6] ?><br>
<input type=text name=bereich2 size="10" value="<?php echo $zeile[bereich2] ?>" maxlength=25><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[7] ?><br>

<input type=text name=inphone1 size="20" value="<?php echo $zeile[inphone1] ?>" maxlength=15><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[8] ?><br>
<input type=text name=inphone2 size="20" value="<?php echo $zeile[inphone2] ?>" maxlength=15><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[9] ?><br>
<input type=text name=inphone3 size="20" value="<?php echo $zeile[inphone3] ?>" maxlength=15><br>
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[10] ?><br>

<input type=text name=exphone1 size="20" value="<?php echo $zeile[exphone1] ?>" maxlength=25><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[11] ?><br>
<input type=text name=exphone2 size="20" value="<?php echo $zeile[exphone2] ?>" maxlength=25><br>
</td>
<td >
&nbsp;
</td>
</tr>

<tr>
<td colspan=2 class="va12_b">
<?php echo $LDEditFields[12] ?><br>

<input type=text name=funk1 size="20" value="<?php echo $zeile[funk1] ?>" maxlength=15><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[13] ?><br>
<input type=text name=funk2 size="20" value="<?php echo $zeile[funk2] ?>" maxlength=15><br>
</td>
<td class="va12_b">
<?php echo $LDEditFields[14] ?><br>
<input type=text name=zimmerno size="20" value="<?php echo $zeile[roomnr] ?>" maxlength=10><br>
</td>
</tr>
<tr>
<td colspan=3>
<p>
<input type="hidden" name="mode" value="save">
<input type="hidden" name="from" value="list">
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="linecount" value="<?php echo $linecount ?>">
<input type="hidden" name="pagecount" value="<?php echo $pagecount ?>">
<input type="hidden" name="batchnum" value="<?php echo $batchnum ?>">
<input type="hidden" name="displaysize" value="<?php echo $displaysize ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="submit"  value="<?php echo $LDUpdate ?>"> &nbsp;
<input type="reset"  value="<?php echo $LDReset ?>">
</td>
<td >
&nbsp;
</td>
</tr>
</table>
</form>


<p>
<FORM action="phone_list.php" method="post">
<input type="hidden" name="linecount" value="<?php echo $linecount ?>">
<input type="hidden" name="pagecount" value="<?php echo $pagecount ?>">
<input type="hidden" name="batchnum" value="<?php echo $batchnum ?>">
<input type="hidden" name="displaysize" value="<?php echo $displaysize ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="image"  <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></font></FORM>
<p>
</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
