<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/inc_date_format_functions.php');
global $db;
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($objPrescription)) 
$objPrescription=new Prescription;
$app_types=$objPrescription->getAppTypes();
$pres_types=$objPrescription->getPrescriptionTypes();
// load the encounter class to check if patient is discharged
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
$enc_obj->loadEncounterData($pn);
$isDischarged = $enc_obj->Is_Discharged($pn);

/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
include_once($root_path.'include/inc_visual_signalling_fx.php');
$thisfile=basename(__FILE__);

///$db->debug=true;
if(!isset($prescriber)||empty($prescriber)) $prescriber=$_COOKIE[$local_user.$sid];

$title="$LDMedication/$LDDosage";
/* Create charts object */
require_once($root_path.'include/care_api_classes/class_charts.php');

$charts_obj= new Charts;
	if($mode=='repeat' && $pn!=''){
		$repeated = false;
		//prescription 
		$prescription = array(
			'encounter_nr' => $pn,
			'prescribe_date'=> date("Y-m-d"),
			'status' => 'saved',
			'dept_nr' => $dept_nr,
			'prescriber' => $prescriber,
			'history' => 'Created by : '. date("Y-m-d H:m:s") . ' : ' .  $prescriber,
			'create_time' => date("Y-m-d H:m:s")
		);
		$objPrescription->insertDataFromArray($prescription);
		
		//get the selected prescription & the id inserted
		$objPrescription->usePrescription('prescription_sub');
		$pk =  $db->Insert_ID();
		$lastId = $objPrescription->LastInsertPK('nr',$pk);
		//prescriptio sub
		$prescription = $objPrescription->getAllPrescriptionById($prescriptionId);
		
		while (!$prescription->EOF){
			$prescription_sub = array(
				'prescription_nr' => $lastId,
				'prescription_type_nr' => $prescription->fields['prescription_type_nr'],
				'bestellnum' => $prescription->fields['bestellnum'],
				'article' => $prescription->fields['article'],
				'drug_class' => $prescription->fields['drug_class'],
				'dosage' => $prescription->fields['dosage'],
				'application_type_nr' => $prescription->fields['application_type_nr'],
				'notes_sub' => $prescription->fields['notes_sub'],
				'sub_speed' => $prescription->fields['sub_speed'],
				'status' => $prescription->fields['status'],
				'color_marker' => $prescription->fields['color_marker'],
				'is_stopped' => $prescription->fields['is_stopped'],
				'stop_date' => $prescription->fields['stop_date'],
				'status' => 'saved',
				'companion' => $prescription->fields['companion'],
				'quantity' => $prescription->fields['quantity'],
				'admin_time' => $prescription->fields['admin_time'],
			);
			$objPrescription->insertDataFromArray($prescription_sub);	
			$prescription->MoveNext();
		}
		
		$repeated = true;
		
		if($repeated) {
			header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&repeated=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&dystart=$dystart&dyname=$dyname&dept_nr=$dept_nr");
			exit;			
		}
	}
	if($mode=='save'){				
		$saved=false;
		if(!empty($maxelements)) {
			//prescription 
			$prescription = array(
				'encounter_nr' => $pn,
				'prescribe_date'=> date("Y-m-d"),
				'notes' => $notes,
				'status' => 'saved',
				'dept_nr' => $dept_nr,			
				'prescriber' => $prescriber,
				'create_time' => date("Y-m-d H:m:s"),
				'history' => 'Created by : '. date("Y-m-d H:m:s") . ' : ' .  $prescriber 
			);
			$objPrescription->insertDataFromArray($prescription);
			//get the selected prescription & the id inserted
			$objPrescription->usePrescription('prescription_sub');
			$pk = $db->Insert_ID();
			$lastId = $objPrescription->LastInsertPK('nr',$pk);	
			$actualRoseBars='';
			for($i=1;$i<=$maxelements+1;$i++){
				$bdx='b'.$i; //bestellnum
				$mdx='m'.$i; //medicament
				$ddx='d'.$i; //dosage
				$tdx='t'.$i; //administration times
				$adx='a'.$i; //administration type
				$pdx='p'.$i; //submission speed for IV
				$ndx='n'.$i; //notes for medicament
				$cdx='c'.$i; //bestellnum of the companion medicament(s)
				$tmpTimes = split("-",$$tdx);
				if($$mdx){
					$prescription_sub = array(
						'prescription_nr' => $lastId,
						//'prescription_type_nr' => $prescription->fields['prescription_type_nr'],
						'bestellnum' => $$bdx,
						'article' => $$mdx,
						'admin_time' => $$tdx,
						'dosage' => $$ddx,
						//'quantity' => ( $$ddx * count($tmpTimes)),
						'quantity' => ( $$ddx ),
						'application_type_nr' => $$adx,
						'sub_speed' => $$pdx,
						'notes_sub' => $$ndx,						
						//'color_marker' => $prescription->fields['color_marker'],
						//'is_stopped' => $prescription->fields['is_stopped'],
						//'stop_date' => $prescription->fields['stop_date'],
						'status' => 'saved',
						'companion' => $$cdx == '' ? serialize('0') : serialize($$cdx)
					);
					$actualRoseBars .= $$tdx . "-";
					$objPrescription->insertDataFromArray($prescription_sub);	
					$saved = true;
					$prescription_sub=null;	
				}						
			}
			//update the rose bars depeneding on the admin time for the medicament
			cleanRoseBars($pn);
			$tmpRoseBars = explode('-',$actualRoseBars);
			for($j = 0; $j < count($tmpRoseBars); $j++) {
				$roseBarNr = str_replace('0','',$tmpRoseBars[$j]);
				if($roseBarNr == '' ) $roseBarNr = '24';
				setEventSignalColor($pn, 'rose_'.$roseBarNr, SIGNAL_COLOR_LEVEL_FULL);
			}			
			
		}
		if($saved){
			header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&dystart=$dystart&dyname=$dyname&dept_nr=$dept_nr");
			exit;
		}
			
	}
	 // end of if(mode==save)
	$count=0;
	$medis=$charts_obj->getAllCurrentPrescription($pn);
	if(is_object($medis)){
		$count=$medis->RecordCount();
	}
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$title &LDInputWin" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<script type="text/javascript" src="../../js/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../../js/scriptaculous/src/effects.js"></script>
<script type="text/javascript" src="../../js/scriptaculous/src/controls.js"></script>
<script type="text/javascript" src="../../js/scriptaculous/src/builder.js"></script>
<script src="../../js/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script language="javascript"><!--
 
	function resetinput(){
		document.infoform.reset();
	}
	
	function pruf(d){
		if(!d.newdata.value) return false;
		else return true
	}
	
	function parentrefresh(){
		window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&dept_nr=$dept_nr&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
	}
		
	function repeatPrescription(prescriptionId){
		var answer = "Are you sure you want to apply the therapy again";
		if( confirm(answer) ) {
			window.location = "<?php echo $thisfile ?>?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname&mode=repeat&dept_nr=$dept_nr&prescriptionId=" ?>" + prescriptionId;
		} else {
			return false;
		}
	}	

    function sethilite(d) {
        d.focus();
        d.value = d.value + "*";
        d.focus();
   }

    function endhilite(d) {
        d.focus();
        d.value = d.value + "**";
        d.focus();
    }
    
	function pullRosebar(cb) {
		var oldValue, newValue;
		oldValue = document.getElementById(cb.name).value;
		if(oldValue == 0) {
			cb.src = '<?php echo $root_path; ?>gui/img/common/default/qbar_2_rose.gif';
			newValue = 1;
		} else if (oldValue == 1) {
			cb.src = '<?php echo $root_path; ?>gui/img/common/default/qbar_0_rose.gif';
			newValue = 0;
		}
		document.getElementById(cb.name).value = newValue;
	}
		    	
	function countRoseBars(){
		var nr = 0;
		var str = new String;
		if(document.getElementById('rose_24').value == 1) {
			str = String('00');
		}		
		for( nr = 1; nr < 24; nr++ ) {
			if(document.getElementById('rose_'+nr).value == 1) {
				tmp = String(nr);
				if(tmp.length == 1) {
					str = str + '-' + String('0' + tmp);
				} else {
					str = str + '-' + nr;
				}
			}
		}
		if(str.charAt(0) == '-')
			return(str.substr(1));
		else
			return(str);
	}
	
	function cleanRoseBars(){
		for( nr = 1; nr < 25; nr++ ) {
			document.getElementById('rose_'+nr).value = 0;
			document.getElementById('r_'+nr).src = '<?php echo $root_path; ?>gui/img/common/default/qbar_0_rose.gif';
		}	
	}
	
	function createBNumCode(strBNum) {
		if(strBNum.charAt(strBNum.length-1) == ',' && strBNum.length > 0)
			return strBNum.substr(0,strBNum.length-1);
		else
			return false;
	}
	
	function checkQuantity (elembName,elemdName,roseBars)  {

	}
	
	var companionBNum = '';		
	var prescriptionNr = 0;
	var countCompanions = 0;
	function addPrescription(){
		notfound = false;
		//chech if i'm working whith accompained medicaments
		if(document.getElementById('companion').checked) {
			companionBNum = document.getElementById('bestellnum').value + ',' + companionBNum ;
			countCompanions++;
		} else {
			companionBNum = '';
			//avoid only one medicament checked as accompanied
			if(countCompanions > 1) countCompanions = 0;
		}
		//avoid only one medicament checked as accompanied
		if(!document.getElementById('companion').checked && countCompanions == 1){
			alert('Warning no companion medicament selected');
			exit;
		}
		var roseBars = countRoseBars();
		if(roseBars == '') { alert('Select Time'); return true;}
		//get the values
		if(document.getElementById('bestellnum').value) elembName = document.getElementById('bestellnum').value;
		if(document.getElementById('search').value) elemmName = document.getElementById('search').value;
		else { alert('Select medicament'); return true; }
		if(document.getElementById('dosage').value) elemdName = document.getElementById('dosage').value
		else { alert('Select quantity'); return true; }	
		if(document.getElementById('application_type_nr').value) elemaName = document.getElementById('application_type_nr').value;
		else { alert('Select application type'); return true; }
		elempName = document.getElementById('pspeed').value;
		elemnName = document.getElementById('notesMed').value;
		
		var tmpatn = document.getElementById('application_type_nr');
		var appTmp = tmpatn.options[tmpatn.selectedIndex].text;

		//check if i have it in the pharmacy
		numTimes = roseBars.split('-');
      	new Ajax.Request("include/inc_check_quantity.php", {
      		asynchronous : false,
      		method: 'post',
        	parameters: { bestellnum : elembName, dose : elemdName,times : numTimes.length },
        	onComplete: function (req) {
        		if(req.responseText == "0") {
        			alert("Medicament : " + elemmName + " \nis not present in the pharmacy!\nPlease check the spelling.");
					notfound = true;
				}
        	}
      	});	
		if(notfound) { document.getElementById('search').value = ''; return true; }
		
		prescriptionNr++;
		var elemId;
		elemId = 'elem' + prescriptionNr;
		//create name & number
		elembNr = 'b' + prescriptionNr;
		elemmNr = 'm' + prescriptionNr;
		elemdNr = 'd' + prescriptionNr;
		elemaNr = 'a' + prescriptionNr;
		elempNr = 'p' + prescriptionNr;
		elemnNr = 'n' + prescriptionNr;
		elemtNr = 't' + prescriptionNr;
		elemcNr = 'c' + prescriptionNr;
		
		//show them to the masses & use them for me :)
		var trFirst,pBestellnum,medicine,dosage,appType,prescriptionSpeed, notesMed ,elemRemove;
		trFirst = Builder.node('tr',{id:elemId,bgcolor:'#fefefe',valign:'top'});
	 		//if we have to use it with another medicament...
	 		if(document.getElementById('companion').checked)
				medicine = Builder.node('td',{style:'border-left:thick solid #0000FF;'},[ 
					Builder.node('h4',{name:elemmNr},elemmName),
						Builder.node('img',{src:'../../gui/img/common/default/info3.gif',onclick:'popinfo( '+ elembName +' )'}),					
		 				Builder.node('input',{name:elembNr,type:'hidden',value:elembName}),
		 				Builder.node('input',{name:elemmNr,type:'hidden',value:elemmName}),
						Builder.node('input',{name:elemcNr,type:'hidden',value:createBNumCode(companionBNum)})		 				
		 			]);
		 	else
				medicine = Builder.node('td',[ 
					Builder.node('h4',{name:elemmNr},elemmName),
						Builder.node('img',{src:'../../gui/img/common/default/info3.gif',onclick:'popinfo( '+ elembName +' )'}),		
		 				Builder.node('input',{name:elembNr,type:'hidden',value:elembName}),
		 				Builder.node('input',{name:elemmNr,type:'hidden',value:elemmName})
		 			]);		
		 			
	 		dosage = Builder.node('td',[Builder.node('h4',{name:elemdNr},elemdName)],
	 			[Builder.node('h4', roseBars),
	 			Builder.node('input',{name:elemdNr,type:'hidden',value:elemdName}),
	 			Builder.node('input',{name:elemtNr,type:'hidden',value:roseBars})]);
	 		appType = Builder.node('td',[ Builder.node('h4',{name:elemaNr},appTmp)],
	 				[ Builder.node('input',{name:elemaNr,type:'hidden',value:elemaName})]);
	 		prescriptionSpeed = Builder.node('td',[ Builder.node('h4',{name:elempNr},elempName)],[ Builder.node('input',{name:elempNr,type:'hidden',value:elempName})]);
	 		if(elemnName.length < 11 )
	 			notesMed = Builder.node('td',[ Builder.node('h4',{name:elemnNr},elemnName)],[ Builder.node('input',{name:elemnNr,type:'hidden',value:elemnName})]);
	 		else
	 			notesMed = Builder.node('td',[ Builder.node('h4',{name:elemnNr},elemnName.truncate(10))],[ Builder.node('input',{name:elemnNr,type:'hidden',value:elemnName})]);
	 		elemRemove = Builder.node('td',{valign:'middle'},[ Builder.node('img',{src:'../../gui/img/control/default/sq/sq_delete.png',onclick:'removeMedicament( '+ elemId +' )'})]);

		  	trFirst.appendChild(medicine);
		  	trFirst.appendChild(dosage);
		  	trFirst.appendChild(appType);
		  	trFirst.appendChild(prescriptionSpeed);
		  	trFirst.appendChild(notesMed);
		  	trFirst.appendChild(elemRemove);

		  	
	  	$('prescriptionTable').appendChild(trFirst);
	  	
	  	//clean up things a bit depending on medicament is composed or not
	  	if(document.getElementById('companion').checked) {
			document.getElementById('bestellnum').value = '';
			document.getElementById('search').value = '';
			document.getElementById('dosage').value = '';
			//document.getElementById('application_type_nr').value = '';  
			//document.getElementById('companion').checked = false;	
			document.getElementById('pspeed').value = '';
			document.getElementById('notesMed').value = ''; 
			//cleanRoseBars();	  	
	  	} else {
			document.getElementById('bestellnum').value = '';
			document.getElementById('search').value = '';
			document.getElementById('dosage').value = '';
			document.getElementById('application_type_nr').value = '';  
			document.getElementById('companion').checked = false;	
			document.getElementById('pspeed').value = '';
			document.getElementById('notesMed').value = ''; 
			cleanRoseBars();	  	
	  	}

		
		//don't forget to update the maxelements
		document.getElementById('maxelements').value = prescriptionNr;
	  	
	}
	function popinfo(b) {
		urlholder="../products/products-bestellkatalog-popinfo.php?sid=7071bab054d376600a2ecf70ac6128a5&lang=sq&keyword="+b+"&mode=search&cat=pharma";
		ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
	}	
	
	function removeMedicament(id) {
		Element.remove(id);
		countCompanions = 0;
	}
	
	function printPrescription(enc,presnr) {
		urlholder="<?php echo $root_path ?>modules/pdfmaker/prescription/report_all.php<?php echo URL_REDIRECT_APPEND; ?>&enc="+enc+"&presnr="+presnr;
		window.open(urlholder,'Daily Therapy',"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
	
	function submitMainForm() {
		if(countCompanions == 1) {
			alert('Error in the selection of the medicament');
			exit;
			return false;
		} else
			document.infoform.submit();
	}

--></script>
<link href="../../js/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v10 { font-family:verdana,arial;font-size:10; }

#search, #orari, #notesMed{
	padding: 3px;
	width: 270px;
	border: 1px solid #999;
	font-family: verdana;
 	arial, sans-serif;
	font-size: 12px;
	background: #ffc;	
}
#pspeed  {
	padding: 3px;
	width: 50px;
	border: 1px solid #999;
	font-family: verdana;
 	arial, sans-serif;
	font-size: 12px;
	text-align:right;
}
#notes{
	padding: 3px;
	border: 1px solid #999;
	font-family: verdana;
 	arial, sans-serif;
	font-size: 12px;
}
#hint ul {
	list-style-type: none;
	font-family: verdana;
 	arial, sans-serif;
	font-size: 10px;
	margin: 5px 0 0 -28px;
}
#hint li {
	list-style-type: none;
	margin: 0 0 5px -10px;
	cursor: default;
	color: green;
}
#hint {
	background:#fff;
	border: 1px solid #999;	
}
#hint > li:hover {
	background: #ffc;
}
.sx {
	text-align:left;
	font-size: 12px;
	font-variant: small-caps;
	color: red;
}
li.selected {
	background: #FCC;
}
.nav:hover {
	background:#FFFF99;
}
.together { border-left:thick solid #0000FF; }
</style>
</HEAD>
<BODY  bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080"    topmargin="0" marginheight="0" if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face="verdana,arial" size="5" color="maroon">
<?php 
	echo $title.'<br><font size=4>';	
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $winid ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> </a>
    <a href="<?php echo "nursing-station-patientdaten.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit" ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> </a></nobr>
</td>
  </tr>
</table>
<form name="infoform" id="infoform" action="<?php echo $thisfile ?>" method="post">
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <ul class="TabbedPanelsTab" tabindex="0"><font face=verdana,arial size=5 color=maroon>Prescription</font></ul>
    <ul class="TabbedPanelsTab" tabindex="0"><font face=verdana,arial size=5 color=maroon>New Prescription</font></ul>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
<!-- end : old prescription -->
<table border=0 width=100%  cellspacing=0 cellpadding=0 >
  <tr>
    <td>
	
  <?php
if($count){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>

<?php
    // Load the editor functions 
	include_once($root_path.'include/inc_editor_fx.php');
	$toggle=0;
	$old_nr = 0;
	$i = 0;	
	$companionBestellnum ='';
	$old_nr = $medis->fields['prescription_nr'];
	$rowNr = $medis->fields['id'];
	$medis->Move($i);
	$row=$medis->fields;
	do {
			$companionBestellnum =  explode(",",unserialize($row['companion']));
			echo "<span style=\"cursor:pointer;font-weight:bold;float: left;\" onclick=\"new Effect.toggle('_". $row['prescription_nr']  ."_', 'blind' );\" /><font face=verdana,arial size=2 color=maroon>Therapy Nr : " . $row['prescription_nr']. " / Dt: " .$row['prescribe_date'] ."</font></span>";
			if(!$isDischarged) {
			echo '<span style="float:right;cursor:pointer;"><img onClick="repeatPrescription(' .  $row['id'] . ');"' . createLDImgSrc($root_path,'redo.png','0') . ' alt=' .  $LDSave . '>&nbsp;';
			} else {
				echo '<span style="float:right;cursor:pointer;">';
			}
			if($row['status'] != 'printed') echo '<img onclick="printPrescription(' . $row['encounter_nr']  .','. $row['id'] .');"' . createLDImgSrc($root_path,'printer.png','0') . ' alt=' .  $LDPrint . '>';
			echo '</span><br /><br />';
			echo '<div id="_' . $row['prescription_nr'] .'_" style="display:none;">';
			echo '<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">';
			echo '<tr><td><strong>Medicament / Form-Dose</strong></td><td><strong>Qty.</strong></td><td><strong>Time</strong></td><td><strong>Speed</strong></td><td><strong>App. type</strong></td><td><strong>Notes</strong></td></tr>';
			do {			
				$i++; ?>
					<?php
						if($toggle) $bgc='#f3f3f3';
							else $bgc='#fefefe';
						$toggle=!$toggle;
//TODO : finish the outpatinet daily therapy					
/*						if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
							else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission*/
					?>
					  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
					    <td
					    <?php //used to show which medicaments are together...
					    	if( in_array($row['bestellnum'],$companionBestellnum) ) {
					    		echo ' style="border-left:thick solid #0000FF;" ';
					    	}					    	
					    	?>					    
					    >
					    <FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?>

					    </font></td>
					    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['dosage']; ?></font></td>
					    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['admin_time'];?></font></td>
					    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['sub_speed'];?> ml / h</font></td>
					    <td><FONT SIZE=-1  FACE="Arial">
					    <?php 
			    			reset($app_types);
			    			while(list($x,$v)=each($app_types)){
								if( $row['application_type_nr'] == $v['nr'] ) {
									if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
										else echo $v['name'];
										break;
								}
							}   	
					    ?>
					    </font></td>
					    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes_sub'];?></font></td>
					  </tr>			
					<?php
					$medis->Move($i);
					$row=$medis->fields;
			} while ( $row['prescription_nr'] == $old_nr && ( $i < $count ) );
			//note for this recipe..i hate what i've done...
			$medis->Move($i-1) ;
			$row=$medis->fields;
			echo'<tr>';
			echo '	<td colspan="4"> Notes : ' . hilite($row['notes']);
			echo '	</td>
			    </tr>';
			echo '</table></div>';
			$medis->Move($i) ;
			//end note for the prescription
		$row=$medis->fields;
		$old_nr = $row['prescription_nr'];
		$rowNr = $row['id'];	
	}while($medis->Move($i-1)  && ( $i < $count )  );
}
?>	
</td>
</tr>
 </table>
 <!-- end : old prescription -->
</div>
<!-- new prescription -->
<?php if(!$isDischarged) { ?>
<div class="TabbedPanelsContent">
<table>
  <tr>
    <td><label>Medicament  / Form-Dose: </label></td>
    <td>&nbsp;</td>
    <td><label>Dose</label></td>
    <td><label>App. Type : </label></td>
    <td><label>Acc. : </label></td>
    <td>Time :</td>
    <td>Notes :</td>
    <td rowspan="4"><?php echo '<img style="cursor:pointer;"onClick="addPrescription();"' . createLDImgSrc($root_path,'add.png','0') . ' alt=' .  $LDAdd . '>'; ?> </td>
  </tr>
  <tr>
    <td><div>
        <input type="text" id="search" name="search" />
        <input type="hidden" id="bestellnum" value=""/>
      </div>
      <div id="hint"></div>
      <script type="text/javascript">	
      var includeScript = "include/inc_search_medicaments.php?";
		var kot = new Ajax.Autocompleter("search","hint",includeScript, {afterUpdateElement : setSelectionId,autoSelect: true, minChars: 2,callback:funxkot});
		
		function setSelectionId(text, li) {
    		document.getElementById('bestellnum').value = li.id;
		}
		function funxkot() {
    		return Form.serialize($('infoform')) ;		
		}
	</script>
    </td>
    <td>&nbsp;</td>
    <td>
      <select id="dosage" name="dosage">
        <option value=""></option>
        <option value="0.1">1 / 10</option>
        <option value="0.25">1 / 4</option>
        <option value="0.5">1 / 2</option>
        <option value="0.75">3 / 4</option>
        <option value="1" selected>1</option>
        <option value="1.25">1 + 1 / 4</option>
        <option value="1.5">1 + 1 / 2</option>
        <option value="1.75">1 + 3 / 4</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </td>
    <td><select name="application_type_nr" id="application_type_nr">
        <option value=""></option>
        <?php
			reset($app_types);
			while(list($x,$v)=each($app_types)){
				echo '<option value="'.$v['nr'].'">';
				if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
					else echo $v['name'];
				echo '</option>';
			}
		?>
      </select>
    </td>
    <td align="right"><input type="checkbox" id="companion" name="companion" align="right">
    </td>
    <td><input type="text" maxlength="4" id="pspeed" name="pspeed">
      ml/hr </td>
    <td><input type="text" id="notesMed" name="notesMed">
    </td>
  </tr>
  <tr>
    <td colspan="6">
<?php
function ha(){ return '<a href="#">'; }

function rx(){ return 'onClick="javascript:pullRosebar(this)"></a>'; }
		/* Create the rose bars*/
		/* Note $h is used here as counter  */
for($h=6;$h<25;$h++) { 
  echo ha().'<img 
	 '.createComIcon($root_path,'qbar_0_rose.gif','0').'" id="r_' .$h . '" alt="'.$h.' '.$LDHour.'"  name="rose_'.$h.'" '.rx();
	if(($h==11)||($h==17)||($h==23))
 	echo'<img
	  '.createComIcon($root_path,'qbar_trans.gif','0').'>';
 }
?><a href="#"><img 
src="../../gui/img/common/default/qbar_0_rose.gif" border=0 width="10" height="40" id="r_1" alt="01 Ora"  name="rose_1" onClick="javascript:pullRosebar(this)"></a><a href="#"><img
src="../../gui/img/common/default/qbar_0_rose.gif" border=0 width="10" height="40" id="r_2" alt="02 Ora"  name="rose_2" onClick="javascript:pullRosebar(this)"></a><a href="#"><img 
src="../../gui/img/common/default/qbar_0_rose.gif" border=0 width="10" height="40" id="r_3" alt="03 Ora"  name="rose_3" onClick="javascript:pullRosebar(this)"></a><a href="#"><img 
src="../../gui/img/common/default/qbar_0_rose.gif" border=0 width="10" height="40" id="r_4" alt="04 Ora"  name="rose_4" onClick="javascript:pullRosebar(this)"></a><a href="#"><img 
src="../../gui/img/common/default/qbar_0_rose.gif" border=0 width="10" height="40" id="r_5" alt="05 Ora"  name="rose_5" onClick="javascript:pullRosebar(this)"></a> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"> 06&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;17&nbsp;&nbsp;18&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;23&nbsp;&nbsp;00&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;07 </td>
    <td>&nbsp;</td>
  </tr>
</table>
<br /><br /><br />
<hr>
<table>
<table id="prescriptionTable" width="100%">
<tr>
<td><strong>Medicament / Form-Dose</strong></td><td><strong>Dose and Time of application</strong></td><td><strong>App. type</strong></td><td><strong>Time</strong></td><td><strong>Notes</strong></td><td>&nbsp;</td> 
</tr>
</table>
<table>
	<tr valign="top">
		<td valign="top"><label>Notes : </label></td>
		<td>
		<textarea name="notes" id="notes" cols="20" rows="4"></textarea>
		<br>&nbsp;
		<a href = "javascript: sethilite(document.infoform.notes)"><img <?php echo createComIcon($root_path, 'hilite-s.gif', '0') ?>></a>
		<a href = "javascript: endhilite(document.infoform.notes)"><img <?php echo createComIcon($root_path, 'hilite-e.gif', '0') ?>></a>
		</td>
	</tr>
</table>
  </div>
  <?php } ?>
<!-- end : new prescription -->  
</div>
</div>

<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxelement ?>">
<input type="hidden" name="enc" value="<?php echo strtr($enc," ","+") ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="maxelements" id="maxelements" value="">
<!-- no comment...please -->
<input type="hidden" id="rose_1" name="rose_1" value="0">
<input type="hidden" id="rose_2" name="rose_2" value="0">
<input type="hidden" id="rose_3" name="rose_3" value="0">
<input type="hidden" id="rose_4" name="rose_4" value="0">
<input type="hidden" id="rose_5" name="rose_5" value="0">
<input type="hidden" id="rose_6" name="rose_6" value="0">
<input type="hidden" id="rose_7" name="rose_7" value="0">
<input type="hidden" id="rose_8" name="rose_8" value="0">
<input type="hidden" id="rose_9" name="rose_9" value="0">
<input type="hidden" id="rose_10" name="rose_10" value="0">
<input type="hidden" id="rose_11" name="rose_11" value="0">
<input type="hidden" id="rose_12" name="rose_12" value="0">
<input type="hidden" id="rose_13" name="rose_13" value="0">
<input type="hidden" id="rose_14" name="rose_14" value="0">
<input type="hidden" id="rose_15" name="rose_15" value="0">
<input type="hidden" id="rose_16" name="rose_16" value="0">
<input type="hidden" id="rose_17" name="rose_17" value="0">
<input type="hidden" id="rose_18" name="rose_18" value="0">
<input type="hidden" id="rose_19" name="rose_19" value="0">
<input type="hidden" id="rose_20" name="rose_20" value="0">
<input type="hidden" id="rose_21" name="rose_21" value="0">
<input type="hidden" id="rose_22" name="rose_22" value="0">
<input type="hidden" id="rose_23" name="rose_23" value="0">
<input type="hidden" id="rose_24" name="rose_24" value="0">

<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">

<p>
<a href="javascript:submitMainForm();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<!-- <a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
 -->&nbsp;&nbsp;
<?php if($saved || $repeated)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>

<p><a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
  <?php endif ; ?>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</form>
</BODY>
</HTML>