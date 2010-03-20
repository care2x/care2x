<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR ) ;
require ('./roots.php') ;
require ($root_path . 'include/inc_environment_global.php') ;
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org, 
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define ( 'LANG_FILE', 'nursing.php' ) ;
$local_user = 'ck_pflege_user' ;
require_once ($root_path . 'include/inc_front_chain_lang.php') ;

///$db->debug = true ;
$thisfile = basename ( __FILE__ ) ;
/* Create charts object */
require_once ($root_path . 'include/care_api_classes/class_charts.php') ;
$charts_obj = new Charts ( ) ;

$title = "$LDMedication/$LDDosage" ;

/* Establish db connection */
if (! isset ( $db ) || ! $db)
	include ($root_path . 'include/inc_db_makelink.php') ;
if ($dblink_ok) {
	/* Load date formatter */
	include_once ($root_path . 'include/inc_date_format_functions.php') ;
	
	if ($mode == 'save') {
		$saved = false ;
		$data_array = array ( ) ;
		for ( $i = 0 ; $i < $maxelement ; $i ++ ) {
			$notes = 'r' . $i ;
			$prev = 'prev' . $i ;
			$notes_nr = 'notes_nr' . $i ;
			$presc_nr = 'p_nr' . $i ;
			
			if (! empty ( $$notes )) {
				$data_array [ 'short_notes' ] = $$prev . ' ' . $$notes ;
				if (empty ( $$notes_nr )) {
					$data_array [ 'prescription_nr' ] = $$presc_nr ;
					$data_array [ 'date' ] = date ( 'Y-m-d', mktime ( 0, 0, 0, $mo, $dy, $yr ) ) ;
					if ($charts_obj->savePrescriptionNotesFromArray ( $data_array ))
						$saved = true ;
				} else {
					$data_array [ 'prescription_nr' ] = '' ;
					if (isset ( $data_array [ 'date' ] ))
						unset ( $data_array [ 'date' ] ) ;
					if (isset ( $data_array [ 'prescription_nr' ] ))
						unset ( $data_array [ 'prescription_nr' ] ) ;
					if ($charts_obj->updatePrescriptionNotesFromArray ( $$notes_nr, $data_array ))
						$saved = true ;
				}
			}
		}
		
		if ($saved) {
			header ( "location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname" ) ;
			exit () ;
		}
	
	}
	
	// end of if(mode==save)
	$count = 0 ;
	$medis = $charts_obj->getDayPrescriptionNotes ( $pn, date ( 'Y-m-d', mktime ( 0, 0, 0, $mo, $dy, $yr ) ) ) ;
	if (is_object ( $medis )) {
		$count = $medis->RecordCount () ;
	}
	$maxelement = $count ;
} else {
	echo "$LDDbNoLink<br>$sql<br>" ;
}
?>

<?php
html_rtl ( $lang ) ;
?>
<HEAD>
<?php echo setCharSet () ; ?>
<TITLE><?php
echo "$title $LDInputWin" ?></TITLE>
<?php
require ($root_path . 'include/inc_js_gethelp.php') ;
require ($root_path . 'include/inc_css_a_hilitebu.php') ;

?>

<script language="javascript">
<!-- 
	function resetinput(){
		document.infoform.reset();
	}

	function pruf(d){
		if(!d.newdata.value) return false;
		else return true
	}
	function parentrefresh(){
		window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php
		echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
	}
//-->
</script>

<STYLE type=text/css>
div.box {
	border: double;
	border-width: thin;
	width: 100%;
	border-color: black;
}

.v12 {
	font-family: verdana, arial;
	font-size: 12;
}

.v13 {
	font-family: verdana, arial;
	font-size: 13;
}

.v10 {
	font-family: verdana, arial;
	font-size: 10;
}
</style>

</HEAD>
<BODY bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080"
	onLoad="<?php
	if ($saved)
		echo "parentrefresh();" ;
	?>if (window.focus) window.focus(); window.focus();">
<table border=0 width="100%">
	<tr>
		<td><b><font face=verdana,arial size=5 color=maroon>
<?php
echo $title . '<br><font size=4>' ;
echo $LDFullDayName [ $dyidx ] . ' (' . formatDate2Local ( date ( 'Y-m-d', mktime ( 0, 0, 0, $mo, $dy, $yr ) ), $date_format ) . ')</font>' ;
?>
	</font></b></td>
		<td align="right" valign="top">
			<a href="javascript:gethelp('nursing_feverchart_xp.php','medication_dailydose','','<?php echo $mdcsize ?>','<?php echo $title ?>')"><img <?php echo createLDImgSrc ( $root_path, 'hilfe-r.gif', '0' ) ?> 
				<?php if ($cfg [ 'dhtml' ]) echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>' ;?></a><a href="javascript:window.close()"><img <?php echo createLDImgSrc ( $root_path, 'close2.gif', '0' ) ?>
				<?php if ($cfg [ 'dhtml' ]) echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>' ;?></a>
			</nobr>
		</td>
	</tr>
