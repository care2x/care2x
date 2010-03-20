<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
//define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/care_yellow_paper.php');
$report_obj= new YellowPaper;
///$db->debug=true; 
//if ($station=='') { $station='Non-department specific';  }
if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$thisfile=basename(__FILE__);
			
require_once($root_path.'include/inc_date_format_functions.php');

if($mode=='save'){
	# Know where we are
	switch($_SESSION['sess_user_origin']){
		case 'lab': $_POST['location_type_nr']=1; # 1 =department
						break;
		default: 	$_POST['location_type_nr']=2; # 2 = ward 
						break;
	}
	$_POST['location_id']=$station; 
	if($report_obj->saveDailyWardNotes($_POST)){
		//echo $report_obj->getLastQuery();
		header("Location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&dept_nr=$dept_nr&location_nr=$location_nr&saved=1");
		exit;
	}else{echo $report_obj->getLastQuery()."<p>$LDDbNoUpdate";}
} elseif ($mode=='update') {
	
	# Know where we are
	switch($_SESSION['sess_user_origin']){
		case 'lab': $_POST['location_type_nr']=1; # 1 =department
						break;
		default: 	$_POST['location_type_nr']=2; # 2 = ward 
						break;
	}
	$_POST['location_id']=$station; 
	if($report_obj->updateDailyWardNotes($_POST)){
		//echo $report_obj->getLastQuery();
		//header("Location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&dept_nr=$dept_nr&location_nr=$location_nr&saved=1");
		echo "<html><body><script>javascript:window.close();</script></body></html>";
		exit;
	}else{echo $report_obj->getLastQuery()."<p>$LDDbNoUpdate";}
}else{
	if($d_notes=&$report_obj->getDailyWardNotes($pn)){
   		include_once($root_path.'include/inc_editor_fx.php');
		$occup=true;
	}
	# If location name is empty, fetch by location nr
	if(!isset($station)||empty($station)){
		# Know where we are
		switch($_SESSION['sess_user_origin']){
			case 'amb': # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_department.php');
						$obj= new Department;
						$station=$obj->FormalName($dept_nr);
						break;
			default: # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_ward.php');
						$obj= new Ward;
						$station=$obj->WardName($location_nr);
		}
		echo $obj->getLastQuery();
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDYellowPaper.' :: '.$station.' ('.formatDate2Local($s_date,$date_format).')');

   # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('patient_remarks.php','','','$station','$LDNotes')");

 # href for close button
 $smarty->assign('breakfile','javascript:window.close()');


 # OnLoad Javascript code
  if(($mode=='save')&&($occup)||$saved) $sTemp = "window.opener.location.reload();this.close();";
  	else $sTemp = '';

 $smarty->assign('sOnLoadJs','onLoad="'.$sTemp.' if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDYellowPaper.' :: '.$station.' ('.formatDate2Local($s_date,$date_format).')');

 # Collect extra javascript code

 ob_start();
 echo '<script src="../../js/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../js/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />';
?>
<script language="javascript">
<!-- 
var n=false;
function checkForm(f)
{
	if(f.notes.value==""||f.personell_name=="") return false;
	 else return true;
}
function setChg()
{
	n=true;
}
// -->
</script>
<style type="text/css" name="s2">
td.vn {
	font-family:verdana, arial;
	color:#000088;
	font-size:10
}
</style>
<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

ob_start();

/*
if($occup){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr class="adm_item">
    <td><FONT color="#000066"><?php echo $LDDate; ?></td>
    <td><FONT color="#000066"><?php echo $LDTime; ?></td>
    <td><FONT color="#000066"><?php echo $LDNotes; ?></td>
    <td><FONT color="#000066"><?php echo $LDCreatedBy; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$d_notes->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		if($toggle) $sRowClass='wardlistrow2';
			else $sRowClass='wardlistrow1';
		$toggle=!$toggle;
		if(!empty($row['short_notes'])) $bgc='yellow';
	
?>


  <tr  class="<?php echo $sRowClass ?>"  valign="top">
    <td><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><?php if($row['time']) echo $row['time']; ?></td>
    <td><FONT color="#000033">
	<?php 
		if(!empty($row['notes'])) echo deactivateHotHtml(nl2br($row['notes'])); 
		if(!empty($row['short_notes'])) echo '<br>[ '.deactivateHotHtml($row['short_notes']).' ]';
	?>
	</td>
    <td><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
*/
?>
<ul>
  <?php
 	if ($occup) {
 		$row = $d_notes->FetchRow();
 	}
 ?>
  <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><b>Quadro anamnestico</b></li>
    <li class="TabbedPanelsTab" tabindex="0"><b>Anamnesi familiare</b></li>
    <li class="TabbedPanelsTab" tabindex="0"><b>Anamnesi socio-ambientale</b></li>
    <li class="TabbedPanelsTab" tabindex="0"><b>Anamnesi fisiologica</b></li>
    <li class="TabbedPanelsTab" tabindex="0"><b>Anamnesi patologica prossima</b></li>
    <li class="TabbedPanelsTab" tabindex="0"><b>Anamnesi patologica remota</b></li>
  </ul>
  <div class="TabbedPanelsContentGroup">
  <div class="TabbedPanelsContent">
  <form method="post" name=remform action="nursing-yellow-paper" onSubmit="return checkForm(this)">
    <textarea name="sunto_anamnestico" cols=60 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['sunto_anamnestico'] ?>
</textarea>
    <br>
    <b>Stato attuale</b><br>
    <table>
      <tr>
        <td><i>Altezza:&nbsp;</i></td>
        <td><input type="text" name="altezza" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['altezza']."'" ?>></td>
      </tr>
      <tr>
        <td><i>Peso:&nbsp;</i></td>
        <td><input type="text" name="peso" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['peso']."'" ?>></td>
      </tr>
      <tr>
        <td><i>Età:&nbsp;</i></td>
        <td><input type="text" name="norm" size=10 maxlength=10 <?php if ($occup) echo "value='".$row['norm']."'" ?>></td>
      </tr>
    </table>
    <i>Sintomatologia</i><br>
    <textarea name="stato_presente" cols=60 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['stato_presente'] ?>
</textarea>
    <br>
    <b>Dati laboratorio</b><br>
    <table>
      <tr>
        <td><i>Urine</i><br>
          <textarea name="dati_urine" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['dati_urine'] ?>
</textarea></td>
        <td><i>Sangue</i><br>
          <textarea name="dati_sangue" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['dati_sangue'] ?>
</textarea></td>
        <td><i>Altro</i><br>
          <textarea name="dati_altro" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['dati_altro'] ?>
</textarea></td>
      </tr>
    </table>
    <table>
      <tr>
        <td><b>Diagnosi</b><br>
          <textarea name="diagnosi" cols=40 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['diagnosi'] ?>
</textarea>
        </td>
        <td><b>Terapia</b><br>
          <textarea name="terapia" cols=60 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['terapia'] ?>
</textarea>
        </td>
      </tr>
    </table>
    </div>
    <div class="TabbedPanelsContent"> <br>
      <table>
        <tr>
          <td><i>Malattie ereditarie </i><br>
            <textarea name="malattia_ereditarie" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['malattia_ereditarie'] ?>
</textarea></td>
          <td><i>Padre</i><br>
            <textarea name="padre" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['padre'] ?>
</textarea></td>
          <td><i>Madre</i><br>
            <textarea name="madre" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['madre'] ?>
</textarea></td>
        </tr>
        <tr>
          <td><i>Coniuge, Compagno/a</i><br>
            <textarea name="coniuge" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['coniuge'] ?>
</textarea></td>
          <td><i>Figli</i><br>
            <textarea name="figli" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['figli'] ?>
</textarea></td>
          <td><i>Fratelli, Sorelle</i><br>
            <textarea name="fratelli" cols=30 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['fratelli'] ?>
</textarea></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent"> <br>
      <table>
        <tr>
          <td><i>Viaggi in paesi extraeuropei?</i><br>
            <textarea name="paesi_esteri" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['paesi_esteri'] ?>
</textarea></td>
          <td><i>Abitazione</i><br>
            <textarea name="abitazione" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['abitazione'] ?>
</textarea></td>
          <td><i>Attività lavorativa passata</i><br>
            <textarea name="lavoro_pregresso" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['lavoro_pregresso'] ?>
</textarea></td>
        </tr>
        <tr>
          <td><i>Attività lavorativa recente</i><br>
            <textarea name="lavoro_presente" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['lavoro_presente'] ?>
</textarea></td>
          <td><i>Attività lavorativa attuale</i><br>
            <textarea name="lavoro_attuale" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['lavoro_attuale'] ?>
</textarea></td>
          <td><i>Ambiente lavorativo</i><br>
            <textarea name="ambiente_lavoro" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['ambiente_lavoro'] ?>
</textarea></td>
        </tr>
        <tr>
          <td><i>Contatto con gas</i><br>
            <textarea name="gas_lavoro" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['gas_lavoro'] ?>
</textarea></td>
          <td><i>Contatto con sostanze tossiche</i><br>
            <textarea name="tossiche_lavoro" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['tossiche_lavoro'] ?>
</textarea></td>
          <td><i>Altri agenti tossici</i><br>
            <textarea name="conviventi" cols=30 rows=2 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['conviventi'] ?>
</textarea></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent"> <br>
      <table>
        <tr>
          <td>Nato prematuro?</td>
          <td><select name='prematuro'>
              <option name='Jo'<?php if (($occup)&&($row['prematuro']=="Jo")) echo "selected"; ?>>Si</option>
              <option name='Po' <?php if (($occup)&&($row['prematuro']=="Po")) echo "selected"; ?>>No</option>
            </select></td>
          <td>Parto eutocico</td>
          <td><select name='eutocico'>
              <option name='Jo' <?php if (($occup)&&($row['eutocico']=="Jo")) echo "selected"; ?>>Si</option>
              <option name='Po' <?php if (($occup)&&($row['eutocico']=="Po")) echo "selected"; ?>>No</option>
            </select></td>
          <td>Sviluppo neonatale normale</td>
          <td><select name='fisiologici_normali'>
              <option name='Jo' <?php if (($occup)&&($row['fisiologici_normali']=="Jo")) echo "selected"; ?>>Si</option>
              <option name='Po' <?php if (($occup)&&($row['fisiologici_normali']=="Po")) echo "selected"; ?>>No</option>
            </select></td>
          <td>Sviluppo tardivo</td>
          <td><select name='fisiologici_tardivi'>
              <option name='Jo' <?php if (($occup)&&($row['fisiologici_tardivi']=="Jo")) echo "selected"; ?>>Si</option>
              <option name='Po' <?php if (($occup)&&($row['fisiologici_tardivi']=="Po")) echo "selected"; ?>>No</option>
            </select></td>
        </tr>
        <tr>
          <td colspan='4'><i>Mestruazione</i><br>
            <textarea name="mestruazione" cols=30 rows=4 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['mestruazione'] ?>
</textarea></td>
          <td colspan='4'><i>Gravidanze</i><br>
            <textarea name="gravidanze" cols=30 rows=4 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['gravidanze'] ?>
</textarea></td>
        </tr>
        <tr>
          <td colspan='4'><i>Servizio Militare</i><br>
            <textarea name="militare" cols=30 rows=4 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['militare'] ?>
</textarea></td>
          <td colspan='4'><i>Droghe</i><br>
            <textarea name="droghe" cols=30 rows=4 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['droghe'] ?>
</textarea></td>
        </tr>
        <tr>
          <td>Alcool</td>
          <td><select name='alcolici'>
              <option name='Astemio' <?php if (($occup)&&($row['alcolici']=="Astemio")) echo "selected"; ?>>Astemio</option>
              <option name='Medio bevitore' <?php if (($occup)&&($row['alcolici']=="Medio bevitore")) echo "selected"; ?>>Medio bevitore</option>
              <option name='Forte bevitore' <?php if (($occup)&&($row['alcolici']=="Forte bevitore")) echo "selected"; ?>>Forte bevitore</option>
            </select></td>
          <td>Caffè Tè</td>
          <td><select name='caffe'>
              <option name='Non bevitore' <?php if (($occup)&&($row['caffe']=="Non bevitore")) echo "selected"; ?>>Non bevitore</option>
              <option name='Medio bevitore' <?php if (($occup)&&($row['caffe']=="Medio bevitore")) echo "selected"; ?>>Medio bevitore</option>
              <option name='Forte bevitore' <?php if (($occup)&&($row['caffe']=="Forte bevitore")) echo "selected"; ?>>Forte bevitore</option>
            </select></td>
          <td>Fumo</td>
          <td><select name='fumo'>
              <option name='Non fumatore' <?php if (($occup)&&($row['fumo']=="Non fumatore")) echo "selected"; ?>>Non fumatore</option>
              <option name='Medio fumatore' <?php if (($occup)&&($row['fumo']=="Medio fumatore")) echo "selected"; ?>>Medio fumatore</option>
              <option name='Forte fumatore' <?php if (($occup)&&($row['fumo']=="Forte fumatore")) echo "selected"; ?>>Forte fumatore</option>
              <option name='Ex fumatore' <?php if (($occup)&&($row['fumo']=="Ex fumatore")) echo "selected"; ?>>Ex fumatore</option>
            </select></td>
        </tr>
        <tr>
          <td>Sete</td>
          <td><select name='sete'>
              <option name='Normale' <?php if (($occup)&&($row['sete']=="Normale")) echo "selected"; ?>>Normale</option>
              <option name='Ridotta' <?php if (($occup)&&($row['sete']=="Ridotta")) echo "selected"; ?>>Ridotta</option>
              <option name='Aumentata' <?php if (($occup)&&($row['sete']=="Aumentata")) echo "selected"; ?>>Aumentata</option>
            </select></td>
          <td>Alvo</td>
          <td><select name='alvo'>
              <option name='Normale' <?php if (($occup)&&($row['alvo']=="Normale")) echo "selected"; ?>>Normale</option>
              <option name='Diarroico'<?php if (($occup)&&($row['alvo']=="Diarroico")) echo "selected"; ?>>Diarroico</option>
              <option name='Stitico'<?php if (($occup)&&($row['alvo']=="Stitico")) echo "selected"; ?>>Stitico</option>
              <option name='Tenesmo' <?php if (($occup)&&($row['alvo']=="Tenesmo")) echo "selected"; ?>>Tenesmo</option>
            </select></td>
          <td>Diuresi</td>
          <td><select name='diuresi'>
              <option name='Normale' <?php if (($occup)&&($row['diuresi']=="Normale")) echo "selected"; ?>>Normale</option>
              <option name='Scarsa' <?php if (($occup)&&($row['diuresi']=="Scarsa")) echo "selected"; ?>>Scarsa</option>
              <option name='Abbondante' <?php if (($occup)&&($row['diuresi']=="Abbondante")) echo "selected"; ?>>Abbondante</option>
            </select></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent"> <br>
      <textarea name="anamnesi_remota" cols=60 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['anamnesi_remota'] ?>
</textarea>
    </div>
    <div class="TabbedPanelsContent"> <br>
      <textarea name="anamnesi_prossima" cols=60 rows=5 wrap="physical" onKeyup="setChg()"><?php if ($occup) echo $row['anamnesi_prossima'] ?>
</textarea>
    </div>
    </div>
    </div>
    <script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
    <input type="text" name="personell_name" size=60 maxlength=60 value="<?php echo $_SESSION['sess_user_name']; ?>" readonly>
    <input type="hidden" name="sid" value="<?php echo $sid ?>">
    <input type="hidden" name="lang" value="<?php echo $lang ?>">
    <input type="hidden" name="station" value="<?php echo $station ?>">
    <input type="hidden" name="location_nr" value="<?php echo $location_nr; ?>">
    <?php if (isset($occup)) { ?>
    <input type="hidden" name="mode" value="update">
    <input type="hidden" name="nr" value="<?php echo $row['nr'] ?>">
    <?php } else { ?>
    <input type="hidden" name="mode" value="save">
    <?php } ?>
    <input type="hidden" name="pn" value="<?php echo $pn ?>">
    <input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
    <p>
      <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif') ?>>
  </form>
  <p> <a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
</ul>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
