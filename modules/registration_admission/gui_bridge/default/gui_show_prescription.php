<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
<?php

//gjergji

include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
$app_types=$pres_obj->getAppTypes();
$pres_types=$pres_obj->getPrescriptionTypes();

//end : gjergji

$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission

?>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['prescribe_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><?php echo $row['dosage']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php 
    			//gjergji
    			reset($app_types);
    			while(list($x,$v)=each($app_types)){
					if( $row['application_type_nr'] == $v['nr'] ) {
						if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
							else echo $v['name'];
							break;
					}
				}
				//end : gjergji    	
    ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td rowspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['drug_class']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['order_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php
    			//gjergji
    			reset($pres_types);
    			while(list($x,$v)=each($pres_types)){
    				if( $row['prescription_type_nr'] == $v['nr'] ) {  
						if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
							else echo $v['name'];
							break;
    				}
				}
    			//end : gjergji
    ?></td>

    <td><FONT SIZE=-1  FACE="Arial">&nbsp;</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>

<?php
}
?>
</table>

<?php
if($parent_admit&&!$is_discharged) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
