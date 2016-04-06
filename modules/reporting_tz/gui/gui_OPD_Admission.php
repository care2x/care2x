<?php
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>OPD Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo $LDOPDAdmissionSummary; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>

						  <br><br><br>
<form name="form1" method="post" action=""></p>
        <?php require_once($root_path.$top_dir.'include/inc_gui_timeframe_dept.php'); ?>
        <p><br>
          <br>
          <br>
        </p>
          
        <table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php //echo $LDDay; ?>Day</td>
            <td width="70" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDTotalOPD; ?>Total OPD</td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDNEW; ?>New</td>
            <td width="65" bgcolor="#ffffaa"><b><?php //echo $LDRETURN; ?>Return</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDUNDERFIVE; ?>NEW <5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDAge; ?>New >5</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDUNDERFIVE; ?>Return <5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDAge; ?>Return >5</td>
            
          </tr>

<?php
$dept=$_POST['dept'];
if($dept=='all'){
$department='';
}else{$department="AND current_dept_nr=$dept";}

//DEPARTMENT NAMES TO BE DISPLAYED
$dept_id=$_POST['dept'];
if($dept_id=='all'){
$dept_name='ALL DEPARTMENTS';
} else{
       $sql_get_dept="SELECT nr, name_formal FROM care_department WHERE nr=$dept";
       $get_dept=$db->Execute($sql_get_dept);
       while($row_dept=$get_dept->FetchRow()){
       $dept_name=$row_dept['name_formal'];
       }
 
  }
echo $dept_name;

$sql_dates="SELECT DATE_FORMAT(encounter_date,'%d.%m.%y') AS admission_date,COUNT(*) AS TOTAL_OPD FROM care_encounter WHERE DATE_FORMAT
(encounter_date,'%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' $department GROUP BY admission_date";
$dates_result=$db->Execute($sql_dates);









$db_ptr_date=$db->Execute($sql_date);


$sql_new="SELECT ce.encounter_date, COUNT( * ) AS NEW
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) = DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_new=$db->Execute($sql_new);

$sql_return="SELECT ce.encounter_date, COUNT( * ) AS R
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) > DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_return=$db->Execute($sql_return);

$sql_new_under_age="SELECT ce.encounter_date, COUNT( * ) AS NEW_UNDER_AGE
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) = DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_new_under_age=$db->Execute($sql_new_under_age);

$sql_new_over_age="SELECT ce.encounter_date, COUNT( * ) AS NEW_OVER_AGE
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) = DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5 AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_new_over_age=$db->Execute($sql_new_over_age);

$sql_return_under_age="SELECT ce.encounter_date, COUNT( * ) AS RETURN_UNDER_AGE
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) > DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_return_under_age=$db->Execute($sql_return_under_age);

$sql_return_over_age="SELECT ce.encounter_date, COUNT( * ) AS RETURN_OVER_AGE
      FROM care_encounter AS ce INNER JOIN care_person AS cp ON cp.pid = ce.pid 
      WHERE DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) > DATE_FORMAT( cp.date_reg,  '%Y-%m-%d' ) 
      AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5 AND DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' ) 
      BETWEEN  '$start' AND  '$end' $department GROUP BY DATE_FORMAT( ce.encounter_date,  '%Y-%m-%d' )";
$db_ptr_return_over_age=$db->Execute($sql_return_over_age);





$data=array();
while($row=$db_ptr_date->FetchRow()) {$data['date'][]=$row;}
while($row=$db_ptr_new->FetchRow()) {$data['NEW_PATIENT'][]=$row;}
while($row=$db_ptr_return->FetchRow()) {$data['RETURN_PATIENT'][]=$row;}
while($row=$db_ptr_new_under_age->FetchRow()) {$data['NEW_UNDER_AGE'][]=$row;}
while($row=$db_ptr_new_over_age->FetchRow()) {$data['NEW_OVER_AGE'][]=$row;}
while($row=$db_ptr_return_under_age->FetchRow()) {$data['RETURN_UNDER_AGE'][]=$row;}
while($row=$db_ptr_return_over_age->FetchRow()) {$data['RETURN_OVER_AGE'][]=$row;}