</table>


<font face=verdana,arial size=3>
<form name="infoform" action="<?php echo $thisfile ?>" method="post"
	onSubmit="return pruf(this)"><font face=verdana,arial size=2>


<table border=0 bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
	<tr>
		<td>
		<table border=0 width=100% cellspacing=1>
			<tr>
				<td align=center class="v12" bgcolor="#cfcfcf"><?php echo $LDMedication ?></td>
				<td align=center class="v12" bgcolor="#cfcfcf"><?php echo $LDDosage ?></td>
				<td align=center class="v12" bgcolor="#cfcfcf"><?php echo $LDTodaysReport ?>:</td>
			</tr>
		<?php
		if ($count) {
			for ( $i = 0 ; $i < $maxelement ; $i ++ ) {
				//if(!$mdc[$i]) continue;
				$v = $medis->FetchRow () ;
				;
				echo '
 					<tr>
   					<td  class="v12" bgcolor="#ffffff">&nbsp;' . $v [ 'article' ] . '&nbsp;</td>
   					<td class="v12" bgcolor="#ffffff"> &nbsp;' . $v [ 'admin_time' ] . '&nbsp;</td>
   					<td class="v12" bgcolor="#ffffff" align="right">&nbsp;' . $v [ 'day_notes' ] . '
					<input type="text" name="r' . $i . '" size=4 maxlength=10 ';
				if( $v['prescribe_date'] < date("Y-m-d")) echo ' disabled ';
				echo '>&nbsp;
					<input type="hidden" name="prev' . $i . '" value="' . $v [ 'day_notes' ] . '">
					<input type="hidden" name="notes_nr' . $i . '" value="' . $v [ 'notes_nr' ] . '">
								 <input type="hidden" name="p_nr' . $i . '" value="' . $v [ 'prescription_nr' ] . '">
						 	</td>
  						</tr>' ;
			}
		} else {
			echo '
		 		<tr>
	   				<td  colspan="3" bgcolor="#ffffff"><img ' . createMascot ( $root_path, 'mascot1_r.gif', '0', 'absmiddle' ) . '>
		        		<font face="Verdana, Arial" size=4 color="#800000">' . $LDNoMedicineYet . '&nbsp;</font>
	        		</td>
  				</tr>' ;
		}
		?>
</table>
		</td>
	</tr>
</table>


<input type="hidden" name="sid" value="<?php echo $sid ?>"> 
<input type="hidden" name="winid" value="<?php echo $winid ?>"> 
<input type="hidden" name="lang" value="<?php echo $lang ?>"> 
<input type="hidden" name="station" value="<?php echo $station ?>"> 
<input type="hidden" name="yr" value="<?php echo $yr ?>"> 
<input type="hidden" name="mo" value="<?php echo $mo ?>"> 
<input type="hidden" name="dy" value="<?php echo $dy ?>"> 
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>"> 
<input type="hidden" name="dystart" value="<?php echo $dystart ?>"> 
<input type="hidden" name="monstart" value="<?php echo $monstart ?>"> 
<input type="hidden" name="yrstart" value="<?php echo $yrstart ?>"> 
<input type="hidden" name="dyname" value="<?php echo $dyname ?>"> 
<input type="hidden" name="pn" value="<?php echo $pn ?>"> 
<input type="hidden" name="edit" value="<?php echo $edit ?>"> 
<input type="hidden" name="mode" value="save"> 
<input type="hidden" name="maxelement" value="<?php echo $maxelement ?>">
</form>
<p>
<?php
if ($count) {
	?>
<a href="javascript:document.infoform.submit();">
	<img <?php echo createLDImgSrc ( $root_path, 'savedisc.gif', '0' ) ?> alt="<?php echo $LDSave ?>">
</a> &nbsp;&nbsp; 
<!-- 
<a href="javascript:resetinput()">
	<img <?php echo createLDImgSrc ( $root_path, 'reset.gif', '0' ) ?> alt="<?php echo $LDReset ?>">
</a>
 -->&nbsp;&nbsp;
<?php
}
?>

<?php
if ($saved) {
	?>
<a href="javascript:window.close()">
 <img <?php echo createLDImgSrc ( $root_path, 'close2.gif', '0' ) ?> alt="<?php echo $LDClose ?>">
</a>
<?php
} else {
	?>
<a href="javascript:window.close()">
	<img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
</a>
<?php } ?>



</BODY>

</HTML>