$count1=count($data['date']);
$count=$count1-1;

$total_opd=0;
$total_new=0;
$total_return=0;
$total_new_under_age=0;
$total_new_over_age=0;
$total_return_under_age=0;
$total_return_over_age=0;
for($i=0; $i<=$count; $i++){

$total_opd=$total_opd+$data['date'][$i]['AMOUNT_ENCOUTERS'];
$total_new=$total_new+$data['NEW_PATIENT'][$i]['NEW'];
$total_return=$total_return+$data['RETURN_PATIENT'][$i]['R'];
$total_new_under_age=$total_new_under_age+$data['NEW_UNDER_AGE'][$i]['NEW_UNDER_AGE'];
$total_new_over_age=$total_new_over_age+$data['NEW_OVER_AGE'][$i]['NEW_OVER_AGE'];
$total_return_under_age=$total_return_under_age+$data['RETURN_UNDER_AGE'][$i]['RETURN_UNDER_AGE'];
$total_return_over_age=$total_return_over_age+$data['RETURN_OVER_AGE'][$i]['RETURN_OVER_AGE'];

if(!isset($data['date'][$i]['AMOUNT_ENCOUTERS'])){$data['date'][$i]['AMOUNT_ENCOUTERS']=0;}
if(!isset($data['NEW_PATIENT'][$i]['NEW'])){$data['NEW_PATIENT'][$i]['NEW']=0;}
if(!isset($data['RETURN_PATIENT'][$i]['R'])){$data['RETURN_PATIENT'][$i]['R']=0;}
if(!isset($data['NEW_UNDER_AGE'][$i]['NEW_UNDER_AGE'])){$data['NEW_UNDER_AGE'][$i]['NEW_UNDER_AGE']=0;}
if(!isset($data['NEW_OVER_AGE'][$i]['NEW_OVER_AGE'])){$data['NEW_OVER_AGE'][$i]['NEW_OVER_AGE']=0;}
if(!isset($data['RETURN_UNDER_AGE'][$i]['RETURN_UNDER_AGE'])){$data['RETURN_UNDER_AGE'][$i]['RETURN_UNDER_AGE']=0;}
if(!isset($data['RETURN_OVER_AGE'][$i]['RETURN_OVER_AGE'])){$data['RETURN_OVER_AGE'][$i]['RETURN_OVER_AGE']=0;}


?>
<tr>
<?php echo '<td width="79" bgcolor="#ffffaa" widtd="220">'.$data['date'][$i]['REGISTRATION_DATE'].'</td>'; ?>
<?php echo '<td width="70" bgcolor="#ffffaa" widtd="70">'.$data['date'][$i]['AMOUNT_ENCOUTERS'].'</td>'; ?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['NEW_PATIENT'][$i]['NEW'].'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['RETURN_PATIENT'][$i]['R'].'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['NEW_UNDER_AGE'][$i]['NEW_UNDER_AGE'].'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['NEW_OVER_AGE'][$i]['NEW_OVER_AGE'].'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['RETURN_UNDER_AGE'][$i]['RETURN_UNDER_AGE'].'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$data['RETURN_OVER_AGE'][$i]['RETURN_OVER_AGE'].'</td>' ;?>

</tr>
<?php }    ?>
    
<tr>
<?php echo '<td width="70" bgcolor="#ffffaa" widtd="70"><b>total</b></td>'; ?>
<?php echo '<td width="70" bgcolor="#ffffaa" widtd="70">'.$total_opd.'</td>'; ?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_new.'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_return.'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_new_under_age.'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_new_over_age.'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_return_under_age.'</td>' ;?>
<?php echo '<td width="51" bgcolor="#ffffaa" widtd="32">'.$total_return_over_age.'</td>' ;?>
</tr>

        </table>
</form>
						  


        <p>&nbsp; </p>

<?php
exit();
}
?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
	}
	function printOut()
    {
    	urlholder="./OPD_Admissions.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
    }

// -->

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>


</HEAD>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT -->


<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingOPDAdmissionSummary; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
  </td>
 </tr>
 </table>


<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action=""></p>
        <?php require_once($root_path.$top_dir.'include/inc_gui_timeframe_dept.php'); ?>
        <p><br>
          <br>
          <br>
        </p>
            
        <table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php //echo $LDDay; ?>Day</td>
            <td width="70" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDTotalOPD; ?>Total OPD</td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDNEW; ?>New</td>
            <td width="65" bgcolor="#ffffaa"><b><?php //echo $LDRETURN; ?>Return</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDUNDERFIVE; ?>NEW <5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDAge; ?>New >5</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDUNDERFIVE; ?>Return <5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDAge; ?>Return >5</td>
            
            
          </tr>

<?php

$dept=$_POST['dept'];
if($dept=='all'){
$department='';
}else{$department="AND current_dept_nr=$dept";}

//DEPARTMENT NAMES TO BE DISPLAYED
$dept_id=$_POST['dept'];
if($dept_id=='all'){
$dept_name='ALL DEPARTMENTS';
} else{
       $sql_get_dept="SELECT nr, name_formal FROM care_department WHERE nr=$dept";
       $get_dept=$db->Execute($sql_get_dept);
       while($row_dept=$get_dept->FetchRow()){
       $dept_name=$row_dept['name_formal'];
       }
 
  }
$TOTAL_OPD=0;
$TOTAL_NEW=0;
$TOTAL_RETURN=0;
$TOTAL_NEW_UNDER_AGE=0;
$TOTAL_NEW_OVER_AGE=0;
$TOTAL_RETURN_UNDER_AGE=0;
$TOTAL_RETURN_OVER_AGE=0;


echo $dept_name;
//RETURN DATE AND TOTAL OPD
$sql_dates="SELECT DATE_FORMAT(encounter_date,'%d.%m.%y') AS admission_date,COUNT(*) AS TOTAL_OPD FROM care_encounter WHERE DATE_FORMAT
(encounter_date,'%Y-%m-%d') BETWEEN '$startdate' AND '$enddate' $department GROUP BY admission_date";
$dates_result=$db->Execute($sql_dates);







$dates=array();
while($rs_dates=$dates_result->FetchRow()){$dates['dates'][]=$rs_dates;}
$count=count($dates['dates']);


for($i=0; $i<$count; $i++){



//NEW
$sql_new="SELECT COUNT(*) AS NEW,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM care_encounter AS ce INNER JOIN care_person AS 
cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')=DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND DATE_FORMAT   
(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";


$result_new=$db->Execute($sql_new);
	if($rs_new=$result_new->FetchRow()){
	$new=$rs_new['NEW'];

	}else{
		$new=0;
		      }


//RETURN
$sql_return="SELECT COUNT(*) AS RETURN_PATIENT,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM care_encounter AS ce INNER JOIN care_person AS 

cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')>DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND DATE_FORMAT   

(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";
$result_new=$db->Execute($sql_return);
	if($rs_return=$result_new->FetchRow()){
	$return=$rs_return['RETURN_PATIENT'];


	}else{
		$return=0;
		      }





//NEW UNDER AGE
$sql_new_under_age="SELECT COUNT(*) AS NEW_UNDER_AGE,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM care_encounter AS ce INNER JOIN care_person AS 
cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')=DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND (DATE_FORMAT(ce.encounter_date , '%Y-%m-%d' ) - DATE_FORMAT( date_birth, '%Y-%m-%d' ))<5 AND DATE_FORMAT   
(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";




$result_new_under_age=$db->Execute($sql_new_under_age);
	if($rs_new_under_age=$result_new_under_age->FetchRow()){
	$new_under_age=$rs_new_under_age['NEW_UNDER_AGE'];

	}else{
		$new_under_age=0;
		      }

//NEW OVER AGE
$sql_new_over_age="SELECT COUNT(*) AS NEW_OVER_AGE,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM care_encounter AS ce INNER JOIN care_person AS 
cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')=DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND (DATE_FORMAT(ce.encounter_date , '%Y-%m-%d' ) - DATE_FORMAT( date_birth, '%Y-%m-%d' ))>5 AND DATE_FORMAT   
(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";




$result_new_over_age=$db->Execute($sql_new_over_age);
	if($rs_new_over_age=$result_new_over_age->FetchRow()){
	$new_over_age=$rs_new_over_age['NEW_OVER_AGE'];

	}else{
		$new_over_age=0;
		      }

//RETURN UNDER AGE
$sql_return_under_age="SELECT COUNT(*) AS RETURN_UNDER_AGE,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM 
care_encounter AS ce INNER JOIN care_person AS 
cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')>DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND (DATE_FORMAT
(ce.encounter_date , '%Y-%m-%d' ) - DATE_FORMAT( date_birth, '%Y-%m-%d' ))<5 AND DATE_FORMAT   
(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";




$result_return_under_age=$db->Execute($sql_return_under_age);
	if($rs_return_under_age=$result_return_under_age->FetchRow()){
	$return_under_age=$rs_return_under_age['RETURN_UNDER_AGE'];

	}else{
		$return_under_age=0;
		      }

//RETURN OVER AGE
$sql_return_over_age="SELECT COUNT(*) AS RETURN_OVER_AGE,DATE_FORMAT(ce.encounter_date,'%Y-%m-%d') AS enrollment_date FROM care_encounter 
AS ce INNER JOIN care_person AS 
cp ON ce.pid=cp.pid WHERE DATE_FORMAT(ce.encounter_date,'%Y-%m-%d')>DATE_FORMAT(cp.date_reg,'%Y-%m-%d') AND (DATE_FORMAT
(ce.encounter_date , '%Y-%m-%d' ) - DATE_FORMAT( date_birth, '%Y-%m-%d' ))>5 AND DATE_FORMAT   
(ce.encounter_date,'%d.%m.%y')='".$dates['dates'][$i]['admission_date']."' $department GROUP BY enrollment_date";
$result_return_over_age=$db->Execute($sql_return_over_age);
	if($rs_return_over_age=$result_return_over_age->FetchRow()){
	$return_over_age=$rs_return_over_age['RETURN_OVER_AGE'];

	}else{
	     $return_over_age=0;
                     }


?>
<table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php echo $dates['dates'][$i]['admission_date'];?></td>
            <td width="70" bgcolor="#ffffaa" widtd="32"><b><?php echo $dates['dates'][$i]['TOTAL_OPD'];  ?></td>

            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php echo $new; ?></td>
            <td width="65" bgcolor="#ffffaa"><b><?php echo $return; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo $new_under_age; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo $new_over_age; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo $return_under_age; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo $return_over_age; ?></td>
            
          </tr>
<?php
$TOTAL_OPD                 =$TOTAL_OPD+$dates['dates'][$i]['TOTAL_OPD']; 
$TOTAL_NEW                 =$TOTAL_NEW+$new;
$TOTAL_RETURN              =$TOTAL_RETURN+$return;
$TOTAL_NEW_UNDER_AGE       =$TOTAL_NEW_UNDER_AGE+$new_under_age;
$TOTAL_NEW_OVER_AGE        =$TOTAL_NEW_OVER_AGE+$new_over_age;
$TOTAL_RETURN_UNDER_AGE    =$TOTAL_RETURN_UNDER_AGE+$return_under_age;
$TOTAL_RETURN_OVER_AGE     =$TOTAL_RETURN_OVER_AGE+$return_over_age;

}
?>
<tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b>SUM:</td>

            <td width="70" bgcolor="#ffffaa" widtd="32"><b><?php echo $TOTAL_OPD;  ?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php echo $TOTAL_NEW; ?></td>
            <td width="65" bgcolor="#ffffaa"><b><?php echo $TOTAL_RETURN; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo $TOTAL_NEW_UNDER_AGE; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo $TOTAL_NEW_OVER_AGE; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo $TOTAL_RETURN_UNDER_AGE; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo $TOTAL_RETURN_OVER_AGE; ?></td>
            
          </tr>
</table>











<!--<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a>--><br>					  

        <p>&nbsp; </p>
       					


<!-- START BOTTIOM OF HTML CONTENT --->
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {

						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

					}
					//  Script End -->
					</script>


					 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</body>
